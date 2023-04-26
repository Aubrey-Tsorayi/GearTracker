<?php
$user_name = $_SESSION['user_name'];
$to = $_SESSION['email'];
//$to = "godzitanaka@gmail.com";
//$cc = "godzitanaka@gmail.com";
//$headers = "From: GearTracker";
$subject = "$user_name New Equipment Takeout"; 
$message = $_SESSION['user_name'] . " has taken out $quantity $equipment_name \n\n Thank you for using GearTracker";
$mail_sent = @mail( $to, $subject, $message);
echo $mail_sent ? "Email Sent Successfully" : "Email Failed";
?>