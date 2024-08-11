<?php
session_start(); // Start session to manage user login state

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../php/db_connect.php'; // Include the database connection file

    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id']; // Store user ID
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == 'admin') {
                header("Location: admin_dashboard_1.php"); // Redirect to admin page
            } else {
                header("Location: homepage.php"); // Redirect to user homepage
            }
            exit();
        } else {
            $error_message = "Invalid email or password.";
        }
    } else {
        $error_message = "Invalid email or password.";
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
    <title>Login Form</title>
    <link rel="stylesheet" href="../css/register-login.css">
</head>
<body>
    <div class="form-container">
        <h2 style="display: flex;justify-content:space-between;align-items: center;">Login <img style="width: 20%;" src="../assets/images/booksvector.jpg" alt=""></h2>
        <form action="" method="POST">
            <?php if (isset($error_message)): ?>
                <p style="color: red;"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter email" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter password" required>

            <h4>New member? <a href="register.php">Register</a></h4>
            
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
