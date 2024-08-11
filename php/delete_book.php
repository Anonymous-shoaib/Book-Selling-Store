<?php
// Include the database connection file
include '../php/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['book_id'])) {
    $book_id = intval($_POST['book_id']);
    
    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("DELETE FROM books WHERE id = ?");
    $stmt->bind_param("i", $book_id);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Book deleted successfully!'); window.location.href = document.referrer;</script>";
    } else {
        echo "<script>alert('Error deleting book: " . $stmt->error . "'); window.location.href = document.referrer;</script>";
    }
    
    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>