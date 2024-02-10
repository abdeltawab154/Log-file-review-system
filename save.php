<?php
// Start the session
session_start();

// Database configuration
$host = 'localhost';
$db   = 'logfilereview';
$user = 'root';
$pass = 'root';

// Create a new mysqli instance
$mysqli = new mysqli($host, $user, $pass, $db);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Calculate total_status based on all sequence statuses
$total_status = 'ok';
$seqStatuses = [];
for ($i = 1; $i <= 31; $i++) { // Change the loop condition to <= 31
    $seqStatuses[$i] = isset($_POST['Seq' . $i . 'Status']) ? $_POST['Seq' . $i . 'Status'] : null;
    if ($seqStatuses[$i] === 'ng') {
        $total_status = 'ng';
    }
}

// Prepare the SQL query for inserting sequence statuses
$sql = "INSERT INTO sequencestatus (seq1, seq2, seq3, seq4, seq5, seq6, seq7, seq8, seq9, seq10, seq11, seq12, seq13, seq14, seq15, seq16, seq17, seq18, seq19, seq20, seq21, seq22, seq23, seq24, seq25, seq26, seq27, seq28, seq29, seq30, seq31, total_status, serial_number, username) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $mysqli->prepare($sql);

// Get the serial number from the form
$serialNumber = $_POST['serialNumber'];

// Get the username from the session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // Handle the case where the username is not set in the session
    die("Error: Username not found in session.");
}

// Bind the parameters to the query
$stmt->bind_param('ssssssssssssssssssssssssssssssssss', $seqStatuses[1], $seqStatuses[2], $seqStatuses[3], $seqStatuses[4], $seqStatuses[5], $seqStatuses[6], $seqStatuses[7], $seqStatuses[8], $seqStatuses[9], $seqStatuses[10], $seqStatuses[11], $seqStatuses[12], $seqStatuses[13], $seqStatuses[14], $seqStatuses[15], $seqStatuses[16], $seqStatuses[17], $seqStatuses[18], $seqStatuses[19], $seqStatuses[20], $seqStatuses[21], $seqStatuses[22], $seqStatuses[23], $seqStatuses[24], $seqStatuses[25], $seqStatuses[26], $seqStatuses[27], $seqStatuses[28], $seqStatuses[29], $seqStatuses[30], $seqStatuses[31], $total_status, $serialNumber, $username);

// Execute the query
if ($stmt->execute()) {
    // Redirect back to the display page
    header('Location: display.php');
} else {
    // Log the error and display a user-friendly message
    error_log("Error: " . $stmt->error);
    echo "An error occurred while inserting the data. Please try again.";
}

// Close the statement and the connection
$stmt->close();
$mysqli->close();
?>
