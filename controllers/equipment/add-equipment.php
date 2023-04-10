<?php
session_start();
require("../../config/db-config.php");

if (isset($_POST['name'])) {
    // getting info from form
    $name = $_POST['name'];
    $code = $_POST['code'];
    $sport = $_POST['sport'];
    $quantity = $_POST['equipment'];
    $description = $_POST['description'];

    $code_names = array();
    $codes = mysqli_query($conn, "SELECT `equipment_code` FROM `equipment`");
    while ($row = mysqli_fetch_assoc($codes)) {
        $code_names[] = $row['equipment_code'];
    }

    if (in_array($code, $code_names)) {
        $quantiy_update = mysqli_query($conn, "UPDATE `equipment` SET `quantity` = `quantity` + '$quantity', `quantity_available` = `quantity_available` + '$quantity' WHERE `equipment_code` = '$code'");
        if ($quantiy_update) {
            echo '<script> window.location.href="../../views/equipment/list-equipment.php"; </script>';
        } else {
            echo '<script> alert("Quantity unupdatable.");
            window.location.href = "../../views/equipment/add-equipment.php";
             </script>';
        }
    } else {
        $query = "INSERT INTO `equipment`(`equipment_code`, `equipment_name`, `sport`, `quantity`, `quantity_available`, `description`) 
        VALUES ('$code','$name','$sport','$quantity','$quantity','$description')";

        $request = mysqli_query($conn, $query);

        if ($request) {
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
