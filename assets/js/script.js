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

  /* TinyMCE */
  tinymce.init({
    selector: ".tinymce",
  });
  /*
   *** Sign up
   */

  /* if radio buttons are checked */
  let membertype = false,
    paymentInterval = false,
    price = 0;

  $(".membership-radio").on("click", () => {
    membertype = true;
  });

  $(".interval-radio").on("click", () => {
    paymentInterval = true;
  });

  $(".interval-radio, .membership-radio").on("click", () => {
    if (membertype === true && paymentInterval === true) {
      let unit = $("input[name=interval]:checked").attr("data-unit");
      let price_per_unit = $("input[name=membership]:checked").attr(
        "data-price"
      );
      let discount = $("input[name=membership]:checked").attr("data-discount");

      if (unit == 4) {
        // If yearly payment, subtract discount
        price = price_per_unit * unit - discount;
      } else {
        price = price_per_unit * unit;
      }

      $("#calculated-price").val(price);
    }
  });

  /* Submit membership form */
  function submitMembership() {
    if (membertype !== false && paymentInterval !== false) {
      let form_data = new FormData();

      let user_id = $("#user_id").val();
      let membership_id = $("input[name=membership]:checked").val();
      let interval_id = $("input[name=interval]:checked").val();
      let price = $("#calculated-price").val();

      form_data.append("user_id", user_id);
      form_data.append("membership_id", membership_id);
      form_data.append("interval_id", interval_id);
      form_data.append("price", price);

      $.ajax({
        type: "POST",
        url: "./handlers/signup.php",
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
          /* Signup response */
          $("#server-msg").html(response);
        },
      });
    }
  }

  $("#sign-up").on("click", submitMembership)
}); // document.ready

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
  tinyMCE.triggerSave(true, true);
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

  /* Show img previews */
  preview();
}

/* Send AJAX request */
function ajax_file_upload(file_obj) {
  if (file_obj != undefined) {
    /* Create form data */
    let form_data = new FormData();
    /* Name of collection */
    form_data.append("name", document.querySelector("#collection_name").value);
    /* Description of collection */
    form_data.append("desc", document.querySelector("#collection_desc").value);
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
        tinyMCE.activeEditor.setContent("");
        showFileNames();
      },
    });
  }
}

/* img preview */
// convert file to a base64 url
const readURL = (file) => {
  return new Promise((res, rej) => {
    const reader = new FileReader();
    reader.onload = (e) => res(e.target.result);
    reader.onerror = (e) => rej(e);
    reader.readAsDataURL(file);
  });
};

// for demo
const fileInput = document.querySelector("#selectfile");

const preview = async (event) => {
  /* Clear list */
  document.querySelector("#img-preview").innerHTML = "";

  const files = document.querySelector("#selectfile").files;
  for (let i = 0; i < files.length; i++) {
    const img = document.createElement("img");
    img.attributeStyleMap.set("max-width", "150px");
    document.querySelector("#img-preview").appendChild(img);

    const url = await readURL(files[i]);
    img.src = url;
  }
};

/* fileInput.addEventListener("change", preview); */
