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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!--JQUERY AND bootstrap.js   -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel='stylesheet' type='text/css' media='screen' href='index.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='aboutus.css'>
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


<div class="container-fluid" id="about-container">
    <div class="container col-10 pr-0" id="outline-term">
            
        <div class="row d-flex col-12 pb-2 justify-content-around" id="center-page">
            <div class="d-none d-md-flex col-md-6 mt-5 pt-5" id="partner-img" ></div>
            <div class="col-12 col-md-6">
                <div class="row pt-5 pb-1 col-12 ml-1 d-flex justify-content-center">    
                <h2 class="h2-color">Vi reduserer tid og kostnad</h2>
                </div>    
            <!-- first paragraph-->
        
                <p class="row mt-1 mb-2 col-12 d-flex justify-content-center" style="line-height: 1.65;">
                <br>
                I en stressende og altoppslukende klubbhverdag, sammen med en tilspisset og anstrengende klubbøkonomi, vil klubber og lag alltid være på utkikk etter gode avtaler på planlagte og nødvendige innkjøp. Og med god erfaring fra idretten, i ulike klubbroller, har vi erfart hvor tidskrevende det er å manøvrere seg blant den store mengden av tilbydere for å finne frem til tilbudet som passer klubben eller lagets behov og bankkonto best.
                <br>
                </p>
            </div>

            <!-- second paragraph-->
            <div class="col-12 pb-2 mb-2">
                <p>
                <br><br>
                <h5 class="text-center font-weight-bold my-h5 bg-dark py-3">Det ønsket vi å gjøre noe med – derav SportsReg.</h5> <br>SportsReg er en markedsplass hvor din klubb, lag eller organisasjon helt kostnadsfritt kan registrere sin forespørsel på et tenkt produkt- eller tjenestekjøp. Forespørselen blir deretter sendt automatisk til våre leverandørbedrifter, som så besvarer med et tilbud på den registrerte forespørselen. Klubben/laget/organisasjonen vil deretter få tilsendt tilbud fra én eller flere tilbydere. <br><br>Tjenesten bidrar til at klubben reduserer tid på å undersøke, kontakte og diskutere kjøp med flere ulike leverandører. Hos SportsReg når man alle på en gang. I tillegg bidrar tjenesten til at klubben vil kunne spare penger på sitt kjøp – da de ulike tilbyderne gjerne vil kjempe for din bestilling, ved å tilby et konkurransedyktig tilbud slik at de vinner en ny kunde og ordre. 
<br><br> Registrer din klubb, lag eller organisasjon i dag, og benytt SportsReg helt kostnadsfritt. Benytter dere SportsReg ved deres kjøp er dere hvert kvartal med i trekningen av ulike premier fra våre leverandører.
                </p>
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
<script src="aboutus.js"></script>
</html>