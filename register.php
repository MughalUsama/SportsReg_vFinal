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

if (array_key_exists('businessloggedin' ,$_SESSION)) {
    header("location: ./businesshome.php");
    exit;  
  }
  
  if(array_key_exists('loggedin',$_SESSION)){
    header("Location: ./userhome.php"); /* Redirect browser */
    /* Make sure that code below does not get executed when we redirect. */
    exit;
  }
  if (array_key_exists('adminloggedin',$_SESSION)) {
    header("Location: ./adminhome.php"); /* Redirect browser */
    /* Make sure that code below does not get executed when we redirect. */
    exit;
  }

require_once("./header.php");
require_once("./db.php");


//$query="select * from tbl_session";
//$sockets = db::getInstance()->get_result($query);
//$query="insert into `tbl_chats` (coloum_name) values('".$val."')";

$errormsg = "d-none";    
$regmsg = "d-none";    

if (isset($_POST["register"])){
    $email = $_POST["email"];
    $query="Select * from clubs where email = '$email';";
    $data = db::getInstance()->get_result($query);
    if(!$data)
    {
        $name =$_POST["clubname"];
        $person =$_POST["contactperson"];
        $telph =$_POST["telephone"];
        $email =$_POST["email"];
        $address =$_POST["address"];
        $code =$_POST["postcode"];
        $city =$_POST["city"];
        $passwd =$_POST["password"];
        
        $query="Insert into clubs(club_name, contact_person, telephone, email, address, post_code, city, password) VALUES ('$name','$person','$telph','$email','$address','$code','$city','$passwd');";

        if(db::getInstance()->dbquery($query))
        {
            header("Location: ./login.php"); /* Redirect browser */
            exit;
        }
    }
    else
    {
      
      $errormsg = "d-flex";    
    }
}
?>
<div class="container" id="regform-container">

    <div class="container px-0" id="outline-register">
        <div class="row mt-5 mb-3 pt-5 pb-2 col-12 d-flex justify-content-center">    
            <h2 class="text-white">Register Club</h2>
        </div>    
        <div class="row d-flex mx-0 col-12 justify-content-center">
            <form class="col-12 mx-0 px-0" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="reg-form" method="POST">
                <div class="form-group row d-flex col-12 justify-content-center">
                    <input type="text" class=" reginput-border form-control ml-3 col-12 col-md-6" id="clubname" name="clubname" placeholder="Club Name"  required>
                </div>
                <div class="form-group row d-flex col-12 justify-content-center">
                <input type="text" class=" reginput-border form-control ml-3 col-12 col-md-6" id="contactperson" name="contactperson" placeholder="Contact Person" required>
                </div>
                <div class="form-group row d-flex col-12 justify-content-center">
                <input type="tel" class=" reginput-border form-control ml-3 col-12 col-md-6" id="telephone" name="telephone" placeholder="Telephone" required>
                </div>

                <div class="form-group row d-flex col-12 py-0 my-0 justify-content-center ml-5">
                <p class="ml-5 my-0 py-0 col-11 col-md-6 text-danger <?php echo($errormsg);?>">Email already in use</p>
                </div>
                <div class="form-group row d-flex col-12 justify-content-center">
                <input type="email" class=" reginput-border form-control ml-3 col-12 col-md-6" id="email" name="email" placeholder="Email (Username)" required>
                </div>
                <div class="form-group row d-flex col-12 justify-content-center">
                <input type="text" class=" reginput-border form-control ml-3 col-12 col-md-6" id="address" name="address" placeholder="Address" required>
                </div>
                <div class="form-group row d-flex col-12 justify-content-center">
                <input type="text" class=" reginput-border form-control ml-3 col-5 col-md-3" id="postcode" name="postcode" placeholder="Post Code" required>
                <input type="text" class=" reginput-border form-control ml-1 col-5 col-md-3" id="city" name="city" placeholder="City" required>
                    
                </div>
                <div class="form-group row d-flex col-12 justify-content-center">
                <input type="password" class=" reginput-border form-control ml-3 col-12 col-md-6" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group row d-flex col-12 justify-content-center">
                <input type="password" class=" reginput-border form-control ml-3 col-12 col-md-6" id="confirmpassword" placeholder="Confirm Password" required>
                </div>
                <div class="form-group row d-flex col-9 justify-content-end">
                <button type="submit" id = "regsub-btn" name="register" class="row col-8 col-md-3 btn btn-default">Register</button>
                </div>
                <div class="form-group row d-flex col-12 justify-content-center ml-5">
                <p class="ml-4 col-11 col-md-6 text-danger" style="display: none;" id="pass-error">Password does not match</p>
                </div>

                <div class="form-group mt-0 pt-0 row d-flex col-12 justify-content-center ml-5">
                <p class="ml-5 col-11 col-md-6 mt-0 pt-0 text-success <?php echo($regmsg);?>" id="reg-success">Registered Successfully</p>
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

<script src="header.js"></script>

<script src="register.js"></script>
</html>