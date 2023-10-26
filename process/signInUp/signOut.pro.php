<?php

require '../process.inc.php';
session_start();
//signup process
require './signInUp.func.php' ;


$isLogout = false;

if(isset($_SESSION["admin"])){

    $_SESSION["admin"] = null;
    session_destroy();
    $isLogout = true;
}

//set data
$data = array(
    'logout' => $isLogout,
);

$jsonData = json_encode($data);
echo $jsonData;




?>