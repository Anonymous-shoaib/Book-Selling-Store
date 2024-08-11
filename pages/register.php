<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../php/db_connect.php'; // Include the database connection file

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
    $role = "user"; // Default role is 'user'

    // Check if username or email already exists
    $check_user_query = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($check_user_query);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User already exists
        $error_message = "Username or email already exists. Please choose another.";
    } else {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);

        if ($stmt->execute()) {
            header("Location: login.php"); // Redirect to login page after successful registration
            exit();
        } else {
            $error_message = "Error: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <link rel="stylesheet" href="../css/register-login.css">
</head>
<body>
    <div class="form-container">
        <h2 style="display: flex; justify-content: space-between; align-items: center;">Signup <img style="width: 15%;" src="../assets/images/booksvector.jpg" alt=""></h2>
        <form action="" method="POST">
            <?php if (isset($error_message)): ?>
                <p style="color: red;"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter username" required>
            
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter email" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter password" required>

            <h4>Already have an account? <a href="login.php">login</a></h4>
            
            <button type="submit">Sign Up</button>
        </form>
    </div>
</body>
</html>
