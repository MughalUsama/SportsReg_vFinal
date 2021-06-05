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
    <link rel='stylesheet' type='text/css' media='screen' href='partner.css'>
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


<div class="container-fluid bg-dark text-white pb-3" id="part-container">
    <div class="container col-10 pr-0" id="outline-term">

        <div class="row d-flex col-12 pb-1 justify-content-around" id="center-page">
            <div class="d-none d-md-flex col-md-6 mt-5 pt-5 pb-5" id="partner-img" ></div>
            <div class="col-12 col-md-6">
                <div class="row pt-4 mt-3 pb-1 col-12 ml-1 d-flex justify-content-center">
                <h2>Bli leverandør</h2>
                </div>
                <!-- first paragraph-->
                <p class="ml-1 mt-1 mb-3 pb-2 col-12 text-justify">
                  Er din bedrift på utkikk etter flere kunder, eller har som mål å øke salget og inntjeningen? SportsReg er derfor den foretrukne plattformen. <br>Ved å registrere seg som leverandør vil din bedrift få direkte tilgang til planlagte kjøp fra klubber og lag i idretten. Dette gir dere muligheten til å kjempe om nye kunder og nye salg.<br>
                  Ved siden av ovennevnte vil din bedrift også bli registret i vårt <a class="d-inline" href="https://sportsreg.wellhealth.fit/companyregister.php">leverandørregister</a> og vi tilbyr tilgang til kjøp av innholdsmarkedsføring i våre kanaler.<br>
                  Dersom dette høres interessant ut – kontakt oss i skjemaet nedenfor. Dere vil så bli kontaktet av en SportsReg-representant i løpet av kort tid.
                </p>
            </div>
            <!-- second paragraph-->
            <!-- Button trigger modal -->
<a class="ml-auto mr-4" href="./contactus.php"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">
  Kontakt oss
</button></a>
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
    require_once("homeheader.js");

}
else{
    echo("<script src = \"header.js\"></script>");
}
?>
<script src="partner.js"></script>
</html>
