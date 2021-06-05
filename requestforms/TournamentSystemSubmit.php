<?php

ob_start();
session_start();
if(!array_key_exists("clubloggedin", $_SESSION)){
    header("Location: ./index.php"); /* Redirect browser */
    exit;
}

require_once("../db.php");


  $_SESSION["nooftournaments"]= $_REQUEST["nooftournaments"];
  $_SESSION["noofteams"]= $_REQUEST["noofteams"];
  $_SESSION["noofmatches"]= $_REQUEST["noofmatches"];
  $_SESSION["description"]= $_REQUEST["description"];
  
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
  $query="INSERT INTO club_requests(sports, category_id, product_id, description,club_id,filename, table_name) VALUES (\"{$_SESSION["sport"]}\",\"{$_SESSION["cid"]}\",\"{$_SESSION["pid"]}\",\"{$_SESSION["description"]}\",\"{$_SESSION["userdata"]["club_id"]}\", \"$newname\", \"tournamentsystem\");";
  db::getInstance()->dbquery($query);
  $query = "Select request_id from club_requests where sports = \"{$_SESSION["sport"]}\" AND category_id = \"{$_SESSION["cid"]}\" AND  product_id = \"{$_SESSION["pid"]}\" AND description = \"{$_SESSION["description"]}\" AND club_id = \"{$_SESSION["userdata"]["club_id"]}\" AND filename =  \"$newname\" AND table_name  =  \"tournamentsystem\"";
  $result = db::getInstance()->get_result($query);
  if($result)
  {
    $row = mysqli_fetch_assoc($result);
  }
  $query="INSERT INTO tournamentsystem(request_id, No_of_Tournaments, No_of_Teams, No_of_Matches) VALUES (\"{$row["request_id"]}\",\"{$_SESSION["nooftournaments"]}\", \"{$_SESSION["noofteams"]}\", \"{$_SESSION["noofmatches"]}\");";
  db::getInstance()->dbquery($query);
  header("Location: ../userhome.php");
  exit();


?>