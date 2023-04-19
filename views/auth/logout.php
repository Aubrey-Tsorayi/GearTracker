<?php

// closing sessions
session_start();
session_unset();
session_destroy();

// redirection to login page
header('Location: ../../views/auth/login.php');
