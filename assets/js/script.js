$(document).ready(function () {
  /* News slider */
  /*
   *** Slickjs
   */
  $('.slick-slider').slick({
    slidesToShow: 3,
    slidesToScroll: 3,
    infinite: false,
    arrows: true
  })

  /*
   *** Magical gallery
   */
  const paths = ['1.JPG', '2.JPG', '3.JPG', '4.JPG', '5.JPG']
  const images = document.querySelectorAll('.magical-gallery-item img')
  const i = 0
  const length = paths.length
})
