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
  if (document.getElementById("magical-data")) {
    const paths = JSON.parse(
      document.querySelector("#magical-data").getAttribute("data-dart-magic")
    );
    const images = document.querySelectorAll(".magical-gallery-item");

    /* Function to start interval that changes a specific image src (based in index, passed as a prop) */
    const startInterval = (i) => {
      window.setInterval(function () {
        const newPath = paths[Math.floor(Math.random() * paths.length)].path;
        $(images[i]).backstretch("uploads/small/" + newPath, { fade: 400 });
      }, 5000);
    };

    /* Set images on load */
    if (paths.length > 10) {
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
        }, 7000);
      }

      // Start the loop
      galleryLoop();
    }
  }

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

    /*
     *** Signup for membership
     */

    /* Show membership benefits when membership is selected */
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

  /* Check if user is logged in */
  const user_id = document.querySelector("#user_id");
  const membershipform = document.querySelector("#membership-form");
  const registerform = document.querySelector("#user-register-form");
  const signUp = document.querySelector("#sign-up");
  const backToMembership = document.querySelector("#back-to-membership");

  /* Submit membership */
  function submitMembership() {
    // Membership fields
    let membership_id = $("input[name=membership]:checked").val();
    let interval_id = $("input[name=interval]:checked").val();
    let price = $("#calculated-price").val();

    // New user fields
    let name = $("#name").val();
    let email = $("#email").val();
    let password = $("#password").val();
    let password_repeat = $("#password_repeat").val();

    // Form validation
    if (membertype == false || paymentInterval == false) {
      // Missing form fields
      alert("Husk lige at vælge medlemskab og betalingsinterval!");
      return false;
    } else {
      // New user form validation
      if (user_id.value == 0 && !name) {
        alert("Indtast dit navn");
        return false;
      }

      // If new user and email validation fails
      if (user_id.value == 0 && !email) {
        alert("Indtast din email");
        return false;
      }

      // If new user and password validation fails
      if (user_id.value == 0 && password !== password_repeat) {
        alert("Dine adgangskoder er ikke ens!");
        return false;
      }

      // Set & send form data
      let form_data = new FormData();
      // If user is already logged on
      form_data.append("user_id", user_id.value);
      form_data.append("membership_id", membership_id);
      form_data.append("interval_id", interval_id);
      form_data.append("price", price);

      // If anonymous user is signing up, append user data to form data
      if (user_id.value == 0) {
        let name = document.querySelector("#name").value;
        let email = document.querySelector("#email").value;
        let password = document.querySelector("#password").value;
        let passwordRepeat = document.querySelector("#password_repeat").value;
        form_data.append("name", name);
        form_data.append("email", email);
        form_data.append("password", password);
        form_data.append("password_repeat", passwordRepeat);
      }

      // Send AJAX request
      $.ajax({
        type: "POST",
        url: "./handlers/membership_signup.php",
        contentType: false,
        processData: false,
        //async: false,
        data: form_data,
        success: function (response) {
          if (response == 1) {
            window.location.href = "index.php?page=profile";
          } else {
            console.log(response);
            document.querySelector("#server-msg").innerHTML = response;
          }
        },
      });
    }
  }

  /* Hide membership form and show user register form */
  function showUserRegister() {
    /* Hide membership form and show user registration form */
    membershipform.style.display = "none";
    registerform.style.display = "block";

    /* Show back-to-membership button */
    backToMembership.style.display = "block";

    /* Add onClick eventlistener to back-to-membership button */
    backToMembership.addEventListener("click", showMembership);

    if (signUp !== null) {
      /* Set text value of submit button */
      signUp.innerHTML = "Bliv medlem";
      /* Remove old event listener */
      signUp.removeEventListener("click", showUserRegister);
      /* Add new event listener */
      signUp.addEventListener("click", submitMembership);
    }
  }

  function showMembership() {
    /* Hide back-to-membership button */
    backToMembership.style.display = "none";

    /* Hide user registration form and show membership form */
    registerform.style.display = "none";
    membershipform.style.display = "block";

    if (signUp !== null) {
      /* Set text value of submit button */
      signUp.innerHTML = "Fortsæt";
      /* Remove old event listener */
      signUp.removeEventListener("click", submitMembership);
      /* Add new event listener */
      signUp.addEventListener("click", showUserRegister);
    }
  }

  /* Tell user if password and password-repeat dont match */
  const password = document.querySelector("#password");
  const passwordRepeat = document.querySelector("#password_repeat");
  const error = document.querySelector("#pw-err");
  function validatePassword() {
    if (
      password.value &&
      passwordRepeat.value &&
      passwordRepeat.value !== password.value
    ) {
      /* Set border color */
      password.style.borderColor = "red";
      passwordRepeat.style.borderColor = "red";
      /* Show error message */
      error.style.display = "block";
    } else {
      /* Set border color */
      password.style.borderColor = "#333";
      passwordRepeat.style.borderColor = "#333";
      /* Show error message */
      error.style.display = "none";
    }
  }

  if (user_id !== null && user_id.value > 0) {
    /* If user is logged on */
    signUp.innerHTML = "Bliv medlem"; // Set text value of submit button
    signUp.addEventListener("click", submitMembership); // Assign eventListener to submit form onClick
  } else {
    if (signUp !== null) {
      /* If user is NOT logged on */
      signUp.innerHTML = "Fortsæt"; // Set text value of submit button
      signUp.addEventListener("click", showUserRegister); // Assign eventListener to shower user register form onClick

      $(password).on("keyup", validatePassword); // Validate password & password repeat
      $(passwordRepeat).on("keyup", validatePassword); // Validate password & password repeat
    }
  }
}); // document.ready
/* TinyMCE */
tinymce.init({
  selector: ".tinymce",
  height: "420",
});
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

/*
 *** News
 */
const filterYear = document.querySelector("#filter-year");

// Filter by year
function handleYearFilter(e) {
  let url = window.location.href;
  /* const value = e.target.value; */
  let value = e.target.value.length == 4 ? e.target.value : null;

  if (value !== null) {
    window.location.href = "index.php?page=news&year=" + value;
  } else {
    window.location.href = "index.php?page=news";
  }
}

if (filterYear) {
  filterYear.addEventListener("change", handleYearFilter);
}

/*
 *** Galleries
 */
const GalleryFilterYear = document.querySelector("#gallery-filter-year");

// Filter by year
function handleGalleryYearFilter(e) {
  let url = window.location.href;
  /* const value = e.target.value; */
  let value = e.target.value.length == 4 ? e.target.value : null;

  if (value !== null) {
    window.location.href = "index.php?page=galleries&year=" + value;
  } else {
    window.location.href = "index.php?page=galleries";
  }
}

if (GalleryFilterYear) {
  GalleryFilterYear.addEventListener("change", handleGalleryYearFilter);
}
