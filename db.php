<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "logfile";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully or already exists";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select database
mysqli_select_db($conn, $dbname);

// sql to create table MyData
$sql = "CREATE TABLE IF NOT EXISTS MyData (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
pbaCode VARCHAR(30) NOT NULL,
topModel VARCHAR(30) NOT NULL,
sharedPcb VARCHAR(50),
fixtureNumber INT(6)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table MyData created successfully or already exists";
} else {
    echo "Error creating table: " . $conn->error;
}

// sql to create table sequence
$sql = "CREATE TABLE IF NOT EXISTS sequence (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
seq1 INT(6), seq2 INT(6), seq3 INT(6), seq4 INT(6), seq5 INT(6),
seq6 INT(6), seq7 INT(6), seq8 INT(6), seq9 INT(6), seq10 INT(6),
seq11 INT(6), seq12 INT(6), seq13 INT(6), seq14 INT(6), seq15 INT(6),
seq16 INT(6), seq17 INT(6), seq18 INT(6), seq19 INT(6), seq20 INT(6)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table sequence created successfully or already exists";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
