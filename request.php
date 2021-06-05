<?php
session_start();
ob_start();
require_once("./db.php");

$query="Select * from products where product_id = \"{$_REQUEST["product"]}\";";
$pdata = db::getInstance()->get_result($query);
while($row = mysqli_fetch_assoc($pdata))
{
    $_SESSION["formname"] = $row["form_name"];
}
require_once("./requestforms/".$_SESSION["formname"]);
?>


