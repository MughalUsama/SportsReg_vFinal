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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' type='text/css' media='screen' href='index.css'>

    <link rel='stylesheet' type='text/css' media='screen' href='sidebar.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='footer.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='userhome.css'>
</head>
<body>

<?php
ob_start();

require_once("./homeheader.php");
require_once("./db.php");

if(!array_key_exists("loggedin",$_SESSION)){
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
$clubname = $_SESSION['userdata']['club_name'];

$query="Select * from category;";
$pdata = db::getInstance()->get_result($query);
$query="Select * from sports;";
$sportsdata = db::getInstance()->get_result($query);
$newmsg = "";
$msgquery="Select * from offer_messages where club_id =\"{$_SESSION["userdata"]["club_id"]}\" and is_seen = 0 and sentby = 1 and status = 0;";
$msgdata = db::getInstance()->get_result($msgquery);
if($msgdata)
{
    $newmsg = "&#9993;";
}
?>
<p class = "d-none" id="clubname">
    <?php echo($clubname);?></p>
<!-- -->
<div class="row mid-body">


<div class="content-container">

<div class="container-fluid">
    <div class="row outline-1 pt-1 pb-3 mb-3" id="main-form">
        <div class="col-1 col-md-6 pb-4" id="football-image"></div>
            <div class="col-11 col-md-6 pb-3 pt-5">
            <h3 class="row wrap p-4">GET NON-BINDING OFFERS – SAVE TIME AND MONEY ON SPORT PURCHASES 
            </h3>
            <form method="POST" action="./request.php" id="req-form">
                <div class="row">
            
                    <div class="btn-group mt-2">
                        <div class="form-group">
                        <select name="sports" class="form-control" id="sports" required>
                        <option  value = "" selected>Choose Sport </option>
                        <?php
                            if($sportsdata){
                                while($row = mysqli_fetch_assoc($sportsdata))
                                {
                                    echo("<option sportid = \"{$row['sports_id']}\" value = \"{$row['sports_name']}\">{$row['sports_name']}</option>");                            
                                }
                            }
                        ?>
                        </select>
                    </div>
                </div>
            </div>
            <!--/row-->
                <div class="row">
                    <div class="btn-group mt-2">
                    <div class="form-group">
                        <select class="form-control" name="category" id="category" required>
                        <option value = "" selected>Choose Category </option>
                            <?php 
                            while($row = mysqli_fetch_assoc($pdata))
                            {
                                echo("<option value = \"{$row['category_id']}\">{$row['category_name']}</option>");                            
                            }
                            ?>

                        </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="btn-group mt-2">
                    <div class="form-group">
                        <select class="form-control" name="product" id="prod" required>
                        <option  value = "" selected>Choose Product/Service </option>

                        </select>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-end mr-5 pb-5 mt-3">
                    <button type="submit" name = "next" id="btn-next">
                        Next
                    </button>
                </div>
            </form>
        </div>
    <!--container 2-->
    </div>


    <li class="mt-2 d-flex d-md-none">
        <a href="#">
            <i class="fa fa-home" aria-hidden="true"></i> Homepage
        </a>
    </li>
    <li class="border-top border-light d-flex d-md-none">
        <a href="./cluboffers.php">
            <i class="fa fa-money" aria-hidden="true"></i> My Offers<sup><?php echo($newmsg) ?></sup>
        </a>
        </li>
    <li class="border-top border-light d-flex d-md-none">
        <a href="./clubprofile.php">
            <i class="fa fa-user" aria-hidden="true"></i> My Profile
        </a>
    </li> 
    <li class="border-top border-light d-flex d-md-none mb-2">
        <a href="./aboutus.php">
            <i class="fa fa-question-circle" aria-hidden="true"></i> About Us
        </a> 
    </li>

</div>
<!-- Footer -->
<?php
require_once("./footer.php");
?>
<!-- Footer -->
</div>

    <div class="sidebar-container hide-sm">
    <ul class="sidebar-navigation">
        
        <li>
        <a href="#">
            <i class="fa fa-home" aria-hidden="true"></i> Homepage
        </a>
        </li>
        <li class="border-top border-light">
        <a href="./cluboffers.php">
            <i class="fa fa-money" aria-hidden="true"></i> My Offers <sup><?php echo($newmsg) ?></sup>
        </a>
        </li>
        <li class="border-top border-light">
        <a href="./clubprofile.php">
            <i class="fa fa-user" aria-hidden="true"></i> My Profile
        </a>
        </li> 
        <li class="border-top border-light">
        <a href="./aboutus.php">
            <i class="fa fa-question-circle" aria-hidden="true"></i> About Us
        </a> 
        </li>
        <li class="border-top border-bottom border-light">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <button class="bg-transparent border-0  logout-btn" type="submit"  name="logout">
                    <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
            </button> 
        </form>
        </li>
    </ul>
    </div>

</div>



</body>

<script src="homeheader.js"></script>
<script src="sidebar.js"></script>
<script src="userhome.js"></script>
</html>