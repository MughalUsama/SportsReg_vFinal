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
    <link rel='stylesheet' type='text/css' media='screen' href='login.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='footer.css'>

</head>
<body>


<?php
ob_start();

require_once("./header.php");
require_once("./db.php");

//$query="select * from tbl_session";
//$sockets = db::getInstance()->get_result($query);
//$query="insert into `tbl_chats` (coloum_name) values('".$val."')";
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
$errormsg = "d-none";    

if (isset($_POST["login"])){
  $email = mysqli_escape_string(db::getInstance(), $_POST["email"]);
  $passwd = mysqli_escape_string(db::getInstance(), $_POST["passwd"]);
  $query="Select * from clubs where email = '$email' and password = '$passwd' ;";
  $data = db::getInstance()->get_result($query);
  
  if($data){

    $_SESSION['userdata'] = mysqli_fetch_assoc($data) ;
    $_SESSION["username"] = $_SESSION['userdata']['club_name'];
    if($_SESSION['userdata']['isadmin']=='1'){ 
      header("location: ./admin.php");
      $_SESSION['adminloggedin'] = "yes";
    }
    else{
    header("Location: ./userhome.php"); /* Redirect browser */
    $_SESSION['loggedin'] = "yes";
    $_SESSION['clubloggedin'] = "yes";
    }
    /* Make sure that code below does not get executed when we redirect. */
    exit;
  
    }
  else
  {
    
    $errormsg = "d-flex";    
  }
}
?>
<div class="cotainer mt-5 mb-5 d-flex justify-content-center align-content-center" id="login-div">
    <div class="outline-2 py-5" id="login-div-body">
        <div class="row justify-content-center align-content-center mb-3">
            <h2>LOG IN</h2>
        </div>
        <div class="row d-flex col-10 col-offset-2 align-content-center justify-content-center">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="login-form">
            <div class="form-group">
                <input type="email" class="form-control outline-input" id="userlogin" placeholder="Email (Username)" name="email" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control outline-input" id="userpass" minlength="8" placeholder="Password" name="passwd" required>
            </div>
            <div class="form-group col-12">
                <button type="submit" name="login" class="form-control sub-btn" id="usersubmit"> Log in</button>
            </div>
        </form>
        </div>
        <div class="row mar-1 d-flex align-content-center justify-content-center">
            <a href="#forgetpassmodal" data-toggle="modal" data-target="#forgetpassmodal" class="my-font-1">Forgot your password?</a>
        </div>
        <div class="row mar-1 align-content-center justify-content-center pt-2 ">
            <hr class="my-hr-2">
        </div>
        <div class="row mar-1 mt-2 d-flex align-content-center justify-content-center">
            <p class="my-font-1">Don't have an account?</p>
        </div>
        <div class="row mar-1 align-content-center justify-content-center pt-2 ">
          <div class="form-group row">
                <button class="form-control reg-btn" id="userregister"> Register</button>
          </div>
        </div>
        <div class="row mar-1 align-content-center justify-content-center pt-2 <?php echo($errormsg);?>">
            <div  class="form-group row">
              <p class="text-danger">Incorrect email of password</p>
             </div>  
        </div>
   </div>
</div>


<!-- Modal -->
<div class="modal fade" id="forgetpassmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Fogot Password?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="email" class="form-control col-12" id="useremail" placeholder="Enter your Email" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" id = "reset-btn" data-target="#resetpassmodal">Next</button>
      </div>
    </div>
  </div>
</div>

<!-- Code Modal -->
<div class="modal fade" id="resetpassmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Reset Code</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <label class="col-12"><b><i> Check your mail for reset code.</i></b></label>
      <input type="number" class="form-control col-12" id="resetcode" placeholder="Reset Code" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-dismiss="modal" id="nextpass-btn">Next</button>
      </div>
    </div>
  </div>
</div>

<!-- New Password Modal -->
<div class="modal fade" id="newpassmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="password" class="form-control col-12" id="newpass" placeholder="New Password" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="change-btn" data-toggle="modal">Change</button>
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

<script src="header.js"></script>

<script src="login.js"></script>
</html>