<?php
$isSet = false;
session_start();
if(isset($_SESSION["cart"]) && isset($_GET["pid"] )){
    $isSet = true;
    $cartArr = $_SESSION["cart"];
    $pid = $_GET["pid"];

    if (in_array($pid, $cartArr)) {
        $index = array_search($pid, $cartArr);
        if ($index !== false) {
            unset($cartArr[$index]);
        }
    } else {
        $cartArr[] = $pid;
    }

    // Update the cart session variable
    $_SESSION["cart"] = $cartArr;



}else{
    $isSet = false;
}

    //JASON
    $data = array(
        "isSet" => $isSet
    );
    
    echo json_encode($data);
