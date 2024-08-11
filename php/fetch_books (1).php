<?php
function fetch_books() {
    include 'db_connect.php';

    $sql = "SELECT * FROM books"; // Adjust query based on your table structure
    $result = $conn->query($sql);

    $books = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $books[] = $row;
        }
    }
    $conn->close();
    return $books;
}
?>
