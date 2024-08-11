<?php
// Fetch book_id from URL
$book_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Review</title>

    <style>
        *{
            margin: 0;
            padding: 0;
        }

        body{
            margin: 0px auto;
            font-family: poppins;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
            background-image: url(../assets/images/confirmbg.png);  
            background-repeat: no-repeat;
            background-size: cover;
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
            padding-top: 30px;
        }

        .img img{
            width: 40%;
        }

        .content{
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .content h1{
            width: 80%;
            margin: 0px auto;
            text-align: center;
            font-weight: 200;
            font-size: 17px;
        }

        .content .rating{
            margin: 0px auto;
            text-align: center;
            width: 75%;
            color: orange;
            font-weight: 600;
            font-size: 30px;
        }

        
        .btn{
            display: flex;
            justify-content: center;
        }

        .btn button{
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

        

        .review{
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 20px;
        }

        
        .review h1{
            font-size: 16px;
            font-family: poppins;
            font-weight: 400;
            padding-left: 10px;
        }

        #comments{
            border-radius: 10px;
            padding: 10px;
        }
    
    </style>
    
    <style>
    .rating-container {
        display: flex;
        align-items: center;
        font-family: Arial, sans-serif;
    }

    .rating-container label {
        font-weight: bold;
        margin-right: 10px;
        font-size: 16px;
        color: #333;
    }

    .rating-container select {
        padding: 5px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ccc;
        background-color: #f9f9f9;
        color: #333;
        cursor: pointer;
        outline: none;
    }

    .rating-container select:focus {
        border-color: #66afe9;
        box-shadow: 0 0 5px rgba(102, 175, 233, 0.6);
    }
</style>
</head>
<body>



    <div class="container">

        <div class="img">
            <img class="group-1171277007" src="../assets/vectors/group_1171277007_x2.svg" />
        </div>

        <div class="content">
    <h1>Rating</h1>
    <div class="rating">★★★★☆</div>
        </div>

    <div class="review">
        <h1>Review</h1>

        <form action="submit_review.php" method="POST">
    <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($book_id); ?>">
    <textarea id="comments" name="comments" rows="8" cols="40" placeholder="Leave a Comment"></textarea>
    <br>
    <div class="rating-container">
    <label for="rating">Rating:</label>
    <select id="rating" name="rating">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>
</div>
    <br>
    <div class="btn">
        <button type="submit" class="submit">Submit</button>
    </div>
</form>

    </div>

    </div>

</body>
</html>