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
    <link rel='stylesheet' type='text/css' media='screen' href='cluboffers.css'>

</head>
<body>

<?php
ob_start();
if(!array_key_exists("clubloggedin",$_SESSION)){
    header("Location: ./index.php"); /* Redirect browser */
    /* Make sure that code below does not get executed when we redirect. */
    exit;

}
require_once("./homeheader.php");
require_once("./db.php");
$allquery = "Select * from club_requests where club_id = \"{$_SESSION["userdata"]["club_id"]}\"";
$allresult = db::getInstance()->get_result($allquery);
$accquery = "Select * from club_requests where club_id = \"{$_SESSION["userdata"]["club_id"]}\" and accepted_by is NOT NULL";
$accresult = db::getInstance()->get_result($accquery);

if (isset($_REQUEST["logout"]))
{
    // remove all session variables
    session_unset();

// destroy the session
    session_destroy();
    header("Location: ./index.php");
    exit;
}
?>

<!-- -->
<div class="row mid-body col-12">


<div class="content-container">

<div class="container-fluid" id="resp-x" >
    <div class="row  outline-1">
        <div class="row col-12 py-3 mt-2 pl-3 ml-2 justify-content-start">
            <h2 class=" col-sm-12 col-md-8">My offers</h2>
            <div class=" col-sm-12 col-md-4">
            <!-- Button trigger modal -->
            <button type="button" id="all-req" class="btn ml-2 mt-1 col-sm-12 col-md-8 btn-primary float-right" data-toggle="modal" data-target="#exampleModalScrollable1">
            All Requests
            </button>
            <button type="button" id="acc-off" class="btn ml-2 col-sm-12 col-md-8 mt-1 btn-primary float-right" data-toggle="modal" data-target="#exampleModalScrollable0">
            Accepted Offers
            </button>

            </div>
        </div>
        <div class="row pl-3 ml-2 px-0 col-12 justify-content-start">

            <div class="row d-flex col-12 mb-5 pb-2 justify-content-start" id="offers">
<!-- Card start-->


            </div>
        </div>


    <!--container 2-->
    </div>


</div>
<!-- Footer -->
<?php
require_once("./footer.php");
?>
<!-- Footer -->
</div>

    <div class="sidebar-container">
    <ul class="sidebar-navigation">

    <li>
        <a href="./userhome.php">
            <i class="fa fa-home" aria-hidden="true"></i> Homepage
        </a>
        </li>
        <li class="border-top border-light">
        <a href="#">
            <i class="fa fa-money" aria-hidden="true"></i> My Offers
        </a>
        </li>
        <li class="border-top border-light">
        <a href="#">
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




<!-- Modal -->
<div class="modal fade" id="exampleModalScrollable0" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle0" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle0">Accepted Offers</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="wrappera">
        <div class="diva"></div>
      </div>

        <div class="table-responsive wrapperb">
        <table class="table table-striped divb">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Sports</th>
            <th scope="col">Category</th>
            <th scope="col">Product</th>
            <th scope="col">Accepted-By</th>
            <th scope="col">Size</th>
            <th scope="col">Quantity</th>
            <th scope="col">Color</th>
            <th scope="col">Description</th>
            <th scope="col">Created On</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $count =0;
        if ($accresult) {
            while($row = $accresult->fetch_assoc())
            {
                $cquery = "Select * from category where category_id = \"{$row["category_id"]}\"";
                $cresult = db::getInstance()->get_result($cquery);
                $row1 = $cresult->fetch_assoc();
                $pquery = "Select * from products where product_id = \"{$row["product_id"]}\"";
                $presult = db::getInstance()->get_result($pquery);
                $row2 = $presult->fetch_assoc();
                $bquery = "Select * from business_info where business_id = \"{$row["accepted_by"]}\"";
                $bresult = db::getInstance()->get_result($bquery);
                $row3 = $bresult->fetch_assoc();
                $count = $count + 1;
                $htmlline = "<tr>
                <th scope=\"row\">$count</th>
                <td>{$row["sports"]}</td>
                <td>{$row1["category_name"]}</td>
                <td>{$row2["product_name"]}</td>
                <td>{$row3["business_name"]}</td>
                <td>{$row["size"]}</td>
                <td>{$row["quantity"]}</td>
                <td>{$row["color"]}</td>
                <td><div class=\"scrollable\">{$row["description"]}</div></td>
                <td>{$row["created_on"]}</td>
                </tr>";
                echo($htmlline);
            }
        }
        ?>
        </tbody>
        </table>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalScrollable1" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle1">ALL REQUESTS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="wrapper1">
        <div class="div1"></div>
      </div>

        <div class="table-responsive wrapper2">
        <table class="table table-striped div2">
        <tbody>
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Sports</th>
            <th scope="col">Category</th>
            <th scope="col">Product</th>
            <th scope="col">Size</th>
            <th scope="col">Quantity</th>
            <th scope="col">Color</th>
            <th scope="col">Description</th>
            <th scope="col">Created On</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $count =0;
        if ($allresult) {
            while($row = $allresult->fetch_assoc())
            {
                $cquery = "Select * from category where category_id = \"{$row["category_id"]}\"";
                $cresult = db::getInstance()->get_result($cquery);
                $row1 = $cresult->fetch_assoc();
                $pquery = "Select * from products where product_id = \"{$row["product_id"]}\"";
                $presult = db::getInstance()->get_result($pquery);
                $row2 = $presult->fetch_assoc();
                $count = $count + 1;
                $htmlline = "<tr>
                <th scope=\"row\">$count</th>
                <td>{$row["sports"]}</td>
                <td>{$row1["category_name"]}</td>
                <td>{$row2["product_name"]}</td>
                <td>{$row["size"]}</td>
                <td>{$row["quantity"]}</td>
                <td>{$row["color"]}</td>
                <td><div class=\"scrollable\">{$row["description"]}</div></td>
                <td>{$row["created_on"]}</td>
                </tr>";
                echo($htmlline);
            }
        }
        ?>
        </tbody>
    </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</body>

<script src="homeheader.js"></script>
<script src="sidebar.js"></script>
<script src="userhome.js"></script>
<script src="cluboffers.js"></script>
</html>
