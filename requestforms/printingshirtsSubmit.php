<?php

ob_start();
session_start();
if(!array_key_exists("clubloggedin", $_SESSION)){
    header("Location: ./index.php"); /* Redirect browser */
    exit;
}

require_once("../db.php");


  $_SESSION["Total_no_of_prints"]= $_REQUEST["quantity1"];
  $_SESSION["No_of_different_prints"]= $_REQUEST["quantity2"];

  $_SESSION["reqdescription"]= $_REQUEST["description"];
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
  $query="INSERT INTO club_requests(sports, category_id, product_id, description,club_id,filename, table_name) VALUES (\"{$_SESSION["sport"]}\",\"{$_SESSION["cid"]}\",\"{$_SESSION["pid"]}\",\"{$_SESSION["reqdescription"]}\",\"{$_SESSION["userdata"]["club_id"]}\", \"$newname\", \"printing\");";
  db::getInstance()->dbquery($query);
  $query = "Select request_id from club_requests where sports = \"{$_SESSION["sport"]}\" AND category_id = \"{$_SESSION["cid"]}\" AND  product_id = \"{$_SESSION["pid"]}\" AND description = \"{$_SESSION["reqdescription"]}\" AND club_id = \"{$_SESSION["userdata"]["club_id"]}\" AND filename =  \"$newname\" AND table_name  =  \"printing\"";
  $result = db::getInstance()->get_result($query);
  if($result)
  {
    $row = mysqli_fetch_assoc($result);
  }
  $query="INSERT INTO printing(request_id, Total_no_of_prints, No_of_different_prints) VALUES (\"{$row["request_id"]}\",\"{$_SESSION["Total_no_of_prints"]}\", \"{$_SESSION["No_of_different_prints"]}\");";

  db::getInstance()->dbquery($query);
  header("Location: ../userhome.php");
  exit();
?>