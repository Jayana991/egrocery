<?php

require '../process.inc.php';
session_start();
//signup process
require './signInUp.func.php' ;

//date
$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d"); //reg date


//validate vars
$isSetPost = true; //->true
$isUserLogIn = false; //->true
$isUserAlredyExists = false; //->ture
$idDataValied = false; //->true
$userPost = "0";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //data trim
    $email = input_data_validate($_POST["email"]);
    $pass = $_POST["pass"];

    $data = [
        "email" => $email,
        "pass" => $pass,
    ];

    $errorsMsg = validateUserSignInData($data);

    if (empty(validateUserSignInData($data))) {

        $idDataValied = true;

        if (isUserExistsSignIn($email, $pass)) {
            $isUserAlredyExists = true;
            $check_use_added_rs = Database::search("SELECT * FROM user WHERE email = '".$email."' ");
            $check_use_added_data = $check_use_added_rs->fetch_assoc();
            
            $isUserLogIn = true;

            if($check_use_added_data["userType_id"] == "1"){
                $_SESSION["user"] = $check_use_added_data;
                $_SESSION["cart"] = array();
                $userPost = "1";
            }else{
                $_SESSION["admin"] = $check_use_added_data;
                $userPost = "2";
            }
        } else {
            $isNotUserAlreadyExists = false;
        }
    } else {
        $idDataValied = true;
    }
}

//JASON
$data = array(
    "isSetPost" => $isSetPost,
    "idDataValied" => $idDataValied,
    "errors" => $errorsMsg,
    "isUserAlredyExists" => $isUserAlredyExists,
    "isUserLogIn" => $isUserLogIn,
    "userPost" => $userPost
);

echo  json_encode($data);

?>