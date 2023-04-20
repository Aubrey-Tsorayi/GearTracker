<?php
require("../../config/db-config.php");

$current_date = date('Y-m-d H:i:s');
// closing sessions
session_start();
$log = mysqli_query($conn, "INSERT INTO `logs` (`user_name`, `action`, `date`) VALUES ('" . $_SESSION['user_name'] . "', 'Logged Out', '$current_date')");
session_unset();
session_destroy();

// redirection to login page
header('Location: ../../views/auth/login.php');
