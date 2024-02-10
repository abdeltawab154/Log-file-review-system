<?php
class LogFileChecker {
    private $fileName;
    private $logFiles;
    private $filePath;
    public function __construct($fileName, $filePath) {
        $this->fileName = $fileName;
        $this->filePath = $filePath;
        $this->logFiles = glob("{$this->filePath}**/*{$this->fileName}*.txt", GLOB_BRACE);
    }
    public function checkLogFile() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return [];
        }
        if (empty($this->logFiles)) {
            return ["No log file found for this file path."];
        }
        usort($this->logFiles, function($a, $b) {
            return filemtime($b) - filemtime($a);
        });
        $logFile = $this->logFiles[0];

        $logContents = file($logFile, FILE_IGNORE_NEW_LINES);
        if ($logContents === false) {
            return ["Error reading log file."];
        } else {
            // Ignore the first 12 lines and the last 6 lines
            return array_slice($logContents, 12, -6);
        }
    }
    public function getLogFile() {
        if (!empty($this->logFiles)) {
            return $this->logFiles[0];
        }
        return null;
    }
}

$logResult1 = [];
$logResult2 = [];
$diffResult = '';
$diffTable = []; // Initialize $diffTable as an empty array
$mmSmSoTable = []; // Initialize $mmSmSoTable as an empty array
$fwSsMtTable = []; // Initialize $fwSsMtTable as an empty array
$missingWordsTable1 = []; // Initialize $missingWordsTable1 as an empty array
$missingWordsTable2 = []; // Initialize $missingWordsTable2 as an empty array
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fileName2 = $_POST['fileName2'];
    $fileName1 = substr($fileName2, 4, 10); // Extract the substring from the 5th to the 14th character
    $filePath2 = "E:\\";
    $filePath1= "E:\\New folder";
    $logFileChecker1 = new LogFileChecker($fileName1, $filePath1);
    $logFileChecker2 = new LogFileChecker($fileName2, $filePath2);
    $logResult1 = $logFileChecker1->checkLogFile();
    $logResult2 = $logFileChecker2->checkLogFile();

    // Convert log results to arrays of words
    $words1 = array_unique(preg_split('/\s+/', implode(' ', $logResult1)));
    $words2 = array_unique(preg_split('/\s+/', implode(' ', $logResult2)));

    // Remove words that contain the section "ok|num" where "num" is a variable number
    $words1 = array_filter($words1, function($word) {
        return !preg_match('/ok\|\d+/', $word);
    });
    $words2 = array_filter($words2, function($word) {
        return !preg_match('/ok\|\d+/', $word);
    });

    // Remove words between "|" characters
    $words1 = array_filter($words1, function($word) {
        return !preg_match('/\|.*\|/', $word);
    });
    $words2 = array_filter($words2, function($word) {
        return !preg_match('/\|.*\|/', $word);
    });

    // Delete any data after "PowerOn=" and "ck|" in the same line or row
    $words1 = array_map(function($word) {
        if (strpos($word, 'PowerOn=') !== false) {
            return substr($word, 0, strpos($word, 'PowerOn='));
        } elseif (strpos($word, 'ck|') !== false) {
            return substr($word, 0, strpos($word, 'ck|'));
        } elseif (strpos($word, 'CHECK Port[') !== false) {
            return substr($word, 0, strpos($word, 'CHECK Port['));
        }
        return $word;
    }, $words1);
    $words2 = array_map(function($word) {
        if (strpos($word, 'PowerOn=') !== false) {
            return substr($word, 0, strpos($word, 'PowerOn='));
        } elseif (strpos($word, 'ck|') !== false) {
            return substr($word, 0, strpos($word, 'ck|'));
        } elseif (strpos($word, 'CHECK Port[') !== false) {
            return substr($word, 0, strpos($word, 'CHECK Port['));
        }
        return $word;
    }, $words2);

    // Check if any word between "<" and ">" exists in the file
    $words1 = array_filter($words1, function($word) use ($words2) {
        if (preg_match('/<(.*)>/', $word, $matches)) {
            return in_array($matches[1], $words2);
        }
        return true;
    });
    $words2 = array_filter($words2, function($word) use ($words1) {
        if (preg_match('/<(.*)>/', $word, $matches)) {
            return in_array($matches[1], $words1);
        }
        return true;
    });

    // Add words from file 1 that do not exist in file 2
    foreach ($words1 as $word1) {
        if (!in_array($word1, $words2)) {
            $missingWordsTable1[] = ['word' => $word1];
        }
    }
    // Add words from file 2 that do not exist in file 1
    foreach ($words2 as $word2) {
        if (!in_array($word2, $words1)) {
            $missingWordsTable2[] = ['word' => $word2];
        }
    }
    // Extract "mm", "sm", and "so" data from the second log file and add to $mmSmSoTable
    foreach ($logResult2 as $line2) {
        if (preg_match_all('/(MM|SM|SO):(.*)/', $line2, $matches2, PREG_SET_ORDER)) {
            foreach ($matches2 as $match) {
                $mmSmSoTable[] = ['type' => $match[1], 'value' => $match[2]];
            }
        }
    }
    // Extract "FW", "SS", and "MT" data from the second log file and add to $fwSsMtTable
    foreach ($logResult2 as $line2) {
        if (preg_match_all('/(FW|SS|MT):(.*)/', $line2, $matches2, PREG_SET_ORDER)) {
            foreach ($matches2 as $match) {
                $fwSsMtTable[] = ['type' => $match[1], 'value' => $match[2]];
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Log File Checker</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="autolog.css"> <!-- Link to the external CSS file -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>

        body {
            background: url('a.jpg') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        .table {
            background-color: rgba(255, 255, 255, 0.8); /* White background with 80% opacity */
            border: 1px solid #000; /* Black border */
            border-collapse: collapse; /* Collapse borders */
        }
        .table th, .table td {
            border: 1px solid #000; /* Black border */
            padding: 8px; /* Add some padding */
        }
        .table th {
            background-color: #f2f2f2; /* Light grey background */
            text-align: left; /* Left-align text */
        }
        .table tr:hover {background-color: #ddd;} /* Add a hover effect */
        /* Style the radio buttons */
        .form-check-input {
            position: relative;
            margin-left: 0;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #999;
            border-radius: 50%;
            outline: none;
            transition: 0.2s all linear;
        }
        .form-check-input:checked {
            border: 6px solid #000;
        }
        .form-check-label {
            margin-left: 5px;
        }
        /* Style the form */
        #logForm {
            background-color: rgba(255, 255, 255, 0.8); /* White background with 80% opacity */
            padding: 20px; /* Add some padding */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); /* Add a shadow */
        }
        /* Style the input box */
        #fileName2 {
            border: none;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); /* Add a shadow */
        }
        /* Style the buttons */
        .btn {
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 18px;
            color: #fff;
            background: #007BFF;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); /* Add a shadow */
            margin-right: 10px; /* Add some right margin */
        }
        .btn:hover {
            background: #0056b3;
            .logo-container {
                     display: flex;
                     justify-content: center;
                     align-items: center;
                     padding: 20px;
                 }
                 .logo-container img {
                     height: 60px;
                     width: auto;
                     border: 2px solid #000; /* Add a border around the logo */
                 }
                 .header {
                     background-color: #f8f9fa;
                     padding: 20px;
                     border-bottom: 1px solid #dee2e6;
                 }
                 .header h1 {
                     margin-left: 20px;
                 }
                 .logo-container {
                     display: flex;
                     justify-content: center;
                     align-items: center;
                     height: 100vh; /* This will center the logo vertically */
                 }

                 .logo-container img {
                     height: 50px; /* Reduced the height to make the logo smaller */
                     width: auto; /* This will maintain the aspect ratio */
                     border-radius: 50%; /* This will make the logo round */
                     border: 1px solid #000; /* Reduced the border thickness for a more professional look */
                     box-shadow: 0 0 5px rgba(0, 0, 0, 0.15); /* Reduced the shadow for a more professional look */
                 }

             </style>
         </head>
         <body>
             <div class="container py-5">
                 <div class="logo-container">
                     <img src="logo.jpg" alt="Logo"> <!-- Logo -->
                 </div>
                 <div class="header">
                     <h1 class="text-center mb-4">Log File Checker</h1>
                 </div>
        <form id="logForm" class="form-inline justify-content-center mb-4" method="post">
            <div class="form-group mr-2">
                <label for="fileName2" class="mr-2">Enter Second File Name:</label>
                <input type="text" id="fileName2" name="fileName2" class="form-control" required>
            </div>
            <div class="form-group mr-2">
                <label class="mr-2">Status:</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="statusOk" value="OK">
                    <label class="form-check-label" for="statusOk">OK</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="statusNg" value="NG">
                    <label class="form-check-label" for="statusNg">NG</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" id="checkLogFiles"><i class="fas fa-search"></i> Check Log Files</button>
            <button type="button" id="saveStatus" class="btn btn-secondary"><i class="fas fa-save"></i> Save Status</button>
        </form>
        <div id="message" class="alert alert-info" role="alert"></div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" id="logTitle1">Log File Standard</div>
                    <div class="card-body">
                        <pre id="logResult1" class="logResult"><?php echo implode("\n", $logResult1); ?></pre>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" id="logTitle2">PBA Log File</div>
                    <div class="card-body">
                        <pre id="logResult2" class="logResult"><?php echo implode("\n", $logResult2); ?></pre>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive mt-4">
            <table class="table table-bordered missingWordsTable">
            <thead>
                <tr>
                    <th scope="col">Missing Words in File 1</th>
                    <th scope="col">Missing Words in File 2</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $maxRows = max(count($missingWordsTable1), count($missingWordsTable2));
                for ($i = 0; $i < $maxRows; $i++) {
                    echo '<tr>';
                    echo '<td>'.($missingWordsTable1[$i]['word'] ?? '').'</td>';
                    echo '<td>'.($missingWordsTable2[$i]['word'] ?? '').'</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        <table class="table table-bordered mmSmSoTable">
            <thead>
                <tr>
                    <th scope="col">Type (mm/sm/so)</th>
                    <th scope="col">Value</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mmSmSoTable as $row): ?>
                <tr>
                    <td><?php echo $row['type']; ?></td>
                    <td><?php echo $row['value']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script>
         // Load the last entered filename from localStorage
         document.getElementById('fileName2').value = localStorage.getItem('lastEnteredFileName') || '';

         document.getElementById('checkLogFiles').addEventListener('click', function() {
             var fileName = document.getElementById('fileName2').value;
             if (!fileName) {
                 alert('File name cannot be empty');
                 return;
             }

             // Save the last entered filename to localStorage
             localStorage.setItem('lastEnteredFileName', fileName);
         });

         document.getElementById('saveStatus').addEventListener('click', function() {
             var fileName = localStorage.getItem('lastEnteredFileName'); // Get the last entered filename from localStorage
             if (!fileName) {
                 alert('File name cannot be empty');
                 return;
             }
             var status = document.querySelector('input[name="status"]:checked').value;
             var xhr = new XMLHttpRequest();
             xhr.open('POST', 'autostatus.php', true);
             xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
             xhr.onreadystatechange = function () {
                 if (xhr.readyState == 4 && xhr.status == 200) {
                     document.getElementById('message').textContent = xhr.responseText;
                     document.getElementById('fileName2').value = ''; // clear the input box
                 }
             };
             xhr.send('fileName=' + encodeURIComponent(fileName) + '&status=' + encodeURIComponent(status));
         });
     </script>
     <script>
          var images = ['a.jpg', 'b.jpg', 'c.jpg','d.jpg','e.jpg']; // replace with your image URLs
          var index = 0;
          setInterval(function() {
              document.body.style.backgroundImage = 'url(' + images[index] + ')';
              index = (index + 1) % images.length;
          }, 5000); // change image every 5 seconds
      </script>
 </body>

</html>
