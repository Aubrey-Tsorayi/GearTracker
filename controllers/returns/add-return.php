<?php
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

    // taking the previous quantity from the take_out table using ref_code
    $previous_quantity = mysqli_query($conn,"SELECT `quantity` FROM `take_out` WHERE reference = '$ref_code'");
    $previous_quantity = mysqli_fetch_row($previous_quantity)[0];
    // calculating the short fall = previous quantity - quantity 
    $shortfall = $previous_quantity - $quantity;

    $query = "INSERT INTO `returns` (`take_out_id`, `date`, `quantity`, `shortfall`, `damaged`, `description`) 
    VALUES ('$ref_code','$current_date','$quantity','$shortfall','$damaged','$description')";

    $request = mysqli_query($conn, $query);

    if($request){
        echo '<script> window.location.href="../../views/returns/list-returns.php"; </script>';
    }
    else{
        echo '<script> alert("User registration failed.");
        window.location.href = "../views/returns/list-returns.php";
         </script>';
    }
}
else{
    echo '<script> alert("Database failed");
        window.location.href = "../../views/auth/login.php";
         </script>';
}
