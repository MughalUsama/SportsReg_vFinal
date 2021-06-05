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
    <!--JQUERY AND bootstrap.js   -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel='stylesheet' type='text/css' media='screen' href='footer.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='index.css'>

</head>
<body class="pl-md-3 mr-3 mr-md-0 indexbody">


<?php
require_once("./header.php");
require_once("./db.php");
ob_start();
if (array_key_exists('businessloggedin' ,$_SESSION)) {
    header("location: ./businesshome.php");
    exit;
  }

  if(array_key_exists('loggedin',$_SESSION)){
    header("Location: ./userhome.php"); /* Redirect browser */
    /* Make sure that code below does not get executed when we redirect. */
    exit;
  }
  if (array_key_exists('adminloggedin',$_SESSION)) {
    header("Location: ./admin.php"); /* Redirect browser */
    /* Make sure that code below does not get executed when we redirect. */
    exit;
}

$query="Select * from category;";
$pdata = db::getInstance()->get_result($query);
$query="Select * from sports;";
$sportsdata = db::getInstance()->get_result($query);
?>

<div class="container-fluid mx-auto mt-5 how-box justify-content-center mid-body">
    <div class="row" id="main-form">
        <div class="hidden-sm pb-5 col-md-6" id="football-image"></div>
        <div class="col-12 py-5 pl-5 col-md-6">
        <h3 class="row wrap p-4 gethead gethead1">GET NON-BINDING OFFERS – SAVE TIME AND MONEY ON SPORTS PURCHASES
        </h3>

        <div class="row">
            <div class="btn-group mt-2">
            <div class="form-group">
            <select class="form-control" id="sports" >
                <option  val = '' selected>Choose Sport </option>
                <?php
                if($sportsdata){
                    while($row = mysqli_fetch_assoc($sportsdata))
                    {
                        echo("<option sportid = \"{$row['sports_id']}\" value = \"{$row['sports_name']}\">{$row['sports_name']}</option>");
                    }
                }
                    ?>
            </select>
                </div>
            </div>
        </div>
        <!--/row-->
            <div class="row">
                <div class="btn-group mt-2">
                <div class="form-group">
                    <select class="form-control" id="category" >
                        <option val = '-1' selected>Choose Category </option>
                            <?php
                            while($row = mysqli_fetch_assoc($pdata))
                            {
                                echo("<option value = \"{$row['category_id']}\">{$row['category_name']}</option>");
                            }
                            ?>
                    </select>
                </div>
                </div>
            </div>

            <div class="row">
                <div class="btn-group mt-2">
                <div class="form-group">
                <select class="form-control" id="prod" >
                    <option  val = '' selected>Choose Product/Service </option>

                    </select>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-end mr-5 pb-5 mt-3">
                <button class="mr-5" id="btn-next">
                    Next
                </button>
            </div>
        </div>

    </div>

    <!--container 2-->

</div>


<div class="container-fluid mx-auto pb-2 justify-content-center how-box" id="an1">
        <div class="row d-flex justify-content-around ml-3 py-3 pr-5 flex-wrap an1div">
        <h1 class="my-1 ml-2 py-2">
        How it works
        </h2>
        </div>

        <hr class="py-0" width="175">
        <div class="d-flex mt-4 ml-5 pb-2 justify-content-around flex-wrap py-1 myicons">
            <div class="icontext justify-content-center ml-1 align-items-center" id="transf-1">
                <img class="row ic1" src="./img/1.svg" width="100" alt="Fill form icon">
                <div class="row custom-numbering1"><h5><span><pre class="round-back d-inline"> 1 </pre></span> Fill out the form</h5></div>
                <div class="row icontext1"><p>Save time by simply filling out the form. We obtain offers from several providers based on your needs.</p></div>
            </div>
            <div class="icontext justify-content-center align-items-center" id="transf-2">
                <img class="row ic1" src="./img/2.svg" width="100" alt="Receive offer icon">
                <div class="row custom-numbering1"><h5><span><pre class="round-back d-inline"> 2 </pre></span> Receive offers</h5></div>
                <div class="row icontext1"><p>Receive offers from several different suppliers and see which offer suits you best.</p></div>

            </div>
            <div class="icontext justify-content-center align-items-center" id="transf-3">
                <img class="row ic1" src="./img/3.svg" width="100" alt="Choose offer icon">
                <div class="row custom-numbering1"><h5><span><pre class="round-back d-inline"> 3 </pre></span> Choose offer</h5></div>
                <div class="row icontext1"><p>Choose the best offer based on your needs.</p></div>

            </div>
        </div>
</div>



