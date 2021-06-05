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
    <link rel='stylesheet' type='text/css' media='screen' href='footer.css'>
    <!--JQUERY AND popper   -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!--JQUERY AND bootstrap.js   -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="./chosen/chosen.jquery.js"></script>
    <link rel='stylesheet' type='text/css' media='screen' href='index.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='regbusiness.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='editbusiness.css'>

</head>
<body>

<?php
ob_start();
require_once("./homeheader.php");
require_once("./db.php");
if (!array_key_exists('adminloggedin',$_SESSION)) {
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
if (isset($_REQUEST["bid"])) {
    $bid = $_REQUEST["bid"];
    $_SESSION["edit_bid"] = $_REQUEST["bid"];    
}
$bid = $_SESSION["edit_bid"];
$ac_er = "";

$bquery = "Select * from business_info where business_id = \"{$bid}\";";
$bpdata = (db::getInstance()->get_result($bquery));
if (!$bpdata) {
    header("Location: ./managebusiness.php");
}
$brow = mysqli_fetch_assoc($bpdata);
$bname = $brow["business_name"];
$bvat = $brow["vat"];
$baddress = $brow["address"];
$bphone = $brow["telephone"];
$bemail = $brow["business_email"];
$bwebsite = $brow["website"];
$bperson = $brow["contact_person"];
$bcemail = $brow["contact_email"];
$busermail = $brow["email"];
$bpass = $brow["password"];
$blogo = $brow["logo_name"];




$query = "Select * from category;";
$pdata = (db::getInstance()->get_result($query));


$sportquery = "Select * from sports;";
$sportdata = (db::getInstance()->get_result($sportquery));



if (isset($_REQUEST["regsub-btn"]))
{
    $bname = mysqli_escape_string(db::getInstance(),$_REQUEST["bname"]);
    $bemail = mysqli_escape_string(db::getInstance(),$_REQUEST["bemail"]);
    $useremail = mysqli_escape_string(db::getInstance(),$_REQUEST["useremail"]);
    $vat = mysqli_escape_string(db::getInstance(),$_REQUEST["vat"]);
    $address = mysqli_escape_string(db::getInstance(),$_REQUEST["address"]);
    $phone = mysqli_escape_string(db::getInstance(),$_REQUEST["btelephone"]);
    $website = mysqli_escape_string(db::getInstance(),$_REQUEST["website"]);
    $bperson = mysqli_escape_string(db::getInstance(),$_REQUEST["bperson"]);
    $contactemail = mysqli_escape_string(db::getInstance(),$_REQUEST["contactemail"]);
    $password = mysqli_escape_string(db::getInstance(),$_REQUEST["password"]);
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
    if(isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['size'] > 0){
        
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        $newname = "";
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
            $info = pathinfo($_FILES['fileToUpload']['name']);
            $ext = $info['extension']; // get the extension of the file
            $nameid = uniqid();
            $newname = $nameid.".".$ext; 
            $target = 'uploads/'.$newname;
            move_uploaded_file( $_FILES['fileToUpload']['tmp_name'], $target);
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        $updatequery = "UPDATE business_info SET business_name= \"$bname\",vat= \"$vat\",business_email= \"$bemail\",address= \"$address\",telephone=\"$phone\",website=\"$website\",contact_person=\"$bperson\",contact_email=\"$contactemail\",password=\"$password\", logo_name=\"$newname\" WHERE business_id = \"$bid\";";
    }
    else{
        $updatequery = "UPDATE business_info SET business_name= \"$bname\",vat= \"$vat\",business_email= \"$bemail\",address= \"$address\",telephone=\"$phone\",website=\"$website\",contact_person=\"$bperson\",contact_email=\"$contactemail\",password=\"$password\" WHERE business_id = \"$bid\";";
    }
    if (db::getInstance()->dbquery($updatequery)) {
        $updatequery = "Delete from business_categories where business_id = \"$bid\";";
        if (db::getInstance()->dbquery($updatequery)) {
            echo("delete2");
            $updatequery = "Delete from business_products where business_id = \"$bid\";";
            if (db::getInstance()->dbquery($updatequery)) {
                if((array_key_exists("sports",$_REQUEST)) and !empty($sports))
                {
                    foreach ($sports as $sport) {
                        $sport = mysqli_escape_string(db::getInstance(),$sport);
                        $insert_query = "INSERT INTO business_sports(business_id, sports_name) VALUES (\"$bid\", \"$sport\");";
                        db::getInstance()->dbquery($insert_query);
                    }
                    //add categories
                    if((array_key_exists("categories",$_REQUEST)) and !empty($categories))
                    {                    
                        foreach ($categories as $category) {
                            $category = mysqli_escape_string(db::getInstance(),$category);
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
                $ac_er = "<p class = \"text-success\">Update Successfully</p>";
           
            }
        }
    }
    else{
        $ac_er = "<p class = \"text-danger\">Update Failed. Try later.</p>";

    }
}
?>
<p class="d-none" id="bus-id"><?php echo($bid)?></p>
<div class="container" id="regform-container">

    <div class="container pl-5 pr-0" id="outline-register">
        <div class="row mt-5 mb-3 pt-5 pb-2 col-12 d-flex justify-content-center">    
            <h2 class="text-white">Edit Business</h2>
        </div>    
        <div class="row d-flex col-12 justify-content-end">
            <form class="col-12 col-md-9" method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group row d-flex col-12 justify-content-center">
                    <?php echo($ac_er) ?>
                </div>
                <div class="form-group row d-flex col-12 justify-content-end">
                    <input type="text" class=" reginput-border form-control ml-3 mr-5 col-11 col-md-9" value="<?php echo($bname) ;?>" name="bname" id="bname" placeholder="Business Name" required>
                </div>
                <div class="form-group row d-flex col-12 justify-content-end">
                <input type="text" class=" reginput-border form-control ml-3 mr-5 col-11 col-md-9" value="<?php echo($bvat) ;?>" name="vat" id="vat" placeholder="VAT number" required>
                </div>
                <div class="form-group row d-flex col-12 justify-content-end">
                <input type="text" class=" reginput-border form-control ml-3 mr-5 col-11 col-md-9" value="<?php echo($baddress) ;?>" name="address" id="address" placeholder="Adresse" required>
                </div>
                <div class="form-group row d-flex col-12 justify-content-end">
                <input type="tel" class=" reginput-border form-control ml-3 mr-5 col-11 col-md-9" value="<?php echo($bphone) ;?>" name="btelephone" id="btelephone" placeholder="Telephone" required>
                </div>

                <div class="form-group row d-flex col-12 justify-content-end">
                <input type="email" class=" reginput-border form-control ml-3 mr-5 col-11 col-md-9" value="<?php echo($bemail) ;?>" name="bemail" id="bemail" placeholder="Email (business contact email)" required>
                </div>
                <div class="form-group row d-flex col-12 justify-content-end">
                <input type="url" class=" reginput-border form-control ml-3 mr-5 col-11 col-md-9" value="<?php echo($bwebsite) ;?>" name="website" id="website" placeholder="Website (http://www.website.com)" required>
                </div>

                <div class="form-group row d-flex col-12 justify-content-end">
                <input type="text" class=" reginput-border form-control ml-3 mr-5 col-11 col-md-9" value="<?php echo($bperson) ;?>" name="bperson" id="bperson" placeholder="Contact person" required>
                </div>

                <div class="form-group row d-flex col-12 justify-content-end">
                <input type="email" class=" reginput-border form-control ml-3 mr-5 col-11 col-md-9" value="<?php echo($bcemail) ;?>" name="contactemail" id="contactemail" placeholder="Email (contact person)" required>
                </div>
                <div class="form-group row d-flex col-12 justify-content-end">
                <input type="email" class=" reginput-border form-control ml-3 mr-5 col-11 col-md-9" value="<?php echo($busermail) ;?>" name="useremail" id="useremail" placeholder="Email (Username)" required>
                </div>
                
                <div class="form-group row d-flex col-12 justify-content-end">
                <input type="password" class=" reginput-border form-control ml-3 ml-3 mr-5 col-11 col-md-9" value="<?php echo($bpass) ;?>" name="password" id="password" placeholder="Password" required>
                </div>
                <div class="form-group row d-flex col-12  justify-content-center">
                <select data-placeholder="Choose Sports" name="sports[]" id="sports" multiple class="chosen" >
                    <option value="-1"></option>
                    <?php 
                        while($row = mysqli_fetch_assoc($sportdata))
                        {
                                echo("<option value = \"{$row['sports_name']}\" >{$row['sports_name']}</option>");                            
                        }
                        ?>
                  </select>

                </div>
                <div class="form-group row d-flex col-12  justify-content-center">
                    
                    <select data-placeholder="Choose Categories" name="categories[]" id="category" multiple class="chosen">
                    <option value="-1"></option>
                    <?php 
                        while($row = mysqli_fetch_assoc($pdata))
                        {
                                echo("<option value = \"{$row['category_id']}\" >{$row['category_name']}</option>");                            
                        }
                        ?>
                  </select>

                </div>
                <div class="form-group row d-flex col-12 justify-content-center">
                    
                    <select data-placeholder="Choose Products/Services" name="products[]" id= "prod"  multiple class="chosen">
                    <option value="-1"></option>
                    <?php
                        echo("usama");
                        $query = "Select * from products;";
                        $pdata = (db::getInstance()->get_result($query));
                        
                        if ($pdata) {

                            while($row = mysqli_fetch_assoc($pdata))
                            {
                                    echo("<option value = \"{$row['product_id']}\" >{$row['product_name']}</option>");                            
                            }
                        }
                        ?>
                    </select>

                </div>
                
                <div class="form-group row d-flex col-12 justify-content-center">
                    
                    <select data-placeholder="Choose Counties" name="counties[]" id="county" multiple class="chosen">
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
                    <input class="ml-2 py-1 text-primary" type="file" name="fileToUpload" id="fileToUpload">
                </div>
                <div class="form-group row d-flex ml-4 col-9 justify-content-end">
                <button type="submit" id = "regsub-btn" name="regsub-btn" class="row col-8 col-md-3 btn btn-default">Update</button>
                </div>

            </form>
            <div class="col-12 col-md-2">
                <div class="form-group row d-flex justify-content-sm-center justify-content-md-end">
                    <table class="mx-auto">
                    <tbody>
                        <tr>
                            <td class="bg-white">
                                <img src="./uploads/<?php echo($blogo)?>" width="135" id="logo-img"/> 
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
<script src="businessprofile.js"></script>
<script src="editbusiness.js"></script>
</html>