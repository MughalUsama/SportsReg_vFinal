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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel='stylesheet' type='text/css' media='screen' href='index.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='footer.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='blog.css'>

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

if (isset($_REQUEST["logout"]))
{
    // remove all session variables
    session_unset();
    // destroy the session
    session_destroy();
    header("Location: ./index.php");
    exit;
}

$news_query = "SELECT * FROM news ORDER BY top_news Desc, posted_on DESC";
$newsdata = db::getInstance()->get_result($news_query);

?>

<div class="container-fluid">
<?php
if($newsdata)
{
    $row_cnt = $newsdata->num_rows;
    $topnews = mysqli_fetch_assoc($newsdata);
    echo ('<div class="container-news d-flex ml-3 mb-2 h-100 jusitfy-content-center align-items-center flex-wrap col-12" id="news-body">');
    echo ('<div class="news-start col-12 d-flex jusitfy-content-center align-items-center row rounded" news-id="'.$topnews["news_id"].'" data-toggle="modal" data-target="#newsModalCenter">');
    echo ('<img class="col-12 my-1 news-img" src="./news/'.$topnews["image_name"].'" alt="Sportsreg news">');
    echo ('<div class="d-none"><h3>'.$topnews["news_headline"].'</h3></div>');
    echo('<div class="col-0 py-2 d-none"><pre class="main-para">'.$topnews["news_description"]);
    echo('</pre></div>');
    echo ('</div></div>');
    $newsposition = 1;
    $latest_n = "";
    while ($nextnews = mysqli_fetch_assoc($newsdata))
    {
        if(fmod($row_cnt,2)==0 and $newsposition==$row_cnt-1)
        {
            $grid_col = 12;
        }
        else
        {
            $grid_col = 6;
        }
        if(fmod($newsposition,2) == 1){
            $newsposition = $newsposition + 1;
            echo('<div class="row ml-2 px-0">');
            echo ('<div class="ml-2 news-start mt-1 col-sm-12 col-md-'.$grid_col.' d-flex align-self-stretch jusitfy-content-center align-items-center rounded row" news-id="'.$nextnews["news_id"].'" data-toggle="modal" data-target="#newsModalCenter">');
            echo ('<img class="col-12 my-1 news-img" src="./news/'.$nextnews["image_name"].'" alt="Sportsreg news">');
            echo ('<div class="d-none"><h5>'.$nextnews["news_headline"].'</h5></div>');
            echo('<div class="col-0 py-2 d-none"><pre class="main-para">'.$nextnews["news_description"]);
            echo('</pre></div>');
            echo ('</div>');
        }
        else{
            $newsposition = $newsposition + 1;
            echo ('<div class="news-start-2 news-start mt-1 col-sm-12 col-md-'.$grid_col.' d-flex align-self-stretch jusitfy-content-center align-items-center rounded row " news-id="'.$nextnews["news_id"].'" data-toggle="modal" data-target="#newsModalCenter">');
            echo ('<img class="col-12 my-1 news-img" src="./news/'.$nextnews["image_name"].'" alt="Sportsreg news">');
            echo ('<div class="d-none"><h5>'.$nextnews["news_headline"].'</h5></div>');
            echo('<div class="col-0 py-2 d-none"><pre class="main-para">'.$nextnews["news_description"]);
            echo('</pre></div>');        
            echo ('</div></div>');
        }
    }
}
?>    
    <!-- end of news container -->
    </div>
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="newsModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg modal-xl" role="document">
        <div class="modal-content">
        <div class="modal-header bg-dark text-white">
            <h5 class="modal-title" id="exampleModalLongTitle">Description</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body bg-secondary">
            <div class="col-12 row">
                <div class="col-12 d-flex justify-content-center align-items-center">
                <img class="col-12 news-img" width="100" src="" alt="Sportsreg news">
                </div>
                <div class="col-12 ml-3 mt-3 d-flex justify-content-start align-items-center" style="color: #44D9E6;">
                <h3>
                </h3>
                </div>
            </div>

            <div class="col-12 ml-3 mt-2 ml-2 row">
            <pre class="news-para mt-3 text-white">
            </pre>
            </div>
        </div>
        <div class="modal-footer bg-dark">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Go Back</button>
        </div>
        </div>
    </div>
    </div>
<!-- Footer -->
<br>
<?php
require_once("./footer.php");
?>
<!-- Footer -->
</div>


</body>

<?php
if (array_key_exists('businessloggedin', $_SESSION) or array_key_exists('loggedin', $_SESSION) or array_key_exists('adminloggedin', $_SESSION)) {
    echo('<script src="./homeheader.js"></script>');
}
else{
    echo('<script src="header.js"></script>');}
    ?>
<script src="blog.js"></script>
<!-- <script src="admin.js"></script> -->
</html>