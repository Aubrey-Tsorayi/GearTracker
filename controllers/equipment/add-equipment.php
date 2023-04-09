<?php
session_start();
require ("../../config/db-config.php");

if (isset($_POST['name'])){
    session_start();
    // getting info from form
    $name = $_POST['name'];
    $code =$_POST['code'];
    $sport = $_POST['sport'];
    $quantity = $_POST['equipment'];
    $description = $_POST['description'];

    $query = "INSERT INTO `equipment`(`equipment_code`, `equipment_name`, `sport`, `quantity`, `quantity_available`, `description`) 
    VALUES ('$code','$name','$sport','$quantity','$quantity','$description')";

    $request = mysqli_query($conn, $query);

    if($request){
        echo '<script> window.location.href="../../views/equipment/list-equipment.php"; </script>';
    }
    else{
        echo '<script> alert("User registration failed.");
        window.location.href = "../../views/equipment/add-equipment.php";
         </script>';
    }
}
else{
    echo '<script> alert("Database failed");
        window.location.href = "../../views/equipment/add-equipment.php";
         </script>';
}
