<?php
session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fileName = $_POST['fileName'];
    $pba_model = substr($fileName, 4, 10);  // Extract characters 5 to 14

    $status = $_POST['status']; // 'OK' or 'NG'
    $username = $_SESSION['username']; // Get the username from the session

    // Database connection
    $db = new mysqli('localhost', 'root', 'root', 'logfilereview');

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Prepare and bind
    $stmt = $db->prepare("INSERT INTO statustable (PBA_Model,serial_number, status, username) VALUES (?, ?, ?,?)");
    $stmt->bind_param("ssss",$pba_model, $fileName, $status, $username);

    // Execute the prepared statement
    $stmt->execute();

    echo "New record created successfully";

    $stmt->close();
    $db->close();
}
?>
