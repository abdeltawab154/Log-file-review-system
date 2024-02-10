<!DOCTYPE html>
<html>
<head>
    <title>Log File Review Status</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
            color: white;
            background-color: #6c757d;
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
        .logo-background {
            background-color: #000000; /* Change this to black */
            display: inline-block; /* This will make the div only as large as the content */
            padding: 10px; /* Adjust this to add space around the logo */
        }

    .logo-background img {
        max-height: 60px;
        max-width: 60px;
        height: auto;
        width: auto;
        border-radius: 50%;
        border: 0.5px solid #000;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
    }
    .logout-container {
        background-color: #003366; /* Replace #yourColorHere with the color you want */
    }
    .logo-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: auto;
        padding: 0;
        margin: 0;
        background-color: #d0ced1 /* Add this line to change the background color */
    }
    body .logo-container img {
        max-height: 150px;
        max-width: 150px;
        height: auto;
        width: auto;
        border-radius: 50%;
        border: 0.5px solid #000;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);

    }
    .btn {
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 18px;
        color: #fff;
        background: #003366;
        cursor: pointer;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        margin-right: 10px;
    }
    .btn:hover {
        background: #0056b3;
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
  <div class="logo-container">
      <img src="logo.jpg" alt="Logo"> <!-- Logo -->
  </div>
  <div class="logout-container" style="align-self: flex-end; width: 100%; text-align: right;">
      <button type="button" id="review" class="btn btn-primary" onclick="window.location.href='auto.php'"><i class="fas fa-check-circle"></i> Check Log File</button>
      <button type="button" id="logout" class="btn btn-danger" onclick="window.location.href='logout.php'"><i class="fas fa-sign-out-alt"></i> Logout</button>
      <span id="welcome" class="badge badge-secondary" style="background-color: #003366;"><i class="fas fa-user"></i> Welcome, <?php echo $_SESSION['name']; ?>!</span> <!-- Add this line -->
  </div>

    <div class="container">
        <h1>Log File Review Status</h1>
        <form method="get">
            <label for="PBA_Model">PBA Code:</label>
            <input type="text" id="PBA_Model" name="PBA_Model">
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
                $PBA_Model = $_GET['PBA_Model'] ?? '';
                $start_date = $_GET['start_date'] ?? '';
                $end_date = $_GET['end_date'] ?? '';

                // Sanitize inputs
                $PBA_Model = $conn->real_escape_string($PBA_Model);
                $start_date = $conn->real_escape_string($start_date);
                $end_date = $conn->real_escape_string($end_date);

                // Pagination parameters
                $limit = 20; // Number of records to show per page
                $page = $_GET['page'] ?? 1; // Current page number
                $start_from = ($page-1) * $limit; // Starting record number

                // Build SQL query
                $sql = "SELECT PBA_Model, serial_number, status, username,timestamp  FROM statustable"; // Include the username column in your SQL query
                $where = [];

                if (!empty($PBA_Model)) {
                    $where[] = "PBA_Model = '$PBA_Model'";
                }

                if (!empty($start_date)) {
                    $where[] = "timestamp >= '$start_date'";
                }

                if (!empty($end_date)) {
                    $where[] = "timestamp <= '$end_date'";
                }

                if (!empty($where)) {
                    $sql .= ' WHERE ' . implode(' AND ', $where);
                }

                $sql .= " ORDER BY timestamp DESC LIMIT $start_from, $limit";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $class = ($row["status"] == 'ng') ? 'status-ng' : '';
                        echo "<tr class='" . $class . "'><td>" . $row["PBA_Model"]. "</td><td>" . $row["serial_number"]. "</td><td>" . $row["status"]. "</td><td>" . $row["timestamp"]. "</td><td>" . $row["username"]. "</td></tr>"; // Display the username in the table
                    }
                } else {
                    echo "0 results";
                }

                // Get total number of records
                $sql = "SELECT COUNT(*) FROM  statustable";
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
    <script>
    $(document).ready(function(){
        $("#welcome").css("font-size", "17px");
    });
    </script>


</body>
</html>
