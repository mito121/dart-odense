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
        <h1 class="mb-8">Beskeder</h1>


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

    <!-- The message -->
    <div class="modal-content" id="theMessage">
        <p>Navn:</p>
        <p id="msgName"></p>

        <p>Afsender:</p>
        <p id="msgEmail"></p>

        <p>Tlf.:</p>
        <p id="msgPhone"></p>

        <p>Besked:</p>
        <p id="msgMsg"></p>

        <div class="flex items-center">
            <button class="btn btn-primary mr-2" id="replyEmail">Besvar som email</button>
            <a href="tel:+4512345678" class="btn btn-primary" id="call">Ring op</a>
        </div>
    </div>

    <!-- The response -->
    <div class="modal-content" id="theResponse">
        <div class="form-row">
            <label for="emailTo">Til</label>
            <input class="disabled-input" type="text" id="emailTo" name="emailTo" readonly>
        </div>

        <div class="form-row">
            <label for="emailFrom">Fra</label>
            <input class="disabled-input" type="text" id="emailFrom" name="emailFrom" readonly
                value="<?php echo $_SESSION['email']; ?>">
        </div>

        <div class="form-row">
            <label for="emailResponse">Besked</label>
            <textarea class="tinymce" name="emailResponse" id="emailResponse"></textarea>
        </div>


        <div class="flex items-center">
            <button class="btn btn-primary mr-2" id="sendResponse">Send</button>
            <button class="btn btn-secondary mr-2" id="backToMessage">Annullér</button>
        </div>
    </div>
</div>

<script>
const modal = document.getElementById("myModal");

/* Reply email */
const theMessage = document.getElementById("theMessage")
const theResponse = document.getElementById("theResponse")
const replyBtn = document.getElementById("replyEmail")
const emailResponse = document.getElementById("emailResponse")
const sendResponse = document.getElementById("sendResponse")
const backToMessage = document.getElementById("backToMessage")

function openModal(el) {
    // Display modal
    modal.style.display = "block";
    theMessage.style.display = "block";
    theResponse.style.display = "none";

    let id = el.getAttribute("data-id");
    let name = el.getAttribute("data-name");
    let email = el.getAttribute("data-email");
    let phone = el.getAttribute("data-phone");
    let message = el.getAttribute("data-message");
    let status = el.getAttribute("data-status");

    // Set message values
    document.getElementById("msgName").innerHTML = name;
    document.getElementById("msgEmail").innerHTML = email;
    document.getElementById("msgPhone").innerHTML = phone;
    document.getElementById("msgMsg").innerHTML = message;

    // If user has submitted phone number, show option to call
    if(phone == 0) {
        document.getElementById("call").style.display = "none";
    } else {
        document.getElementById("call").style.display = "block";
    }

    // Set values for email reply
    document.getElementById("emailTo").value = email;
    tinymce.get("emailResponse").setContent('');

    // Set unread to false
    if (status == 1) {
        // Set & send form data
        let form_data = new FormData();
        // Message ID
        form_data.append("id", id);

        $.ajax({
            type: "POST",
            url: "./handlers/read_message.php",
            contentType: false,
            processData: false,
            data: form_data,
            success: function(response) {
                // Update messages list
                el.classList.remove("unread");
                el.setAttribute("data-status", "0");
                el.children[3].innerHTML = "Læst";

                // Update header messages alert
                const messagesAlert = document.getElementById("unread-messages");
                const messagesBullet = document.getElementById("unread-bullet");
                let unreadMessages = document.getElementById("unread-messages").innerHTML;
                if (unreadMessages > 1) {
                    unreadMessages = unreadMessages - 1;
                    messagesAlert.innerHTML = unreadMessages;
                } else if (unreadMessages == 1) {
                    messagesAlert.style.display = "none";
                    messagesBullet.style.display = "none";
                }
            }
        });
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

/* Open reply */
replyBtn.addEventListener("click", () => {
    theMessage.style.display = "none"
    theResponse.style.display = "block"
})

/* Close reply */
backToMessage.addEventListener("click", () => {
    theMessage.style.display = "block"
    theResponse.style.display = "none"
})

sendResponse.addEventListener("click", () => {
    alert("LOL")
})
</script>