<?php
$host = 'localhost';
$db   = 'logfilereview';
$user = 'root';
$pass = 'root';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

$search = $_GET['search'] ?? '';
$page = $_GET['page'] ?? 1;
$items_per_page = 10; // Change this to the number of items you want per page

$sql = "SELECT * FROM fixturebom WHERE fixtureID LIKE ? LIMIT ? OFFSET ?";
$stmt = $pdo->prepare($sql);
$stmt->execute(["%$search%", $items_per_page, ($page - 1) * $items_per_page]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// New SQL query to calculate total for all columns
$sql_total = "SELECT SUM(usbGender) as USB_Gender, SUM(hdmiGender) as HDMI_Gender,
SUM(dpGender) as DP_Gender, SUM(lanCable) as LAN_Cable, SUM(satelliteConnector) as Satalite_Connector, SUM(rfConnector) as RF_Connector, SUM(satelliteCable) as satelliteCable, SUM(raspberryPi) as Raspberrypi, SUM(memorycard) as total_memorycard, SUM(hdmigender2) as HDMI_Gender2, SUM(camreadyconnector) as CAM_Ready_Connector,
SUM(camreadygender) as total_camreadygender, SUM(hdmisstboard) as total_hdmisstboard, SUM(interfaceboard) as total_interfaceboard, SUM(camreadycard) as total_camreadycard, SUM(camreadycard) as total_camreadycard,
 SUM(camreadycard) as total_camreadycard, SUM(hdmigender2) as HDMIGender2,
  SUM(camreadyconnector) as CAMReadyConnector, SUM(camreadygender) as CAMReadyGender,
  SUM(hdmisstboard) as HDMISSTBoard,SUM(interfaceboard) as InterfaceBoard,SUM(testpin) as TestPin,
  SUM(camreadycard) as CAMReadyConnector,
  SUM(lvdsdp) as LVDS_DP_Cable,SUM(lvdshdmi) as LVDS_HDMI_Cable FROM fixturebom";
$stmt_total = $pdo->prepare($sql_total);
$stmt_total->execute();
$rows_total = $stmt_total->fetchAll(PDO::FETCH_ASSOC);

// Transpose data
$rows_transposed = [];
foreach ($rows as $row) {
    foreach ($row as $key => $value) {
        $rows_transposed[$key][] = $value;
    }
}

// Transpose total
$rows_total_transposed = [];
foreach ($rows_total[0] as $key => $value) {
    $rows_total_transposed[$key][] = $value;
}

// Divide total into three parts
$total_parts = array_chunk($rows_total_transposed, ceil(count($rows_total_transposed) / 3), true);

// Column names mapping
$column_names = [
    // 'fixtureID' => 'Fixture ID',  // Comment this line to remove the ID column
    'usbGender' => 'USB Gender',
    'hdmiGender' => 'HDMI Gender',
    'dpGender' => 'DP Gender',
    'lanCable' => 'LAN Cable',
    'satelliteConnector' => 'Satellite Connector',
    'rfConnector' => 'RF Connector',
    'satelliteCable' => 'Satellite Cable',
    'raspberryPi' => 'Raspberry Pi',
    'memorycard' => 'Memory Card',
    'hdmigender2' => 'HDMI Gender 2',
    'camreadyconnector' => 'Cam Ready Connector',
    'camreadygender' => 'Cam Ready Gender',
    'hdmisstboard' => 'HDMI SST Board',
    'interfaceboard' => 'Interface Board',
    'testpin' => 'Test Pin',
    'camreadycard' => 'Cam Ready Card',
    'newItem1' => 'New Item 1',  // Add new items here
    'newItem2' => 'New Item 2',
    // ...
];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Fixture BOM Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
        body {
            font-size: 0.75rem;
            background-color: #f8f9fa;
        }
        .container-fluid {
            padding: 1rem;
        }
        .table-wrapper {
            margin: 1rem 0;
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, .05);
        }
        .table-responsive {
            max-height: 600px;
            overflow-y: auto;
            -ms-overflow-style: -ms-autohiding-scrollbar;
        }
        table {
            width: 100%;
            background-color: #fff;
            border: 1px solid #dee2e6; /* Light grey border */
        }
        th {
          background-color: #000000 !important;  /* Black background */
          color: #fff !important; /* White text
        }
        th, td {
            padding: 0.25rem 0.1rem;  /* Adjust as needed */
            vertical-align: top;
            border-top: 1px solid #dee2e6; /* Light grey border */
            width: 1%;  /* Adjust as needed */
            white-space: nowrap;
        }
        /* Change the background color of the fixtureID row */
        /* Change the background color of the second row */
        .second-table tr:nth-child(1) {
            background-color: #483d8b  !important;  /* Black background */
            color: #fff !important; /* White text */
        }
        .second-table tr td:first-child {
          background-color: #2f4f4f !important;  /* Black background */
    color: #fff; /* White text */
}
.table tr td:first-child {
  background-color: #7b1113  !important;  /* Black background */
    color: #fff; /* White text */
}

/* Change the background color of the first column in the second table */
.second-table tr td:first-child {
  background-color: #808080 !important;  /* Black background */
    color: #fff; /* White text */
}

    </style>
</head>
<body>
    <div class="container-fluid">
        <h1 class="my-4">Fixture BOM Data</h1>
        <form method="GET" class="mb-4">
            <div class="form-group">
                <input type="text" class="form-control" name="search" placeholder="Search by fixtureID" value="<?php echo htmlspecialchars($search); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <!-- New tables for total of all columns -->
        <div class="row">
            <?php foreach ($total_parts as $total_part): ?>
                <div class="col-md-4">
                    <div class="table-wrapper">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Column Name</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($total_part as $key => $value): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($column_names[$key] ?? $key); ?></td>
                                            <td><?php echo htmlspecialchars($value[0]); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- New table for all data -->
        <div class="table-wrapper">
            <div class="table-responsive">
                <table class="table table-striped table-bordered second-table"> <!-- Add the 'second-table' class here -->
                    <tbody>
                        <?php foreach ($rows_transposed as $key => $value): ?>
                            <?php if ($key !== 'id'):  // Add this line ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($column_names[$key] ?? $key); ?></td>
                                    <?php foreach ($value as $cell): ?>
                                        <td><?php echo htmlspecialchars($cell); ?></td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endif;  // Add this line ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?search=<?php echo urlencode($search); ?>&page=<?php echo $page - 1; ?>">Previous</a>
                </li>
                <li class="page-item <?php echo count($rows) < $items_per_page ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?search=<?php echo urlencode($search); ?>&page=<?php echo $page + 1; ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</body>
</html>
