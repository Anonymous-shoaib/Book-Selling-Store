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

  const carousel1 = createCarousel('.carousel-1', '.carousel-item-1');
  const carousel2 = createCarousel('.carousel-2', '.carousel-item-2');
  const carousel3 = createCarousel('.carousel-3', '.carousel-item-3');

  carousel1.init();
  carousel2.init();
  carousel3.init();
});
