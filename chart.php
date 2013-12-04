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
		<title>Chart - Forest&trade;</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        
		<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="scripts/Chart.min.js" type="text/javascript"></script>
        <script src="scripts/forestCharts.js" type="text/javascript"></script>
		<script type="text/javascript">
            window.onload = function () {
				var organizationId = "527add43c1781f0200000001";
				$.getJSON("https://forest-api.herokuapp.com/printerList?organizationId=" + organizationId, null,
					function (data) {
						var printerId = data.printers[0].id;
						printerGraphs(printerId, function(name){
                          $("#printerInfo").text(name);
                        });
					});
            }
		</script>
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

		<h1 id="printerInfo"></h1>
		<h3>Consumables:</h3>
		<canvas class="graph" id="consumables" width="800" height="400"></canvas>
        <ul class="legend" id="consumables.legend"></ul>
		<h3>Page Count:</h3>
		<canvas class="graph" id="pageCount" width="800" height="400"></canvas>
        <ul class="legend" id="pageCount.legend"></ul>
        <h3>Status:</h3>
        <canvas class="graph" id="statusPie" width="400" height="400"></canvas>
        <ul class="legend" id="statusPie.legend"></ul>
</div>
	</body>
</html>