<?php
// Include the database connection file
include '../php/db_connect.php';

// Get the book ID from the URL
$book_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

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
    <title>Cart screen</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="cart_screen_1.css" />
  </head>
  <body>
  <?php if ($book): 
      // Calculate the shipping fee and subtotal
      $shipping_fee = 50;
      $subtotal = $book['price'] + $shipping_fee;
  ?>
    <div class="cart-screen-1">

      <div class="arrow-left">
        <img class="vector-28" src="../assets/vectors/vector_19_x2.svg" />
        <span class="book-name">
        <?php echo htmlspecialchars($book['title']); ?>
          </span>
      </div>

      <div class="section-1" style="display: flex;">
        <div class="rectangle-336">
          <img src="<?php echo htmlspecialchars($book['cover_photo']); ?>" alt="">
        </div>

        <div class="group-1171276994">
          <span class="book-name-1">
          <?php echo htmlspecialchars($book['title']); ?>
          </span>
          <p class="category-cat">
          <span class="category-cat-sub-9">category: <?php echo htmlspecialchars($book['genre']); ?></span>
          </p>
          <div class="group-1171276976">
            <img class="star-1" src="../assets/vectors/star_11_x2.svg" />
            <img class="star-2" src="../assets/vectors/star_22_x2.svg" />
            <img class="star-4" src="../assets/vectors/star_4_x2.svg" />
            <img class="star-5" src="../assets/vectors/star_51_x2.svg" />
            <img class="star-3" src="../assets/vectors/star_32_x2.svg" />
          </div>
          <span class="container-1">
          $<?php echo htmlspecialchars($book['price']); ?>
          </span>
        </div>
      </div>

      <div class="section-2">
        <span class="book-price">
          Book Price
          <span class="container-3">
          $<?php echo htmlspecialchars($book['price']); ?>
            </span>
          </span>
        
        <span class="book-price">
        Shipping Fee
        <span class="container-3">
          $<?php echo htmlspecialchars($shipping_fee); ?>
          </span>
        </span>
        
        <div class="line-4">
          <hr>
        </div>

        <span class="book-price">
        Sub Total
        <span class="container-3">
          $<?php echo htmlspecialchars($subtotal); ?>
          </span>
        </span>
      </div>

      <div class="section-3">
      <form class="payment-form" id="payment-form" method="POST" action="process_payment.php">
    <input type="hidden" name="book-id" value="<?php echo htmlspecialchars($book['id']); ?>">
    <input type="hidden" name="book-price" value="<?php echo htmlspecialchars($book['price']); ?>">
          <div class="group-1171277002">
              <div class="group-1171277000">
                  <label class="first-name-label" for="first-name"></label>
                  <input type="text" id="first-name" name="first-name" class="first-name-input" placeholder="First Name" required>
              </div>
              <div class="group-1171277001">
                  <input type="text" id="last-name" name="last-name" class="last-name-input" placeholder="Last Name" required>
              </div>
          </div>
          <div class="group-1171276999">
              <input type="tel" id="mobile-number" name="mobile-number" class="mobile-number-input" placeholder="Mobile Number" required>
          </div>
          <div class="group-1171276998">
              <input type="email" id="email" name="email" class="email-input" placeholder="Email" required>
          </div>
          <div class="group-1171276997">
              <input type="text" id="zip-code" name="zip-code" class="zip-code-input" placeholder="Zip Code" required>
          </div>
          <div class="group-1171276996">
              <input type="text" id="address" name="address" class="address-input" placeholder="Address" required>
          </div>

          <div class="select-apayment-method">
              Select a Payment Method :
          </div>
          <div class="payment-options">
              <label class="option">
                  <input type="radio" name="payment" value="paypal" checked>
                  <div class="content">
                      <img class="group" src="../assets/vectors/group_2_x2.svg" />
                      <div class="paypal">Paypal</div>
                  </div>
              </label>
              <label class="option">
                  <input type="radio" name="payment" value="mastercard">
                  <div class="content">
                      <img class="mastercard-full-svgrepo-com-2" src="../assets/vectors/mastercard_full_svgrepo_com_22_x2.svg" />
                      <div class="master-card">Master card</div>
                  </div>
              </label>
              <label class="option">
                  <input type="radio" name="payment" value="googlepay">
                  <div class="content">
                      <img class="google-pay-svgrepo-com-1" src="../assets/vectors/google_pay_svgrepo_com_1_x2.svg" />
                      <div class="google">Google</div>
                  </div>
              </label>
              <label class="option">
                  <input type="radio" name="payment" value="applepay">
                  <div class="content">
                      <img class="vector-13" src="../assets/vectors/vector_26_x2.svg" />
                      <span class="apple-pay">Apple Pay</span>
                  </div>
              </label>
          </div>

          <button type="submit" class="submit-button">Continue</button>
      </form>
    </div>

    </div>

    
    <?php else: ?>
    <p>Book not found.</p>
    <?php endif; ?>
    
    <script>
      document.querySelector('.arrow-left').addEventListener('click', function() {
    if (document.referrer) {
        window.history.back(); // Goes to the previous page in the browser history
    } else {
        window.close(); // Closes the current window if there's no previous page
    }
});

    </script>
    </body>
</html>
