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
  <title>Forest&trade;</title>
  <meta charset="utf-8" />

  <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  
  <script type="text/javascript" src="scripts/jquery.tablesorter.min.js"></script>
  <script type="text/javascript" src="scripts/forestCharts.js"></script>
  <script type="text/javascript" src="scripts/Chart.min.js"></script>
  
  <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="stylesheet.css">

  <script type="text/javascript">
  $(document).ready(function() {
    $("#homeTable").tablesorter({
      sortList: [[1,0]]
    });
    $( "#chart-modal" ).dialog({
      height: 600,
      width: 850,
      modal: true,
      autoOpen: false
    });
  });
  
  function openModal(printerId) {
    if(!printerId) {
      printerId = "5283b32024e02d0200000002";
    }
    var titleInfo = printerGraphs(printerId, function (titleInfo) {
        $("#chart-modal").dialog("option", "title", titleInfo + " - Status Graphs");
        $("#chart-modal").dialog("open");
    });
  }
  </script>
</head>
  
<body>
  <div id="userInfo">
    <?php echo $_SESSION["name"]; ?> | <a href="logouthelper.php">Logout</a>
  </div>
  <div id="chart-modal">
    <h4>Consumables:</h4>
    <canvas class="graph" id="consumables" width="800" height="400"></canvas>
    <ul class="legend" id="consumables.legend"></ul>
    <h4>Page Count:</h4>
    <canvas class="graph" id="pageCount" width="800" height="400"></canvas>
    <ul class="legend" id="pageCount.legend"></ul>
    <h4>Status:</h4>
    <canvas class="graph" id="statusPie" width="400" height="400"></canvas>
    <ul class="legend" id="statusPie.legend"></ul>
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
	<p>Welcome to Forest, the printer status checker.  Here is where you will be able to access options and be able to check the status of printers.</p>

  <table id="homeTable" class="tablesorter">
    <thead>
      <tr>
          <th>Status</th>
          <th>Name</th>
          <th>IP Address</th>
          <th>Alert</th>
          <th>Make</th>
          <th>Paper level</th>
          <th>Ink level</th>
          <th class="{sorter: false}"><img src="chart.png" alt="Chart icon"></th>
      </tr>
    </thead>
    <tbody>
      <tr>
          <td>Idle</td>
          <td>Trumbower 48</td>
          <td>192.168.130.238</td>
          <td></td>
          <td>HP LaserJet P4010 Series</td>
          <td>Low</td>
          <td>Good</td>
          <td><a class="grapher" onclick="openModal();" style="cursor:pointer;"><img src="chart.png" alt="Chart icon"></a></td>
      </tr>
      <tr>
          <td>Off</td>
          <td>Shankwieler Lab</td>
          <td>192.168.130.287</td>
          <td>Bad</td>
          <td>HP LaserJet P4010 Series</td>
          <td>None</td>
          <td>None</td>
          <td><a class="grapher" onclick="openModal();" style="cursor:pointer;"><img src="chart.png" alt="Chart icon"></a></td>
      </tr>
    </tbody>
</table>
</div>
</body>
</html>
