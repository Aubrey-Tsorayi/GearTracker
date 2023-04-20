<?php
session_start();
require ("../../config/db-config.php");

if (isset($_POST['submit'])){

    // getting info from form
    $name =  mysqli_real_escape_string($conn, $_POST['name']);
    $number =$_POST['number'];
    $email = $_POST['email'];
    $sport = $_POST['sport'];
    $user_id = $_POST['id'];
    $passw = $_POST['password'];
    $return = $_POST['return'];
    $current_date = date('Y-m-d H:i:s');

    // checking if email address is already in the database
    $emails = mysqli_query($conn, "SELECT `email` FROM `users`");
    $email_names = array();
    while ($row = mysqli_fetch_assoc($emails)){
        $email_names[] = $row['email'];
    }
    
    if(in_array($email, $email_names)){
        echo '<script> alert("Email already exists");
        window.location.href = "../../views/users/add-users.php";
         </script>';
        exit();
    }

    // checking if user is a return manager
    if ($return == "Yes"){
        $accesss_level = 2;
    }
    else{
        $accesss_level = 1;
    }

    // encryting password
    $en_passw = password_hash($passw, PASSWORD_DEFAULT);

    // inserting into database
    $query = "INSERT INTO `users`(`user_id`, `user_name`, `email`, `phone_number`, `password`, `sport`, `level_access`) 
    VALUES ('$user_id','$name','$email','$number','$en_passw','$sport', '$accesss_level')";

    // running query
    $request = mysqli_query($conn, $query);

    // checking if query was successfull
    if($request){ 
        $log = mysqli_query($conn, "INSERT INTO `logs` (`user_name`, `action`, `date`) VALUES ('" . $_SESSION['user_name'] . "', 'User Added', '$current_date')");
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
