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
$productDelete =false;

if (isset($_GET["id"])) {
    $isSetPost = true; //->true

    $id = $_GET["id"];

    Database::iud("DELETE FROM `product` WHERE id = '".$id."' ");

    $productDelete = true;
   
}else{
    $isSetPost = false; //->true
    $productDelete =false;
}


    $data = array(
        "isSetPost" => $isSetPost,
        "productDelete" => $productDelete
    );
    echo  json_encode($data);
