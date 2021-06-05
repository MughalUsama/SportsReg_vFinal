<?php
session_start();
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>SportsReg</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="icon" href="./img/logo2.png"/>
    <!--bootstrap   -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--JQUERY AND popper   -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!--JQUERY AND bootstrap.js   -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel='stylesheet' type='text/css' media='screen' href='index.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='contactus.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='footer.css'>
</head>
<body>

<?php
ob_start();

if (array_key_exists('businessloggedin', $_SESSION) or array_key_exists('loggedin', $_SESSION) or array_key_exists('adminloggedin', $_SESSION)) {
    require_once("./homeheader.php");
}
else{
    require_once("./header.php");
}
?>

<div class="container" id="reqform-container">

    <div class="container pl-5 pr-0" id="outline-request">
        <div class="row mt-5 mb-3 pt-5 pb-2 col-12 d-flex justify-content-center">
            <h2 id="contact-head pt-2">Contact Us</h2>
        </div>
        <div class="row d-flex col-12 justify-content-center">
            <form class="col-12" id="contact-form">
                <div class="form-group row d-flex col-12 justify-content-center">
                <input type="text" class=" reqinput-border form-control ml-3 col-11 col-md-6" id="name" placeholder="Name" required>
                </div>
                <div class="form-group row d-flex col-12 justify-content-center">
                <input type="email" class=" reqinput-border form-control ml-3 col-11 col-md-6" id="email" placeholder="Email" required>
                </div>
                <div class="form-group row d-flex col-12 justify-content-center">
                <input type="tel" class=" reqinput-border form-control ml-3 col-11 col-md-6" id="telephone"  pattern="[0-9]{8,16}" placeholder="Telephone" required>
                </div>
                <div class="form-group row d-flex col-12 justify-content-center">
                <textarea class=" reqinput-border form-control ml-3 col-11 col-md-6" id="description" placeholder="Your message" rows="5"></textarea>
                </div>

                <div class="form-group row d-flex col-9 justify-content-end">
                <button id = "contact-btn" class="row col-8 col-md-3 btn btn-default">Send</button>
                </div>
            </form>
        </div>
    </div>

</div>




<!-- Footer -->
<?php
require_once("./footer.php");
?>
<!-- Footer -->
</body>

<?php
if (array_key_exists('businessloggedin', $_SESSION) or array_key_exists('loggedin', $_SESSION) or array_key_exists('adminloggedin', $_SESSION)) {
    echo("<script src = \"homeheader.js\"></script>");
}
else{
    echo("<script src = \"header.js\"></script>");
}
?>
<script src="request.js"></script>
<script src="contactus.js"></script>
</html>
