<!DOCTYPE html>
<html>
<head>
    <title>Log File Review System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    // Start the session
    session_start();

    // Check if the user is not logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.html");
        exit;
    }
    ?>
    <div class="container-fluid">
        <h1 class="text-center my-4">Log File Review System</h1>
        <div class="d-flex justify-content-end">
            <a href="logcheck.php" class="btn btn-primary mr-2">Log file check </a>
            <a href="realtimeview.php" class="btn btn-primary mr-2">Current Log File Review Status</a>
            <a href="historystatus.php" class="btn btn-primary mr-2">Log File Review Status History</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
        </div>


        <!-- MyData Section -->
        <section>
            <div class="card">
                <div class="card-header">
                    <h2>PBA Model Data</h2>
                </div>
                <div class="card-body">
                    <form id="myDataForm" method="post" action="main.php">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="pbaCode">PBA Code</label>
                                <input type="text" class="form-control" id="pbaCode" name="pbaCode" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tactTime">Tact Time</label>
                                <input type="text" class="form-control" id="tactTime" name="tactTime">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="topModel">Top Model</label>
                                <input type="text" class="form-control" id="topModel" name="topModel">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="sharedPcb">Shared PCB</label>
                                <input type="text" class="form-control" id="sharedPcb" name="sharedPcb">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="pcbCode">PCB Code</label>
                                <input type="text" class="form-control" id="pcbCode" name="pcbCode">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" id="addEditButton1">Add/Edit</button>
                    </form>
                </div>
            </div>
            <hr>
            <div id="myData"></div>
        </section>

        <!-- Sequence Section -->
        <section>
            <div class="card">
                <div class="card-header">
                    <h2>Enter Log File Sequence</h2>
                </div>
                <div class="card-body">
                    <form id="sequenceForm" method="post" action="main.php">
                        <div class="form-group">
                            <label for="pbaCodeSeq">PBA Code</label>
                            <input type="text" class="form-control" id="pbaCodeSeq" name="pbaCode" required>
                        </div>
                        <div id="sequenceFields"></div>
                        <button type="submit" class="btn btn-primary" id="addEditSeq">Add/Edit All Sequences</button>
                    </form>
                </div>
            </div>
            <hr>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="app.js"></script>
    <script>
    $(function(){
      for (let i = 1; i <= 20; i++) {
        $('#sequenceFields').append(`
          <div class="form-group">
            <label for="seq${i}">Seq${i}</label>
            <input type="text" class="form-control" id="seq${i}" name="seq${i}">
          </div>
        `);
      }
    });
    </script>
</body>
</html>
