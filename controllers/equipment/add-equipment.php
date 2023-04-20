<?php
session_start();
require("../../config/db-config.php");

if (isset($_POST['name'])) {
    // getting info from form
    $name = $_POST['name'];
    $code = $_POST['code'];
    $sport = $_POST['sport'];
    $quantity = $_POST['equipment'];
    $current_date = date('Y-m-d H:i:s');

    // getting equipment codes from database and storing in an array
    $code_names = array();

    $codes = mysqli_query($conn, "SELECT `equipment_code` FROM `equipment`");
    while ($row = mysqli_fetch_assoc($codes)) {
        $code_names[] = $row['equipment_code'];
    }

    // checking if code exisit in the database
    if (in_array($code, $code_names)) {
        
        // updating the quantity of the existing code
        $quantiy_update = mysqli_query($conn, "UPDATE `equipment` SET `quantity` = `quantity` + '$quantity', `quantity_available` = `quantity_available` + '$quantity' WHERE `equipment_code` = '$code'");
        if ($quantiy_update) {
            $log = mysqli_query($conn, "INSERT INTO `logs` (`user_name`, `action`, `date`) VALUES ('" . $_SESSION['user_name'] . "', 'Equipment Updated', '$current_date')");
            echo '<script> window.location.href="../../views/equipment/list-equipment.php"; </script>';
        } else {
            echo '<script> alert("Quantity unupdatable.");
            window.location.href = "../../views/equipment/add-equipment.php";
             </script>';
        }
    } else {
        // inserting into equipment table
        $query = "INSERT INTO `equipment`(`equipment_code`, `equipment_name`, `sport`, `quantity`, `quantity_available`) 
        VALUES ('$code','$name','$sport','$quantity','$quantity')";

        // running query
        $request = mysqli_query($conn, $query);

        if ($request) {
            $log = mysqli_query($conn, "INSERT INTO `logs` (`user_name`, `action`, `date`) VALUES ('" . $_SESSION['user_name'] . "', 'Equipment Added, '$current_date')");
            echo '<script> window.location.href="../../views/equipment/list-equipment.php"; </script>';
        } else {
            echo '<script> alert("Make sure details are correct");
        window.location.href = "../../views/equipment/add-equipment.php";
         </script>';
        }
    }
} else {
    echo '<script> alert("Database failed");
        window.location.href = "../../views/equipment/add-equipment.php";
         </script>';
}
