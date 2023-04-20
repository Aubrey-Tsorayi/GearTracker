<?php
session_start();
require("../../config/db-config.php");

if (isset($_POST['submit'])) {

    // getting info from form
    $equipment = $_POST['equipment'];
    $sport = $_POST['sport'];
    $quantity = $_POST['quantity'];
    $current_date = date('Y-m-d');
    $datetime = date('Y-m-d H:i:s');
    $user = $_SESSION['user_id'];

    // checking if giving quanity is above zero
    if ($quantity == 0) {
        echo '<script> alert("Quantity cannot be 0");
        window.location.href = "../../views/take_out/take-out-equipment.php";
         </script>';
    } else {


        // Generate the new reference code for take out ID
        $result = mysqli_query($conn, 'SELECT COUNT(`take_out_id`) FROM `take_out`');
        $max_ref_num = mysqli_fetch_row($result)[0];
        if ($max_ref_num == 0) {
            $reference = 'TAKEOUT0';
        } else {
            $new_ref_num = $max_ref_num + 1;
            // Generate the new reference code
            $reference = 'TAKEOUT' . $new_ref_num;
        }


        // getting available quantity
        $available = mysqli_query($conn, "SELECT `quantity_available` FROM `equipment` WHERE `equipment_code` = '$equipment'");
        $available_quantity = mysqli_fetch_row($available)[0];

        if ($available_quantity == 0) {
            echo '<script> alert("No available quantity");
        window.location.href = "../../views/take_out/take-out-equipment.php";
         </script>';
        } else if ($available_quantity < $quantity) {
            echo '<script> alert("Quantity requested is more than available");
        window.location.href = "../../views/take_out/take-out-equipment.php";
         </script>';
        } else if ($quantity > 0) {
            $new_quantity = $available_quantity - $quantity;

            // updating the new quantity in the equipment 
            $update = mysqli_query($conn, "UPDATE `equipment` SET `quantity_available`='$new_quantity' WHERE `equipment_code` = '$equipment'");

            // getting equipment name
            $equipment_query = mysqli_query($conn, "SELECT `equipment_name` FROM `equipment` WHERE `equipment_code` = '$equipment'");
            $equipment_name = mysqli_fetch_row($equipment_query)[0];

            // inserting into take out table
            $query = "INSERT INTO `take_out`(`take_out_id`, `equipment_code`, `equipment_name`, `user_id`, `date`, `quantity`)
            VALUES ('$reference','$equipment', '$equipment_name', '$user','$current_date','$quantity')";

            // running query
            $request = mysqli_query($conn, $query);

            if ($request) { // checking if the query is a success

                //notification message
                $title = "Take Out";
                $message = $_SESSION['user_name'] . " has taken out $quantity $equipment_name";

                // inserting into notification table
                $notification = mysqli_query($conn, "INSERT INTO `notifications`(`title`, `message`, `date`)
                VALUES ('$title', '$message', '$datetime')");

                // sending email
                //require("../email/mailer.php");
                    $user_name = $_SESSION['user_name'];
                    $to = $_SESSION['email'];
                    $cc = "godzitanaka@gmail.com";
                    $subject = "$user_name New Equipment Takeout"; 
                    $txt = $_SESSION['user_name'] . " has taken out $quantity $equipment_name from the equipment inventory";
                    $message = "Thank you for using Geartracker ";
                    $header = "From: GearTracker";
                    
                    if (mail($to,$cc,$subject,$txt,$message)) {
                        echo "Email Sent Successfully";    
                    } else {
                        echo "Email Failed";
                }

                echo '<script> window.location.href="../../views/take_out/equipment-taken.php"; </script>';
            } else {
                echo '<script> alert("Take Out failed");
        window.location.href = "../../views/take_out/take-out-equipment.php";
         </script>';
            }
        } else {
            '<script> alert("Error");
        window.location.href = "../../views/take_out/take-out-equipment.php";
         </script>';
        }
    }

} else {
    echo '<script> alert("Database failed");
        window.location.href = "../../views/take_out/take-out-equipment.php";
         </script>';
}