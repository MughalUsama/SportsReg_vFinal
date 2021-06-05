<?php

ob_start();
session_start();
if(!array_key_exists("clubloggedin", $_SESSION)){
    header("Location: ./index.php"); /* Redirect browser */
    exit;
}
require_once("../db.php");

  $No_of_People= $_REQUEST["Noofpeople"];
  $No_productsperson = $_REQUEST["Noofproductsperperson"];
  echo($No_productsperson);
  $No_of_Sales_Rounds= $_REQUEST["Noofsalesrounds"];
  $_SESSION["reqdescription"]= $_REQUEST["description"];

  if(isset($_REQUEST["ToiletPaper"])){
    $Toilet_Paper= "Yes";
  }
  else{
    $Toilet_Paper= "No";
  }
  if(isset($_REQUEST["PaperTowels"])){
    $Paper_Towels= "Yes";
  }
  else{
    $Paper_Towels= "No";
  }
  if(isset($_REQUEST["Socks"])){
    $Socks= "Yes";
  }
  else{
    $Socks= "No";
  }
  if(isset($_REQUEST["LighterBriquettes"])){
    $Lighter_Briquettes= "Yes";
  }
  else{
    $Lighter_Briquettes= "No";
  }
  if(isset($_REQUEST["CleaningProducts"])){
    $Cleaning_Products= "Yes";
  }
  else{
    $Cleaning_Products= "No";
  }
  if(isset($_REQUEST["CookiesandGoodies"])){
    $Cookies_and_Goodies= "Yes";
  }
  else{
    $Cookies_and_Goodies= "No";
  }

  if(isset($_REQUEST["Card"])){
    $Card= "Yes";
  }
  else{
    $Card= "No";
  }
  if(isset($_REQUEST["Meat"])){
    $Meat= "Yes";
  }
  else{
    $Meat= "No";
  }
  if(isset($_REQUEST["Other"])){
    $Other= "Yes";
  }
  else{
    $Other= "No";
  }

  
  $target_dir = "../requestuploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $newname = "";
  $uploadOk = 1;
  $info = pathinfo($_FILES['fileToUpload']['name']);
  $ext = $info['extension']; // get the extension of the file
  $nameid = uniqid();
  $newname = $nameid.".".$ext; 
  $target = '../requestuploads/'.$newname;
  move_uploaded_file( $_FILES['fileToUpload']['tmp_name'], $target);
  if(!is_uploaded_file(["fileToUpload"]["name"])){
    $newname = null;    
  }
  $query="INSERT INTO club_requests(sports, category_id, product_id, description,club_id,filename, table_name) VALUES (\"{$_SESSION["sport"]}\",\"{$_SESSION["cid"]}\",\"{$_SESSION["pid"]}\", \"{$_REQUEST["description"]}\",\"{$_SESSION["userdata"]["club_id"]}\", \"$newname\", \"dugnad\");";
  db::getInstance()->dbquery($query);
  $query = "Select request_id from club_requests where sports = \"{$_SESSION["sport"]}\" AND category_id = \"{$_SESSION["cid"]}\" AND  product_id = \"{$_SESSION["pid"]}\" AND description = \"{$_REQUEST["description"]}\" AND club_id = \"{$_SESSION["userdata"]["club_id"]}\" AND filename =  \"$newname\" AND table_name  =  \"dugnad\"";
  $result = db::getInstance()->get_result($query);
  if($result)
  {
    $row = mysqli_fetch_assoc($result);
  }
  $query="INSERT INTO dugnad(request_id, No_of_People, No_of_Products_Per_Person, No_of_Sales_Rounds, Toilet_Paper, Paper_Towels, Socks, Lighter_Briquettes, Cleaning_Products, Cookies_and_Goodies, Card, Meat, Other) VALUES (\"{$row["request_id"]}\", \"$No_of_People\", \"$No_productsperson\", \"$No_of_Sales_Rounds\", \"$Toilet_Paper\", \"$Paper_Towels\", \"$Socks\", \"$Lighter_Briquettes\", \"$Cleaning_Products\", \"$Cookies_and_Goodies\", \"$Card\", \"$Meat\", \"$Other\");";
  db::getInstance()->dbquery($query);
  header("Location: ../userhome.php");
  exit();


?>