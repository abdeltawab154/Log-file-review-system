<?php
// Start the session
session_start();

// Connect to your database
$db = new mysqli('localhost', 'username', 'password', 'database');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch the user from the database
    $result = $db->query("SELECT * FROM users WHERE username = '$username' AND password = '$password'");

    if ($result->num_rows > 0) {
        // User exists, start a new session
        $user = $result->fetch_assoc();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user['username'];

        // Record the login time
        $db->query("INSERT INTO login_history (user_id, login_time) VALUES ('{$user['id']}', NOW())");

        header("Location: dashboard.php"); // Redirect to a dashboard page
    } else {
        echo "Invalid username or password.";
    }
}

// If the user is logging out
if (isset($_GET['logout'])) {
    if (isset($_SESSION['username'])) {
        // Fetch the user from the database
        $result = $db->query("SELECT * FROM users WHERE username = '{$_SESSION['username']}'");

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Update the logout time
            $db->query("UPDATE login_history SET logout_time = NOW() WHERE user_id = '{$user['id']}' AND logout_time IS NULL");
        }

        // Destroy the session
        session_destroy();
    }

    header("Location: login.php"); // Redirect to the login page
}
?>
