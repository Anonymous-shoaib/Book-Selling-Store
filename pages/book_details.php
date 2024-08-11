<?php
// Include the database connection file
include '../php/db_connect.php';

// Get the book ID from the URL
$book_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the book details from the database
$sql = "SELECT id, title, author_name, cover_photo, genre, isbn, description, price, author_description FROM books WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

$stmt->close();
?>

<?php
// Fetch the reviews for the book from the database
$sql = "SELECT user_name, review_date, comment FROM reviews WHERE book_id = ? ORDER BY review_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();

$reviews = [];
while ($row = $result->fetch_assoc()) {
    $reviews[] = $row;
}

$stmt->close();
$conn->close();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($book['title']); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="book_details.css" />
    <style>
      body{
        width: 60%;
        margin: 0px auto;
      }
      @media (max-width: 500px){
        body{
          width: 100%;
        }
      } 

      .feedback {
        padding-right: 20px;
      }

      .feedback a{

background-color: #F18231;
color: #fff;
padding: 10px 20px;
border: none;
border-radius: 50px;
font-size: 16px;
cursor: pointer;
transition: background-color 0.3s ease;
text-decoration: none;

}

.container-16{
  display: flex;
  justify-content: space-between;
}

.review{
  display: flex;
}

a{
  text-decoration: none;
  color: inherit;
  font-size: 14px;
}
    </style>
  </head>
  <body>
    <?php if ($book): ?>
      <div class="book-deatils">
        <div class="container-11">
          <div class="container-8">
            <div class="group-1171276968"></div>
            <span class="book-name">
              <?php echo htmlspecialchars($book['title']); ?>
            </span>
          </div>
          <div class="arrow-left">
            <img class="vector-10" src="../assets/vectors/vector_70_x2.svg" />
          </div>
        </div>
        <div class="book">
          <img style="margin: 0 0 8px 0.9px; display: flex; align-self: center; width: 234.9px; height: 344px; box-sizing: border-box;" src="<?php echo htmlspecialchars($book['cover_photo']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>">
        </div>
        <div class="container-6">
          <span class="tab active" data-target="about-book">About Book</span>
          <span class="tab" data-target="about-author">About Author</span>
          <span class="tab" data-target="reviews">Reviews</span>
        </div>
        <div id="about-book" class="content active">
          <div class="container-9">
            <span class="book-name-1">
              <?php echo htmlspecialchars($book['title']); ?>
            </span>
            <span class="container">
              $<?php echo htmlspecialchars($book['price']); ?>
            </span>
          </div>
          <div class="group-1000005436">
            <img class="star" src="../assets/vectors/star_14_x2.svg" />
            <img class="star-1" src="../assets/vectors/star_7_x2.svg" />
            <img class="star-2" src="../assets/vectors/star_11_x2.svg" />
            <img class="star-3" src="../assets/vectors/star_38_x2.svg" />
            <img class="star-4" src="../assets/vectors/star_59_x2.svg" />
          </div>
          <div class="lorem-ipsumis-simply-dummy-text-of-the-printing-and-typesetting-industry-lorem-ipsum-has-been-the-industrys-standard-dummy-text-ever-since-the-1500-swhen-an-unknown-printer-took-agalley-of-type-and-scrambled-it-to-make-atype-specimen-book">
            <?php echo nl2br(htmlspecialchars($book['description'])); ?>
          </div>
        </div>
        <div id="about-author" class="content">
          <div class="container-9">
            <span class="book-name-1">
              <?php echo htmlspecialchars($book['author_name']); ?>
            </span>
          </div>
          <div class="lorem-ipsumis-simply-dummy-text-of-the-printing-and-typesetting-industry-lorem-ipsum-has-been-the-industrys-standard-dummy-text-ever-since-the-1500-swhen-an-unknown-printer-took-agalley-of-type-and-scrambled-it-to-make-atype-specimen-book">
            <?php echo nl2br(htmlspecialchars($book['author_description'])); ?>
          </div>
        </div>
        <div id="reviews" class="content">
          <div class="container-16">
            <div class="review">
            <span class="reviews">Reviews</span>
            <span class="container">(<?php echo count($reviews); ?>)</span>
            </div>
            <div class="feedback">
    <a href="review.php?id=<?php echo $book_id; ?>">Give Feedback</a>
