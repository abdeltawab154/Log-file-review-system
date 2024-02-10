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
            color: black; /* Add this line */
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
            color: black; /* Add this line */
        }
        .status-ng {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Log File Review Status</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>PBA Code</th>
                    <th>E-Pass Serial</th>
                    <th>Log File Status</th>
                    <th>Review Time</th>
                    <th>Username</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection
                $conn = new mysqli('localhost', 'root', 'root', 'logfilereview');
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT PBA_Code, serial_number, total_status, review_date, username FROM sequencestatus ORDER BY review_date DESC LIMIT 15";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $class = ($row["total_status"] == 'ng') ? 'status-ng' : '';
                        echo "<tr class='" . $class . "'><td>" . $row["PBA_Code"]. "</td><td>" . $row["serial_number"]. "</td><td>" . $row["total_status"]. "</td><td>" . $row["review_date"]. "</td><td>" . $row["username"]. "</td></tr>";
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function(){
            setInterval(function(){
                location.reload();
            }, 20000);
        });
    </script>
</body>
</html>
