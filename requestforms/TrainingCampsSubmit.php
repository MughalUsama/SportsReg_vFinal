<?php

ob_start();
session_start();
if(!array_key_exists("clubloggedin", $_SESSION)){
    header("Location: ./index.php"); /* Redirect browser */
    exit;
}

require_once("../db.php");

$_SESSION["No_of_Players"]= $_REQUEST["quantity1"];
$_SESSION["No_of_Coaches"]= $_REQUEST["quantity2"];
$_SESSION["No_of_Single_rooms"]= $_REQUEST["quantity3"];
$_SESSION["No_of_Double_rooms"]= $_REQUEST["quantity4"];
$_SESSION["No_of_Triple_rooms"]= $_REQUEST["quantity5"];
$_SESSION["Desirable_time_of_tournament"]= $_REQUEST["timeanddate"];
$_SESSION["No_of_Days"]= $_REQUEST["days"];
$_SESSION["No_of_Trainings_per_Day"]= $_REQUEST["trainingsperday"];
$_SESSION["No_of_Training_Matches"]= $_REQUEST["noofmatches"];
$_SESSION["Grass_Artificial_Club"]= $_REQUEST["grass"];

$_SESSION["description"]= $_REQUEST["description"];

if(isset($_REQUEST["Norway"])){
  $Norway = "Yes";    
}
else{
  $Norway = "No";
}
if(isset($_REQUEST["Spain"])){
  $Spain = "Yes";    
}
else{
  $Spain = "No";
}

if(isset($_REQUEST["TheNetherlands"])){
  $The_Netherland = "Yes";    
}
else{
  $The_Netherland = "No";
}
if(isset($_REQUEST["Germany"])){
  $Germany = "Yes";    
}
else{
  $Germany = "No";
}
if(isset($_REQUEST["Sweden"])){
  $Sweden = "Yes";    
}
else{
  $Sweden = "No";
}

if(isset($_REQUEST["Turkey"])){
  $Turkey = "Yes";    
}
else{
  $Turkey = "No";
}
if(isset($_REQUEST["Malta"])){
  $Malta = "Yes";    
}
else{
  $Malta = "No";
}
if(isset($_REQUEST["Dubai"])){
  $Dubai = "Yes";    
}
else{
  $Dubai = "No";
}
if(isset($_REQUEST["Denmark"])){
  $Denmark = "Yes";    
}
else{
  $Denmark = "No";
}
if(isset($_REQUEST["Cyprus"])){
  $Cyprus = "Yes";    
}
else{
  $Cyprus = "No";
}
if(isset($_REQUEST["England"])){
  $England = "Yes";    
}
else{
  $England = "No";
}
if(isset($_REQUEST["France"])){
  $France = "Yes";    
}
else{
  $France = "No";
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
  $query="INSERT INTO club_requests(sports, category_id, product_id, description,club_id,filename, table_name) VALUES (\"{$_SESSION["sport"]}\",\"{$_SESSION["cid"]}\",\"{$_SESSION["pid"]}\",\"{$_SESSION["description"]}\",\"{$_SESSION["userdata"]["club_id"]}\", \"$newname\", \"trainingcamps\");";
  db::getInstance()->dbquery($query);
  $query = "Select request_id from club_requests where sports = \"{$_SESSION["sport"]}\" AND category_id = \"{$_SESSION["cid"]}\" AND  product_id = \"{$_SESSION["pid"]}\" AND description = \"{$_SESSION["description"]}\" AND club_id = \"{$_SESSION["userdata"]["club_id"]}\" AND filename =  \"$newname\" AND table_name  =  \"trainingcamps\"";
  $result = db::getInstance()->get_result($query);
  if($result)
  {
    $row = mysqli_fetch_assoc($result);
  }
  $query="INSERT INTO trainingcamps(request_id, No_of_Players, No_of_Coaches, No_of_Single_rooms, No_of_Double_rooms, No_of_Triple_rooms,  Desirable_time_of_tournament, No_of_Days, No_of_Trainings_per_Day, No_of_Training_Matches, Grass_Artificial_Club, Norway, Spain, TheNetherlands, Germany, Sweden, Turkey, Malta, Dubai, Denmark, Cyprus, England, France) VALUES (\"{$row["request_id"]}\",\"{$_SESSION["No_of_Players"]}\", \"{$_SESSION["No_of_Coaches"]}\", \"{$_SESSION["No_of_Single_rooms"]}\", \"{$_SESSION["No_of_Double_rooms"]}\", \"{$_SESSION["No_of_Triple_rooms"]}\", \"{$_SESSION["Desirable_time_of_tournament"]}\",\"{$_SESSION["No_of_Days"]}\", \"{$_SESSION["No_of_Trainings_per_Day"]}\", \"{$_SESSION["No_of_Training_Matches"]}\", \"{$_SESSION["Grass_Artificial_Club"]}\", \"$Norway\", \"$Spain\",\"$The_Netherland\", \"$Germany\", \"$Sweden\", \"$Turkey\", \"$Malta\", \"$Dubai\", \"$Denmark\", \"$Cyprus\", \"$England\", \"$France\");";
  db::getInstance()->dbquery($query);
  header("Location: ../userhome.php");
  exit();


?>