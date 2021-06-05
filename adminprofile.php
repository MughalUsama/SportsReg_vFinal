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
    <link rel='stylesheet' type='text/css' media='screen' href='register.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='footer.css'>
</head>
<body>

<?php
ob_start();

if(($_SESSION['adminloggedin']) != "yes"){
    header("Location: ./index.php"); /* Redirect browser */
    /* Make sure that code below does not get executed when we redirect. */
    exit;
}

require_once("./db.php");


//$query="select * from tbl_session";
//$sockets = db::getInstance()->get_result($query);
//$query="insert into `tbl_chats` (coloum_name) values('".$val."')";

$errormsg = "d-none";    
$regmsg = "d-none";    

if (isset($_POST["update"])){
    $email = $_SESSION['userdata']['email'];
    $query="Select * from clubs where email = '$email';";
    $data = db::getInstance()->get_result($query);
    if($data)
    {
        $name =$_POST["clubname"];
        $passwd =$_POST["password"];
        
        $query="Update clubs Set club_name = \"$name\", password = '$passwd' where email = '{$_SESSION["userdata"]["email"]}';";
        $regmsg = $query;
        if(db::getInstance()->dbquery($query))
        {
            $regmsg = "d-flex";        
        }
        $query="Select * from clubs where email = '$email';";
        $data = db::getInstance()->get_result($query);
        $_SESSION['userdata'] = mysqli_fetch_assoc($data);
    }
}
require_once("./homeheader.php");

?>

<div class="container" id="regform-container">

    <div class="container pl-5 pr-0" id="outline-register">
        <div class="row mt-5 mb-3 pt-5 pb-2 col-12 d-flex justify-content-center">    
            <h2 class="text-white">Admin</h2>
        </div>    
        <div class="row d-flex ml-n1 col-12 justify-content-center">
            <form class="col-12" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="update-form" method="POST">
    
                <div class="form-group mt-0 pt-0 row d-flex col-12 justify-content-center ml-5">
                <p class="ml-5 col-11 col-md-6 mt-0 pt-0 text-success <?php echo($regmsg);?>" id="reg-success">Updated Successfully</p>
                </div>

                <div class="form-group row d-flex col-12 justify-content-center">
                    <input type="text" class=" reginput-border form-control ml-3 col-11 col-md-6" value="<?php echo($_SESSION['userdata']['club_name']); ?>" id="clubname" name="clubname" placeholder="Admin Name"  required>
                </div>
                <div class="form-group row d-flex col-12 justify-content-center">
                <input type="email" class=" reginput-border form-control ml-3 col-11 col-md-6" value="<?php echo($_SESSION['userdata']['email']); ?>" id="email" placeholder="Email (Username)" disabled required>
                </div>
                <div class="form-group row d-flex col-12 justify-content-center">
                <input type="password" class=" reginput-border form-control ml-3 col-11 col-md-6" value="<?php echo($_SESSION['userdata']['password']); ?>" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group row d-flex col-12 justify-content-center">
                <input type="password" class=" reginput-border form-control ml-3 col-11 col-md-6" value="<?php echo($_SESSION['userdata']['password']); ?>" id="confirmpassword" placeholder="Confirm Password" required>
                </div>
                <div class="form-group row d-flex col-9 justify-content-end">
                <button type="submit" id = "regsub-btn" name="update" class="row col-8 col-md-3 btn btn-default">Update</button>
                </div>
                <div class="form-group row d-flex col-12 justify-content-center ml-5">
                <p class="ml-4 col-11 col-md-6 text-danger" style="display: none;" id="pass-error">Password does not match</p>
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

<script src="homeheader.js"></script>

<script src="adminprofile.js"></script>
</html>