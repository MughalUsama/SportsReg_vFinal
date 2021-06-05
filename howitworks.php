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
    <!--JQUERY AND bootstrap.js   -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel='stylesheet' type='text/css' media='screen' href='index.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='howitworks.css'>
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



<div class="container-fluid mx-auto pb-2 justify-content-center how-box" id="an1">
        <div class="row d-flex justify-content-around ml-3 py-3 pr-5 flex-wrap an1div">
        <h1 class="my-1 ml-2 py-2">
        How it works
        </h2>
        </div>

        <hr class="py-0" width="175">
        <div class="d-flex mt-4 ml-5 pb-2 justify-content-around flex-wrap py-1 myicons">
            <div class="icontext justify-content-center ml-1 align-items-center" id="transf-1">
                <img class="row ic1" src="./img/1.svg" width="100" alt="Fill form icon">
                <div class="row custom-numbering"><h5><span><pre class="round-back d-inline"> 1 </pre></span> Fill out the form</h5></div>
                <div class="row icontext1"><p>Save time by simply filling out the form. We obtain offers from several providers based on your needs.</p></div>
            </div>
            <div class="icontext justify-content-center align-items-center" id="transf-2">
                <img class="row ic1" src="./img/2.svg" width="100" alt="Receive offer icon">
                <div class="row custom-numbering"><h5><span><pre class="round-back d-inline"> 2 </pre></span> Receive offers</h5></div>
                <div class="row icontext1"><p>Receive offers from several different suppliers and see which offer suits you best.</p></div>

            </div>
            <div class="icontext justify-content-center align-items-center" id="transf-3">
                <img class="row ic1" src="./img/3.svg" width="100" alt="Choose offer icon">
                <div class="row custom-numbering"><h5><span><pre class="round-back d-inline"> 3 </pre></span> Choose offer</h5></div>
                <div class="row icontext1"><p>Choose the best offer based on your needs.</p></div>

            </div>
        </div>
</div>




<!-- Footer -->
<?php
require_once("./footer.php");
?>
<!-- Footer -->
<?php
if (array_key_exists('businessloggedin', $_SESSION) or array_key_exists('loggedin', $_SESSION) or array_key_exists('adminloggedin', $_SESSION)) {
    require_once("homeheader.js");
    
}
else{
    echo("<script src = \"header.js\"></script>");
}
?><script src="./js/index.js"></script>
<script>
    $(document).ready(function() 
    {
        $("#my-icon1").fadeIn(600);
        $("#my-icon2").fadeIn(600)
        $("#my-icon3").fadeIn(600);
    });
</script>


</body>
</html>