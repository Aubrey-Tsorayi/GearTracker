<?php
// start sessions
session_set_cookie_params(0);
session_start();
if(isset($_SESSION['user_id'])){
    //pass

}else{
    echo '<script> window.location.href = "../../views/auth/login.php"; </script>';
}
?>
 
 