</div>

            
          </div>
          <?php foreach ($reviews as $review): ?>
            <div class="group-1171276992">
              <div class="container-3">
                <div class="container">
                  <div class="profile-container">
                    <img class="profile-image" src="../assets/images/mask.png" alt="Profile Image">
                  </div>
                  <div class="group-11712769911">
                    <span class="guy-hawkins-1"><?php echo htmlspecialchars($review['user_name']); ?></span>
                    <span class="st-july-20241"><?php echo date('jS F, Y', strtotime($review['review_date'])); ?></span>
                  </div>
                </div>

                <div class="group-10000060191">
            <img class="vector-5" src="../assets/vectors/vector_13_x2.svg" />
            <img class="vector-6" src="../assets/vectors/vector_37_x2.svg" />
            <img class="vector-7" src="../assets/vectors/vector_61_x2.svg" />
            <img class="vector-8" src="../assets/vectors/vector_58_x2.svg" />
            <img class="vector-9" src="../assets/vectors/vector_67_x2.svg" />
          </div>
              </div>
              <span class="lorem-ipsumis-simply-dummy-text-of-the-printing-and-typesetting-industry-lorem-ipsum-has-been-the-industrys-standard-dummy-text-ever-since-the-1500-swhen-an-unknown-printer-took-agalley-of-type-and-scrambled-it-to-make-atype-specimen-book-1">
                <?php echo htmlspecialchars($review['comment']); ?>
              </span>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="vector-1"></div>
        <div class="container-10">
          <a href="cart_screen_1.php?id=<?php echo $book['id']; ?>"><button class="add-to-cart-150">Add to cart | $<?php echo htmlspecialchars($book['price']); ?></button></a>
        </div>
       
       
<div class="footer-container" style="display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;">
          
          <div class="container" style="display: flex;
    justify-content: space-between;
    align-items: center; width:100%;padding: 10px;color: #000000c9;">


            <div class="left-side" style="display: flex;justify-content: space-between;width:35%">
              <div class="shop" style="display: flex;flex-direction:column;align-items: center;">
              <a href="books_list1.php"><i class="fa-solid fa-store"></i></a>

                <span>
                <a href="books_list1.php">Shops</a>
                </span>
              </div>
              <div class="shop" style="display: flex;flex-direction:column;align-items: center;">
              <a href="books_list1.php"><i class="fa-solid fa-book"></i></a>
                <span>
                <a href="books_list1.php">Shop</a>
                </span>
              </div>
            </div>

            <!-- ////////// -->

            <div class="mid-side" style=" display: flex;
    justify-content: center;
    align-items: center;width:30%">
              <a href="homepage.php"><img  src="../assets/vectors/huge_iconinterfaceoutlinehome_044_x2.svg" style="width: 60%;
    background-color: #F18231;
    padding: 20px;
    border-radius: 100px;color:white;"></a>
            </div>

            <!-- ////////// -->

            <div class="right-side" style="display: flex;justify-content: space-between;width:35%">
              
              <div class="contact" style="display: flex;flex-direction:column;align-items: center;">
              <a href="contact.html"><i class="fa-solid fa-id-card"></i></a>
                <span>
               <a href="contact.html"> Contact</a>
                </span>
              </div>
              <div class="contact" style="display: flex;flex-direction:column;align-items: center;">
              <a href="profile.php"><i class="fa-regular fa-user"></i></a>
                <span>
                <a href="profile.php">Profile</a>
                </span>
              </div>
              
            </div>
          </div>
        </div>
        
      </div>
    <script src="../js/scrol.js"></script>
    <?php else: ?>
      <p>Book not found.</p>
    <?php endif; ?>

    <script>
      document.querySelector('.arrow-left').addEventListener('click', function() {
    if (document.referrer) {
        window.history.back(); // Goes to the previous page in the browser history
    } else {
        window.close(); // Closes the current window if there's no previous page
    }
});

    </script>
  </body>
</html>
