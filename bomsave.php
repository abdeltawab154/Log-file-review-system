<?php
// Ensure session is started before any output
session_start();

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "logfilereview";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Add or Edit data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate inputs (you may need to enhance this depending on your requirements)
    $requiredFields = array(
        "fixtureID", "usbGender", "hdmiGender", "dpGender", "lanCable", "satelliteConnector",
        "rfConnector", "satelliteCable", "raspberryPi", "memorycard", "fixturestatus", "fixturestartdate",
        "hdmigender2", "fixturescrapdate", "fixturebackboardtype", "camreadyconnector", "camreadygender",
        "hdmisstboard", "interfaceboard", "testpin", "camreadycard", "pcbcode", "lvdsdp", "lvdshdmi"
    );

    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            die("Error: " . ucfirst($field) . " is required");
        }
    }

    // Check if UsbGender field is provided
    if (empty($_POST["usbGender"])) {
        die("Error: UsbGender is required");
    }

    try {
        // Check if the fixtureID already exists
        $stmt_check = $conn->prepare("SELECT COUNT(*) FROM FixtureBOM WHERE fixtureID = :fixtureID");
        $stmt_check->bindParam(':fixtureID', $_POST["fixtureID"]);
        $stmt_check->execute();
        $existing_records = $stmt_check->fetchColumn();

        if ($existing_records > 0) {
            // Update the existing record instead of inserting a new one
            $stmt_update = $conn->prepare("UPDATE FixtureBOM SET
                usbGender = :usbGender,
                hdmiGender = :hdmiGender,
                dpGender = :dpGender,
                lanCable = :lanCable,
                satelliteConnector = :satelliteConnector,
                rfConnector = :rfConnector,
                satelliteCable = :satelliteCable,
                raspberryPi = :raspberryPi,
                memorycard = :memorycard,
                fixturestatus = :fixturestatus,
                fixturestartdate = :fixturestartdate,
                hdmigender2 = :hdmigender2,
                fixturescrapdate = :fixturescrapdate,
                fixturebackboardtype = :fixturebackboardtype,
                camreadyconnector = :camreadyconnector,
                camreadygender = :camreadygender,
                hdmisstboard = :hdmisstboard,
                interfaceboard = :interfaceboard,
                testpin = :testpin,
                camreadycard = :camreadycard,
                pcbcode = :pcbcode,
                lvdsdp = :lvdsdp,
                lvdshdmi = :lvdshdmi,
                username = :username
                WHERE fixtureID = :fixtureID");

            // Bind parameters and execute the update query
            // (Assuming all fields need to be updated)
            $stmt_update->bindParam(':fixtureID', $_POST["fixtureID"]);
            $stmt_update->bindParam(':usbGender', $_POST["usbGender"]);
            $stmt_update->bindParam(':hdmiGender', $_POST["hdmiGender"]);
            $stmt_update->bindParam(':dpGender', $_POST["dpGender"]);
            $stmt_update->bindParam(':lanCable', $_POST["lanCable"]);
            $stmt_update->bindParam(':satelliteConnector', $_POST["satelliteConnector"]);
            $stmt_update->bindParam(':rfConnector', $_POST["rfConnector"]);
            $stmt_update->bindParam(':satelliteCable', $_POST["satelliteCable"]);
            $stmt_update->bindParam(':raspberryPi', $_POST["raspberryPi"]);
            $stmt_update->bindParam(':memorycard', $_POST["memorycard"]);
            $stmt_update->bindParam(':fixturestatus', $_POST["fixturestatus"]);
            $stmt_update->bindParam(':fixturestartdate', $_POST["fixturestartdate"]);
            $stmt_update->bindParam(':hdmigender2', $_POST["hdmigender2"]);
            $stmt_update->bindParam(':fixturescrapdate', $_POST["fixturescrapdate"]);
            $stmt_update->bindParam(':fixturebackboardtype', $_POST["fixturebackboardtype"]);
            $stmt_update->bindParam(':camreadyconnector', $_POST["camreadyconnector"]);
            $stmt_update->bindParam(':camreadygender', $_POST["camreadygender"]);
            $stmt_update->bindParam(':hdmisstboard', $_POST["hdmisstboard"]);
            $stmt_update->bindParam(':interfaceboard', $_POST["interfaceboard"]);
            $stmt_update->bindParam(':testpin', $_POST["testpin"]);
            $stmt_update->bindParam(':camreadycard', $_POST["camreadycard"]);
            $stmt_update->bindParam(':pcbcode', $_POST["pcbcode"]);
            $stmt_update->bindParam(':lvdsdp', $_POST["lvdsdp"]);
            $stmt_update->bindParam(':lvdshdmi', $_POST["lvdshdmi"]);
            $stmt_update->bindParam(':username', $_SESSION["username"]);

            $stmt_update->execute();
        } else {
            // If fixtureID doesn't exist, proceed with insertion
            $stmt = $conn->prepare("INSERT INTO FixtureBOM
                (fixtureID, usbGender, hdmiGender, dpGender, lanCable, satelliteConnector,
                rfConnector, satelliteCable, raspberryPi, memorycard, fixturestatus, fixturestartdate,
                hdmigender2, fixturescrapdate, fixturebackboardtype, camreadyconnector, camreadygender,
                hdmisstboard, interfaceboard, testpin, camreadycard, pcbcode, lvdsdp, lvdshdmi, username)
                VALUES
                (:fixtureID, :usbGender, :hdmiGender, :dpGender, :lanCable, :satelliteConnector,
                :rfConnector, :satelliteCable, :raspberryPi, :memorycard, :fixturestatus, :fixturestartdate,
                :hdmigender2, :fixturescrapdate, :fixturebackboardtype, :camreadyconnector, :camreadygender,
                :hdmisstboard, :interfaceboard, :testpin, :camreadycard, :pcbcode, :lvdsdp, :lvdshdmi, :username)");

            $stmt->bindParam(':fixtureID', $_POST["fixtureID"]);
            $stmt->bindParam(':usbGender', $_POST["usbGender"]);
            $stmt->bindParam(':hdmiGender', $_POST["hdmiGender"]);
            $stmt->bindParam(':dpGender', $_POST["dpGender"]);
            $stmt->bindParam(':lanCable', $_POST["lanCable"]);
            $stmt->bindParam(':satelliteConnector', $_POST["satelliteConnector"]);
            $stmt->bindParam(':rfConnector', $_POST["rfConnector"]);
            $stmt->bindParam(':satelliteCable', $_POST["satelliteCable"]);
            $stmt->bindParam(':raspberryPi', $_POST["raspberryPi"]);
            $stmt->bindParam(':memorycard', $_POST["memorycard"]);
            $stmt->bindParam(':fixturestatus', $_POST["fixturestatus"]);
            $stmt->bindParam(':fixturestartdate', $_POST["fixturestartdate"]);
            $stmt->bindParam(':hdmigender2', $_POST["hdmigender2"]);
            $stmt->bindParam(':fixturescrapdate', $_POST["fixturescrapdate"]);
            $stmt->bindParam(':fixturebackboardtype', $_POST["fixturebackboardtype"]);
            $stmt->bindParam(':camreadyconnector', $_POST["camreadyconnector"]);
            $stmt->bindParam(':camreadygender', $_POST["camreadygender"]);
            $stmt->bindParam(':hdmisstboard', $_POST["hdmisstboard"]);
            $stmt->bindParam(':interfaceboard', $_POST["interfaceboard"]);
            $stmt->bindParam(':testpin', $_POST["testpin"]);
            $stmt->bindParam(':camreadycard', $_POST["camreadycard"]);
            $stmt->bindParam(':pcbcode', $_POST["pcbcode"]);
            $stmt->bindParam(':lvdsdp', $_POST["lvdsdp"]);
            $stmt->bindParam(':lvdshdmi', $_POST["lvdshdmi"]);
            $stmt->bindParam(':username', $_SESSION["username"]);

            $stmt->execute();
        }

        // Redirect to fixture_bom.php after successful insertion or update
        header("Location: fixture_bom.php");
        exit();
    } catch(PDOException $e) {
        echo "Error updating record: " . $e->getMessage();
    }
}

// Close the database connection
$conn = null;
?>
