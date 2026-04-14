<?php
session_start();
require_once 'db.php';

$name_err = $price_err = $image_err = "";
$name = $price = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST["product_name"];
    $priceTag = $_POST["price"];
    $imagePath = $_POST["image_path"];

    $arahanSQL = mysqli_prepare($conn,"INSERT INTO products (product_name, price, image_path) VALUES (?,?,?)");
    mysqli_stmt_bind_param($arahanSQL, "sds", $productName, $priceTag,$imagePath);
    if (mysqli_stmt_execute( $arahanSQL)) {
        $mesej = "<p style='color:green;'>data is accepted.</p>";
    } else {
        $mesej = "<p style='color:red;'>data failed.</p>";
    }     
    }

    


?>