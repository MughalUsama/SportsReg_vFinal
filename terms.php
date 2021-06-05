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
    <link rel='stylesheet' type='text/css' media='screen' href='terms.css'>
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


<div class="container-fluid" id="term-container">
    <div class="container pl-5 pr-0" id="outline-term">
        <div class="row mt-5 mb-3 pt-5 pb-2 col-12 d-flex justify-content-center">    
            <h2 class="text-white">Terms and Conditions</h2>
        </div>    
        <div class="row d-flex col-12 justify-content-center">    
            <div class="card col-12 rounded mb-1"><div class="card-header"><h5 class="mb-0"><a class="d-block text-left text-dark" > Hvordan deltar jeg i en quiz? </a></h5></div></div>
        </div>

        <div class="row d-flex col-12 justify-content-center">    
            <div class="card col-12 rounded mb-1"><div class="card-header"><h5 class="mb-0"><a class="d-block text-left text-dark" > Hvordan deltar jeg i en quiz? </a></h5></div></div>
        </div>

        <div class="row d-flex col-12 justify-content-center">    
            <div class="card col-12 rounded mb-1"><div class="card-header"><h5 class="mb-0"><a class="d-block text-left text-dark" > Hvordan deltar jeg i en quiz? </a></h5></div></div>
        </div>

        <div class="row d-flex col-12 justify-content-center">    
            <div class="card col-12 rounded mb-1"><div class="card-header"><h5 class="mb-0"><a class="d-block text-left text-dark" > Hvordan deltar jeg i en quiz? </a></h5></div></div>
        </div>

        <div class="row d-flex col-12 justify-content-center">    
            <div class="card col-12 rounded mb-1"><div class="card-header"><h5 class="mb-0"><a class="d-block text-left text-dark" > Hvordan deltar jeg i en quiz? </a></h5></div></div>
        </div>

        <div class="row d-flex col-12 justify-content-center">    
            <div class="card col-12 rounded mb-1"><div class="card-header"><h5 class="mb-0"><a class="d-block text-left text-dark" > Hvordan deltar jeg i en quiz? </a></h5></div></div>
        </div>

    
        </div>
    </div>
</div>


<!-- Footer --><?php
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
<script src="login.js"></script>
</html>