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
    <link rel='stylesheet' type='text/css' media='screen' href='footer.css'>

</head>
<body>

<?php
ob_start();
require_once("./homeheader.php");
require_once("./db.php");
if (!array_key_exists('adminloggedin',$_SESSION)) {
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
$ac_er = "";
$query = "Select * from category;";
$pdata = (db::getInstance()->get_result($query));
$query="Select * from sports;";
$sportsdata = db::getInstance()->get_result($query);

if (isset($_REQUEST["regsub-btn"]))
{
    $bname = mysqli_escape_string(db::getInstance(), $_REQUEST["bname"]);
    $vat = mysqli_escape_string(db::getInstance(), $_REQUEST["vat"]);
    $address = mysqli_escape_string(db::getInstance(), $_REQUEST["address"]);
    $phone = mysqli_escape_string(db::getInstance(), $_REQUEST["btelephone"]);
    $bemail = mysqli_escape_string(db::getInstance(), $_REQUEST["bemail"]);
    $website = mysqli_escape_string(db::getInstance(), $_REQUEST["website"]);
    $bperson = mysqli_escape_string(db::getInstance(), $_REQUEST["bperson"]);
    $contactemail = mysqli_escape_string(db::getInstance(), $_REQUEST["contactemail"]);
    $useremail = mysqli_escape_string(db::getInstance(), $_REQUEST["useremail"]);
    $password = mysqli_escape_string(db::getInstance(), $_REQUEST["password"]);
    if(array_key_exists("categories",$_REQUEST)){
        $categories = $_REQUEST["categories"];
    }
    if(array_key_exists("products",$_REQUEST)){
        $products = $_REQUEST["products"];

    }
    if(array_key_exists("counties",$_REQUEST)){
        $counties = $_REQUEST["counties"];
    }
    if(array_key_exists("sports",$_REQUEST)){
        $sports = $_REQUEST["sports"];
    }
    $bquery = "Select * from business_info where email = \"{$_REQUEST["useremail"]}\";";
    if(db::getInstance()->get_result($bquery)){
        $ac_er = "<p class =\"bg-danger px-1 text-white\">Email already in use.</p>" ;
    }
    else{
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        $newname = "";
        if($check !== false) {
            $uploadOk = 1;
            $info = pathinfo($_FILES['fileToUpload']['name']);
            $ext = $info['extension']; // get the extension of the file
            $nameid = uniqid();
            $newname = $nameid.".".$ext; 
            $target = 'uploads/'.$newname;
            move_uploaded_file( $_FILES['fileToUpload']['tmp_name'], $target);
        }
        $insert_query = "INSERT INTO business_info(business_name, vat, address, telephone, business_email, website, contact_person, contact_email, email, password, logo_name) VALUES (\"$bname\",\"$vat\",\"$address\",\"$phone\",\"$bemail\",\"$website\",\"$bperson\",\"$contactemail\", \"$useremail\",\"$password\", \"$newname\");";
        if(db::getInstance()->dbquery($insert_query))
        {
            $bquery = "Select * from business_info where email = \"{$_REQUEST["useremail"]}\";";
            $result = db::getInstance()->get_result($bquery);
            $bid = $result->fetch_assoc()["business_id"];
            if((array_key_exists("sports",$_REQUEST)) and !empty($sports))
            {
                foreach ($sports as $sport) {
                    $sport = mysqli_escape_string(db::getInstance(), $sport);
                    $insert_query = "INSERT INTO business_sports(business_id, sports_name) VALUES (\"$bid\", \"$sport\");";
                    db::getInstance()->dbquery($insert_query);
                }
                //add categories
                if((array_key_exists("categories",$_REQUEST)) and !empty($categories))
                {                    
                    foreach ($categories as $category) {
                        $category = mysqli_escape_string(db::getInstance(), $category);
                        $insert_query = "INSERT INTO business_categories(business_id, category_id) VALUES (\"$bid\",\"$category\");";
                        db::getInstance()->dbquery($insert_query);
                    }
                    //add products
                    if((array_key_exists("products",$_REQUEST)) and !empty($products))
                    {                    
                        foreach ($products as $product) {
                            $cat_pro = explode(" ",trim($product));
                            $insert_query = "INSERT INTO business_products(business_id, product_id, category_id) VALUES (\"$bid\",\"$cat_pro[1]\",\"$cat_pro[0]\");";
                            db::getInstance()->dbquery($insert_query);
                        }
                    } 
                }
            }
            //add counties
            if((array_key_exists("counties",$_REQUEST)) and !empty($counties))
            {                    
                foreach ($counties as $county) {
                    $county = mysqli_escape_string(db::getInstance(), $county);
                    $insert_query = "INSERT INTO business_counties(business_id, county_name) VALUES (\"$bid\",\"$county\");";
                    db::getInstance()->dbquery($insert_query);
                }
            }
            $ac_er = "<p class = \"bg-success px-1 text-white\">Account added successfully</p>";
        }    
    }
}
?>

<div class="container" id="regform-container">

    <div class="container pl-5 pr-0" id="outline-register">
        <div class="row mt-5 mb-3 pt-5 pb-2 col-12 d-flex justify-content-center">    
            <h2 class="text-white">Business Registration</h2>
        </div>    
        <div class="row d-flex col-12 justify-content-center">
            <form class="col-12 col-md-10" method="POST" id="breg-form"  enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group row d-flex ml-1 col-sm-12 col-md-9 justify-content-center justify-content-md-end">
                    <?php echo($ac_er) ?>
                </div>
                <div class="form-group row d-flex justify-content-center justify-content-md-end">
                    <input type="text" class=" reginput-border form-control ml-3 mr-5 col-11 col-md-8" name="bname" id="bname" placeholder="Business Name" required>
                </div>
                <div class="form-group row d-flex justify-content-center justify-content-md-end">
                <input type="text" class=" reginput-border form-control ml-3 mr-5 col-11 col-md-8" name="vat" id="vat" placeholder="VAT number" required>
                </div>
                <div class="form-group row d-flex justify-content-center justify-content-md-end">
                <input type="text" class=" reginput-border form-control ml-3 mr-5 col-11 col-md-8" name="address" id="address" placeholder="Adresse" required>
                </div>
                <div class="form-group row d-flex justify-content-center justify-content-md-end">
                <input type="tel" class=" reginput-border form-control ml-3 mr-5 col-11 col-md-8" name="btelephone" id="btelephone" placeholder="Telephone" required>
                </div>

                <div class="form-group row d-flex justify-content-center justify-content-md-end">
                <input type="email" class=" reginput-border form-control ml-3 mr-5 col-11 col-md-8" name="bemail" id="bemail" placeholder="Email (business contact email)" required>
                </div>
                <div class="form-group row d-flex justify-content-center justify-content-md-end">
                <input type="url" class=" reginput-border form-control ml-3 mr-5 col-11 col-md-8" name="website" id="website" placeholder="Website (http://www.website.com)" required>
                </div>

                <div class="form-group row d-flex justify-content-center justify-content-md-end">
                <input type="text" class=" reginput-border form-control ml-3 mr-5 col-11 col-md-8" name="bperson" id="bperson" placeholder="Contact person" required>
                </div>

                <div class="form-group row d-flex justify-content-center justify-content-md-end">
                <input type="email" class=" reginput-border form-control ml-3 mr-5 col-11 col-md-8" name="contactemail" id="contactemail" placeholder="Email (contact person)" required>
                </div>
                <div class="form-group row d-flex justify-content-center justify-content-md-end">
                <input type="email" class=" reginput-border form-control ml-3 mr-5 col-11 col-md-8" name="useremail" id="useremail" placeholder="Email (Username)" required>
                </div>
                
                <div class="form-group row d-flex justify-content-center justify-content-md-end">
                <input type="password" class=" reginput-border form-control ml-3 mr-5 col-11 col-md-8" name="password" id="password" placeholder="Password" required>
                </div>
                <div class="form-group row d-flex justify-content-center justify-content-md-end">
                    <select data-placeholder="Choose Sports" id="sports" name="sports[]" multiple class="chosen">
                        <option value="-1"></option>
                        <?php 
                            while($row = mysqli_fetch_assoc($sportsdata))
                            {
                                echo("<option sportid = \"{$row['sports_id']}\" value = \"{$row['sports_name']}\">{$row['sports_name']}</option>");                            
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group row d-flex justify-content-center justify-content-md-end">
                    
                    <select data-placeholder="Choose Categories" id="category" name="categories[]" multiple class="chosen">
                    <option value="-1"></option>
                    <?php 
                        while($row = mysqli_fetch_assoc($pdata))
                        {
                            echo("<option value = \"{$row['category_id']}\">{$row['category_name']}</option>");                            
                        }
                        ?>
                  </select>

                </div>


                <div class="form-group row d-flex justify-content-center justify-content-md-end">
                    
                    <select data-placeholder="Choose Products/Services" id= "prod" name="products[]" multiple class="chosen" disabled>
                    <option value="-1"></option>
                    </select>

                </div>
                
                <div class="form-group row d-flex justify-content-center justify-content-md-end">
                    
                    <select data-placeholder="Choose Counties" name="counties[]" multiple class="chosen">
                    <option value="-1"></option>
                        <option value="Hele Norge (all over the country)">Hele Norge (all over the country)</option>
                        <option value="Oslo">Oslo</option>
                        <option value="Rogaland">Rogaland</option>
                        <option value="Møre og Romsdal">Møre og Romsdal</option>
                        <option value="Nordland">Nordland</option>
                        <option value="Viken">Viken</option>
                        <option value="Innlandet">Innlandet</option>
                        <option value="Vestfold og Telemark">Vestfold og Telemark</option>
                        <option value="Agder">Agder</option>
                        <option value="Vestland">Vestland</option>
                        <option value="Trøndelag">Trøndelag</option>
                        <option value="Troms og Finnmark">Troms og Finnmark</option>
                    </select>



                </div>
                <div class="form-group row d-flex ml-5 col-12 justify-content-center">
                    <div class="input-group-prepend d-none d-md-flex ml-5">
                        <label class="input-group-text d-md-flex ml-5" for="inputGroupSelect01">Upload logo image:</label>
                    </div>
                    <input class="ml-2 py-1 text-primary" type="file" name="fileToUpload" id="fileToUpload" required>
                </div>
                <div class="form-group row d-flex col-9 justify-content-end">
                <button type="submit" id = "regsub-btn" name="regsub-btn" class="row col-8 col-md-3 btn btn-default">Register</button>
                </div>

            </form>
            <div class="col-12 col-md-2">
                <div class="form-group row d-flex justify-content-sm-center justify-content-md-end">
                    <table class="mx-auto" CELLPADDING="55">
                    <tbody>
                        <tr>
                            <td class="bg-white">
                                <img width="125" class="d-none" id="logo-img"/> 
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
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
<script src="regbusiness.js"></script>
</html>