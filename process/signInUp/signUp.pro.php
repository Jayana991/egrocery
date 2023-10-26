<?php
require '../process.inc.php';
session_start();
//signup process
require './signInUp.func.php';
//date
$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d"); //reg date

//validate vars
$isSetPost = true; //->true
$isUserAdded = false; //->true
$isNotUserAlreadyExists = false; //->ture
$idDataValied = false; //->true

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //data trim
    $email = input_data_validate($_POST["email"]);
    $name = input_data_validate($_POST["name"]);
    $address = input_data_validate($_POST["address"]);
    $pass = $_POST["pass"];
    $contact = input_data_validate($_POST["contact"]);

    $data = [
        "email" => $email,
        "name" => $name,
        "address" => $address,
        "pass" => $pass,
        "contact" => $contact
    ];

    $errorsMsg = validateUserSignUpData($data);

    if (empty(validateUserSignUpData($data))) {

        $idDataValied = true;

        if (isUserExistsSignUp($email, $contact)) {

            $isNotUserAlreadyExists = true;

            //pass->hash
            $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

            // Insert user data into the database
            $insertSuccess = Database::iud("INSERT INTO `user` ( `name`, `email`, `pass`, `date`, `contact`, `address`, `userType_id`)
            VALUES ('".$name."', '".$email."', '".$hashedPassword."', '".$date."', '".$contact."', '".$address."', '1');");

            if ($insertSuccess) {
                // Fetch the user data
                $user = Database::$connection->insert_id;
                $check_use_added_rs = Database::search("SELECT * FROM user WHERE id = '".$user."' ");
                $check_use_added_data = $check_use_added_rs->fetch_assoc();
                $_SESSION["user"] = $check_use_added_data;
                $_SESSION["cart"] = array();
                $isUserAdded = true;
            } else {
                $isUserAdded = false;
                // echo "Database error: " . mysqli_error(Database::$connection);
            }
        } else {
            $isNotUserAlreadyExists = false;
        }
    } else {
        $idDataValied = true;
    }
} else {
    $isSetPost = false;
}

// //JASON
$data = array(
    "isSetPost" => $isSetPost,
    "idDataValied" => $idDataValied,
    "errors" => $errorsMsg,
    "isNotUserAlreadyExists" => $isNotUserAlreadyExists,
    "isUserAdded" => $isUserAdded
);

echo  json_encode($data);
