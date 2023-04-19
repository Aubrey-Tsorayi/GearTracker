<?php
session_start();
require ("../../config/db-config.php");

if (isset($_POST['submit'])){
    
    // getting info from form
    $ref_code = $_POST['reference'];
    $name =$_POST['name'];
    $returnee = $_POST['returnee'];
    $quantity = $_POST['quantity'];
    $damaged = $_POST['damaged'];
    $description = $_POST['description'];
    $current_date = date('Y-m-d');
    $admin = $_SESSION['user_name'];
    $equipment_name = $_POST['equipment_name'];

    // taking the previous quantity from the take_out table using ref_code
    $previous_quantity = mysqli_query($conn,"SELECT `quantity` FROM `take_out` WHERE `take_out_id` = '$ref_code'");
    $previous_quantity = mysqli_fetch_row($previous_quantity)[0];

    // calculating the short fall = previous quantity - quantity 
    $shortfall = $previous_quantity - $quantity;

    // calculating new availabe and updating the equipment table
    $new_avaliable = $previous_quantity + $quantity;
    $update_available = mysqli_query($conn, "UPDATE `equipment` SET `quantity_available` = '$new_avaliable' WHERE `equipment_name` = '$equipment_name'");

    // insert into the returns table
    $query = "INSERT INTO `returns` (`take_out_id`, `date`, `quantity`, `shortfall`, `damaged`, `description`, `return_admin`) 
    VALUES ('$ref_code','$current_date','$quantity','$shortfall','$damaged','$description', '$admin')";

    // updating the quantity in the equipment table, remove the short fall from total quantity
    $new_quantity = mysqli_query($conn, "UPDATE `equipment` SET `quantity` = `quantity` - '$shortfall'");

    $request = mysqli_query($conn, $query);

    if($request){
        echo '<script> window.location.href="../../views/returns/list-returns.php"; </script>';
    }
    else{
        echo '<script> alert("Return failed.");
        window.location.href = "../views/returns/list-returns.php";
         </script>';
    }
}
else{
    echo '<script> alert("Database failed");
        window.location.href = "../../views/auth/login.php";
         </script>';
}
