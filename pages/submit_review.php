<?php
// Include the database connection file
include '../php/db_connect.php';

session_start(); // Start session to manage user login state

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if user_id and username are set in the session
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
        echo "User not logged in.";
        exit;
    }

    // Get the logged-in user's ID and name from the session
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['username'];

   
    // Get the book_id from the form
    $book_id = isset($_POST['book_id']) ? $_POST['book_id'] : null;
    if (!$book_id) {
        echo "Book ID is missing.";
        exit;
    }
    

    // Get the current date and time
    $review_date = date('Y-m-d H:i:s');

    // Get the comment and rating from the form
    $comment = isset($_POST['comments']) ? $_POST['comments'] : '';
    $rating = isset($_POST['rating']) ? intval($_POST['rating']) : null;
    if (!$rating) {
        echo "Rating is required.";
        exit;
    }

    // Prepare and bind the statement
    $sql = "INSERT INTO reviews (user_id, user_name, book_id, review_date, comment, rating) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isisss", $user_id, $user_name, $book_id, $review_date, $comment, $rating);

    // Execute and check for success
 
   if ($stmt->execute()) {
    // Redirect to the book details page after successful submission
    header("Location: book_details.php?id=" . $book_id);
    exit;
} else {
    echo "Error: " . $stmt->error;
}

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
