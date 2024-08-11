<?php
session_start();

if (isset($_SESSION['username'])) {
    // User is logged in, redirect to profile page
    header("Location: profile.php");
} else {
    // User is not logged in, redirect to login page
    header("Location: login.php");
}
exit();
?>
