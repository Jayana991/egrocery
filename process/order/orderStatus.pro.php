<?php

require '../process.inc.php';
session_start();

//date
$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d"); //reg date

if(isset($_SESSION["admin"]) && isset($_GET["id"])){
    $isidSet = true;

    Database::iud("UPDATE `order` SET orderStatus_id = '2' WHERE `oid` = '".$_GET["id"]."' ");

}else{
    $isidSet = false;
}


    //JASON
    $data = array(
        "isidSet" => $isidSet,
    );
    
    echo json_encode($data);


?>