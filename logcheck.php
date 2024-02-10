<?php
// Start the session
session_start();

// Check if the user is not logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.html");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "LogFileReview";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$data = [];
$sequences = [];
$pbaCode = '';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["pbaCode"])) {
  $pbaCode = $_GET["pbaCode"];

  // Fetch data and sequences for the given PBA_Code
  $sqlData = "SELECT * FROM data WHERE PBA_Code='$pbaCode'";
  $sqlSeq = "SELECT * FROM seq WHERE PBA_Code='$pbaCode'";
  $resultData = $conn->query($sqlData);
  $resultSeq = $conn->query($sqlSeq);

  if ($resultData->num_rows > 0) {
    // Output data
    while($row = $resultData->fetch_assoc()) {
      unset($row['id']); // Remove 'id' from the data
      $data = $row;
    }
  }

  if ($resultSeq->num_rows > 0) {
    // Output sequences
    while($row = $resultSeq->fetch_assoc()) {
      unset($row['id'], $row['PBA_Code']); // Remove 'id' and 'PBA_Code' from the sequences
      foreach ($row as $key => $value) {
        if (!empty($value)) {
          $sequences[$key] = $value;
        }
      }
    }
  }
}

$conn->close();

// Include the HTML file
include 'display.php';
?>
