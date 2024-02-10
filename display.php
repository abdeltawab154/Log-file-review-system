<!DOCTYPE html>
<html>
<head>
    <title>Display Data and Sequences</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

  <?php
  if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
// Get the username from the session
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // Redirect to login page or show an error
    header('Location: login.html');
    exit;
}


  // Check if the user is not logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.html");
      exit;
  }
  ?>
  <div class="container-fluid">
      <h1 class="text-center my-4">Log File Review System</h1>
      <div class="d-flex justify-content-end">
          <a href="realtimeview.php" class="btn btn-primary mr-2">Current Log File Review Status</a>
          <a href="historystatus.php" class="btn btn-primary mr-2">Log File Review Status History</a>
          <a href="logout.php" class="btn btn-danger">Logout</a>
      </div>
      </div>
    <div class="container">
        <h1 class="text-center my-4">Data and Sequences for PBA_Code</h1>

        <!-- Form to enter PBA_Code -->
        <form method="get" action="logcheck.php">
            <div class="form-group">
                <label for="pbaCode">Enter PBA_Code:</label>
                <input type="text" class="form-control" id="pbaCode" name="pbaCode" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <!-- Display fetched data -->
        <?php if (!empty($data)): ?>
            <h2>Data</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Key</th>
                        <th scope="col">Value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $key => $value): ?>
                        <tr>
                            <td><?= htmlspecialchars($key) ?></td>
                            <td><?= htmlspecialchars($value) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <!-- Form to submit all sequence statuses -->
        <?php if (!empty($sequences)): ?>
            <h2>Sequences</h2>
            <form method="post" action="save.php" id="sequenceForm">
                <input type="hidden" name="pbaCode" value="<?= htmlspecialchars($pbaCode) ?>">

                <!-- Add input field for serial number -->
                <div class="form-group">
                    <label for="serialNumber">Enter Serial Number:</label>
                    <input type="text" class="form-control" id="serialNumber" name="serialNumber" required>
                </div>

                <!-- Add input field for username -->
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($_SESSION['username']) ?>" readonly>
                </div>
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Sequence</th>
                            <th scope="col">Value</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sequences as $key => $value): ?>
                            <tr>
                                <td><?= htmlspecialchars($key) ?></td>
                                <td><?= htmlspecialchars($value) ?></td>
                                <td>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-outline-success">
                                            <input type="radio" name="<?= htmlspecialchars($key) ?>Status" id="<?= htmlspecialchars($key) ?>Ok" value="ok" required> OK
                                        </label>
                                        <label class="btn btn-outline-danger">
                                            <input type="radio" name="<?= htmlspecialchars($key) ?>Status" id="<?= htmlspecialchars($key) ?>Ng" value="ng" required> NG
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- Add a button to set all sequences to OK -->
                <button type="button" class="btn btn-success my-2" id="setAllOk">Set All OK</button>
                <button type="submit" class="btn btn-primary" id="submitButton" disabled>Submit All</button>
            </form>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.btn-group-toggle input').change(function() {
            var allChecked = true;
            $('.btn-group-toggle input').each(function() {
                var name = $(this).attr('name');
                if (!$('input:radio[name="' + name + '"]').is(':checked')) {
                    allChecked = false;
                }
            });
            if (allChecked) {
                $('#submitButton').prop('disabled', false);
            } else {
                $('#submitButton').prop('disabled', true);
            }
        });

        // Add click event for the new button
        $('#setAllOk').click(function() {
            $('.btn-group-toggle input[value="ok"]').prop('checked', true).change();
            $('.btn-outline-success').addClass('active');
            $('.btn-outline-danger').removeClass('active');
        });
    });
    </script>
</body>
</html>
