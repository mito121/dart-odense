<?php
require_once 'includes/dbconnect.php';

/* 
*** Get gallery
 */
$id = $_GET['id'];
if(isset($id)){
    $sql_collection = "SELECT `name`, `description`, `thumbnail` FROM `dart_collections` WHERE id = '$id'";
    $sql_images = "SELECT `id`, `path`FROM `dart_images` WHERE collection_id = '$id'";
} else {
    die("Hovsa... Dette album findes ikke!");
}

/* Get collection data */
$colelction_result = $conn->query($sql_collection);
if (mysqli_num_rows($colelction_result) > 0) {
    while ($obj = $colelction_result->fetch_object()) {
        $title = $obj->name;
        $description = $obj->description;
        $thumbnail = "uploads/" . $obj->thumbnail;
    }
}

/* Get images for collection */
$images_result = $conn->query($sql_images);
$dataIndex = 1;
$img_thumbs = "";
$modal_content = "";
$demo_content = "";
if (mysqli_num_rows($images_result) > 0) {
    $img_count = mysqli_num_rows($images_result);
    while ($obj = $images_result->fetch_object()) {
        $img_id = $obj->id;
        $img_small = "uploads/small/" . $obj->path;
        $img_big = "uploads/" . $obj->path;

        $img_thumbs .= "
                        <div class=\"gallery-content\">
                            <img src=\"$img_small\" alt=\"\" onclick=\"openModal();currentSlide($dataIndex)\" class=\"hover-shadow cursor\" />
                        </div>
                    ";

        $modal_content .= "
                        <div class=\"modal-slide\">
                            <div class=\"numbertext\">$dataIndex / $img_count</div>
                            <img src=\"$img_big\" style=\"width:100%\">
                        </div>
                    ";
        $dataIndex++;
    }
}
?>

<section class="top-space">
    <div class="wrapper">
        <h1 class="mb-8"><?php echo $title; ?></h1>

        <div class="parallax" style="background-image: url(<?php echo $thumbnail; ?>);"></div>

        <p><?php echo $description; ?></p>

        <div class="gallery-images">
            <?php echo $img_thumbs; ?>
        </div>


        <div id="myModal" class="modal">
            <span class="close cursor" onclick="closeModal()">&times;</span>
            <div class="modal-content">

                <div class="active-image">
                    <?php echo $modal_content; ?>
                </div>

                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>

                <div class="caption-container">
                    <p id="caption"></p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function openModal() {
    document.getElementById("myModal").style.display = "block";
}

function closeModal() {
    document.getElementById("myModal").style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("modal-slide");
    var dots = document.getElementsByClassName("demo");
    var captionText = document.getElementById("caption");
    if (n > slides.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = slides.length
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
}
</script>