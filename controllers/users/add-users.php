<?php
session_start();
require ("../../config/db-config.php");

if (isset($_POST['submit'])){

    // getting info from form
    $name = $_POST['name'];
    $number =$_POST['number'];
    $email = $_POST['email'];
    $sport = $_POST['sport'];
    $user_id = $_POST['id'];
    $passw = $_POST['password'];
    $return = $_POST['return'];

    if ($return == "Yes"){
        $accesss_level = 2;
    }
    else{
        $accesss_level = 1;
    }

    // encryting password
    $en_passw = password_hash($passw, PASSWORD_DEFAULT);

    $query = "INSERT INTO `users`(`user_id`, `user_name`, `email`, `phone_number`, `password`, `sport`, `level_access`) 
    VALUES ('$user_id','$name','$email','$number','$en_passw','$sport', '$accesss_level')";

    $request = mysqli_query($conn, $query);

    if($request){
        echo '<script> window.location.href="../../views/users/list-users.php"; </script>';
    }
    else{
        echo '<script> alert("User registration failed.");
        window.location.href = "../../views/users/add-users.php";
         </script>';
    }
}
else{
    echo '<script> alert("Database failed");
        window.location.href = "../../views/auth/login.php";
         </script>';
}
