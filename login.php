<?php
// Start the session
session_start();

// Check if the user is already logged in, if yes then redirect him to index page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

// Connect to your database
$db = new mysqli('localhost', 'root', 'root', 'logfilereview');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $db->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User exists, start a new session
        $user = $result->fetch_assoc();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user['username'];
        $_SESSION['name'] = $user['name']; // Fetch the name from the database

        // Update the is_active status in the database
        $stmt = $db->prepare("UPDATE users SET is_active = TRUE WHERE id = ?");
        $stmt->bind_param("i", $user['id']);
        $stmt->execute();

        // Save the login time and username in the history table
        $login_time = date("Y-m-d H:i:s");
        $stmt = $db->prepare("INSERT INTO login_history(user_id, username, login_time) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user['id'], $username, $login_time);
        $stmt->execute();

        header("Location:index.php"); // Redirect to a dashboard page
    } else {
        echo "Invalid username or password.";
    }
}
?>
