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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel='stylesheet' type='text/css' media='screen' href='index.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='footer.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='admin.css'>

</head>
<body>

<?php
ob_start();
require_once("./homeheader.php");
require_once("./db.php");

if (!array_key_exists( "adminloggedin",$_SESSION)) {
    # code...
    header("Location: ./index.php"); /* Redirect browser */

    /* Make sure that code below does not get executed when we redirect. */
    exit;
}
if (isset($_REQUEST["logout"]))
{
    // remove all session variables
    session_unset();

// destroy the session
    session_destroy();
    header("Location: ./index.php");
    exit;
}

//$query="select * from tbl_session";
//$sockets = db::getInstance()->get_result($query);
//$query="insert into `tbl_chats` (coloum_name) values('".$val."')";


?>
<p style="display: none;" id="adminname"> <?php echo($_SESSION["userdata"]["club_name"]); ?> </p>
<div class="container-fluid px-5" id="card-container">
        <div class="row mt-5 mb-3">
            <div class="col-lg-4 col-sm-6">
                <div class="card-box bg-blue">
                    <div class="inner py-4 ml-2">
                        <h2 class="pb-1"> My Profile </h2>
                        <h6> Manage your profile </h6>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </div>
                    <a href="./adminprofile.php" class="card-box-footer py-3"><b>Lets Go!</b> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="card-box bg-green">
                    <div class="inner ml-2 py-4">
                        <h2 class="pb-1"> Categories & Products </h2>
                        <h6> Manage categories and products </h6>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cart-plus" aria-hidden="true"></i>
                    </div> 
                    <a href="./addproducts.php" class="card-box-footer py-3"><b>Lets Go!</b> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card-box bg-orange">
                    <div class="inner py-4 ml-2 ">
                        <h2 class="pb-1"> Club Requests </h2>
                        <h6> See products requests from clubs </h6>
                    </div>
                    <div class="icon">
                        <i class="fa fa-usd" aria-hidden="true"></i>
                    </div> 
                    <a href="./clubrequests.php" class="card-box-footer py-3"><b><b>Lets Go!</b></b> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card-box bg-red">
                    <div class="inner py-4 ml-2 ">
                        <h2 class="pb-1">Add Business</h2>
                        <h6> Add new business accounts </h6>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="./regbusiness.php" class="card-box-footer py-3"><b><b>Lets Go!</b></b> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card-box bg-dark">
                    <div class="inner py-4 ml-2 ">
                        <h2 class="pb-1">Manage Business</h2>
                        <h6> Edit or delete business accounts </h6>
                    </div>
                    <div class="icon">
                        <i class="fa fa-trash"></i>
                    </div>
                    <a href="./managebusiness.php" class="card-box-footer py-3"><b><b>Lets Go!</b></b> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card-box bg-secondary">
                    <div class="inner py-4 ml-2 ">
                        <h2 class="pb-1">Manage News</h2>
                        <h6> Manage news and blog page </h6>
                    </div>
                    <div class="icon">
                        <i class="fa fa-newspaper-o"></i>
                    </div>
                    <a href="./managenews.php" class="card-box-footer py-3"><b><b>Lets Go!</b></b> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>



<!-- Footer -->
<?php
require_once("./footer.php");
?>
<!-- Footer -->
</body>

<script src="homeheader.js"></script>
<script src="admin.js"></script>
<!-- <script src="admin.js"></script> -->
</html>