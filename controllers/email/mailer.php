<?php
$to = $_SESSION['email'];
$subject = "Takeout Order";
$txt = "You have taken out ".$quantity." from the inventory.";
$headers = "From: GearTracker" . "\r\n" .
"CC: tsorayit@africa.edu";

mail($to,$subject,$txt,$headers);
?>