<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $pbaCode = isset($_POST["pbaCode"]) ? $_POST["pbaCode"] : '';
  $tactTime = isset($_POST["tactTime"]) ? $_POST["tactTime"] : '';
  $topModel = isset($_POST["topModel"]) ? $_POST["topModel"] : '';
  $sharedPcb = isset($_POST["sharedPcb"]) ? $_POST["sharedPcb"] : '';
  $pcbCode = isset($_POST["pcbCode"]) ? $_POST["pcbCode"] : '';
  $seq = array();
  for ($i = 1; $i <= 20; $i++) {
    $seq[$i] = isset($_POST["seq$i"]) ? $_POST["seq$i"] : '';
  }

  // Check if record already exists
  $checkSql = "SELECT * FROM data WHERE PBA_Code='$pbaCode'";
  $checkResult = $conn->query($checkSql);

  if ($checkResult === false) {
    die("Error: " . $conn->error);
  }

  if ($checkResult->num_rows > 0) {
    // Record exists, update it
    $sqlData = "UPDATE data SET ";
    $fieldsToUpdate = array();
    if ($tactTime != '') $fieldsToUpdate[] = "Tact_Time='$tactTime'";
    if ($topModel != '') $fieldsToUpdate[] = "Top_Model='$topModel'";
    if ($sharedPcb != '') $fieldsToUpdate[] = "Shared_PCB='$sharedPcb'";
    if ($pcbCode != '') $fieldsToUpdate[] = "PCB_Code='$pcbCode'";
    if (!empty($fieldsToUpdate)) {
      $sqlData .= implode(', ', $fieldsToUpdate);
      $sqlData .= " WHERE PBA_Code='$pbaCode'";
      if ($conn->query($sqlData) === false) {
        die("Error: " . $conn->error);
      }
    }

    $sqlSeq = "UPDATE seq SET ";
    $seqToUpdate = array();
    for ($i = 1; $i <= 20; $i++) {
      if ($seq[$i] != '') $seqToUpdate[] = "Seq$i='$seq[$i]'";
    }
    if (!empty($seqToUpdate)) {
      $sqlSeq .= implode(', ', $seqToUpdate);
      $sqlSeq .= " WHERE PBA_Code='$pbaCode'";
      if ($conn->query($sqlSeq) === false) {
        die("Error: " . $conn->error);
      }
    }
  } else {
    // Record does not exist, insert it
    $sqlData = "INSERT INTO data (PBA_Code, Tact_Time, Top_Model, Shared_PCB, PCB_Code)
    VALUES ('$pbaCode', '$tactTime', '$topModel', '$sharedPcb', '$pcbCode')";
    if ($conn->query($sqlData) === false) {
      die("Error: " . $conn->error);
    }

    $sqlSeq = "INSERT INTO seq (PBA_Code, ";
    for ($i = 1; $i <= 20; $i++) {
      $sqlSeq .= "Seq$i, ";
    }
    $sqlSeq = rtrim($sqlSeq, ", ");  // Remove trailing comma
    $sqlSeq .= ") VALUES ('$pbaCode', ";
    for ($i = 1; $i <= 20; $i++) {
      $sqlSeq .= "'$seq[$i]', ";
    }
    $sqlSeq = rtrim($sqlSeq, ", ");  // Remove trailing comma
    $sqlSeq .= ")";
    if ($conn->query($sqlSeq) === false) {
      die("Error: " . $conn->error);
    }
  }

  // Redirect back to the form page after the operations
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}

$conn->close();
?>
