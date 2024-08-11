<?php
// Include the database connection file
include '../php/db_connect.php';

// Get the search query from the URL
$search_query = isset($_GET['query']) ? trim($_GET['query']) : '';

// Fetch matching books from the database
$sql = "SELECT id, title, author_name, cover_photo, genre, isbn, description, price FROM books WHERE title LIKE ? OR author_name LIKE ?";
$stmt = $conn->prepare($sql);
$search_param = "%" . $search_query . "%";
$stmt->bind_param("ss", $search_param, $search_param);
$stmt->execute();
$result = $stmt->get_result();

$books = [];
while ($row = $result->fetch_assoc()) {
    $books[] = $row;
}

$stmt->close();
$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search Results</title>
    <link rel="stylesheet" href="styles.css" />
    <style>
        img{
            width: 20%;
        }
    </style>
</head>
<body>
    <h1>Search Results for "<?php echo htmlspecialchars($search_query); ?>"</h1>
    <?php if (count($books) > 0): ?>
        <ul>
            <?php foreach ($books as $book): ?>
                <li>
                    <a href="book_details.php?id=<?php echo $book['id']; ?>">
                        <img src="<?php echo htmlspecialchars($book['cover_photo']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>">
                        <span><?php echo htmlspecialchars($book['title']); ?></span>
                        <span><?php echo htmlspecialchars($book['author_name']); ?></span>
                        <span>$<?php echo htmlspecialchars($book['price']); ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No books found matching your query.</p>
    <?php endif; ?>
</body>
</html>
