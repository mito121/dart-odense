$(document).ready(function () {
  /* News slider */
  /*
   *** Slickjs
   */
  $(".slick-slider").slick({
    slidesToShow: 3,
    slidesToScroll: 3,
    infinite: false,
    arrows: true,
  });

  /*
   *** Magical gallery
   */
  const paths = ["1.JPG", "2.JPG", "3.JPG", "4.JPG", "5.JPG"];
  const images = document.querySelectorAll(".magical-gallery-item img");

  //window.setInterval(function () {
  /*   for (let i = 0; i < images.length; i++) {
    window.setInterval(function () {
      console.log(i);
      const newPath = paths[Math.floor(Math.random() * paths.length)];
      images[i].src = "assets/img/" + newPath;
      console.log(images[i]);
    }, 5000);
  } */
  //}, 700);
  /* Change specific image src */
  function handleSrc(i) {
    window.setInterval(function () {
      const newPath = paths[Math.floor(Math.random() * paths.length)];
      images[i].src = "assets/img/" + newPath;
    }, 5000);
  }

  /* Loop with timeout delay */
  var i = 0;
  function galleryLoop() {
    setTimeout(function () {
      console.log(i);
      handleSrc(i);
      i++;

      if (i < images.length) {
        galleryLoop();
      }
    }, 7000);
  }

  galleryLoop(); //  start the loop
});
