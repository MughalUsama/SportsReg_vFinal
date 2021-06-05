<?php

ob_start();
session_start();
if(!array_key_exists("clubloggedin", $_SESSION)){
    header("Location: ./index.php"); /* Redirect browser */
    exit;
}

require_once("../db.php");


  $_SESSION["No_of_People_Travelling"]= $_REQUEST["quantity1"];
  $_SESSION["Date_of_Travel"]= $_REQUEST["datetravel"];
  $_SESSION["Place_of_Departure"]= $_REQUEST["placedeparture1"];
  $_SESSION["Place_of_Arrival"]= $_REQUEST["placearrival1"];

  $_SESSION["Date_of_Return"]= $_REQUEST["datereturn"];
  $_SESSION["Place_of_Departure_for_Return"]= $_REQUEST["placedeparture2"];
  $_SESSION["Place_of_Arrival_for_Return"]= $_REQUEST["placearrival2"];
  if(isset($_REQUEST["RoundTrip"])){
    $_SESSION["Round_Trip"]= "Yes";
  }
  else{
    $_SESSION["Round_Trip"]= "No";
  }
  if(isset($_REQUEST["withdriver"])){
    $_SESSION["With_Driver"]= "Yes";
  }
  else{
    $_SESSION["With_Driver"]= "No";
  }
  if(isset($_REQUEST["withoutdriver"])){
    $_SESSION["With_Driver"]= "No";
  }
  else{
    $_SESSION["With_Driver"]= "Yes"; 
  }

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
  $query="INSERT INTO club_requests(sports, category_id, product_id, description,club_id,filename, table_name) VALUES (\"{$_SESSION["sport"]}\",\"{$_SESSION["cid"]}\",\"{$_SESSION["pid"]}\",\"{$_SESSION["reqdescription"]}\",\"{$_SESSION["userdata"]["club_id"]}\", \"$newname\", \"transport\");";
  db::getInstance()->dbquery($query);
  $query = "Select request_id from club_requests where sports = \"{$_SESSION["sport"]}\" AND category_id = \"{$_SESSION["cid"]}\" AND  product_id = \"{$_SESSION["pid"]}\" AND description = \"{$_SESSION["reqdescription"]}\" AND club_id = \"{$_SESSION["userdata"]["club_id"]}\" AND filename =  \"$newname\" AND table_name  =  \"transport\"";
  $result = db::getInstance()->get_result($query);
  if($result)
  {
    $row = mysqli_fetch_assoc($result);
  }
  $query="INSERT INTO transport(request_id, No_of_People_Travelling, Date_of_Travel, Place_of_Departure, Place_of_Arrival, Date_of_Return, Place_of_Departure_for_Return, Place_of_Arrival_for_Return, Round_Trip, With_Driver) VALUES (\"{$row["request_id"]}\", \"{$_SESSION["No_of_People_Travelling"]}\", \"{$_SESSION["Date_of_Travel"]}\", \"{$_SESSION["Place_of_Departure"]}\", \"{$_SESSION["Place_of_Arrival"]}\", \"{$_SESSION["Date_of_Return"]}\", \"{$_SESSION["Place_of_Departure_for_Return"]}\", \"{$_SESSION["Place_of_Arrival_for_Return"]}\", \"{$_SESSION["Round_Trip"]}\", \"{$_SESSION["With_Driver"]}\");";

  db::getInstance()->dbquery($query);
//  header("Location: ../userhome.php");
  exit();

?>