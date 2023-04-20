<?php
session_start();
require("../../config/db-config.php");

if (isset($_POST['submit'])) {

    // getting info from form
    $ref_code = $_POST['reference'];
    $returnee = $_POST['returnee'];
    $quantity = $_POST['quantity'];
    $damaged = $_POST['damaged'];
    $description = $_POST['description'];
    $current_date = date('Y-m-d');
    $admin = $_SESSION['user_name'];
    $equipment_name = $_POST['equipment_name'];

    // taking the previous quantity from the take_out table using ref_code
    $previous_quantity = mysqli_query($conn, "SELECT `quantity` FROM `take_out` WHERE `take_out_id` = '$ref_code'");
    $previous_quantity = mysqli_fetch_row($previous_quantity)[0];

    // checking if the quantity returned is more than the quantity taken out
    if ($previous_quantity < $quantity) {
        echo '<script> alert("Quantity returned is more than the quantity taken out");
        window.location.href = "../../views/returns/add-return.php";
         </script>';
    } else {
        // calculating the short fall = previous quantity - quantity 
        $shortfall = $previous_quantity - $quantity;

        // calculating new availabe and updating the equipment table
        //$new_avaliable = $previous_quantity + $quantity;
        $update_available = mysqli_query($conn, "UPDATE `equipment` SET `quantity_available` = `quantity_available`  + '$quantity' WHERE `equipment_name` = '$equipment_name'");

        // insert into the returns table
        $query = "INSERT INTO `returns` (`take_out_id`, `date`, `quantity`, `shortfall`, `damaged`, `description`, `return_admin`) 
    VALUES ('$ref_code','$current_date','$quantity','$shortfall','$damaged','$description', '$admin')";

        // updating the quantity in the equipment table, remove the short fall from total quantity
        $new_quantity = mysqli_query($conn, "UPDATE `equipment` SET `quantity` = `quantity` - '$shortfall' WHERE `equipment_name` = '$equipment_name'");

        //return email
        //we will need to call out the takeout email address
        
                    //$to = $_SESSION['email'];
                    $to = "godzitanaka@gmail.com";
                    $cc = "godzitanaka@gmail.com";
                    //$headers = "From: GearTracker";
                    $subject = "$returnee Equipment Takeout Returned"; 
                    $message = $returnee. " has Returned $quantity $equipment_name on $current_date\n\n
                     There is $shortfall Shortfall \n\n
                     Return Done by $admin
                     \n\n Thank you for using GearTracker";
                    $mail_sent = @mail( $to, $subject, $message);
                    echo $mail_sent ? "Email Sent Successfully" : "Email Failed";

        $request = mysqli_query($conn, $query);

        if ($request) {
            echo '<script> window.location.href="../../views/returns/list-returns.php"; </script>';
        } else {
            echo '<script> alert("Return failed.");
        window.location.href = "../views/returns/list-returns.php";
         </script>';
        }
    }
} else {
    echo '<script> alert("Database failed");
        window.location.href = "../../views/auth/login.php";
         </script>';
}