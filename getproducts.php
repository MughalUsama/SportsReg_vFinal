<?php
    header('charset=utf-8');

    require_once("./db.php");
	session_start();
    
	$productsdata= array();	
    
    $category_id = mysqli_escape_string(db::getInstance(), $_REQUEST["category"]); 
    $sportsname = mysqli_escape_string(db::getInstance(), $_REQUEST["sports"]); 
    $sql = "SELECT * from products where category_id = {$category_id} and sports=\"$sportsname\";";
    $result = db::getInstance()->get_result($sql);
    if ($result) {
        while($row = $result->fetch_assoc())
        {
            $productsdata[]=array(
                'product_id' => $row["product_id"],
                'product_name' => mb_convert_encoding($row["product_name"], "HTML-ENTITIES", "UTF-8"),
                'category_id' => $row["category_id"],
            );
        }
    }
	print_r(json_encode($productsdata));
	


?>