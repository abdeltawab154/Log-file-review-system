<!DOCTYPE html>
<html>
<head>
    <title>Log File Review Status</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            color: #212529;
        }
        h1 {
            text-align: center;
            padding: 20px 0;
            color: #6c757d;
        }
        .container {
            max-width: 100%;
            padding: 0;
        }
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        th, td {
            height: 50px;
            vertical-align: center;
            border: 1px solid #ddd;
            padding: 8px;
            color: #212529;
        }
        .status-ng {
            background-color: #dc3545;
            color: white;
        }
        form {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            border: 2px solid #6c757d;
            padding: 20px;
            border-radius: 10px;
            background-color: #e9ecef;
        }
        label {
            margin-right: 10px;
            font-weight: bold;
        }
        input[type="text"], input[type="date"] {
            border: 1px solid #6c757d;
            border-radius: 5px;
            padding: 5px;
        }
        input[type="submit"] {
            margin-left: 10px;
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
        }
        input[type="submit"]:hover {
            background-color: #5a6268;
        }
        .pagination {
            justify-content: center;
        }
        .pagination li a {
            color: #6c757d;
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #6c757d;
            margin: 0 5px;
        }
        .pagination li a:hover {
            background-color: #6c757d;
            color: white;
        }
    </style>
</head>
<body>
  <?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

  // Check if the user is not logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.html");
      exit;
  }
  ?>
    <div class="container">
        <h1>Log File Review Status</h1>
        <form method="get">
            <label for="pba_code">PBA Code:</label>
            <input type="text" id="pba_code" name="pba_code">
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date">
            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date">
            <input type="submit" value="Submit">

        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>PBA Code</th>
                    <th>E-Pass Serial</th>
                    <th>Log File Status</th>
                    <th>Review Time</th>
                    <th>Username</th> <!-- Add a new header for the username -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection
                $conn = new mysqli('localhost', 'root', 'root', 'logfilereview');
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Get filter parameters from GET request
                $pba_code = $_GET['pba_code'] ?? '';
                $start_date = $_GET['start_date'] ?? '';
                $end_date = $_GET['end_date'] ?? '';

                // Sanitize inputs
                $pba_code = $conn->real_escape_string($pba_code);
                $start_date = $conn->real_escape_string($start_date);
                $end_date = $conn->real_escape_string($end_date);

                // Pagination parameters
                $limit = 10; // Number of records to show per page
                $page = $_GET['page'] ?? 1; // Current page number
                $start_from = ($page-1) * $limit; // Starting record number

                // Build SQL query
                $sql = "SELECT PBA_Code, serial_number, total_status, review_date, username FROM sequencestatus"; // Include the username column in your SQL query
                $where = [];

                if (!empty($pba_code)) {
                    $where[] = "PBA_Code = '$pba_code'";
                }

                if (!empty($start_date)) {
                    $where[] = "review_date >= '$start_date'";
                }

                if (!empty($end_date)) {
                    $where[] = "review_date <= '$end_date'";
                }

                if (!empty($where)) {
                    $sql .= ' WHERE ' . implode(' AND ', $where);
                }

                $sql .= " ORDER BY review_date DESC LIMIT $start_from, $limit";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $class = ($row["total_status"] == 'ng') ? 'status-ng' : '';
                        echo "<tr class='" . $class . "'><td>" . $row["PBA_Code"]. "</td><td>" . $row["serial_number"]. "</td><td>" . $row["total_status"]. "</td><td>" . $row["review_date"]. "</td><td>" . $row["username"]. "</td></tr>"; // Display the username in the table
                    }
                } else {
                    echo "0 results";
                }

                // Get total number of records
                $sql = "SELECT COUNT(*) FROM sequencestatus";
                if (!empty($where)) {
                    $sql .= ' WHERE ' . implode(' AND ', $where);
                }
                $result = $conn->query($sql);
                $row = $result->fetch_row();
                $total_records = $row[0];

                // Calculate total pages
                $total_pages = ceil($total_records / $limit);

                // Display pagination
                echo "<ul class='pagination'>";
                for ($i=1; $i<=$total_pages; $i++) {
                    echo "<li><a href='?page=".$i."'>".$i."</a></li>";
                }
                echo "</ul>";

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
