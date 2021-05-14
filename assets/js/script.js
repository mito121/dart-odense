/* News swiper */
/*
 *** Swiperjs
 */
const slides = $('.swiper-slide')

const swiper = new Swiper('#news-swiper', {
  direction: 'horizontal',
  slidesPerView: 3,
  slidesPerGroup: 4,
  spaceBetween: 50,
  centeredSlides: true,
  centeredSlidesBounds: true,
  speed: 1200,

  mousewheel: true,

  grabCursor: true,

  navigation: {
    nextEl: '#swiper-next',
    prevEl: '#swiper-prev'
  }
})
