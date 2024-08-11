<?php
// Include the database connection file
include '../php/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $mobile_number = $_POST['mobile-number'];
    $email = $_POST['email'];
    $zip_code = $_POST['zip-code'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment'];
    $book_id = $_POST['book-id'];
    $book_price = $_POST['book-price'];
    $shipping_fee = 50;
    $subtotal = $book_price + $shipping_fee;

    // Store in the database
    $sql = "INSERT INTO orders (first_name, last_name, mobile_number, email, zip_code, address, payment_method, book_id, subtotal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssii", $first_name, $last_name, $mobile_number, $email, $zip_code, $address, $payment_method, $book_id, $subtotal);
    $stmt->execute();
    
    // Get the last inserted order ID
     $order_id = $stmt->insert_id;

    // Send email
    $to = "oseintilegacycentre@gmail.com";
    $subject = "New Order Received";
    $message = "
    <html>
    <head>
    <title>New Order Received</title>
    </head>
    <body>
    <h2>New Order Details</h2>
    <p><strong>First Name:</strong> $first_name</p>
    <p><strong>Last Name:</strong> $last_name</p>
    <p><strong>Mobile Number:</strong> $mobile_number</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Zip Code:</strong> $zip_code</p>
    <p><strong>Address:</strong> $address</p>
    <p><strong>Payment Method:</strong> $payment_method</p>
    <p><strong>Book ID:</strong> $book_id</p>
    <p><strong>Book Price:</strong> $$book_price</p>
    <p><strong>Shipping Fee:</strong> $$shipping_fee</p>
    <p><strong>Subtotal:</strong> $$subtotal</p>
    </body>
    </html>
    ";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <no-reply@yourdomain.com>' . "\r\n";

    mail($to, $subject, $message, $headers);

    // Close the connection
    $stmt->close();
    $conn->close();

    // Redirect to the checkout confirmation page
    header("Location: checkout_confirmation.php?payment_method=$payment_method&book_id=$book_id");
    exit();
}
?>
