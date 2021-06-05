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
    <link rel='stylesheet' type='text/css' media='screen' href='./chosen/chosen.css'>

    <!--JQUERY AND popper   -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!--JQUERY AND bootstrap.js   -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="./chosen/chosen.jquery.js"></script>
    <link rel='stylesheet' type='text/css' media='screen' href='index.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='regbusiness.css'>

</head>
<body>

<?php
ob_start();
require_once("./homeheader.php");
require_once("./db.php");
if (!array_key_exists('businessloggedin',$_SESSION)) {
    header("Location: ./index.php"); /* Redirect browser */
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
$ac_er = "";
$query = "Select * from business_categories where business_id = \"{$_SESSION["userdata"]["business_id"]}\";";
$pdata = (db::getInstance()->get_result($query));


$sportquery = "Select * from business_sports where business_id = \"{$_SESSION["userdata"]["business_id"]}\" and sports_name = \"Football\";";
$footballdata = (db::getInstance()->get_result($sportquery));

$sportquery = "Select * from business_sports where business_id = \"{$_SESSION["userdata"]["business_id"]}\" and sports_name = \"Handball\";";
$handballdata = (db::getInstance()->get_result($sportquery));

$sportquery = "Select * from business_sports where business_id = \"{$_SESSION["userdata"]["business_id"]}\" and sports_name = \"Ishockey\";";
$ishockeydata = (db::getInstance()->get_result($sportquery));


if (isset($_REQUEST["regsub-btn"]))
{

    $address = $_REQUEST["address"];
    $phone = $_REQUEST["btelephone"];
    $website = $_REQUEST["website"];
    $bperson = $_REQUEST["bperson"];
    $contactemail = $_REQUEST["contactemail"];
    $password = $_REQUEST["password"];
    
    $updatequery = "UPDATE business_info SET address= \"$address\",telephone=\"$phone\",website=\"$website\",contact_person=\"$bperson\",contact_email=\"$contactemail\",password=\"$password\" WHERE business_id = \"{$_SESSION["userdata"]["business_id"]}\";";
    if (db::getInstance()->dbquery($updatequery)) {
        $ac_er = "<p class = \"text-success\">Update Successfully</p>";
    }
    else{
        $ac_er = "<p class = \"text-danger\">Update Failed. Try later.</p>";

    }
}
?>

<div class="container" id="regform-container">

    <div class="container pl-5 pr-0" id="outline-register">
        <div class="row mt-5 mb-3 pt-5 pb-2 col-12 d-flex justify-content-center">    
            <h2 class="text-white">Business Profile</h2>
        </div>    
        <div class="row d-flex col-12 justify-content-center">
            <form class="col-12" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group row d-flex col-12 justify-content-center">
                    <img class=" reginput-border form-control ml-3 col-4 col-md-3" height="120" width="120" src="./uploads/<?php echo($_SESSION["userdata"]["logo_name"]) ;?>">
                </div>
                <div class="form-group row d-flex col-12 justify-content-center">
                    <?php echo($ac_er) ?>
                </div>
                <div class="form-group row d-flex col-12 justify-content-center">
                    <input type="text" class=" reginput-border form-control ml-3 col-11 col-md-6" value="<?php echo($_SESSION["userdata"]["business_name"]) ;?>" name="bname" id="bname" placeholder="Business Name" disabled required>
                </div>
                <div class="form-group row d-flex col-12 justify-content-center">
                <input type="text" class=" reginput-border form-control ml-3 col-11 col-md-6" value="<?php echo($_SESSION["userdata"]["vat"]) ;?>" name="vat" id="vat" placeholder="VAT number" disabled required>
                </div>
                <div class="form-group row d-flex col-12 justify-content-center">
                <input type="text" class=" reginput-border form-control ml-3 col-11 col-md-6" value="<?php echo($_SESSION["userdata"]["address"]) ;?>" name="address" id="address" placeholder="Adresse" required>
                </div>
                <div class="form-group row d-flex col-12 justify-content-center">
                <input type="tel" class=" reginput-border form-control ml-3 col-11 col-md-6" value="<?php echo($_SESSION["userdata"]["telephone"]) ;?>" name="btelephone" id="btelephone" placeholder="Telephone" required>
                </div>

                <div class="form-group row d-flex col-12 justify-content-center">
                <input type="email" class=" reginput-border form-control ml-3 col-11 col-md-6" value="<?php echo($_SESSION["userdata"]["business_email"]) ;?>" name="bemail" id="bemail" placeholder="Email (business contact email)" disabled required>
                </div>
                <div class="form-group row d-flex col-12 justify-content-center">
                <input type="url" class=" reginput-border form-control ml-3 col-11 col-md-6" value="<?php echo($_SESSION["userdata"]["website"]) ;?>" name="website" id="website" placeholder="Website (http://www.website.com)" required>
                </div>

                <div class="form-group row d-flex col-12 justify-content-center">
                <input type="text" class=" reginput-border form-control ml-3 col-11 col-md-6" value="<?php echo($_SESSION["userdata"]["contact_person"]) ;?>" name="bperson" id="bperson" placeholder="Contact person" required>
                </div>

                <div class="form-group row d-flex col-12 justify-content-center">
                <input type="email" class=" reginput-border form-control ml-3 col-11 col-md-6" value="<?php echo($_SESSION["userdata"]["contact_email"]) ;?>" name="contactemail" id="contactemail" placeholder="Email (contact person)" required>
                </div>
                <div class="form-group row d-flex col-12 justify-content-center">
                <input type="email" class=" reginput-border form-control ml-3 col-11 col-md-6" value="<?php echo($_SESSION["userdata"]["email"]) ;?>"  id="useremail" placeholder="Email (Username)" disabled required>
                </div>
                
                <div class="form-group row d-flex col-12 justify-content-center">
                <input type="password" class=" reginput-border form-control ml-3 col-11 col-md-6" value="<?php echo($_SESSION["userdata"]["password"]) ;?>" name="password" id="password" placeholder="Password" required>
                </div>
                <div class="form-group row d-flex col-12 justify-content-center">
                    <label class="form-check-label ml-4"><b>Sports: </b></label>
                    <div class="form-check ml-1 form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Football" disabled <?php if ($footballdata){echo("checked");} ;?>>
                        <label class="form-check-label" for="inlineCheckbox1">Football</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="Handball" disabled <?php if ($handballdata){echo("checked");} ;?>>
                        <label class="form-check-label" for="inlineCheckbox2"> Handball</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="Ishockey" disabled <?php if ($ishockeydata){echo("checked");} ;?>>
                        <label class="form-check-label" for="inlineCheckbox3">Ishockey</label>
                    </div>
                </div>
                <div class="form-group row d-flex col-12 justify-content-center">
                    
                    <select data-placeholder="Choose Categories" id="category" multiple class="chosen" disabled>
                    <option value="-1">Your Categories:</option>
                    <?php 
                        while($row = mysqli_fetch_assoc($pdata))
                        {
                            $query = "Select * from category where category_id = \"{$row['category_id']}\";";
                            $categorydata = (db::getInstance()->get_result($query));
                            if ($categorydata) {
                                $row1 = mysqli_fetch_assoc($categorydata);
                                echo("<option value = \"{$row['category_id']}\"  selected>{$row1['category_name']}</option>");                            
                                }
                        }
                        ?>
                  </select>

                </div>


                <div class="form-group row d-flex col-12 justify-content-center">
                    
                    <select data-placeholder="Choose Products/Services" id= "prod"  multiple class="chosen" disabled>
                    <option value="-1">Your Products/Services: </option>
                    <?php
                    
                        $query = "Select * from business_products where business_id = \"{$_SESSION["userdata"]["business_id"]}\";";
                        $pdata = (db::getInstance()->get_result($query));

                        while($row = mysqli_fetch_assoc($pdata))
                        {
                            $query = "Select * from products where product_id = \"{$row['product_id']}\";";
                            $categorydata = (db::getInstance()->get_result($query));
                            if ($categorydata) {
                                $row1 = mysqli_fetch_assoc($categorydata);
                                echo("<option value = \"{$row['product_id']}\"disabled selected>{$row1['product_name']}</option>");                            
                                }
                        }
                        ?>
                    </select>

                </div>
                
                <div class="form-group row d-flex col-12 justify-content-center">
                    
                    <select data-placeholder="Choose Counties" multiple class="chosen" disabled>
                    <option value="-1">Counties where you operate:</option>
                    <?php 
                        $query = "Select * from business_counties where business_id = \"{$_SESSION["userdata"]["business_id"]}\";";
                        $pdata = (db::getInstance()->get_result($query));
                        
                        while($row = mysqli_fetch_assoc($pdata))
                        {

                            echo("<option value = \"{$row['business_counties_id']}\" disabled selected>{$row['county_name']}</option>");                            
                        }
                        ?>
                    </select>

                </div>

                <div class="form-group row d-flex col-9 justify-content-end">
                <button type="submit" id = "regsub-btn" name="regsub-btn" class="row col-8 col-md-3 btn btn-default">Update</button>
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
<script src="businessprofile.js"></script>
</html>