
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
</head>
<body>
    <h1>Log File Checker</h1>
    <div class="container">
        <form id="logForm" class="form-inline" method="post">
            <div class="form-group">
                <label for="fileName2" class="mr-2">Enter Second File Name:</label>
                <input type="text" id="fileName2" name="fileName2" class="form-control mr-2">
            </div>
            <button type="submit" class="btn btn-primary">Check Log Files</button>
        </form>
        <div class="logContainer">
            <div>
                <div id="logTitle1" class="logTitle">Log File Standard</div>
                <pre id="logResult1" class="logResult"><?php echo implode("\n", $logResult1); ?></pre>
            </div>
            <div>
                <div id="logTitle2" class="logTitle">PBA Log File</div>
                <pre id="logResult2" class="logResult"><?php echo implode("\n", $logResult2); ?></pre>
            </div>
        </div>
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

        </table>
    </div>
    <script>
        window.onload = function() {
            var logResult1 = document.getElementById('logResult1');
            var logResult2 = document.getElementById('logResult2');

            var contentLength1 = logResult1.textContent.length;
            var contentLength2 = logResult2.textContent.length;

            var borderSize1 = Math.min(Math.max(contentLength1 / 100, 3), 10); // Minimum border size is 3px, maximum is 10px
            var borderSize2 = Math.min(Math.max(contentLength2 / 100, 3), 10); // Minimum border size is 3px, maximum is 10px

            logResult1.style.borderWidth = borderSize1 + 'px';
            logResult2.style.borderWidth = borderSize2 + 'px';
        }
    </script>
</body>
</html>
