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
$successmsg = "";

if (isset($_REQUEST["logout"]))
{
    // remove all session variables
    session_unset();
    // destroy the session
    session_destroy();
    header("Location: ./index.php");
    exit;
}
if (isset($_REQUEST["addnews"]))
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
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["postimage"]["tmp_name"]);
    $newname = "";
    if($check !== false) {
        $uploadOk = 1;
        $info = pathinfo($_FILES['postimage']['name']);
        $ext = $info['extension']; // get the extension of the file
        $nameid = uniqid();
        $newname = $nameid.".".$ext; 
        $target = 'news/'.$newname;
        move_uploaded_file( $_FILES['postimage']['tmp_name'], $target);
    }

    $addnews ="INSERT INTO `news`(`news_headline`, `news_description`, `image_name`, `top_news`) VALUES (\"$headline\",\"$description\",\"$newname\",\"$topnews\")";
    if(db::getInstance()->dbquery($addnews))
    {
        $successmsg = "Post added successfully";
    }
    else{
        $successmsg = "Post cannot added successfully";
    }
}
$allnews = "SELECT * FROM news ORDER BY top_news DESC , posted_on DESC";
$getallnews = db::getInstance()->get_result($allnews);
?>

<div class="container-fluid">
    <div class="d-flex mb-2 jusitfy-content-center align-items-center flex-wrap col-12" id="news-body">

    <div class="ml-0 mt-4 col-12 py-1 d-flex jusitfy-content-center align-items-center row rounded border border-info bg-secondary">
    <h3 class="pt-1 text-white">Add new Post/News</h3>
    </div>
    <!-- NEWS BOXES BELOW -->
    <div class="news-start ml-0 col-12 d-flex jusitfy-content-center align-items-center row rounded border border-info bg-dark">
    <div class="col-sm-12 col-md-3">
                <table class="mx-auto" CELLPADDING="70">
                    <tbody>
                        <tr>
                            <td class="bg-white">
                            <img class="col-12 my-1 bg-white news-img d-none" src="" alt="Add Image" width="125" id="news-img"/> 
                            </td>
                        </tr>
                    </tbody>
                </table>
    </div>
    <div class="col-sm-12 py-2 my-2 col-md-9 rounded border border-info bg-secondary newsclass">
    <!-- form -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="addnewsform" enctype="multipart/form-data">
    <div class="form-group">
        <h6 class="text-success"><?php echo($successmsg); ?></h6>
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">News/Post Headline:</label>
        <textarea class="form-control" placeholder="Write News/Post Headline" name="newsheadline" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea2">News Description:</label>
        <textarea class="form-control" placeholder="Write News/Post Description" name="newsdescription" id="exampleFormControlTextarea2" rows="5" required></textarea>
    </div>
    <div class="form-group">
    <label for="postimage">Select Image:</label>
        <input type="file" accept=".gif,.png.,.jpg,.jpeg,.jpeg" class="form-control-file" id="postimage" name="postimage" required>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" name="topnews" type="checkbox" id="topnews" value="1" >
        <label class="form-check-label" for="topnews">Top News</label>
    </div>
    <div class="form-check-inline float-right col-auto">
      <button type="submit" class="btn btn-primary mb-2" name="addnews">Add News</button>
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
<div class="d-flex mb-2 jusitfy-content-center align-items-center flex-wrap col-12">

<table class="table table-hover table-dark rounded border border-info">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Headline</th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col">Posted on</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php 
    if($getallnews)
    {   //loop and print
        $serial_num = 0;
        while($nnews = mysqli_fetch_assoc($getallnews))
        {
            $serial_num+=1;
            echo '<tr>';
            echo '<th scope="row">'.$serial_num.'</th>';
            echo '<td colspan="3">'.$nnews["news_headline"].'</td>';
            echo '<td>'.$nnews["posted_on"].'</td>';
            echo '<td><button class="btn btn-danger delete-news" news-id="'.$nnews["news_id"].'">Delete</button></td>';
            echo '<td><form action="editpost.php" method="POST" class="d-inline"><input class="d-none" name="editnewsid" value = "'.$nnews["news_id"].'" type="number" ><button type="submit" name="edit-btn" class="btn btn-warning edit-news" news-id="'.$nnews["news_id"].'">Edit</button></form></td>';
            echo '</tr>';
        }
    }
  
  ?>
  </tbody>
</table>

</div>

<!-- Footer -->
<?php
require_once("./footer.php");
?>
<!-- Footer -->
</div>


</body>

<script src="homeheader.js"></script>
<script src="managenews.js"></script>
</html>