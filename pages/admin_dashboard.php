<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>

<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Include the database connection file
    include '../php/db_connect.php';

     // Sanitize and validate form inputs
    $title = $conn->real_escape_string($_POST['book-title']);
    $genre = $conn->real_escape_string($_POST['genre']);
    $isbn = $conn->real_escape_string($_POST['isbn']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = $conn->real_escape_string($_POST['price']);
    $author_name = $conn->real_escape_string($_POST['author-name']);
    $author_description = $conn->real_escape_string($_POST['author-description']);

    // Check for duplicate title
    $check_sql = "SELECT COUNT(*) AS count FROM books WHERE title = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $title);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    $check_row = $check_result->fetch_assoc();

    if ($check_row['count'] > 0) {
        $message = "Error: A book with this title already exists.";
    } else {
        // Handle file uploads
        $cover_photo = '';
        $pdf_file = '';

        if (isset($_FILES['cover-photo']) && $_FILES['cover-photo']['error'] == UPLOAD_ERR_OK) {
            $cover_photo = 'uploads/' . basename($_FILES['cover-photo']['name']);
            move_uploaded_file($_FILES['cover-photo']['tmp_name'], $cover_photo);
        }

        if (isset($_FILES['pdf-file']) && $_FILES['pdf-file']['error'] == UPLOAD_ERR_OK) {
            $pdf_file = 'uploads/' . basename($_FILES['pdf-file']['name']);
            move_uploaded_file($_FILES['pdf-file']['tmp_name'], $pdf_file);
        }

        // Insert data into the database
        $sql = "INSERT INTO books (title, genre, isbn, description, price, cover_photo, pdf_file, author_name, author_description)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssss", $title, $genre, $isbn, $description, $price, $cover_photo, $pdf_file, $author_name, $author_description);

        if ($stmt->execute()) {
            $message = "Book information saved successfully!";
        } else {
            $message = "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $check_stmt->close();
    $conn->close();
}
?>

<?php include '../php/header.php'; ?>

<div class="container-33">
        <div class="search-for-1">
        Admin Dashboard
        </div>





        
        <div class="search-for-1">
          <h2 style="font-size: 1rem;">Upload a Book</h2>
      </div>

      </div>
      
      <form class="book-upload-form" action="#" method="post" enctype="multipart/form-data">
        <div class="container-13">
            <label class="search-for-4" for="book-title">Book Title</label>
            <input type="text" id="book-title" name="book-title" required>
        </div>
        <div class="container-6">
            <div class="container-21">
                <label class="search-for-8" for="genre">Genre</label>
                <input type="text" id="genre" name="genre" required>
            </div>
            <div class="container-17">
                <label class="search-for-11" for="isbn">ISBN</label>
                <input type="text" id="isbn" name="isbn" required>
            </div>
        </div>
        <div class="container-12">
            <label class="search-for-9" for="description">Description</label>
            <textarea id="description" name="description" rows="12" required></textarea>
        </div>
        <div class="container-11">
            <label class="search-for-7" for="price">Price in Dollars</label>
            <input type="number" id="price" name="price" step="0.01" required>
        </div>
        <div class="container-9">
            <div class="container-23">
                <label class="custom-file-upload">
                    <label class="search-for-10" for="cover-photo">Upload Cover Photo</label>
                    <input type="file" id="cover-photo" name="cover-photo" accept="image/*" required>
                </label>
            </div>
            <div class="container-23" style="background:#FBD9C1">
                <label class="custom-file-upload" style="background:#FBD9C1" >
                    <label class="search-for-10" for="pdf-file" style="color:black" >Upload PDF File</label>
                    <input type="file" id="pdf-file" name="pdf-file" accept="application/pdf" required>
                </label>
            </div>
        </div>
        <div class="search-for-3">
            <h2>About Author</h2>
        </div>
        <div class="container-18">
            <label class="search-for-5" for="author-name">Author Name</label>
            <input type="text" id="author-name" name="author-name" required>
        </div>
        <div class="container-3">
            <label class="search-for-6" for="author-description">Author Description</label>
            <textarea id="author-description" name="author-description" rows="10" required></textarea>
        </div>
        <div class="container-24">
            <button type="submit" class="search-for-13">Publish</button>
        </div>
    </form>

      <?php include '../php/footer.php'; ?>
