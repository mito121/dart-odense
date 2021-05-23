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
  let membertype = false,
    paymentInterval = false,
    price = 0,
    parents;
  // Show membership details when membership is selected
  function displayMembershipDetails(id) {
    const details = [
      {
        id: 1,
        heading: "Som aktiv medlem får du:",
        perks: [
          "Fri adgang til klubbens faciliteter på åbningsdage",
          "Mulighed for at spille med i løbende turnering under Dartfyn og DDU",
          "Betalt licens hvis du ønsker at spille med i Dartfyn eller DDU.",
          "Stemmeret til klubbens årlige generalforsamling.",
        ],
      },
      {
        id: 2,
        heading: "Som passiv medlem får du:",
        perks: ["Fri adgang til klubbens faciliteter på åbningsdage"],
      },
      {
        id: 3,
        heading: "Som pensionist får du:",
        perks: [
          "Fri adgang til klubbens faciliteter på åbningsdage",
          "Mulighed for at spille med i løbende turnering under Dartfyn og DDU",
          "Betalt licens hvis du ønsker at spille med i Dartfyn eller DDU.",
          "Stemmeret til klubbens årlige generalforsamling.",
        ],
      },
      {
        id: 4,
        heading: "Som junior får du:",
        perks: [
          "Fri adgang til klubbens faciliteter på åbningsdage",
          "Mulighed for at spille med i løbende turnering under Dartfyn og DDU",
          "Betalt licens hvis du ønsker at spille med i Dartfyn eller DDU.",
        ],
      },
    ];

    const container = document.querySelector("#member-details");
    const heading = document.querySelector("#membership-heading");
    const list = document.querySelector("#membership-details");
    const perks = details[id - 1].perks;
    const parents = document.querySelector("#parents-radio");
    // Show details container
    container.style.display = "block";

    // Set heading in HTML
    heading.innerHTML = details[id - 1].heading;
    // Reset list
    list.innerHTML = "";
    // Set new values
    for (let i = 0; i < perks.length; i++) {
      $("#membership-details").append("<li>" + perks[i] + "</li>");
    }

    // If membership type is Junior, show extra input for discount
    if (id == 4) {
      parents.style.display = "block";
    } else {
      parents.style.display = "none";
    }
  }

  // On radio input clicks
  $(".interval-radio, .membership-radio, .parents-radio").on("click", (e) => {
    // On membership click
    if (e.target.classList.contains("membership-radio")) {
      membertype = true;
      // Display membership details
      displayMembershipDetails(e.target.value);
      // On interval click
    } else if (e.target.classList.contains("interval-radio")) {
      paymentInterval = true;
    }

    // Calculate price
    if (membertype === true && paymentInterval === true) {
      let unit = $("input[name=interval]:checked").attr("data-unit");
      let price_per_unit = $("input[name=membership]:checked").attr(
        "data-price"
      );
      let discount = $("input[name=membership]:checked").attr("data-discount");

      if (unit == 4) {
        // Yearly payment
        // If yearly payment, subtract discount
        price = price_per_unit * unit - discount;

        // Check if membership is junior and has parents with memberships
        parents = $("input[name=parents]:checked").val();
        if (parents > 0) {
          price = price / 2;
        }
      } else {
        // Quarterly payment
        price = price_per_unit * unit;
      }

      $("#calculated-price").val(price);
    }
  });

  /* Submit membership form */
  function submitMembership() {
    let user_id = $("#user_id").val();
    let membership_id = $("input[name=membership]:checked").val();
    let membership_name = $("input[name=membership]:checked").attr("data-name");
    let interval_id = $("input[name=interval]:checked").val();
    let price = $("#calculated-price").val();

    if (membertype == false || paymentInterval == false) {
      // Missing form fields
      alert("husk nu lige at udfylde alle felterne :)");
    } else if (user_id == 0) {
      // User is not logged
      alert("du skal altså lige logge på, du...");
    } else {
      // Set & send form data
      let form_data = new FormData();
      form_data.append("user_id", user_id);
      form_data.append("membership_id", membership_id);
      form_data.append("membership_name", membership_name);
      form_data.append("interval_id", interval_id);
      form_data.append("price", price);

      $.ajax({
        type: "POST",
        url: "./handlers/membership_signup.php",
        contentType: false,
        processData: false,
        //async: false,
        data: form_data,
        success: function (response) {
          $("#server-msg").html(response);
          let url = window.location.href;
          window.location.href = url + "&response=" + response;
        },
      });
    }
  }

  $("#sign-up").on("click", submitMembership);
}); // document.ready

/*
 *** Create image collection
 */

/* Create collection */
let fileobj;

/* Set files on drag & drop */
function upload_file(e) {
  e.preventDefault();
  document.querySelector("#selectfile").files = e.dataTransfer.files;
  preview();
}

/* Open file explorer */
function file_explorer() {
  document.querySelector("#selectfile").click();
  document.getElementById("selectfile").onchange = function () {
    preview();
  };
}

/* Submit collection */
function upload_collection() {
  const files = document.querySelector("#selectfile").files;
  tinyMCE.triggerSave(true, true);
  ajax_file_upload(files);
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
    /* Selected collection thumbnail */
    form_data.append("thumb", document.querySelector("#thumbnail").value);
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
        preview();
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

const preview = async (event) => {
  // Clear list
  document.querySelector("#img-preview").innerHTML = "";

  const files = document.querySelector("#selectfile").files;
  for (let i = 0; i < files.length; i++) {
    // Create container
    const container = document.createElement("div");
    container.onclick = selectThumbnail;
    // Set container classes & attributes
    container.className = "preview-container";
    container.setAttribute("data-name", files[i].name);
    container.setAttribute("data-index", i);
    // Create <img>
    const img = document.createElement("img");
    // Create Text node
    const name = document.createTextNode(files[i].name);
    // Create <p>
    const p = document.createElement("p");
    // Append img to container
    container.appendChild(img);
    // Append textnode to <p>
    p.appendChild(name);
    // Append <p> to container
    container.appendChild(p);

    document.querySelector("#img-preview").appendChild(container);
    /*document.querySelector("#img-preview").appendChild(img); */

    const url = await readURL(files[i]);
    img.src = url;
  }
};

// Set thumbnail
function selectThumbnail(event) {
  // Get name of selected image
  let thumbnail = event.target.getAttribute("data-name");
  // Set hidden thumbnail input
  document.querySelector("#thumbnail").value = thumbnail;

  // Remove all border-colors
  const images = document.querySelectorAll(".preview-container");
  for (let i = 0; i < images.length; i++) {
    images[i].style.borderColor = "transparent";
  }

  // Add border-color to selected image
  event.target.style.borderColor = "green";
}
