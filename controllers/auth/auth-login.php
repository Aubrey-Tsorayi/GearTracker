<?php
session_start();
require ("../../config/db-config.php");

if(isset($_POST['user'])) {
    
    // taking info from the view
    $user = $_POST['user'];
    $passw = $_POST['password'];

    // query
    $sql = "SELECT * FROM `users` WHERE  `user_id` = '$user' AND `password` = '$passw'";

    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id']= $row['user_id'];
        $_SESSION['user_name']= $row['user_name'];
        $_SESSION['access_level'] = $row['level_access'];
        $_SESSION['sport'] = $row['sport'];

        if($row['level_acess'] != 3){
            echo '<script> window.location.href="../../views/equipment/list-equipment.php"; </script>';
        }
        echo '<script> window.location.href="../../views/dashboard/main-dash.php"; </script>';
    } else {
        echo '<script> alert("Incorrect username or password.");
        window.location.href = "../../views/auth/login.php";
         </script>';
    }
}
else
{
    echo "Databse failed";
}
?>