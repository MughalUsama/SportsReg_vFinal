<?php

ob_start();
session_start();
if(!array_key_exists("clubloggedin", $_SESSION)){
    header("Location: ./index.php"); /* Redirect browser */
    exit;
}

require_once("../db.php");


  $_SESSION["date-of-photo"]= $_REQUEST["date-of-photo"];
  $_SESSION["num-of-teams"]= $_REQUEST["num-of-teams"];
  $_SESSION["num-of-players"]= $_REQUEST["num-of-players"];
  $_SESSION["reqdescription"]= $_REQUEST["description"];

  if(isset($_REQUEST["TeamPhoto"])){
    $_SESSION["TeamPhoto"]= "Yes";
  }
  else{
    $_SESSION["TeamPhoto"]= "No";
  }

  if(isset($_REQUEST["PlayerPhoto"])){
    $_SESSION["PlayerPhoto"]= "Yes";
  }
  else{
    $_SESSION["PlayerPhoto"]= "No";
  }
  
  if(isset($_REQUEST["ActionPhoto"])){
    $_SESSION["ActionPhoto"]= "Yes";
  }
  else{
    $_SESSION["ActionPhoto"]= "No";
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
  $query="INSERT INTO club_requests(sports, category_id, product_id, description,club_id,filename, table_name) VALUES (\"{$_SESSION["sport"]}\",\"{$_SESSION["cid"]}\",\"{$_SESSION["pid"]}\",\"{$_SESSION["reqdescription"]}\",\"{$_SESSION["userdata"]["club_id"]}\", \"$newname\", \"photo\");";
  db::getInstance()->dbquery($query);
  $query = "Select request_id from club_requests where sports = \"{$_SESSION["sport"]}\" AND category_id = \"{$_SESSION["cid"]}\" AND  product_id = \"{$_SESSION["pid"]}\" AND description = \"{$_SESSION["reqdescription"]}\" AND club_id = \"{$_SESSION["userdata"]["club_id"]}\" AND filename =  \"$newname\" AND table_name  =  \"photo\"";
  $result = db::getInstance()->get_result($query);
  if($result)
  {
    $row = mysqli_fetch_assoc($result);
  }
  $query="INSERT INTO photo(request_id, No_of_Teams, No_of_Players, Date_of_Photo, Team_Photo, Player_Photo, Action_Photo) VALUES (\"{$row["request_id"]}\",\"{$_SESSION["num-of-teams"]}\", \"{$_SESSION["num-of-players"]}\",\"{$_SESSION["date-of-photo"]}\", \"{$_SESSION["TeamPhoto"]}\",\"{$_SESSION["PlayerPhoto"]}\", \"{$_SESSION["ActionPhoto"]}\");";

  db::getInstance()->dbquery($query);
  header("Location: ../userhome.php");
  exit();


?>