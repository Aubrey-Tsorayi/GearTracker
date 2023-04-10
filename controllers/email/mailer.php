<?php
session_start();
$to = "godzit@africau.edu";
$subject = "Takeout Order";
$txt = "You have taken out 3 from the inventory.";
$headers = "From: GearTracker" . "\r\n" .
"CC: tsorayit@africa.edu";

mail($to,$subject,$txt,$headers);
?>