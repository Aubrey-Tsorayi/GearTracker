<?php
$sql = "SELECT `equipment_name` FROM `equipment` WHERE `quantity` < '5'";
$request = mysqli_query($conn, $sql);

$names = array();

while ($row = mysqli_fetch_assoc($request)) {
    $names[] = $row['equipment_name'];
}

for($i=0; $i < count($names); $i++){
    echo '<script>alert("' . $names[$i]. ' is running low");</script>';
    }
?>