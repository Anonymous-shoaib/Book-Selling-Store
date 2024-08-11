<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}
?>

<?php
include '../php/fetch_books.php';
$books = fetch_books();
?>


<?php include '../php/header.php'; ?>


<div class="search-for-1" style="display: flex; justify-content: space-between; width: 92%;">
        <h5>Featured Books</h5>
        <a href="books_list.php"><h6>see all</h6></a>
    </div>
    
    <div class="carousel-container">
        <button class="prev" onclick="carousel1.prevSlide()">❮</button>
        <div class="carousel">
            <?php foreach ($books as $book): ?>
                <a href="book_details.php?id=<?php echo $book['id']; ?>" class="carousel-item">
                <img src="<?php echo htmlspecialchars($book['cover_photo']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>">
               
                <div class="rating-2">★★★★☆</div>
                <div class="book-details">
                    <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                    <p><?php echo htmlspecialchars($book['author_name']); ?></p>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <button class="next" onclick="carousel1.nextSlide()">❯</button>
    </div>
    
    <div class="search-for-1" style="display: flex; justify-content: space-between; width: 92%; padding-top: 10px;">
        <h5>New Arrivals</h5>
        <a href="books_list.php"><h6>see all</h6></a>
    </div>
    
    <div class="carousel-container">
        <button class="prev-2" onclick="carousel2.prevSlide()">❮</button>
        <div class="carousel-2">
        <?php foreach ($books as $book): ?>
             <a href="book_details.php?id=<?php echo $book['id']; ?>" class="carousel-item-2">
            <img src="<?php echo htmlspecialchars($book['cover_photo']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>">
           
                <div class="rating-2">★★★★☆</div>
                <div class="book-details">
                    <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                    <p><?php echo htmlspecialchars($book['author_name']); ?></p>
                </div>
        </a>
            <?php endforeach; ?>
           
            </div>
        
        <button class="next-2" onclick="carousel2.nextSlide()">❯</button>
    </div>
    
      

    <!-- Carousel 3 -->
<div class="search-for-1" style="display: flex; justify-content: space-between; width: 92%; padding-top: 10px;">
  <h5>Bestsellers</h5>
  <a href="books_list.php"><h6>see all</h6></a>
</div>
<div class="carousel-container">
    <button class="prev prev-3" onclick="carousel3.prevSlide()">❮</button>
    <div class="carousel carousel-3">
        <?php foreach ($books as $book): ?>
            <a href="book_details.php?id=<?php echo $book['id']; ?>" class="carousel-item carousel-item-3">
                <img src="<?php echo htmlspecialchars($book['cover_photo']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>">
                <div class="rating-2">★★★★☆</div>
                <div class="book-details">
                    <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                    <p><?php echo htmlspecialchars($book['author_name']); ?></p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
    <button class="next next-3" onclick="carousel3.nextSlide()">❯</button>
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
    align-items: center;width:30%;padding-left: 30px;">
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

    <script>
      document.addEventListener('DOMContentLoaded', function() {
    const createCarousel = (carouselSelector, itemSelector) => {
        return {
          currentIndex: 0,
          carousel: document.querySelector(carouselSelector),
          slides: document.querySelectorAll(itemSelector),
          totalSlides: document.querySelectorAll(itemSelector).length,

          showSlide: function(index) {
              if (index >= this.totalSlides) {
                  this.currentIndex = 0;
              } else if (index < 0) {
                  this.currentIndex = this.totalSlides - 1;
              } else {
                  this.currentIndex = index;
              }
              const offset = -this.currentIndex * 100;
              this.carousel.style.transform = `translateX(${offset}%)`;
          },

          nextSlide: function() {
              this.showSlide(this.currentIndex + 1);
          },

          prevSlide: function() {
              this.showSlide(this.currentIndex - 1);
          },

          init: function() {
              this.showSlide(this.currentIndex);
              this.carousel.addEventListener('touchstart', (e) => {
                  this.startX = e.touches[0].clientX;
              });

              this.carousel.addEventListener('touchmove', (e) => {
                  this.endX = e.touches[0].clientX;
              });

              this.carousel.addEventListener('touchend', () => {
                  if (this.startX > this.endX + 50) {
                      this.nextSlide();
                  } else if (this.startX < this.endX - 50) {
                      this.prevSlide();
                  }
              });
          }
      };
  };

  const carousel1 = createCarousel('.carousel', '.carousel-item');
    const carousel2 = createCarousel('.carousel-2', '.carousel-item-2');
    const carousel3 = createCarousel('.carousel-3', '.carousel-item-3');

    carousel1.init();
    carousel2.init();
    carousel3.init();

    document.querySelector('.prev').addEventListener('click', () => carousel1.prevSlide());
    document.querySelector('.next').addEventListener('click', () => carousel1.nextSlide());
    document.querySelector('.prev-2').addEventListener('click', () => carousel2.prevSlide());
    document.querySelector('.next-2').addEventListener('click', () => carousel2.nextSlide());
    document.querySelector('.prev-3').addEventListener('click', () => carousel3.prevSlide());
    document.querySelector('.next-3').addEventListener('click', () => carousel3.nextSlide());
});


    </script>
    
  </body>
</html>


        
        