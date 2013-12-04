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
  <title>About - Forest&trade;</title>
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
  
	<p>Information about us goes here!</p>
</div>
</body>
</html>