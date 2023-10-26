<?php

session_start();
$setCart = false;
$cartArr = array(); // Initialize cartArr as an empty array

if (isset($_SESSION["cart"]) && is_array($_SESSION["cart"])) {
    $cartArr = $_SESSION["cart"];
    $setCart = true;
} else {
    $setCart = false;
}

// JSON response
$data = array(
    "cartArr" => $cartArr,
    "setCart" => $setCart
);

echo json_encode($data);

