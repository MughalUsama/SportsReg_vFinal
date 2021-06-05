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
    <link rel='stylesheet' type='text/css' media='screen' href='request.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='footer.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='./requestforms/FStyle.css'>

</head>
<body>

<?php
ob_start();

if(!array_key_exists("clubloggedin", $_SESSION)){
  header("Location: ./index.php"); /* Redirect browser */
  exit;
}

require_once("./homeheader.php");
require_once("./db.php");


if (isset($_REQUEST["logout"]))
{
   // remove all session variables
    session_unset();

// destroy the session
    session_destroy();
    header("Location: ./index.php");
    exit;
}
$req_er = "";
if (isset($_REQUEST["next"])){
    $_SESSION["sport"] = $_REQUEST["sports"];
    $_SESSION["cid"] = $_REQUEST["category"];
    $_SESSION["pid"] = $_REQUEST["product"];
    $query="Select * from category where category_id = \"{$_SESSION["cid"]}\";";
    $pdata = db::getInstance()->get_result($query);
    while($row = mysqli_fetch_assoc($pdata))
    {
        $_SESSION["cname"] = $row["category_name"];
    }
    $query="Select * from products where product_id = \"{$_SESSION["pid"]}\";";
    $pdata = db::getInstance()->get_result($query);
    while($row = mysqli_fetch_assoc($pdata))
    {
        $_SESSION["pname"] = $row["product_name"];
    }
}

?>
<div class="container" id="reqform-container">
    <div class="container pl-5 pr-0" id="outline-request">
        <div class="row mt-5 mb-3 pt-5 pb-2 col-12 d-flex justify-content-center">    
            <h3 id="req-head"> Trykkeritjenester - Trykkmerker </h3> <!-- Change names in this line -->
        </div>    
        <div class="row d-flex col-12 px-0 justify-content-center">
            <form class="col-12 px-0" action="./requestforms/TransferMarksSubmit.php" enctype="multipart/form-data" method="POST" id="detail-form">
                <div id="div1" class="form-group row d-flex col-12 justify-content-center">
                <input type="number" class=" reqinput-border form-control ml-3 col-11 col-md-3" id="quantity1" name="quantity1" placeholder="Total number of transfer marks" required>
                <input type="number" class=" reqinput-border form-control ml-3 col-11 col-md-3" id="quantity2" name="quantity2" placeholder="Number of different transfer marks" required>
                </div>
                <div class="form-group row d-flex col-12 justify-content-center">
                <input type="text" class=" reqinput-border form-control ml-3 col-11 col-md-6" id="size" name="size" placeholder="Size of transfer marks" required>
                </div>
                <div class="form-group row d-flex col-12 justify-content-center">
                <textarea class=" reqinput-border form-control ml-3 col-11 col-md-6" id="description" name="description" placeholder="Provide detailed information about your needs" rows="5"  ></textarea>
                </div>
                <div class="form-group row d-flex col-12 justify-content-center">
                  <input class=" reqinput-border form-control ml-3 col-11 col-md-6" type="file" name="fileToUpload" id="fileToUpload" accept=".txt,.xlsx,.png,.jpg,.jpeg,.pdf,.pptx,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                </div>
                <div class="form-group row d-flex col-12 justify-content-center">
                     <?php echo($req_er) ;?>
                </div>
                <div class="form-group row d-flex col-xs-10 col-md-9 justify-content-end">
                <button type="submit" id = "req-btn" name="send-req" class="row col-8 col-md-3 btn btn-default">Send Request</button>
                </div>
            </form>
        </div>
    </div>

</div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModalScrollable0" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle0" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle0">Product Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Thanks for your request. You will receive your offers in a short time.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
<script src="request.js"></script>
</html>