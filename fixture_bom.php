<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PBA Fixture BOM</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container-fluid {
            padding-top: 20px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            border-radius: 10px 10px 0 0;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header img {
            max-height: 50px;
            max-width: 50px;
        }

        .card-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ced4da;
            padding: 10px;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-control:focus {
            border-color: #007bff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 18px;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .item-description {
            margin-bottom: 10px;
        }

        .item-description p {
            margin-bottom: 5px;
            color: #6c757d;
        }

        .item-description img {
            max-width: 30%;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            margin-top: 10px;
        }
        <?php
        session_start();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>PBA Fixture BOM</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f8f9fa;
                }

                .container-fluid {
                    padding-top: 20px;
                }

                .card {
                    border: none;
                    border-radius: 10px;
                    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
                }

                .card-header {
                    background-color: #007bff;
                    color: #fff;
                    border-radius: 10px 10px 0 0;
                    padding: 15px;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }

                .card-header img {
                    max-height: 50px;
                    max-width: 50px;
                }

                .card-body {
                    padding: 20px;
                }

                .form-group {
                    margin-bottom: 20px;
                }

                .form-control {
                    border-radius: 5px;
                    border: 1px solid #ced4da;
                    padding: 10px;
                    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                }

                .form-control:focus {
                    border-color: #007bff;
                    outline: 0;
                    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
                }

                .btn-primary {
                    background-color: #007bff;
                    border: none;
                    border-radius: 5px;
                    padding: 10px 20px;
                    font-size: 18px;
                    color: #fff;
                    cursor: pointer;
                    transition: background-color 0.3s;
                }

                .btn-primary:hover {
                    background-color: #0056b3;
                }

                .item-description {
                    margin-bottom: 10px;
                }

                .item-description p {
                    margin-bottom: 5px;
                    color: #6c757d;
                }

                .item-description img {
                    max-width: 30%;
                    height: auto;
                    border-radius: 5px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
                    margin-top: 10px;
                }
                .card-header {
                    background-color: #343a40; /* Change background color */
                    color: #fff;
                    border-radius: 0 0 10px 10px;
                    padding: 15px;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    border: 1px solid #343a40; /* Add border */
                }

                .logo-container {
                    background-color: #0F1110; /* Change background color */
                    padding: 20px; /* Add padding */
                    border-radius: 10px; /* Add border-radius */
                    margin-bottom: 20px; /* Add margin bottom */
                }

                .logo-container img {
                    max-height: 200px; /* Increase logo size */
                    max-width: 200px; /* Increase logo size */
                }

            </style>
        </head>
        <body>
          <div class="container-fluid">
       <div class="card">
           <!-- Logo container above the header -->
           <div class="logo-container text-center pt-3">
                           <img src="logo2.jpg" alt="Logo" style="max-height: 250px; max-width: 250px;">
           </div>
           <div class="card-header">
               <h2 class="text-center mb-0"><i class="fa fa-list-alt mr-2"></i> PBA Fixture BOM</h2>
           </div>
                <div class="card-body">
                    <form id="myDataForm" method="post" action="bomsave.php">
                        <!-- Fixture ID -->
                        <div class="form-group">
                            <label for="fixtureID">Fixture ID</label>
                            <div class="item-description">
                                <p>Enter the ID of the fixture.</p>
                            </div>
                                  <input type="text" class="form-control" id="fixtureID" name="fixtureID" value="<?php echo isset($_SESSION['data']['fixtureID']) ? $_SESSION['data']['fixtureID'] : ''; ?>" required>
                                  <button type="submit" class="btn btn-secondary mt-2" id="searchButton" formaction="searchbom.php"><i class="fa fa-search"></i> Search</button>
                              </div>
                              <!-- PCB Code -->
                              <div class="row">
                                  <div class="col-md-4 form-group">
                                      <label for="pcbcode"><i class="fa fa-plug"></i> PCB Code</label>
                                      <div class="item-description">
                                          <p>Enter the code for the PCB.</p>
                                          <img src="logo.jpg" alt="PCB Code Photo">
                                      </div>
                                      <input type="text" class="form-control" id="pcbcode" name="pcbcode" value="<?php echo isset($_SESSION['data']['pcbcode']) ? $_SESSION['data']['pcbcode'] : ''; ?>">
                                  </div>
                                  <div class="col-md-4 form-group">
                                      <label for="fixturestartdate"><i class="fa fa-plug"></i> Fixture start date</label>
                                      <div class="item-description">
                                          <p>Select the start date of the fixture.</p>
                                          <img src="fixture_start_date_photo.jpg" alt="Fixture Start Date Photo">
                                      </div>
                                      <input type="date" class="form-control" id="" name="fixturestartdate" value="<?php echo isset($_SESSION['data']['fixturestartdate']) ? $_SESSION['data']['fixturestartdate'] : ''; ?>">
                                  </div>
                                  <div class="col-md-4 form-group">
                                      <label for="fixturescrapdate"><i class="fa fa-plug"></i> Fixture Scrap date</label>
                                      <div class="item-description">
                                          <p>Select the scrap date of the fixture.</p>
                                          <img src="fixture_scrap_date_photo.jpg" alt="Fixture Scrap Date Photo">
                                      </div>
                                      <input type="date" class="form-control" id="fixturescrapdate" name="fixturescrapdate" value="<?php echo isset($_SESSION['data']['fixturescrapdate']) ? $_SESSION['data']['fixturescrapdate'] : ''; ?>">
                                  </div>
                              </div>
                              <!-- HDMI Gender, HDMI Gender 2, DP Gender -->
                              <div class="row">
                                  <div class="col-md-4 form-group">
                                      <label for="hdmiGender"><i class="fa fa-plug"></i> HDMI Gender</label>
                                      <div class="item-description">
                                          <p>Enter the HDMI gender.</p>
                                          <img src="hdmi_gender_photo.jpg" alt="HDMI Gender Photo">
                                      </div>
                                      <input type="number" class="form-control" id="hdmiGender" name="hdmiGender" value="<?php echo isset($_SESSION['data']['hdmiGender']) ? $_SESSION['data']['hdmiGender'] : ''; ?>">
                                  </div>
                                  <div class="col-md-4 form-group">
                                      <label for="hdmigender2"><i class="fa fa-plug"></i> HDMI Gender 2</label>
                                      <div class="item-description">
                                          <p>Enter the second HDMI gender.</p>
                                          <img src="hdmi_gender_2_photo.jpg" alt="HDMI Gender 2 Photo">
                                      </div>
                                      <input type="number" class="form-control" id="hdmigender2" name="hdmigender2" value="<?php echo isset($_SESSION['data']['hdmigender2']) ? $_SESSION['data']['hdmigender2'] : ''; ?>">
                                  </div>
                                  <div class="col-md-4 form-group">
                                      <label for="dpGender"><i class="fa fa-plug"></i> DP Gender</label>
                                      <div class="item-description">
                                          <p>Enter the DP gender.</p>
                                          <img src="dp_gender_photo.jpg" alt="DP Gender Photo">
                                      </div>
                                      <input type="number" class="form-control" id="dpGender" name="dpGender" value="<?php echo isset($_SESSION['data']['dpGender']) ? $_SESSION['data']['dpGender'] : ''; ?>">
                                  </div>
                              </div>
                              <!-- Satellite Connector, RF Connector, Satellite Cable -->
                              <div class="row">
                                  <div class="col-md-4 form-group">
                                      <label for="satelliteConnector"><i class="fa fa-plug"></i> Satellite Connector</label>
                                      <div class="item-description">
                                          <p>Enter the satellite connector.</p>
                                          <img src="satellite_connector_photo.jpg" alt="Satellite Connector Photo">
                                      </div>
                                      <input type="number" class="form-control" id="satelliteConnector" name="satelliteConnector" value="<?php echo isset($_SESSION['data']['satelliteConnector']) ? $_SESSION['data']['satelliteConnector'] : ''; ?>">
                                  </div>
                                  <div class="col-md-4 form-group">
                                      <label for="rfConnector"><i class="fa fa-plug"></i> RF Connector</label>
                                      <div class="item-description">
                                          <p>Enter the RF connector.</p>
                                          <img src="rf_connector_photo.jpg" alt="RF Connector Photo">
                                      </div>
                                      <input type="number" class="form-control" id="rfConnector" name="rfConnector" value="<?php echo isset($_SESSION['data']['rfConnector']) ? $_SESSION['data']['rfConnector'] : ''; ?>">
                                  </div>
                                  <div class="col-md-4 form-group">
                                      <label for="satelliteCable"><i class="fa fa-plug"></i> Satellite Cable</label>
                                      <div class="item-description">
                                          <p>Enter the satellite cable.</p>
                                          <img src="satellite_cable_photo.jpg" alt="Satellite Cable Photo">
                                      </div>
                                      <input type="number" class="form-control" id="satelliteCable" name="satelliteCable" value="<?php echo isset($_SESSION['data']['satelliteCable']) ? $_SESSION['data']['satelliteCable'] : ''; ?>">
                                  </div>
                              </div>
                              <!-- Raspberry Pi, USB Gender, Memory Card -->
                              <div class="row">
                                  <div class="col-md-4 form-group">
                                      <label for="raspberryPi"><i class="fa fa-plug"></i> Raspberry PI</label>
                                      <div class="item-description">
                                          <p>Enter the Raspberry Pi.</p>
                                          <img src="raspberry_pi_photo.jpg" alt="Raspberry Pi Photo">
                                      </div>
                                      <input type="number" class="form-control" id="raspberryPi" name="raspberryPi" value="<?php echo isset($_SESSION['data']['raspberryPi']) ? $_SESSION['data']['raspberryPi'] : ''; ?>">
                                  </div>
                                  <div class="col-md-4 form-group">
                                      <label for="usbGender"><i class="fa fa-usb"></i> USB Gender</label>
                                      <div class="item-description">
                                          <p>Enter the USB gender.</p>
                                          <img src="usb_gender_photo.jpg" alt="USB Gender Photo">
                                      </div>
                                      <input type="number" class="form-control" id="usbGender" name="usbGender" value="<?php echo isset($_SESSION['data']['usbGender']) ? $_SESSION['data']['usbGender'] : ''; ?>">
                                  </div>
                                  <div class="col-md-4 form-group">
                                      <label for="memorycard"><i class="fa fa-usb"></i> Memory Card</label>
                                      <div class="item-description">
                                          <p>Enter the memory card.</p>
                                          <img src="memory_card_photo.jpg" alt="Memory Card Photo">
                                      </div>
                                      <input type="number" class="form-control" id="memorycard" name="memorycard" value="<?php echo isset($_SESSION['data']['memorycard']) ? $_SESSION['data']['memorycard'] : ''; ?>">
                                  </div>
                              </div>
                              <!-- CAM Ready Card, CAM Ready Gender, CAM Ready Connector -->
                              <div class="row">
                                  <div class="col-md-4 form-group">
                                      <label for="camreadycard"><i class="fa fa-usb"></i> CAM Ready Card</label>
                                      <div class="item-description">
                                          <p>Enter the CAM Ready card.</p>
                                          <img src="cam_ready_card_photo.jpg" alt="CAM Ready Card Photo">
                                      </div>
                                      <input type="number" class="form-control" id="camreadycard" name="camreadycard" value="<?php echo isset($_SESSION['data']['camreadycard']) ? $_SESSION['data']['camreadycard'] : ''; ?>">
                                  </div>
                                  <div class="col-md-4 form-group">
                                      <label for="camreadygender"><i class="fa fa-usb"></i> CAM Ready Gender</label>
                                      <div class="item-description">
                                          <p>Enter the CAM Ready gender.</p>
                                          <img src="cam_ready_gender_photo.jpg" alt="CAM Ready Gender Photo">
                                      </div>
                                      <input type="number" class="form-control" id="camreadygender" name="camreadygender" value="<?php echo isset($_SESSION['data']['camreadygender']) ? $_SESSION['data']['camreadygender'] : ''; ?>">
                                  </div>
                                  <div class="col-md-4 form-group">
                                      <label for=camreadyconnector><i class="fa fa-plug"></i> CAM Ready Connector</label>
                                      <div class="item-description">
                                          <p>Enter the CAM Ready connector.</p>
                                          <img src="cam_ready_connector_photo.jpg" alt="CAM Ready Connector Photo">
                                      </div>
                                      <input type="number" class="form-control" id="camreadyconnector" name="camreadyconnector" value="<?php echo isset($_SESSION['data']['camreadyconnector']) ? $_SESSION['data']['camreadyconnector'] : ''; ?>">
                                  </div>
                              </div>
                              <!-- Interface Board, Fixture Backboard Type, LAN Cable -->
                              <div class="row">
                                  <div class="col-md-4 form-group">
                                      <label for="interfaceboard"><i class="fa fa-plug"></i> Interface Board</label>
                                      <div class="item-description">
                                          <p>Enter the interface board.</p>
                                          <img src="interface_board_photo.jpg" alt="Interface Board Photo">
                                      </div>
                                      <input type="number" class="form-control" id="interfaceboard" name="interfaceboard" value="<?php echo isset($_SESSION['data']['interfaceboard']) ? $_SESSION['data']['interfaceboard'] : ''; ?>">
                                  </div>
                                  <div class="col-md-4 form-group">
                                      <label for="fixturebackboardtype"><i class="fa fa-usb"></i> Fixture Backboard Type</label>
                                      <div class="item-description">
                                          <p>Enter the type of fixture backboard.</p>
                                          <img src="fixture_backboard_type_photo.jpg" alt="Fixture Backboard Type Photo">
                                      </div>
                                      <input type="text" class="form-control" id="fixturebackboardtype" name="fixturebackboardtype" value="<?php echo isset($_SESSION['data']['fixturebackboardtype']) ? $_SESSION['data']['fixturebackboardtype'] : ''; ?>">
                                  </div>
                                  <div class="col-md-4 form-group">
                                      <label for="lanCable"><i class="fa fa-plug"></i> LAN Cable</label>
                                      <div class="item-description">
                                          <p>Enter the LAN cable.</p>
                                          <img src="lan_cable_photo.jpg" alt="LAN Cable Photo">
                                      </div>
                                      <input type="number" class="form-control" id="lanCable" name="lanCable" value="<?php echo isset($_SESSION['data']['lanCable']) ? $_SESSION['data']['lanCable'] : ''; ?>">
                                  </div>
                              </div>
                              <!-- HDMI SST Board, LVDS DP Cable, LVDS HDMI Cable -->
                              <div class="row">
                                  <div class="col-md-4 form-group">
                                      <label for="hdmisstboard"><i class="fa fa-usb"></i> HDMI SST Board</label>
                                      <div class="item-description">
                                          <p>Enter the HDMI SST board.</p>
                                          <img src="hdmi_sst_board_photo.jpg" alt="HDMI SST Board Photo">
                                      </div>
                                      <input type="number" class="form-control" id="hdmisstboard" name="hdmisstboard" value="<?php echo isset($_SESSION['data']['hdmisstboard']) ? $_SESSION['data']['hdmisstboard'] : ''; ?>">
                                  </div>
                                  <div class="col-md-4 form-group">
                                      <label for="lvdsdp"><i class="fa fa-plug"></i> LVDS DP Cable</label>
                                      <div class="item-description">
                                          <p>Enter the LVDS DP cable.</p>
                                          <img src="lvds_dp_cable_photo.jpg" alt="LVDS DP Cable Photo">
                                      </div>
                                      <input type="number" class="form-control" id="lvdsdp" name="lvdsdp" value="<?php echo isset($_SESSION['data']['lvdsdp']) ? $_SESSION['data']['lvdsdp'] : ''; ?>">
                                  </div>
                                  <div class="col-md-4 form-group">
                                      <label for="lvdshdmi"><i class="fa fa-plug"></i> LVDS HDMI Cable</label>
                                      <div class="item-description">
                                          <p>Enter the LVDS HDMI cable.</p>
                                          <img src="lvds_hdmi_cable_photo.jpg" alt="LVDS HDMI Cable Photo">
                                      </div>
                                      <input type="number" class="form-control" id="lvdshdmi" name="lvdshdmi" value="<?php echo isset($_SESSION['data']['lvdshdmi']) ? $_SESSION['data']['lvdshdmi'] : ''; ?>">
                                  </div>
                              </div>
                              <!-- Test Pin, Fixture status -->
                              <div class="row">
                                  <div class="col-md-4 form-group">
                                      <label for="testpin"><i class="fa fa-plug"></i> Test Pin</label>
                                      <div class="item-description">
                                          <p>Enter the test pin.</p>
                                          <img src="test_pin_photo.jpg" alt="Test Pin Photo">
                                      </div>
                                      <input type="number" class="form-control" id="testpin" name="testpin" value="<?php echo isset($_SESSION['data']['testpin']) ? $_SESSION['data']['testpin'] : ''; ?>">
                                  </div>
                                  <div class="col-md-4 form-group">
                                      <label for="fixturestatus"><i class="fa fa-plug"></i>Fixture status</label>
                                      <div class="item-description">
                                          <p>Enter the status of the fixture.</p>
                                          <img src="fixture_status_photo.jpg" alt="Fixture Status Photo">
                                      </div>
                                      <input type="text" class="form-control" id="fixturestatus" name="fixturestatus" value="<?php echo isset($_SESSION['data']['fixturestatus']) ? $_SESSION['data']['fixturestatus'] : ''; ?>">
                                  </div>
                              </div>
                              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                            </form>

                        </div>
                    </div>
                    <hr>
                    <div id="myData"></div>
                </section>
            </div>
            <!-- Scripts -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        </body>
        </html>

    </style>
