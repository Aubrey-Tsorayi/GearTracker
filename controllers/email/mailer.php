<?php
$to = "godzitanaka@gmail.com";
$subject = "Takeout Order";
$txt = "You have taken out 3 from the inventory.";
$headers = "From: GearTracker";

mail($to,$subject,$txt,$headers);
?>