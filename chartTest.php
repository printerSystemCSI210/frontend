<!DOCTYPE>
<html>
	<head>
		<title>Chart Test</title>
		<script src="chartjs/Chart.js" type="text/javascript"></script>
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script type="text/javascript">
			//Controls the maximum number of data sets possible
			var colorStrings = ["rgba(40,73,7,1)",
								"rgba(56,37,19,1)",
								"rgba(54,57,66,1)",
								"rgba(216,202,168,1)",
								"rgba(92,131,47,1)"];
			window.onload = function() {
				var organizationId =  "527add43c1781f0200000001";
				var printerId = "";
				$.getJSON("https://forest-api.herokuapp.com/printerList?organizationId=" + organizationId, null,
					function (data) {
						printerId = data.printers[0].id;
						printerName = data.printers[0].name + " (" + data.printers[0].location + ")";
						console.log(printerName);
						$("#printerInfo").text(printerName);
						$.getJSON("https://forest-api.herokuapp.com/statusList?printerId=" + printerId, null,
							function (data){
								var consumables = [[],[],[],[]];
								var dateLabels = [];
								var pageCounts = [];
								//Get Data & Process
								for(i = 0; i<data.statuses.length; i++)
								{
									var currStatus = data.statuses[i];
									var timeStamp = currStatus.timeStamp;
									dateLabels[i] = timeStamp.replace("T", " ").slice(5, -8);
									for(j = 0; j<currStatus.consumables.length; j++)
									{
										consumables[j].push(currStatus.consumables[j].percentage);
									}
									pageCounts[i] = currStatus.pageCount;
								}
								var ctx = $("#consumables").get(0).getContext("2d");
								makeLineGraph(ctx, dateLabels, consumables);
								ctx = $("#pageCount").get(0).getContext("2d");
								makeLineGraph(ctx, dateLabels, [pageCounts]);
							}
						);
					}
				);
			}
			var makeLineGraph = function (context, dataLabels, dataSets) {
				var constructedDataSets = [];
				for(i = 0; i<dataSets.length && i<colorStrings.length; i++)
				{
					constructedDataSets[i] = {fillColor: "rgba(0,0,0,0)",
											  strokeColor: colorStrings[i],
											  pointColor: colorStrings[i],
											  pointStrokeColor: "rgba(0,0,0,0)",
											  data: dataSets[i]};
				}
				var cartridgeData = {
					labels : dataLabels,
					datasets : constructedDataSets
				};
				var newChart = new Chart(context).Line(cartridgeData, {animation: false});
			};
		</script>
	</head>
	<body>
		<h1 id="printerInfo"></h1>
		<h3>Consumables:</h3>
		<canvas id="consumables" width="800" height="400"></canvas>
		<h3>Page Count:</h3>
		<canvas id="pageCount" width="800" height="400"></canvas>
	</body>
</html>