</head>
<body>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2 class="text-center mb-0"><i class="fa fa-list-alt mr-2"></i> PBA Fixture BOM</h2>
            <img src="logo.jpg" alt="Logo">
        </div>
        <div class="card-body">
            <form id="myDataForm" method="post" action="bomsave.php">
                <!-- Fixture ID -->
                <div class="form-group">
                    <label for="fixtureID">Fixture ID</label>
                    <div class="item-description">
                        <p>Enter the ID of the fixture.</p>
                    </div>
                          <input type="text" class="form-control" id="fixtureID" name="fixtureID" value="<?php echo isset($_SESSION['data']['fixtureID']) ? $_SESSION['data']['fixtureID'] : ''; ?>" required>
                          <button type="submit" class="btn btn-secondary mt-2" id="searchButton" formaction="searchbom.php"><i class="fa fa-search"></i> Search</button>
                      </div>
                      <!-- PCB Code -->
                      <div class="row">
                          <div class="col-md-4 form-group">
                              <label for="pcbcode"><i class="fa fa-plug"></i> PCB Code</label>
                              <div class="item-description">
                                  <p>Enter the code for the PCB.</p>
                                  <img src="logo.jpg" alt="PCB Code Photo">
                              </div>
                              <input type="text" class="form-control" id="pcbcode" name="pcbcode" value="<?php echo isset($_SESSION['data']['pcbcode']) ? $_SESSION['data']['pcbcode'] : ''; ?>">
                          </div>
                          <div class="col-md-4 form-group">
                              <label for="fixturestartdate"><i class="fa fa-plug"></i> Fixture start date</label>
                              <div class="item-description">
                                  <p>Select the start date of the fixture.</p>
                                  <img src="fixture_start_date_photo.jpg" alt="Fixture Start Date Photo">
                              </div>
                              <input type="date" class="form-control" id="" name="fixturestartdate" value="<?php echo isset($_SESSION['data']['fixturestartdate']) ? $_SESSION['data']['fixturestartdate'] : ''; ?>">
                          </div>
                          <div class="col-md-4 form-group">
                              <label for="fixturescrapdate"><i class="fa fa-plug"></i> Fixture Scrap date</label>
                              <div class="item-description">
                                  <p>Select the scrap date of the fixture.</p>
                                  <img src="fixture_scrap_date_photo.jpg" alt="Fixture Scrap Date Photo">
                              </div>
                              <input type="date" class="form-control" id="fixturescrapdate" name="fixturescrapdate" value="<?php echo isset($_SESSION['data']['fixturescrapdate']) ? $_SESSION['data']['fixturescrapdate'] : ''; ?>">
                          </div>
                      </div>
                      <!-- HDMI Gender, HDMI Gender 2, DP Gender -->
                      <div class="row">
                          <div class="col-md-4 form-group">
                              <label for="hdmiGender"><i class="fa fa-plug"></i> HDMI Gender</label>
                              <div class="item-description">
                                  <p>Enter the HDMI gender.</p>
                                  <img src="hdmi_gender_photo.jpg" alt="HDMI Gender Photo">
                              </div>
                              <input type="number" class="form-control" id="hdmiGender" name="hdmiGender" value="<?php echo isset($_SESSION['data']['hdmiGender']) ? $_SESSION['data']['hdmiGender'] : ''; ?>">
                          </div>
                          <div class="col-md-4 form-group">
                              <label for="hdmigender2"><i class="fa fa-plug"></i> HDMI Gender 2</label>
                              <div class="item-description">
                                  <p>Enter the second HDMI gender.</p>
                                  <img src="hdmi_gender_2_photo.jpg" alt="HDMI Gender 2 Photo">
                              </div>
                              <input type="number" class="form-control" id="hdmigender2" name="hdmigender2" value="<?php echo isset($_SESSION['data']['hdmigender2']) ? $_SESSION['data']['hdmigender2'] : ''; ?>">
                          </div>
                          <div class="col-md-4 form-group">
                              <label for="dpGender"><i class="fa fa-plug"></i> DP Gender</label>
                              <div class="item-description">
                                  <p>Enter the DP gender.</p>
                                  <img src="dp_gender_photo.jpg" alt="DP Gender Photo">
                              </div>
                              <input type="number" class="form-control" id="dpGender" name="dpGender" value="<?php echo isset($_SESSION['data']['dpGender']) ? $_SESSION['data']['dpGender'] : ''; ?>">
                          </div>
                      </div>
                      <!-- Satellite Connector, RF Connector, Satellite Cable -->
                      <div class="row">
                          <div class="col-md-4 form-group">
                              <label for="satelliteConnector"><i class="fa fa-plug"></i> Satellite Connector</label>
                              <div class="item-description">
                                  <p>Enter the satellite connector.</p>
                                  <img src="satellite_connector_photo.jpg" alt="Satellite Connector Photo">
                              </div>
                              <input type="number" class="form-control" id="satelliteConnector" name="satelliteConnector" value="<?php echo isset($_SESSION['data']['satelliteConnector']) ? $_SESSION['data']['satelliteConnector'] : ''; ?>">
                          </div>
                          <div class="col-md-4 form-group">
                              <label for="rfConnector"><i class="fa fa-plug"></i> RF Connector</label>
                              <div class="item-description">
                                  <p>Enter the RF connector.</p>
                                  <img src="rf_connector_photo.jpg" alt="RF Connector Photo">
                              </div>
                              <input type="number" class="form-control" id="rfConnector" name="rfConnector" value="<?php echo isset($_SESSION['data']['rfConnector']) ? $_SESSION['data']['rfConnector'] : ''; ?>">
                          </div>
                          <div class="col-md-4 form-group">
                              <label for="satelliteCable"><i class="fa fa-plug"></i> Satellite Cable</label>
                              <div class="item-description">
                                  <p>Enter the satellite cable.</p>
                                  <img src="satellite_cable_photo.jpg" alt="Satellite Cable Photo">
                              </div>
                              <input type="number" class="form-control" id="satelliteCable" name="satelliteCable" value="<?php echo isset($_SESSION['data']['satelliteCable']) ? $_SESSION['data']['satelliteCable'] : ''; ?>">
                          </div>
                      </div>
                      <!-- Raspberry Pi, USB Gender, Memory Card -->
                      <div class="row">
                          <div class="col-md-4 form-group">
                              <label for="raspberryPi"><i class="fa fa-plug"></i> Raspberry PI</label>
                              <div class="item-description">
                                  <p>Enter the Raspberry Pi.</p>
                                  <img src="raspberry_pi_photo.jpg" alt="Raspberry Pi Photo">
                              </div>
                              <input type="number" class="form-control" id="raspberryPi" name="raspberryPi" value="<?php echo isset($_SESSION['data']['raspberryPi']) ? $_SESSION['data']['raspberryPi'] : ''; ?>">
                          </div>
                          <div class="col-md-4 form-group">
                              <label for="usbGender"><i class="fa fa-usb"></i> USB Gender</label>
                              <div class="item-description">
                                  <p>Enter the USB gender.</p>
                                  <img src="usb_gender_photo.jpg" alt="USB Gender Photo">
                              </div>
                              <input type="number" class="form-control" id="usbGender" name="usbGender" value="<?php echo isset($_SESSION['data']['usbGender']) ? $_SESSION['data']['usbGender'] : ''; ?>">
                          </div>
                          <div class="col-md-4 form-group">
                              <label for="memorycard"><i class="fa fa-usb"></i> Memory Card</label>
                              <div class="item-description">
                                  <p>Enter the memory card.</p>
                                  <img src="memory_card_photo.jpg" alt="Memory Card Photo">
                              </div>
                              <input type="number" class="form-control" id="memorycard" name="memorycard" value="<?php echo isset($_SESSION['data']['memorycard']) ? $_SESSION['data']['memorycard'] : ''; ?>">
                          </div>
                      </div>
                      <!-- CAM Ready Card, CAM Ready Gender, CAM Ready Connector -->
                      <div class="row">
                          <div class="col-md-4 form-group">
                              <label for="camreadycard"><i class="fa fa-usb"></i> CAM Ready Card</label>
                              <div class="item-description">
                                  <p>Enter the CAM Ready card.</p>
                                  <img src="cam_ready_card_photo.jpg" alt="CAM Ready Card Photo">
                              </div>
                              <input type="number" class="form-control" id="camreadycard" name="camreadycard" value="<?php echo isset($_SESSION['data']['camreadycard']) ? $_SESSION['data']['camreadycard'] : ''; ?>">
                          </div>
                          <div class="col-md-4 form-group">
                              <label for="camreadygender"><i class="fa fa-usb"></i> CAM Ready Gender</label>
                              <div class="item-description">
                                  <p>Enter the CAM Ready gender.</p>
                                  <img src="cam_ready_gender_photo.jpg" alt="CAM Ready Gender Photo">
                              </div>
                              <input type="number" class="form-control" id="camreadygender" name="camreadygender" value="<?php echo isset($_SESSION['data']['camreadygender']) ? $_SESSION['data']['camreadygender'] : ''; ?>">
                          </div>
                          <div class="col-md-4 form-group">
                              <label for=camreadyconnector><i class="fa fa-plug"></i> CAM Ready Connector</label>
                              <div class="item-description">
                                  <p>Enter the CAM Ready connector.</p>
                                  <img src="cam_ready_connector_photo.jpg" alt="CAM Ready Connector Photo">
                              </div>
                              <input type="number" class="form-control" id="camreadyconnector" name="camreadyconnector" value="<?php echo isset($_SESSION['data']['camreadyconnector']) ? $_SESSION['data']['camreadyconnector'] : ''; ?>">
                          </div>
                      </div>
                      <!-- Interface Board, Fixture Backboard Type, LAN Cable -->
                      <div class="row">
                          <div class="col-md-4 form-group">
                              <label for="interfaceboard"><i class="fa fa-plug"></i> Interface Board</label>
                              <div class="item-description">
                                  <p>Enter the interface board.</p>
                                  <img src="interface_board_photo.jpg" alt="Interface Board Photo">
                              </div>
                              <input type="number" class="form-control" id="interfaceboard" name="interfaceboard" value="<?php echo isset($_SESSION['data']['interfaceboard']) ? $_SESSION['data']['interfaceboard'] : ''; ?>">
                          </div>
                          <div class="col-md-4 form-group">
                              <label for="fixturebackboardtype"><i class="fa fa-usb"></i> Fixture Backboard Type</label>
                              <div class="item-description">
                                  <p>Enter the type of fixture backboard.</p>
                                  <img src="fixture_backboard_type_photo.jpg" alt="Fixture Backboard Type Photo">
                              </div>
                              <input type="text" class="form-control" id="fixturebackboardtype" name="fixturebackboardtype" value="<?php echo isset($_SESSION['data']['fixturebackboardtype']) ? $_SESSION['data']['fixturebackboardtype'] : ''; ?>">
                          </div>
                          <div class="col-md-4 form-group">
                              <label for="lanCable"><i class="fa fa-plug"></i> LAN Cable</label>
                              <div class="item-description">
                                  <p>Enter the LAN cable.</p>
                                  <img src="lan_cable_photo.jpg" alt="LAN Cable Photo">
                              </div>
                              <input type="number" class="form-control" id="lanCable" name="lanCable" value="<?php echo isset($_SESSION['data']['lanCable']) ? $_SESSION['data']['lanCable'] : ''; ?>">
                          </div>
                      </div>
                      <!-- HDMI SST Board, LVDS DP Cable, LVDS HDMI Cable -->
                      <div class="row">
                          <div class="col-md-4 form-group">
                              <label for="hdmisstboard"><i class="fa fa-usb"></i> HDMI SST Board</label>
                              <div class="item-description">
                                  <p>Enter the HDMI SST board.</p>
                                  <img src="hdmi_sst_board_photo.jpg" alt="HDMI SST Board Photo">
                              </div>
                              <input type="number" class="form-control" id="hdmisstboard" name="hdmisstboard" value="<?php echo isset($_SESSION['data']['hdmisstboard']) ? $_SESSION['data']['hdmisstboard'] : ''; ?>">
                          </div>
                          <div class="col-md-4 form-group">
                              <label for="lvdsdp"><i class="fa fa-plug"></i> LVDS DP Cable</label>
                              <div class="item-description">
                                  <p>Enter the LVDS DP cable.</p>
                                  <img src="lvds_dp_cable_photo.jpg" alt="LVDS DP Cable Photo">
                              </div>
                              <input type="number" class="form-control" id="lvdsdp" name="lvdsdp" value="<?php echo isset($_SESSION['data']['lvdsdp']) ? $_SESSION['data']['lvdsdp'] : ''; ?>">
                          </div>
                          <div class="col-md-4 form-group">
                              <label for="lvdshdmi"><i class="fa fa-plug"></i> LVDS HDMI Cable</label>
                              <div class="item-description">
                                  <p>Enter the LVDS HDMI cable.</p>
                                  <img src="lvds_hdmi_cable_photo.jpg" alt="LVDS HDMI Cable Photo">
                              </div>
                              <input type="number" class="form-control" id="lvdshdmi" name="lvdshdmi" value="<?php echo isset($_SESSION['data']['lvdshdmi']) ? $_SESSION['data']['lvdshdmi'] : ''; ?>">
                          </div>
                      </div>
                      <!-- Test Pin, Fixture status -->
                      <div class="row">
                          <div class="col-md-4 form-group">
                              <label for="testpin"><i class="fa fa-plug"></i> Test Pin</label>
                              <div class="item-description">
                                  <p>Enter the test pin.</p>
                                  <img src="test_pin_photo.jpg" alt="Test Pin Photo">
                              </div>
                              <input type="number" class="form-control" id="testpin" name="testpin" value="<?php echo isset($_SESSION['data']['testpin']) ? $_SESSION['data']['testpin'] : ''; ?>">
                          </div>
                          <div class="col-md-4 form-group">
                              <label for="fixturestatus"><i class="fa fa-plug"></i>Fixture status</label>
                              <div class="item-description">
                                  <p>Enter the status of the fixture.</p>
                                  <img src="fixture_status_photo.jpg" alt="Fixture Status Photo">
                              </div>
                              <input type="text" class="form-control" id="fixturestatus" name="fixturestatus" value="<?php echo isset($_SESSION['data']['fixturestatus']) ? $_SESSION['data']['fixturestatus'] : ''; ?>">
                          </div>
                      </div>
                      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                    </form>

                </div>
            </div>
            <hr>
            <div id="myData"></div>
        </section>
    </div>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
