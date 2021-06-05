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
    <link rel="stylesheet" type='text/css' href="./scale.css"/>
    <link rel='stylesheet' type='text/css' media='screen' href='index.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='companyregister.css'>
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
require_once("./db.php");
?>



<div class="container-fluid" id="creg-container">
    <div class="container col-12 pr-0" id="outline-term">
            
        <div class="row d-flex col-12 pb-1 justify-content-center" id="center-page">
            <div class="d-none mt-2 d-md-flex col-md-12 py-2" id="f1-img" >
                <div class="d-none d-md-flex col-md-7" id="f2-img" ></div>
                <div class="d-none d-md-flex col-md-5" id="f3-img" ></div>

            </div>
        </div>

        <div class="row d-flex col-12 pb-1 justify-content-center">
            <h3>Company Register</h3>
        </div>
        <div class="row d-flex col-12 justify-content-center align-items-center" id="search-div">
            <p class="hide-xs mx-auto col-md-3 mt-3"> Search <i class="fa fa-search" aria-hidden="true"></i></p>
            <input type="text" class="d-inline col-xs-12 col-md-9 form-control " id="search-txt" name="search-txt" placeholder="Type here to search">
        </div>
        <div class="row d-flex my-3 col-12 justify-content-around align-items-center">
        <div class="form-check ml-1 form-check-inline">
                        <input class="form-check-input" type="checkbox" id="fcbox" value="option1">
                        <label class="form-check-label" for="fcbox">Football</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="hcbox" value="option2">
                        <label class="form-check-label" for="hcbox"> Handball</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="icbox" value="option3">
                        <label class="form-check-label" for="icbox">Ishockey</label>
                    </div>
        </div>
        <div class="row d-flex my-3 col-12 pt-5 justify-content-between align-items-start" id="scontent">
        
        <?php 
            $query = "Select Distinct(category_id) from business_categories Order by category_id;";
            $result = db::getInstance()->get_result($query);
            $categories = array();
            if($result)
            {
                while($row = mysqli_fetch_assoc($result)){
                    array_push($categories,$row);
                }
            }
            foreach($categories as $category)
            {
                $query1 = "Select * from category where category_id = {$category["category_id"]};";
                $result = db::getInstance()->get_result($query1);
                $row = mysqli_fetch_assoc($result);
                $query2 = "Select * from business_categories where category_id = {$category["category_id"]};";
                $result2 = db::getInstance()->get_result($query2);
                $disp = "<div class=\"row col-xs-12 px-0 col-md-4 d-flex justify-content-center\">";
                $disp = $disp."<h6 class = \"row ml-auto px-0 mt-4 mb-2 justify-content-center col-12 cname\"><b>{$row["category_name"]}</b></h6>";
                while($row2 = mysqli_fetch_assoc($result2))
                {
                    $query2 = "Select * from business_info where business_id = {$row2["business_id"]} and business_id in (Select business_id from business_sports where sports_name = \"Football\" or sports_name = \"Handball\" or sports_name = \"Ishockey\" );";
                    $result3 = db::getInstance()->get_result($query2);
                    $row3 = mysqli_fetch_assoc($result3);
                    $disp = $disp."<p class = \"row ml-auto my-0 px-0 justify-content-center col-12 bname\" currentbid = \"{$row2["business_id"]}\"><u>".$row3["business_name"]."</u></p>";
                }
                $disp = $disp."</div>";
                echo($disp);
            }
        ?>

        </div>


    </div>



</div>


<!-- Footer --><?php
require_once("./footer.php");
?>
<!-- Footer -->
</body>


<!-- Development -->
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>


<?php
if (array_key_exists('businessloggedin', $_SESSION) or array_key_exists('loggedin', $_SESSION) or array_key_exists('adminloggedin', $_SESSION)) {
    echo("<script src = \"homeheader.js\"></script>");    
}
else{
    echo("<script src = \"header.js\"></script>");
}
?>
<script src="companyregister.js"></script>
</html>