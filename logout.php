<?php
// Initialize the session
session_start();

// Connect to your database
$db = new mysqli('localhost', 'root', 'root', 'logfilereview');

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    // Get the user's ID from the session
    $user_id = $_SESSION['id'];

    // Save the logout time in the history table
    $logout_time = date("Y-m-d H:i:s");
    $stmt = $db->prepare("UPDATE login_history SET logout_time = ? WHERE user_id = ? ORDER BY login_time DESC LIMIT 1");
    $stmt->bind_param("si", $logout_time, $user_id);
    $stmt->execute();
}

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page
header("location: login.html");
exit;
?>