<!-- Save money part-->
<div class="container-fluid mx-auto justify-content-center" id="save-money">
        <div class="row d-flex justify-content-around ml-4 pr-5 py-3 flex-wrap savemoneydiv">
        <h3 class="my-1 text-center gethead">
        Save money on various purchases and collaborations
        </h3>
        </div>
        <div class="d-flex my-5 ml-md-5 justify-content-around py-3 flex-wrap myicons">
            <div class="icontext justify-content-center align-items-center">
                <img class="row ic2" src="./img/4.svg" width="80" alt="Fotballmål">
                <hr class="my-hr">
                <div class="row icontext2 justify-content-center"><p>Mål</p></div>
            </div>
            <div class="icontext justify-content-center align-items-center">
                <img class="row ic2" src="./img/5.svg" width="80" alt="Baller">
                <hr class="my-hr">
                <div class="row icontext2 justify-content-center"><p>Baller</p></div>
            </div>

            <div class="icontext justify-content-center align-items-center">
                <img class="row ic2" src="./img/6.svg" width="80" alt="Transport">
                <hr class="my-hr">
                <div class="row icontext2 justify-content-center"><p>Transport</p></div>
            </div>

            <div class="icontext justify-content-center align-items-center">
                <img class="row ic2" src="./img/Dugnad.svg" width="80" alt="Dugnad">
                <hr class="my-hr">
                <div class="row icontext2 justify-content-center"><p>Dugnad</p></div>
            </div>
        </div>
        <!-- Second row-->
        <div class="d-flex my-5 ml-md-5 justify-content-around flex-wrap myicons">
            <div class="icontext justify-content-center align-items-center">
                <img class="row ic2" src="./img/8.svg" width="80" alt="Premier">
                <hr class="my-hr">
                <div class="row icontext2 justify-content-center"><p>Premier</p></div>
            </div>
            <div class="icontext justify-content-center align-items-center">
                <img class="row ic2" src="./img/9.svg" width="80" alt="Treningsklær">
                <hr class="my-hr">
                <div class="row icontext2 justify-content-center"><p>Treningsklær</p></div>
            </div>

            <div class="icontext justify-content-center align-items-center">
                <img class="row ic2" src="./img/10.svg" width="80" alt="Treningsutstyr">
                <hr class="my-hr">
                <div class="row icontext2 justify-content-center"><p>Treningsutstyr</p></div>
            </div>

            <div class="icontext justify-content-center align-items-center">
                <img class="row ic2" src="./img/11.svg" width="80" alt="Treningsleir">
                <hr class="my-hr">
                <div class="row icontext2 justify-content-center"><p>Treningsleir</p></div>
            </div>
        </div>
</div>
<div class="container-fluid mx-auto justify-content-center py-4 how-box1" id="an2">
        <div class="row d-flex justify-content-around ml-4 pr-5 py-3 flex-wrap">
        <h2 class="my-1 ml-2 gethead gethead1">
        Hvorfor benytte seg av SportsReg?
        </h2>
        </div>

        <hr class="py-0" width="175">
        <div class="d-flex mt-5 ml-5 pb-5 pt-1 justify-content-around flex-wrap py-1 myicons">
            <div class="icontext-z justify-content-center align-items-center" id="transf-4">
                <div class="row custom-numbering"><h5 class="font-weight-bold"><span><pre class="round-back d-inline"> &#x2714; </pre></span> Get offers from several suppliers</h5></div>
                <div class="row icontext1"><p>With SportsReg, you and your group save a lot of time looking for, finding and discussing suppliers and agreements. With us, you only spend a few seconds filling out the form and you will in return receive offers from one or more suppliers.</p></div>
            </div>
            <div class="icontext-z justify-content-center align-items-center" id="transf-5">
                <div class="row custom-numbering2"><h5 class="font-weight-bold"><span><pre class="round-back d-inline"> &#x2714; </pre></span> Choose the best offer based on your needs</h5></div>
                <div class="row icontext001"><p>By using SportsReg, your request is sent to several suppliers who would like you as a customer. This means that they will give good offers to win just you, and in this way the price can be pushed to the extreme to your advantage.</p></div>

            </div>
            <div class="icontext-z justify-content-center align-items-center" id="transf-6">
                <div class="row custom-numbering"><h5 class="font-weight-bold"><span><pre class="round-back d-inline"> &#x2714; </pre></span> It's free and without obligation!</h5></div>
                <div class="row icontext1"><p>It is completely free for you or your group to use our service, and you have no requirement to complete an agreement. The only thing you risk is saving time and money on getting a good purchase deal.</p></div>

            </div>
        </div>
</div>
<!-- partner+blog-->
<div class="container-fluid row mx-auto p-0 d-flex justify-content-center align-items-center" id="partner-blog">
  <div class="d-flex col-sm-12 col-md-6 justify-content-center align-items-center" id="partner-div">
        <div class="col-sm-7 col-md-6 justify-content-md-end align-items-center">
                <img class="row float-md-right ic5" id="img-partner" src="./img/Picture4.png"  alt="Blog">
        </div>
        <div class="icontext-x col-sm-5 col-md-5 justify-content-center align-items-start">
                <h2 class="ml-2 mb-4"><b class="mx-auto mb-4">Become a supplier</b></h2>
                <p class="word-wrap mt-2">and get direct access to new customers in purchase mode</p>
        </div>
  </div>
  <div class="d-flex col-sm-12 col-md-6 justify-content-center align-items-center" id="blog-div">
        <div class="col-sm-7 col-md-6 justify-content-md-end align-items-center">
                <img class="row float-md-right ic5" id="img-blog" src="./img/Picture5.png"  alt="Blog">
        </div>
        <div class="icontext-x col-sm-5 col-md-5 justify-content-center align-items-start">
                <h2 class="ml-2 mb-4"><b class="mx-auto mb-4">Our Blog</b></h2>
                <p class="word-wrap mt-2">find and read our latest posts and news on our blog</p>
        </div>
  </div>

  </div>
</div>

<!-- Footer -->
<?php
require_once("./footer.php");
?>
<!-- Footer -->
<script src="header.js"></script>
<script src="./js/index.js"></script>

</body>
</html>
