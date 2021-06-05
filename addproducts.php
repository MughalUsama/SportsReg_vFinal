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
    <link rel='stylesheet' type='text/css' media='screen' href='admin.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='addproducts.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='footer.css'>
</head>
<body>

<?php
ob_start();
require_once("./homeheader.php");
require_once("./db.php");

 if(!($_SESSION['userdata'])){
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
$ac_er ="";
$rc_er ="";
$ap_er ="";
$rp_er ="";
$as_er ="";
$rs_er ="";
if (isset($_REQUEST["addcat-btn"])){
    $cat_name = mysqli_escape_string(db::getInstance(),$_REQUEST["cat-name"]);
    $query = "Select * from category where category_name = \"{$cat_name}\"";
    if(!(db::getInstance()->get_result($query)))
    {
        $query = "Insert into category (category_name) values  (\"{$cat_name}\")";
        db::getInstance()->dbquery($query);
        $ac_er = "Category added successfully." ;
    }
    else{
        $ac_er = "Category already exists." ;
    }
}
if (isset($_REQUEST["addpro-btn"])){
    $pro_name = mysqli_escape_string(db::getInstance(),$_REQUEST["pro-name"]);
    $cat1 = mysqli_escape_string(db::getInstance(),$_REQUEST["category1"]);
    $query = "Select * from products where product_name =\"{$pro_name}\" and category_id = \"{$cat1}\"  and sports=\"{$_REQUEST["sports1"]}\"";
    if(!db::getInstance()->get_result($query))
    {
        $query = "Insert into products (product_name, category_id, sports) values(\"{$pro_name}\", \"{$cat1}\",\"{$_REQUEST["sports1"]}\")";
        db::getInstance()->dbquery($query);
        $ap_er = "Product added successfully." ;
    }
    else{
        $ap_er = "Product already exists." ;
    }
}
if (isset($_REQUEST["remcat-btn"])){
    $remcat_name = mysqli_escape_string(db::getInstance(),$_REQUEST["remcat-name"]);

    $query = "Select * from category where category_id = \"{$remcat_name}\"";
    if(db::getInstance()->get_result($query))
    {
        $query = "Delete from category where category_id = \"{$remcat_name}\"";
        db::getInstance()->dbquery($query);
        $rc_er = "Category deleted successfully." ;

    }
    else{
        $rc_er = "Category doesn't exists." ;
    }
}
if (isset($_REQUEST["rempro-btn"])){
    $query = "Select * from products where product_id =\"{$_REQUEST["rempro-name"]}\" and category_id = \"{$_REQUEST["category2"]}\" and sports=\"{$_REQUEST["sports2"]}\"";
    if(db::getInstance()->get_result($query))
    {
        $rm_pro_name = mysqli_escape_string(db::getInstance(),$_REQUEST["rempro-name"]);
        $rm_cat2 = mysqli_escape_string(db::getInstance(),$_REQUEST["category2"]);
        $query = "Delete from products where  product_id=\"{$rm_pro_name}\" and category_id=\"{$rm_cat2}\" and sports=\"{$_REQUEST["sports2"]}\";";
        db::getInstance()->dbquery($query);
        $rp_er = "Product removed successfully." ;
    }
    else{
        $rp_er = "Product doesn't exists." ;
    }

}
if (isset($_REQUEST["addsports-btn"])){
    $sp_name = mysqli_escape_string(db::getInstance(),$_REQUEST["sports-name"]);
    $query = "Select * from sports where sports_name = \"{$sp_name}\"";
    if(!db::getInstance()->get_result($query))
    {
        $query = "Insert into sports (sports_name) values(\"{$sp_name}\")";
        db::getInstance()->dbquery($query);
        $as_er = "Sports added successfully." ;
    }
    else{
        $as_er = "Sports already exists." ;
    }
}
if (isset($_REQUEST["remsports-btn"])){
    $delsp_name = mysqli_escape_string(db::getInstance(),$_REQUEST["remsports-name"]);

    $query = "Select * from sports where sports_name = \"{$delsp_name}\"";
    if(db::getInstance()->get_result($query))
    {
        $query = "Delete from sports where sports_name = \"{$delsp_name}\"";
        db::getInstance()->dbquery($query);
        $rs_er = "Sports deleted successfully." ;

    }
    else{
        $rs_er = "Sports doesn't exists." ;
    }
}
$query1="Select * from category;";
$pdata = db::getInstance()->get_result($query1);
$pdata1 = db::getInstance()->get_result($query1);
$pdata2 = db::getInstance()->get_result($query1);
$sportsquery1="Select * from sports;";
$sportsdata1 = db::getInstance()->get_result($sportsquery1);
$sportsdata2 = db::getInstance()->get_result($sportsquery1);
?>

<div class="container-fluid d-flex justify-content-center px-5" id="card-container">
    <div class="row col-12 mt-1 mb-3 padd-x">
        <div class="row col-12 mb-3 py-5 outline-00">

            <div class="col-12 ml-3 d-flex py-3 padd-y1">
                <h4>Add Category:</h4>
            </div>

            <div class="row col-12 justify-content-center  padd-y">
                
            <form class="col-12 flex-wrap d-flex justify-content-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="cat-form">
            <div class="form-group flex-wrap col-12 d-flex justify-content-center">
                <input type="text" class="form-control col-xs-12 col-md-5 d-sm-flex d-md-inline" id="cat-name" placeholder="Category name" name="cat-name" required>
                <button class="form-control addcat-btn col-xs-4 col-md-2 d-sm-flex d-md-inline ml-1"  name="addcat-btn" id="addcat-btn"> Add</button>
            </div>
            <div class="form-group flex-wrap col-12 d-flex justify-content-center">
                <p id="ac-res"> <?php echo($ac_er);?> </p>
            </div>
            </form>
            </div>
        </div>

<hr>
        <div class="row col-12 py-5 mt-3 outline-01">
            <div class="row ml-3 col-12 py-3 padd-y1">
                <h4>Add Product/Service:</h4>
            </div>
            <div class="row justify-content-center col-12  padd-y">
            <div class="btn-group mt-2">
            <form class="col-12 flex-wrap d-flex justify-content-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="pro-form">
                <div class="form-group flex-wrap col-12 d-flex justify-content-center">
                    <select class="form-control col-sm-12 col-md-3" id="sports1" name="sports1">
                        <option val = '-1' selected>Choose Sports </option>
                        <?php 
                        while($row = mysqli_fetch_assoc($sportsdata1))
                        {
                            echo("<option value = \"{$row['sports_name']}\">{$row['sports_name']}</option>");                            
                        }
                        ?>

                    </select>
                    <select class="form-control ml-1 col-sm-12 col-md-4" id="category1" name="category1">
                        <option val = '-1' selected>Choose Category </option>
                        <?php 
                        while($row = mysqli_fetch_assoc($pdata))
                        {
                            echo("<option value = \"{$row['category_id']}\">{$row['category_name']}</option>");                            
                        }
                        ?>

                    </select>
                    </div>
                
                    <div class="form-group flex-wrap ml-3 col-12 d-flex justify-content-center">
                        <input type="text" class="form-control col-sm-12 col-md-5 d-sm-flex d-md-inline" id="pro-name" placeholder="Product/Service name" name="pro-name" required>
                        <button class="form-control addpro-btn col-sm-4 col-md-2 d-sm-flex d-md-inline ml-1" name="addpro-btn" id="addpro-btn"> Add</button>
                    </div>
                </form>
            </div>
                <div class="form-group flex-wrap col-12 d-flex justify-content-center">
                    <p id="ap-res"> <?php echo($ap_er) ?> </p>
                </div>           

            </div>

        </div>


        <hr>
        <hr>
        <div class="row col-12 mb-3 mt-3 py-5 outline-00">

            <div class="col-12 ml-3 d-flex py-3 padd-y1">
                <h4>Remove Category:</h4>
            </div>

            <div class="row col-12 justify-content-center padd-y">
                
            <form class="col-12 flex-wrap d-flex justify-content-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="remcat-form">
                <div class="form-group flex-wrap col-12 d-flex justify-content-center">

                    <select class="form-control" id="remcat-name"  name="remcat-name">
                        <option val = '-1' selected>Choose Category </option>
                        <?php 
                        while($row = mysqli_fetch_assoc($pdata2))
                        {
                            echo("<option value = \"{$row['category_id']}\">{$row['category_name']}</option>");                            
                        }
                        ?>

                    </select>

                    <button class="form-control addcat-btn col-sm-4 col-md-2 d-sm-flex d-md-inline ml-1" name="remcat-btn" id="remcat-btn"> Remove</button>
                </div>
            </form>
            </div>
            <div class="form-group flex-wrap col-12 d-flex justify-content-center">
                <p id="rc-res"><?php echo($rc_er);?> </p>
            </div>

        </div>

<hr>
        <div class="row col-12 py-5 mt-3 outline-01">
            <div class="row  ml-3 col-12 py-3 padd-y1">
                <h4>Remove Product/Service:</h4>
            </div>
            <div class="row justify-content-center col-12 padd-y">
            <div class="btn-group mt-2">
            <form class="col-12 flex-wrap d-flex justify-content-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="rempro-form">

                <div class="form-group flex-wrap col-12 d-flex justify-content-center">
                    <select class="form-control col-sm-12 col-md-4" id="sports2" name="sports2">
                        <option val = '-1' selected>Choose Sports </option>
                        <?php 
                        while($row = mysqli_fetch_assoc($sportsdata2))
                        {
                            echo("<option value = \"{$row['sports_name']}\">{$row['sports_name']}</option>");                            
                        }
                        ?>
                    </select>

                    <select class="form-control ml-2 col-sm-12 col-md-4" id="remcategory"  name="category2">
                        <option val = '-1' selected>Choose Category </option>
                        <?php 
                        while($row = mysqli_fetch_assoc($pdata1))
                        {
                            echo("<option value = \"{$row['category_id']}\">{$row['category_name']}</option>");                            
                        }
                        ?>

                    </select>
                    </div>
                </div>
                    <div class="form-group flex-wrap col-12 d-flex justify-content-center">
                        <select class="form-control col-sm-12 col-md-5 d-sm-flex d-md-inline" id="prod" name="rempro-name">
                            <option  val = '-1' selected>Choose Product/Service </option>
                        </select>
                        <button class="form-control addpro-btn col-sm-4 col-md-2 d-sm-flex d-md-inline ml-1" name="rempro-btn" id="rempro-btn"> Remove</button>
                    </div>
                </form>
            </div>
            <div class="form-group flex-wrap col-12 d-flex justify-content-center">
                <p id="rp-res"><?php echo($rp_er) ?> </p>
            </div>

        </div>

        <!-- add sports-->
    <div class="row col-12 mb-3 mt-3 py-5 outline-00">

    <div class="col-12 ml-3 d-flex py-3 padd-y1">
                <h4>Add Sports:</h4>
            </div>

            <div class="row col-12 justify-content-center  padd-y">
                
            <form class="col-12 flex-wrap d-flex justify-content-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="sports-form">
            <div class="form-group flex-wrap col-12 d-flex justify-content-center">
                <input type="text" class="form-control col-xs-12 col-md-5 d-sm-flex d-md-inline" id="sports-name" placeholder="Sports name" name="sports-name" required>
                <button class="form-control addcat-btn col-xs-4 col-md-2 d-sm-flex d-md-inline ml-1"  name="addsports-btn" id="addsports-btn"> Add</button>
            </div>
            <div class="form-group flex-wrap col-12 d-flex justify-content-center">
                <p id="ac-res"> <?php echo($as_er);?> </p>
            </div>
            </form>
            </div>
    </div>

<hr>
<div class="row col-12 py-5 mb-5 mt-3 outline-01">
<div class="row  ml-3 col-12 py-3 padd-y1">
    <h4>Remove Sports:</h4>
</div>
<div class="row justify-content-center col-12 padd-y">
    <div class="btn-group mt-2">
        <form class="col-12 flex-wrap d-flex justify-content-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="remsports-form">
        <div class="form-group flex-wrap col-12 d-flex justify-content-center">

            <select class="form-control col-md-9" id="remsports-name"  name="remsports-name" required>
                <option val ="" selected>Choose Sports </option>
                <?php
                  $query = "Select * from sports";
                  $pdata5 = db::getInstance()->get_result($query); 
                while($row = mysqli_fetch_assoc($pdata5))
                {
                    echo("<option value = \"{$row['sports_name']}\">{$row['sports_name']}</option>");                            
                }
                ?>

            </select>

            <button type="submit" class="form-control addcat-btn col-sm-4 col-md-2 d-sm-flex d-md-inline ml-1" name="remsports-btn" id="remsports-btn"> Remove</button>
        </div>
        </form>
    </div>
<div class="form-group flex-wrap col-12 d-flex justify-content-center">
    <p id="rp-res"><?php echo($rs_er) ?> </p>
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

<script src="addproducts.js"></script>
</html>