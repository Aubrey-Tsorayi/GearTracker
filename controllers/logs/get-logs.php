<?php
require('../../config/db-config.php');

// Query the logs table
$result = mysqli_query($conn, 'SELECT * FROM logs');

// Loop through the results and append them to a string
$logs = '';
while ($row = mysqli_fetch_assoc($result)) {
    $logs .= $row['user_name'] . ' - ' . $row['action'] . ' - ' . $row['date'] . "\n";
}

// Close the database connection
mysqli_close($conn);

// Set the response headers to indicate that the response contains plain text
header('Content-Type: text/plain');

// Echo the logs
echo $logs;
