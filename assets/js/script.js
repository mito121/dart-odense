$(document).ready(function () {
  /*
   *** Small header on scroll
   */
  /* Set small header */
  window.onscroll = function () {
    setSmallHeader();
  };

  const header = document.querySelector("header");
  const small = header.offsetTop;

  function setSmallHeader() {
    if (window.pageYOffset > small) {
      header.classList.add("small");
    } else {
      header.classList.remove("small");
    }
  }

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

  if (document.querySelector("#magical-data")) {
    const paths = JSON.parse($("#magical-data").attr("data-dart-magic"));
    const images = document.querySelectorAll(".magical-gallery-item");

    /* Function to start interval that changes a specific image src (based in index, passed as a prop) */
    const startInterval = (i) => {
      window.setInterval(function () {
        const newPath = paths[Math.floor(Math.random() * paths.length)].path;
        $(images[i]).backstretch("uploads/small/" + newPath, { fade: 400 });
      }, 500);
    };

    /* Set images on load */
    if (paths.length > 0) {
      // If there are more than 10 images uploaded
      for (let n = 0; n < paths.length; n++) {
        const newPath = paths[n].path;
        console.log(newPath);
        $(images[n]).backstretch("uploads/small/" + newPath);
      }
    } else {
      // If there are less than 10 images uploaded
      for (let n = 0; n < paths.length; n++) {
        const newPath = paths[n].path;
        console.log(newPath);
        $(images[n]).backstretch("uploads/small/" + newPath);
      }
    }

    /* Loop function with timeout delay */
    let i = 0;
    function galleryLoop() {
      setTimeout(function () {
        console.log(i);
        startInterval(i);
        i++;

        if (i < images.length) {
          galleryLoop();
        }
      }, 700);
    }

    // Start the loop
    galleryLoop();
  }
});

/*
 *** Admin images
 */

/* Create collection */
let fileobj;

/* Set files on drag & drop */
function upload_file(e) {
  e.preventDefault();
  document.querySelector("#selectfile").files = e.dataTransfer.files;
  showFileNames();
}

/* Open file explorer */
function file_explorer() {
  document.querySelector("#selectfile").click();
  document.getElementById("selectfile").onchange = function () {
    showFileNames();
  };
}

/* Submit collection */
function upload_collection() {
  const files = document.querySelector("#selectfile").files;
  ajax_file_upload(files);
}

/* Show uploaded file names */
function showFileNames() {
  /* Clear list */
  document.querySelector("#uploaded-files").innerHTML = "";
  /* Get files */
  const files = document.querySelector("#selectfile").files;

  /* Append each file name to ul */
  for (let i = 0; i < files.length; i++) {
    /* Create <li> element */
    const li = document.createElement("LI");
    /* Create text node */
    const val = document.createTextNode(files[i].name);
    /* Append text node to <li> */
    li.appendChild(val);
    /* Append <li> to <ol> */
    document.querySelector("#uploaded-files").appendChild(li);
  }
}

/* Send AJAX request */
function ajax_file_upload(file_obj) {
  if (file_obj != undefined) {
    /* Create form data */
    let form_data = new FormData();
    /* Name of collection */
    form_data.append("name", document.querySelector("#collection_name").value);
    /* Append each selected file to form data */
    for (i = 0; i < file_obj.length; i++) {
      form_data.append("file[]", file_obj[i]);
    }
    $.ajax({
      type: "POST",
      url: "./handlers/add_collection.php",
      contentType: false,
      processData: false,
      data: form_data,
      success: function (response) {
        $("#create-collection").html(response);
        $("#collection_name").val("");
        $("#selectfile").val("");
        showFileNames();
      },
    });
  }
}
