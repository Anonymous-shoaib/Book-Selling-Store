<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
 
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 40px;
            background-color: orange;
            color: white;
        }

        header h4:hover {
            color: red;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .profile-form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            height: 300px;
            margin: 20px auto;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .profile-form label {
            display: block;
            font-size: 16px;
            margin-bottom: 10px;
            color: #333;
        }

        .profile-form input[type="file"] {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .profile-form button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .profile-form button:hover {
            background-color: #0056b3;
        }

        footer{
            text-align: center;
        }
        
         .track-feedback{
            padding-top: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 40px;
        }
        
        .track-feedback a{

            background-color: #F18231;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
    </style>
</head>
<body>
   
    
    <?php
    if (isset($_SESSION['message']) && $_SESSION['message'] != '') {
        echo '<p>' . $_SESSION['message'] . '</p>';
        // Clear the message after displaying
        unset($_SESSION['message']);
    }
    ?>

    <!-- Your profile page content -->

    <header>
        <h1>Edit Profile</h1>
        <a href="../php/logout.php"><h4>logout</h4></a>
    </header>
    
    <?php
    // Check if the user is logged in and not an admin
    if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] != 'admin') {
        // Display the "Track Order" option only for regular users
        echo '<div class="track-feedback">';
        echo '<a href="navigation.php">Track Order</a>';
        echo '</div>';
    }
    ?>

    <form action="upload_profile.php" class="profile-form" method="POST" enctype="multipart/form-data">
        <label for="profile_image">Update Profile Image</label>
        <input type="file" id="profile_image" name="profile_image" required>
        <button type="submit">Upload</button>
    </form>
  

    <footer>
    <p>&copy; 2024 All rights reserved.</p>
</footer>



  
</body>
</html>





