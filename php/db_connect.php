<?php
$servername = "localhost"; // Change if your MySQL server is hosted somewhere else
$username = "connerld_root"; // Change this if you have a different MySQL username
$password = "310088310088Klm"; // Change this if you have a MySQL password
$dbname = "connerld_book_store"; // Make sure this matches the name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
