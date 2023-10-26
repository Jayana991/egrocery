<?php

require '../process.inc.php';
session_start();


//date
$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d"); //reg date


//validate vars
$isSetPost = false; //->true

if (isset($_GET["id"])) {
    $isSetPost = true; //->true

    $id = $_GET["id"];

    $get_data_rs = Database::search("SELECT * FROM `product` WHERE id = '".$id."' ");
    $get_data_dat = $get_data_rs->fetch_assoc();

    $data = array(
        "isSetPost" => $isSetPost,
        "productData" => $get_data_dat
    );
   
}else{
    $isSetPost = false; //->true

    $data = array(
        "isSetPost" => $isSetPost,
    );
}

    echo  json_encode($data);

?>