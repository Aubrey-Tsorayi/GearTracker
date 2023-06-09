<?php
session_start();
require("../../config/db-config.php");

if (isset($_POST['user'])) {

    // taking info from the view
    $user = $_POST['user'];
    $passw = $_POST['password'];
    $current_date = date('Y-m-d H:i:s');

    // retrive user
    $sql = "SELECT * FROM `users` WHERE  `user_id` = '$user'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $hash = $row['password'];

    // verify password
    if (password_verify($passw, $hash)) {
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['user_name'] = $row['user_name'];
        $_SESSION['access_level'] = $row['level_access'];
        $_SESSION['sport'] = $row['sport'];
        $_SESSION['email'] = $row['email'];

        $log = mysqli_query($conn, "INSERT INTO `logs` (`user_name`, `action`, `date`) VALUES ('" . $_SESSION['user_name'] . "', 'Logged in', '$current_date')");
        // redirect to dashboard
        if ($row['level_access'] != 3) {
            echo '<script> window.location.href="../../views/equipment/list-equipment.php"; </script>';
        }
        echo '<script> window.location.href="../../views/dashboard/main-dash.php"; </script>';
    } else {
        echo '<script> alert("Incorrect username or password.");
            window.location.href = "../../views/auth/login.php";
             </script>';
    }

    //query
    // $sql = "SELECT * FROM `users` WHERE  `user_id` = '$user' AND `password` = '$passw'";

    // $result = mysqli_query($conn, $sql);
    // $resultCheck = mysqli_num_rows($result);

    // if ($resultCheck == 1) {
    //     $row = mysqli_fetch_assoc($result);
    //     $_SESSION['user_id']= $row['user_id'];
    //     $_SESSION['user_name']= $row['user_name'];
    //     $_SESSION['access_level'] = $row['level_access'];
    //     $_SESSION['sport'] = $row['sport'];

    //     if($row['level_access'] != 3){
    //         echo '<script> window.location.href="../../views/equipment/list-equipment.php"; </script>';
    //     }
    //     echo '<script> window.location.href="../../views/dashboard/main-dash.php"; </script>';
    // } else {
    //     echo '<script> alert("Incorrect username or password.");
    //     window.location.href = "../../views/auth/login.php";
    //      </script>';
    // }
} else {
    echo "Databse failed";
}
?>