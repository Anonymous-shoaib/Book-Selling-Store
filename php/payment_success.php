<?php
include '../php/db_connect.php';

$order_id = $_GET['order_id'];

// You can use the order_id to fetch and update the order status in your database

// Example: Update order status to 'paid'
$sql = "UPDATE orders SET status = 'paid' WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$stmt->close();
$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Success</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }

        body{
            font-family: poppins;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
            background-image: url(../assets/images/confirmbg.png);
        }

        .container{
            display: flex;
            flex-direction: column;
            gap: 50px;
            background-color: white;
            box-shadow: 0px 0px 20px black;
            border-radius: 30px;
        }

        .img{
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 10px;
        }

        .img img{
            width: 60%;
        }

        .content{
            display: flex;
            flex-direction: column;
            gap: 50px;
        }

        .content h1{
            width: 80%;
            margin: 0px auto;
            text-align: center;
            font-weight: 600;
        }

        .content p{
            margin: 0px auto;
            text-align: center;
            width: 75%;
            color: gray;
            font-weight: 200;
        }

        .btns{
            display: flex;
            flex-direction: column;
        }

        .btns .btn-1{
            margin: 0px auto;
            
        }

        .btns .btn-1 button{
            padding: 20px 100px;
            color: white;
            background-color: orange;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            font-weight: 700;
            font-family: poppins;
            cursor: pointer;
        }

        .btns .btn-2{
            margin: 0px auto;
        }

        .btns .btn-2 button{
            padding: 20px 100px;
            color: black;
            background: none;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            font-weight: 600;
            font-family: poppins;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="container">

        <div class="img">
    <img class="group-6872" src="../assets/vectors/group_6872_x2.svg" />
        </div>

        <div class="content">
    <h1>You just Placed the Order</h1>
    <p>Your items has been placcd and is on it’s way to being processed</p>
        </div>

    <div class="btns">
    <div class="btn-1">
        <a href="navigation.php"><button>Track Order</button></a>
    </div>

    <div class="btn-2">
        <a href="homepage.php"><button>Back To Home</button></a>
    </div>
    </div>

    </div>
    </body>
</html>
