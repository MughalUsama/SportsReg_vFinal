<?php

ob_start();
session_start();
if(!array_key_exists("clubloggedin", $_SESSION)){
    header("Location: ./index.php"); /* Redirect browser */
    exit;
}

require_once("../db.php");


  $sizeofwardrobe = $_REQUEST["sizeofWardrobe"]." meter square";
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
  $query="INSERT INTO club_requests(sports, category_id, product_id, description,club_id,filename, size) VALUES (\"{$_SESSION["sport"]}\",\"{$_SESSION["cid"]}\",\"{$_SESSION["pid"]}\",\"{$_SESSION["description"]}\",\"{$_SESSION["userdata"]["club_id"]}\", \"$newname\", \"$sizeofwardrobe\");";
  echo($query);
  db::getInstance()->dbquery($query);

  header("Location: ../userhome.php");
  exit();


?>