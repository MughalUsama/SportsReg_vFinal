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
    <link rel='stylesheet' type='text/css' media='screen' href='login.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='footer.css'>
</head>
<body>



<?php
ob_start();
require_once("./header.php");
require_once("./db.php");
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


$ac_er = "";


if (isset($_REQUEST["login"]))
{
    $email = $_REQUEST["email"];
    $passwd = $_REQUEST["passwd"];
    $query = "Select * from business_info where email = \"$email\" and password = \"$passwd\";";
    $data = db::getInstance()->get_result($query);
    if ($data)
    {
        $_SESSION['userdata'] = mysqli_fetch_assoc($data) ;
        $_SESSION['username'] = $_SESSION['userdata']['business_name'];
        $_SESSION['businessloggedin'] = "yes";
        header("location: ./businesshome.php");
        exit;        
    }
    else
    {
        $ac_er = "<p class = \"bg-danger px-1 text-white\">Invalid Credentials</p>";
    }
}
?>

<div class="cotainer mt-5 mb-5 d-flex justify-content-center align-content-center" id="login-div">
    <div class="outline-2 py-5" id="login-div-body">
        <div class="row justify-content-center align-content-center mb-3">
            <h2>LOG IN - BUSINESS</h2>
        </div>
        <div class="row d-flex col-10 col-offset-2 align-content-center justify-content-center">
        <form method="POST">
            <div class="form-group">
                <input type="email" class="form-control outline-input" id="userlogin" name = "email" placeholder="Email (Username)" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control outline-input" id="userpass" name = "passwd" minlength="8" placeholder="Password" required>
            </div>   
            <div class="form-group">
                <button type="submit" class="form-control sub-btn" name="login" id="usersubmit"> Log in</button>
            </div>
        </form>
        </div>
        <div class="row justify-content-center align-content-center">
                <?php echo("$ac_er"); ?>
        </div>
    
    </div>
</div>



<!-- Footer -->
<?php
require_once("./footer.php");
?><!-- Footer -->
</body>

<script src="header.js"></script>

<script src="business.js"></script>
</html>