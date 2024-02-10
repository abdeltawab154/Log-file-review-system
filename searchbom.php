<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "logfilereview";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$fixtureID = "";

// Search data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["fixtureID"])) {
  $fixtureID = $_POST["fixtureID"];

  // Use prepared statements to avoid SQL injection
  $stmt = $conn->prepare("SELECT * FROM fixturebom WHERE fixtureID = ?");

  if ($stmt === false) {
    die("Failed to prepare statement: " . $conn->error);
  }

  if (!$stmt->bind_param("s", $fixtureID)) {
    die("Failed to bind parameters: " . $stmt->error);
  }

  if (!$stmt->execute()) {
    die("Failed to execute statement: " . $stmt->error);
  }

  $result = $stmt->get_result();
  if ($conn->error) {
      die("SQL error: " . $conn->error);
  }


  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $_SESSION['data'] = $row;
    }
  } else {
    echo "No results found";
  }

  $stmt->close();
}

$conn->close();

// Redirect to fixture_bom.php
header("Location: fixture_bom.php");
exit;
?>
