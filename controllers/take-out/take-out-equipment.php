<?php
session_start();
require ("../../config/db-config.php");

if (isset($_POST['submit'])){

    // getting info from form
    $equipment = $_POST['equipment'];
    $sport =$_POST['sport'];
    $quantity = $_POST['quantity'];
    $current_date = date('Y-m-d');
    $user = $_SESSION['user_id'];

    // Generate the new reference code
    $result = mysqli_query($conn, 'SELECT MAX(take_out_id) FROM take_out');
    $max_ref_num = mysqli_fetch_row($result)[0];
    $new_ref_num = $max_ref_num + 1;
    // Generate the new reference code
    $reference = 'TAKEOUT' . $new_ref_num;     

    // getting available quantity and updating it with the new available
    $available = mysqli_query($conn,"SELECT `quantity_availalble` FROM `equipment` WHERE code = '$sport'");
    $available_quantity = mysqli_fetch_row($available)[0];
    $new_quantity = $available_quantity - $quantity;
    // updating the new quantity in the equipment using code
    $update = mysqli_query($conn, "UPDATE `equipment` SET `quantity_availalble`='$new_quantity' WHERE `code` = '$sport'");


    $query = "INSERT INTO `take_out`(`name`,`code`, `user_id`, `date`, `quantity`, `reference`) 
    VALUES ('$equipment','$sport','$user','$current_date','$quantity','$reference')";

    $request = mysqli_query($conn, $query);

    if($request){
        echo '<script> window.location.href="../../views/take_out/equipment-taken.php"; </script>';
    }
    else{
        echo '<script> alert("Take Out failed");
        window.location.href = "../../views/take_out/take-out-equipment.php";
         </script>';
    }
}
else{
    echo '<script> alert("Database failed");
        window.location.href = "../../views/take_out/take-out-equipment.php";
         </script>';
}
