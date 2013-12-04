<?php
session_start();
if(!isset($_SESSION['loggedIn']) || !isset($_SESSION['userId'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Add Printer - Forest&trade;</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
  <div id="userInfo">
    <?php echo $_SESSION["name"]; ?> | <a href="logouthelper.php">Logout</a>
  </div>

  <div class="top">
  <div class="icon">
    <a href="home.php">
      <img src="websiteIcon.png" alt="Forest icon">
    </a>
  </div>

  <!-- NAVIGATION BAR -->
  <div class="navigate">
  <ul>
  <li><a href="home.php">Home</a></li>
  <li><a href="chart.php">Data</a></li>
  <li><a href="#add">Add</a>
    <ul>
      <li><a href="addprinter.php">Printer</a></li>
      <li><a href="registeruser.php">User</a></li>
    </ul>
  </li>
  <li><a href="#MyForst">Manage</a>
    <ul>
        <li><a href="#preferences">Preferences</a></li>
    </ul>
  </li>
  <li><a href="report.php">Report</a></li>
  <li><a href="about.php">About</a></li>
  </ul>
  </div>
</div>

<div class="innerbox">  

<form name='addPrinter' action='add_printer.php' method='post'>

  <h3> Fill in required information to add a printer.</h3>
  <p>Printer: <input type="text" name="printerName" id="name" maxlength="50"></p>
  <p>Organization: <input type="text" name="organization" id="organization" maxlength="100"></p>
  <p>IP Address: <input type="text" name="ip" id="ip" maxlength="50"></p>

  <h3>Optional information:</h3>
  <p>Location: <input type="text" name="location" id="location" maxlength="50"> </p>
  <p>Manufacturer: <input type="text" name="manufacturer" id="manufacturer" maxlength="50"> </p>
  <p>Model: <input type="text" name="model" id="model" maxlength="50"> </p>
  <p>Serial number: <input type="text" name="serial" id="serial" maxlength="50"> </p>

  <p><input type='submit' name='Add' value='Add' /></p>
</form>

</div>
</body>
</html>
