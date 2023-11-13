<?php
$title = "Contact Receipt";
include("../templates/template_top.php"); ?>
<?php

$name = htmlspecialchars($_POST["name"]);
$mail = htmlspecialchars(strval($_POST["email"]));
$phone = htmlspecialchars($_POST["phone"]);
$question = htmlspecialchars($_POST["message"]);
$header = "From: nurses.nexus@donkeyteam.com";
$subject = "Nurses Nexus Question Submission Confirmation";
$recipient = "donkeytestmail@donkeytwo.greenriverdev.com";
$message =
"New Message From: \r\n".$name.
"\r\n\nPhone Number: \r\n".$phone.
"\r\n\nEmail: \r\n".$mail.
"\r\n\nMessage: \r\n".$question;
mail($recipient, $subject, $message, $header);
?>

<div class="card col-9 mx-auto my-5 text-center" id="receipt-div">
    <div class="card-body p-5">
        <h4 class="card-title pb-3">Thank you for your question!</h4>
        <p class="card-text">Your question has been received and will be address by phone or
            email as soon as possible.
        </p>
    </div>
</div>


<?php include("../templates/template_bottom.php");//leave in place for standard mobile sized bottom menu includes the closing tags

