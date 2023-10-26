<?php

require '../process.inc.php';
session_start();

//date
$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d"); //reg date

if(isset($_SESSION["cart"])){
    $isCartSet = true;

    $user = $_SESSION["user"];
    $cart = $_SESSION["cart"];
    $uniqid = uniqid();

    //palce order
    Database::iud("INSERT INTO `order` ( `oid`, `date`,`orderStatus_id`,`user_id`) VALUES ( '".$uniqid."', '".$date."' ,'1','".$user["id"]."');");
    $orderid = Database::$connection->insert_id;

    //place items
    foreach($cart as $item){
        Database::iud("INSERT INTO `user_has_product` (`user_id`, `product_id`,`order_id`) VALUES ( '".$user["id"]."', '".$item."' , '".$orderid."' );");
    }

}else{
    $isCartSet = false;
}


    //JASON
    $data = array(
        "isCartSet" => $isCartSet,
        "orderId" => $uniqid
    );
    
    echo json_encode($data);


?>