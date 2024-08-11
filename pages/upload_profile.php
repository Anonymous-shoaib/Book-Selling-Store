<?php
session_start();
include '../php/db_connect.php'; // Include your database connection file

// Initialize message variable
$_SESSION['message'] = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $profile_image = $_FILES['profile_image'];

        // Define the upload directory and file path
        $upload_dir = 'uploads/';
        $upload_file = $upload_dir . basename($profile_image['name']);

        // Ensure the upload directory exists
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // Validate file type and size (optional)
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($profile_image['type'], $allowed_types)) {
            $_SESSION['message'] = "Error: Invalid file type.";
            header("Location: profile.php"); // Redirect to profile page
            exit();
        }
        if ($profile_image['size'] > 2000000) { // Limit file size to 2MB
            $_SESSION['message'] = "Error: File size exceeds the maximum limit.";
            header("Location: profile.php"); // Redirect to profile page
            exit();
        }

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($profile_image['tmp_name'], $upload_file)) {
            $profile_image_path = $upload_file;

            // Update the user's profile image path in the database
            $stmt = $conn->prepare("UPDATE users SET profile = ? WHERE username = ?");
            $stmt->bind_param("ss", $profile_image_path, $_SESSION['username']); // Assuming username is stored in session

            if ($stmt->execute()) {
                $_SESSION['message'] = "Profile image updated successfully.";
            } else {
                $_SESSION['message'] = "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $_SESSION['message'] = "Error: File upload failed.";
        }
    } else {
        $_SESSION['message'] = "Error: No file uploaded or upload error.";
    }

    $conn->close();
    header("Location: profile.php"); // Redirect to profile page
    exit();
}
?>
