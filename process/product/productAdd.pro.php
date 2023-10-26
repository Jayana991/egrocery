<?php

require '../process.inc.php';
session_start();

//date
$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d"); //reg date


//validate vars
$upOrAdd = true; //true->add // false->update
$isPost = false;


if (isset($_POST["name"]) 
    && isset($_POST["cat"])
    && isset($_POST["sdis"]) 
    && isset($_POST["dis"]) 
    && isset($_POST["price"]) 
    && isset($_POST["priceQty"])
    && isset($_POST["unit"])){

    $isPost = true;

    //php data validate func 
    function input_data_validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $name =input_data_validate($_POST["name"]);
    $catId = input_data_validate($_POST["cat"]);
    $sdis = input_data_validate($_POST["sdis"]);
    $dis = input_data_validate($_POST["dis"]);
    $price = input_data_validate($_POST["price"]);
    $priceQty = input_data_validate($_POST["priceQty"]);
    $unit = input_data_validate($_POST["unit"]);


    if (isset($_FILES['images'])) {
        $images = $_FILES['images'];
        $filetype = "img";
        foreach ($images['tmp_name'] as $key => $tmpName) {
            $imageExtension = pathinfo($images['name'][$key], PATHINFO_EXTENSION);
            $uniqueID = uniqid();
            $imageName = $filetype . '_' . $uniqueID . '.' . $imageExtension;
            move_uploaded_file($tmpName, '../../document/' . $imageName);
        }
    }else{
        $imageName = "empty.jpg";
    }

    if (isset($_POST["updateId"])) {
        // === data updating === //
        $upOrAdd = false;

        Database::iud("UPDATE `product` 
            SET `name` = '".$name."', 
                `discription` = '".$dis."', 
                `img_path` = '".$imageName."', 
                `price` = '".$price."', 
                `category_id` = '".$catId."', 
                `priceQty` = '".$priceQty."', 
                `unit_id` = '".$unit."', 
                `smapleDis` = '".$sdis."' 
            WHERE `id` = '".$_GET["id"]."'");

    } else {
        // === data adding === //
        $upOrAdd = true;

        Database::iud("INSERT INTO `product` 
        (`name`, `discription`, `img_path`, `price`, `category_id`, `priceQty`, `unit_id`, `smapleDis`) 
        VALUES ('".$name."', '".$dis."', '".$imageName."', '".$price."', '".$catId."', '".$priceQty."', '".$unit."', '".$sdis."');");
    }
} else {
    $isPost = false;
}


$data = array(
    "upOrAdd" => $upOrAdd,
    "isPost" => $isPost,
);
echo  json_encode($data);
