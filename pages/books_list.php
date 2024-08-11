<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>

<?php
// Include the database connection file
include '../php/db_connect.php';

// Fetch all books from the database
$sql = "SELECT id, title, author_name, cover_photo FROM books";
$result = $conn->query($sql);

// Check if there are books to display
$books = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}
$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book List</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.book-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    padding: 20px;
}

.book-item {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin: 10px;
    padding: 10px;
    width: 200px; /* Adjust as needed */
    text-align: center;
}

.book-item img {
    width: 100%;
    height: auto;
    border-radius: 4px;
    object-fit: cover;
}

.book-details {
    margin-top: 10px;
}

.book-details h3 {
    font-size: 1.2em;
    margin: 0;
    color: #333;
}

.book-details p {
    font-size: 1em;
    margin: 5px 0 0;
    color: #666;
}

    </style>
</head>
<body>
<?php include '../php/header.php'; ?>
<div class="book-list">
        <?php if (!empty($books)): ?>
            <?php foreach ($books as $book): ?>
            <a href="book_details.php?id=<?php echo $book['id']; ?>" class="book-item-link">
                <div class="book-item">
                    <img src="<?php echo htmlspecialchars($book['cover_photo']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>">
                    <div class="book-details">
                        <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                        <p><?php echo htmlspecialchars($book['author_name']); ?></p>
                    </div>
                    
                </div>
            </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No books available.</p>
        <?php endif; ?>
    </div>
</body>
</html>
