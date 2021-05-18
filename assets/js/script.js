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

  const paths = JSON.parse($("#magical-data").attr("data-dart-magic"));
  const images = document.querySelectorAll(".magical-gallery-item");

  /* Function to change a specific image src (based in index, passed as a prop) */
  function handleSrc(i) {
    window.setInterval(function () {
      const newPath = paths[Math.floor(Math.random() * paths.length)].path;
      $(images[i]).backstretch("uploads/small/" + newPath, { fade: 400 });
    }, 500);
  }

  /* Set images on load */

  // *** USE THIS WHEN THERE ARE MORE THAN 10 IMAGES UPLOADED
  // for (let n = 0; n < paths.length; n++) {
  // *** USE THIS WHEN THERE ARE LESS THAN 10 IMAGES UPLOADED
  for (let n = 0; n < paths.length; n++) {
    const newPath = paths[n].path;
    console.log(newPath);
    $(images[n]).backstretch("uploads/small/" + newPath);
  }

  /* Loop function with timeout delay */
  var i = 0;
  function galleryLoop() {
    setTimeout(function () {
      console.log(i);
      handleSrc(i);
      i++;

      if (i < images.length) {
        galleryLoop();
      }
    }, 700);
  }

  // Start the loop
  galleryLoop();
});
