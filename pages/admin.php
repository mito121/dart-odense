<?php
require_once 'includes/dbconnect.php';
/* Get messages */
$sql = "SELECT `id`, `name`, `email`, `phone`, `message`, `unread` FROM `dart_messages` ORDER BY id desc";
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {
    $messages = "";
    while ($obj = $result->fetch_object()) {
        $id = $obj->id;
        $name = $obj->name;
        $email = $obj->email;
        $phone = $obj->phone;
        $message = $obj->message;
        $unread = $obj->unread;

        if($unread == 1){
            $status = "Ulæst";
            $read_class = "unread";
        } else {
            $status = "Læst";
            $read_class = "";
        }

        $messages .= "
                <tr class=\"$read_class\" data-id=\"$id\" data-name=\"$name\" data-email=\"$email\" data-phone=\"$phone\" data-message=\"$message\" data-status=\"$unread\" onclick=\"openModal(this)\">
                    <td>$name</td>
                    <td>$email</td>
                    <td>$phone</td>
                    <td>$status</td>
                </tr>
        ";
    }
} else {
    $messages = "<tr><td>Der er endnu ingen beskeder.</td><td></td><td></td><td></td></tr>";
}
?>
<section class="top-space">
    <div class="wrapper ">
        <h1 class="mb-8">Admin dashboard</h1>


        <table class="messages">
            <h3>Beskeder</h3>
            <thead>
                <tr>
                    <th>Navn</th>
                    <th>Email</th>
                    <th>Tlf.</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <?php echo $messages; ?>
            </tbody>
        </table>
</section>

<div id="myModal" class="modal message-modal">
    <span class="close cursor" onclick="closeModal()">&times;</span>
    <div class="modal-content">
        <p>Navn:</p>
        <p id="msgName"></p>

        <p>Afsender:</p>
        <p id="msgEmail"></p>

        <p>Tlf.:</p>
        <p id="msgPhone"></p>

        <p>Besked:</p>
        <p id="msgMsg"></p>
    </div>
</div>

<script>
const modal = document.getElementById("myModal");

function openModal(el) {
    // Display modal
    modal.style.display = "block";

    let id = el.getAttribute("data-id");
    let name = el.getAttribute("data-name");
    let email = el.getAttribute("data-email");
    let phone = el.getAttribute("data-phone");
    let message = el.getAttribute("data-message");
    let status = el.getAttribute("data-unread");

    // Set message values
    document.getElementById("msgName").innerHTML = name;
    document.getElementById("msgEmail").innerHTML = email;
    document.getElementById("msgPhone").innerHTML = phone;
    document.getElementById("msgMsg").innerHTML = message;

    // Set unread to false
    if (status !== 1) {
        // Set & send form data
        let form_data = new FormData();
        // If user is already logged on
        form_data.append("id", id);

        $.ajax({
            type: "POST",
            url: "./handlers/read_message.php",
            contentType: false,
            processData: false,
            data: form_data,
            success: function(response) {
                el.classList.remove("unread");
                el.setAttribute("data-unread", "0");
                el.children[3].innerHTML = "Læst";
            },
        });
    } else {
        console.log("already read")
    }

}

function closeModal() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        closeModal();
    }
}
</script>