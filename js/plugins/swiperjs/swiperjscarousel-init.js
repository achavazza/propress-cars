const swiperCarousel = new Swiper('.swiper-carousel', {
  // Optional parameters
  direction: 'horizontal',
  slidesPerView: 1,
  spaceBetween: 20,
  //centeredSlides: true,
  // If we need pagination
  /*
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  */
  // when window width is >= 640px
  breakpoints: {
    800: {
      slidesPerView: 3,
      spaceBetween: 20
    }
  },

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

  // And if we need scrollbar
  /*
  scrollbar: {
    el: '.swiper-scrollbar',
  },
  */
});
