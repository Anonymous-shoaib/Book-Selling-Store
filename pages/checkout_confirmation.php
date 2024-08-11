<?php
// Include the database connection file
include '../php/db_connect.php';

// Get the book ID and payment method from the URL
$book_id = isset($_GET['book_id']) ? intval($_GET['book_id']) : 0;
$payment_method = isset($_GET['payment_method']) ? htmlspecialchars($_GET['payment_method']) : '';
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

// Fetch the book details from the database
$sql = "SELECT id, title, author_name, cover_photo, genre, isbn, description, price, author_description FROM books WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout Confirmation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="cart_screen_1.css" />
    <style>
        body {
            font-family: Poppins;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: end;
            background: url(../assets/images/confirmbg.png);
            background-repeat: no-repeat;
            background-size: cover;
        }
        .book-price {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            overflow-wrap: break-word;
            font-family: 'Poppins';
            font-weight: 400;
            font-size: 14px;
            color: gray;
        }
        .checkout {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .container-3 {
            color: black;
        }
        p {
            font-size: 12px;
            color: gray;
            width: 70%;
        }
        p b {
            color: black;
        }
        button {
            background-color: orange;
            border: none;
            border-radius: 30px;
            color: white;
            padding: 20px 100px;
            cursor: pointer;
        }
        .btn {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .checkout-confirmation {
            background-color: white;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0px 0px 30px gray;
            opacity: 0;
            transform: translateY(100%);
            animation: slideUp 0.5s ease-out forwards;
            width: 100%;
        }
        @keyframes slideUp {
            0% {
                transform: translateY(100%);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
<?php if ($book):
    // Calculate the shipping fee and subtotal
    $shipping_fee = 50;
    $subtotal = $book['price'] + $shipping_fee;
    ?>
    <div class="checkout-confirmation">
        <div class="section-2">
            <div class="checkout">
                <h2>Checkout</h2>
                <i class="fa-solid fa-xmark"></i>
            </div>
            <div class="line-4">
                <hr>
            </div>
            <span class="book-price">
                Payment Method
                <span class="container-3">
                    <?php echo htmlspecialchars($payment_method); ?>
                </span>
            </span>
            <span class="book-price">
                Delivery
                <span class="container-3">
                    $<?php echo htmlspecialchars($shipping_fee); ?>
                </span>
            </span>
            <span class="book-price">
                Price
                <span class="container-3">
                    $<?php echo htmlspecialchars($book['price']); ?>
                </span>
            </span>
            <span class="book-price">
                Sub Total
                <span class="container-3">
                    $<?php echo htmlspecialchars($subtotal); ?>
                </span>
            </span>
        </div>
        <div class="btn">
            <?php if ($payment_method === 'paypal'): ?>
                <div id="paypal-button-container"></div>
                <script src="https://www.paypal.com/sdk/js?client-id=AXbsTU-BrVrrvJ7hcWlm1IPoE4iJ634XLyElDUjv8AL9EPAw3mNO0fJmm90H9VsQPym7ulMbzfsqQi_R&currency=USD"></script>
                <script>
    paypal.Buttons({
        fundingSource: paypal.FUNDING.PAYPAL,
        createOrder: function(data, actions) {
            return fetch('paypal_payment.php', {
                method: 'post',
                headers: {
                    'content-type': 'application/json'
                },
                body: JSON.stringify({
                    subtotal: <?php echo $subtotal; ?>
                })
            }).then(function(res) {
                if (!res.ok) {
                    return res.json().then(function(data) {
                        throw new Error('Network response was not ok: ' + JSON.stringify(data));
                    });
                }
                return res.json();
            }).then(function(data) {
                if (!data.id) {
                    throw new Error('Payment ID not returned: ' + JSON.stringify(data));
                }
                return data.id; // Use the payment id from the server
            }).catch(function(err) {
                console.error('Error:', err);
                alert('An error occurred while creating the order. Please try again.');
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                alert('Transaction completed by ' + details.payer.name.given_name);
                window.location.href = 'payment_success.php?order_id=<?php echo $order_id; ?>';
            });
        },
        onError: function(err) {
            console.error('Error:', err);
            alert('An error occurred during the transaction. Please try again.');
        }
    }).render('#paypal-button-container');
    // Display payment options on your web page
</script>

            <?php else: ?>
                <button id="payment-button">Confirm Order</button>
            <?php endif; ?>
        </div>
        <p>By placing an order you agree to our <b>Terms</b> and <b>Conditions</b></p>
    </div>
    <script>
        document.getElementById('payment-button').addEventListener('click', function() {
            var paymentMethod = "<?php echo htmlspecialchars($payment_method); ?>";
            if (paymentMethod === 'mastercard') {
                window.location.href = 'https://www.mastercard.com';
            } else if (paymentMethod === 'googlepay') {
                window.location.href = 'https://pay.google.com';
            } else if (paymentMethod === 'applepay') {
                window.location.href = 'https://www.apple.com/apple-pay/';
            }
        });
    </script>
<?php else: ?>
    <p>Book not found.</p>
<?php endif; ?>

<script>document.querySelector('.fa-solid.fa-xmark').addEventListener('click', function() {
    if (document.referrer) {
        window.history.back(); // Goes to the previous page in the browser history
    } else {
        window.close(); // Closes the current window if there's no previous page
    }
});
</script>
</body>
</html>
