<?php
session_start(); // Start the session

// Unset all of the session variables
$_SESSION = array();

// If you want to destroy the session cookie, you need to set the expiration date in the past
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session
session_destroy();

// Redirect to the login page or homepage
header("Location: ../pages/login.php");
exit();
?>
