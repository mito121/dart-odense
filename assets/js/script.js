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

  if (document.querySelector('#magical-data')) {
    const paths = JSON.parse($('#magical-data').attr('data-dart-magic'))
    const images = document.querySelectorAll('.magical-gallery-item')

    /* Function to start interval that changes a specific image src (based in index, passed as a prop) */
    const startInterval = i => {
      window.setInterval(function () {
        const newPath = paths[Math.floor(Math.random() * paths.length)].path
        $(images[i]).backstretch('uploads/small/' + newPath, { fade: 400 })
      }, 500)
    }

    /* Set images on load */
    if (paths.length > 0) {
      // If there are more than 10 images uploaded
      for (let n = 0; n < paths.length; n++) {
        const newPath = paths[n].path
        console.log(newPath)
        $(images[n]).backstretch('uploads/small/' + newPath)
      }
    } else {
      // If there are less than 10 images uploaded
      for (let n = 0; n < paths.length; n++) {
        const newPath = paths[n].path
        console.log(newPath)
        $(images[n]).backstretch('uploads/small/' + newPath)
      }
    }

    /* Loop function with timeout delay */
    let i = 0
    function galleryLoop () {
      setTimeout(function () {
        console.log(i)
        startInterval(i)
        i++

        if (i < images.length) {
          galleryLoop()
        }
      }, 700)
    }

    // Start the loop
    galleryLoop()
  }
})
