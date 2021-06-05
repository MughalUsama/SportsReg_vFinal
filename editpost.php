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
    <!--JQUERY AND bootstrap.js   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel='stylesheet' type='text/css' media='screen' href='index.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='footer.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='managenews.css'>

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

if (!array_key_exists( "adminloggedin",$_SESSION)) {
    # code...
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
$editnewsid = "";
if(isset($_REQUEST["edit-btn"]))
{
    $editnewsid = mysqli_escape_string(db::getInstance(), $_REQUEST["editnewsid"]);
    $_SESSION["edit_news_id"] = $editnewsid;
}
//getting details to fil form
$newsdetailsquery = "Select * from news where news_id = \"{$_SESSION["edit_news_id"]}\";";
$getndetails = db::getInstance()->get_result($newsdetailsquery);
$newsdetailsresult =  mysqli_fetch_assoc($getndetails);


$successmsg = "";
if (isset($_REQUEST["update-btn"]))
{
    $headline = mysqli_escape_string(db::getInstance(), $_REQUEST["newsheadline"]);
    $description = mysqli_escape_string(db::getInstance(), $_REQUEST["newsdescription"]);
    $topnews = "0";
    $latestnews = "0";
    if(isset($_REQUEST["topnews"]))
    {
        $topnews = "1";
        $updatetop = "Update news Set top_news = \"0\"";
        if(!db::getInstance()->dbquery($updatetop))
        {
            echo("Something went wrong. Try again later");
        }
    }
    if(isset($_REQUEST["latestnews"]))
    {
        $latestnews = "1";
    }
    $addnews = "";
    // Check if image file is a actual image or fake image
    $check = false;
    if(file_exists($_FILES['postimage']['tmp_name']) && is_uploaded_file($_FILES['postimage']['tmp_name']))
    {
        $check = getimagesize($_FILES["postimage"]["tmp_name"]);
    }
    $editnewsid = $_SESSION["edit_news_id"]; 
    $newname = "";
    if($check != false) {
        $uploadOk = 1;
        $info = pathinfo($_FILES['postimage']['name']);
        $ext = $info['extension']; // get the extension of the file
        $nameid = uniqid();
        $newname = $nameid.".".$ext; 
        $target = 'news/'.$newname;
        move_uploaded_file( $_FILES['postimage']['tmp_name'], $target);
        $addnews  = "UPDATE `news` SET `news_headline`=\"$headline\",`news_description`=\"$description\",`image_name`=\"$newname\",`top_news`=\"$topnews\" WHERE `news_id`= \"$editnewsid\";";
    }
    else{
        $addnews  = "UPDATE `news` SET `news_headline`=\"$headline\",`news_description`=\"$description\",`top_news`=\"$topnews\" WHERE `news_id`= \"$editnewsid\";";
    }
    if(db::getInstance()->dbquery($addnews))
    {
        $successmsg = "Post Updated Successfully";
    }
    else{
        {
            $successmsg = "Post Update Failed";
        }
        
    }
}
//getting details to fil form
$newsdetailsquery = "Select * from news where news_id = \"{$_SESSION["edit_news_id"]}\";";
$getndetails = db::getInstance()->get_result($newsdetailsquery);
$newsdetailsresult =  mysqli_fetch_assoc($getndetails);

?>

<div class="container-fluid">
    <div class="d-flex mb-2 ml-1 jusitfy-content-center align-items-center flex-wrap col-12" id="news-body">
    <div class="ml-0 mt-4 col-12 py-1 d-flex jusitfy-content-center align-items-center row rounded border border-info bg-secondary">
    <h3 class="pt-1 text-white">Edit Posts/News</h3>
    </div>
    <!-- NEWS BOXES BELOW -->
    <div class="news-start ml-0 col-12 d-flex jusitfy-content-center align-items-center row rounded border border-info bg-dark">
    <div class="col-sm-12 col-md-3">
                <table class="mx-auto">
                    <tbody>
                        <tr>
                            <td class="bg-white">
                            <img class="col-12 my-1 bg-white news-img" src="./news/<?php echo($newsdetailsresult["image_name"]); ?>" alt="Add Image" width="125" id="news-img"/> 
                            </td>
                        </tr>
                    </tbody>
                </table>
    </div>
    <div class="col-sm-12 py-2 my-2 col-md-9 rounded border border-info bg-secondary newsclass">
    <!-- form -->
    <form action="<?php echo $_SERVER['PHP_SELF'];  ?>" id="updatenewsform" method="POST"  enctype="multipart/form-data">
    <div class="form-group">
        <h6 class="text-success"><?php echo($successmsg); ?></h6>
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">News/Post Headline:</label>
        <textarea class="form-control" placeholder="Write News/Post Headline" name="newsheadline" id="exampleFormControlTextarea1" rows="3" required><?php echo($newsdetailsresult["news_headline"]); ?></textarea>
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea2">News Description:</label>
        <textarea class="form-control" placeholder="Write News/Post Description" name="newsdescription" id="exampleFormControlTextarea2" rows="5" required><?php echo($newsdetailsresult["news_description"]); ?></textarea>
    </div>
    <div class="form-group">
    <label for="postimage">Select Image:</label>
        <input type="file" accept=".gif,.png.,.jpg,.jpeg,.jpeg" class="form-control-file" id="postimage" name="postimage">
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" name="topnews" type="checkbox" id="topnews" value="1" >
        <label class="form-check-label" for="topnews">Top News</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" name="latestnews" type="checkbox" id="latestnews" value="1" >
    </div>
    <div class="form-check-inline float-right col-auto">
    <button type="submit" name="update-btn" class="btn btn-primary mb-2">Update News</button>
    </div>
    <div class="form-check col-auto mt-2">
     <p class="ml-1 mt-3">
        Top News = News at the top of the page<br>
    </p>
    </div>

    </form>
    </div>
    </div>
    <!-- ending box container  -->
    </div>


<!-- Footer -->
<?php
require_once("./footer.php");
?>
<!-- Footer -->
</div>


</body>

<script src="homeheader.js"></script>
<script src="editpost.js"></script>
</html>