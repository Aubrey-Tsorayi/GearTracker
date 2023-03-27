<?php
session_start();
require ("../../config/db-config.php");

if (isset($_POST['name'])){

    // getting info from form
    $equipment = $_POST['equipment'];
    $sport =$_POST['sport'];
    $quantity = $_POST['quantity'];
    $current_date = date('Y-m-d');
    $user = $_SESSION['user_id'];

    // Generate the new reference code
    $result = mysqli_query($conn, 'SELECT MAX(SUBSTRING(ref_code, 8)) FROM your_table_name');
    $max_ref_num = mysqli_fetch_row($result)[0];
    $new_ref_num = $max_ref_num + 1;
    // Generate the new reference code
    $reference = 'TAKEOUT' . $new_ref_num;     

    $query = "INSERT INTO `take_out`(`name`,`equipment_id`, `user_id`, `date`, `quantity`, `reference`) 
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
