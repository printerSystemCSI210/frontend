//Controls the maximum number of data sets possible
var colorStrings = ['rgba(40,73,7,1)',
					'rgba(56,37,19,1)',
					'rgba(54,57,66,1)',
					'rgba(216,202,168,1)',
					'rgba(92,131,47,1)'];
var statusLabels = ['OK', 'Working', 'Error'];

/**
 *  Function that creates graphs of printer status data based on the given printer id
 *  params: printId : the printer ID to chart
 *          the canvas elements should have ids of idPrefix.'consumables', idPrefix.'pageCount', and idPrefix.'statusPie'
 *          therefore, if idPrefix is p1, the three ids will be p1.consumables, p1.pageCount, and p1.statusPie
 *  passes the printer name to the callback function
 */
var printerGraphs = function (printId, callback) {
	if (!(String.prototype.contains)) {
		String.prototype.contains = function (str, startIndex) { return -1 !== String.prototype.indexOf.call(this, str, startIndex); };
    }
    var printerName = "";
	$.getJSON('https://forest-api.herokuapp.com/printerGet?printerId=' + printId, null,
		function (data) {
			if (data.error) {
				return;
			}
			printerName = data.name + ' (' + data.location + ')';
			$('#printerInfo').text(printerName);
            $.getJSON('https://forest-api.herokuapp.com/statusList?printerId=' + printId, null,
				function (statusData) {
					var pieData = [0, 0, 0],
                        consumables = [[], [], [], [], []],
                        consumablesLegend = [],
                        dateLabels = [],
                        pageCounts = [],
                        currStatus,
                        timeStamp,
                        lowerCaseStatus,
                        ctx,
                        i,
                        j;
					//Get Data from Statuses & Process It
					for (i = 0; i < statusData.statuses.length; i += 1) {
						currStatus = statusData.statuses[i];
                        timeStamp = currStatus.timeStamp;
						dateLabels[i] = timeStamp.replace('T', ' ').slice(5, -8);
						for (j = 0; j < currStatus.consumables.length; j += 1) {
							consumables[j].push(currStatus.consumables[j].percentage);
							//Get Labels for the consumables only for the first status
							if (i === 0) {
								consumablesLegend.push(currStatus.consumables[j].name);
							}
						}
						pageCounts[i] = currStatus.pageCount;
                        lowerCaseStatus = currStatus.status.toLowerCase();
						if (lowerCaseStatus.contains('idle') || lowerCaseStatus.contains('ready')) {
							pieData[0] += 1;
						} else if (lowerCaseStatus.contains('processing') || lowerCaseStatus.contains('working')) {
							pieData[1] += 1;
						} else {
							pieData[2] += 1;
						}
					}
                    if ($('#consumables').get(0)) {
                        ctx = $('#consumables').get(0).getContext('2d');
                        makeLineGraph(ctx, dateLabels, consumables, consumablesLegend);
                    }
                    if ($('#pageCount').get(0)) {
                        ctx = $('#pageCount').get(0).getContext('2d');
                        makeLineGraph(ctx, dateLabels, [pageCounts], ['Page Count']);
                    }
                    if ($('#statusPie').get(0)) {
                        ctx = $('#statusPie').get(0).getContext('2d');
                        makePieChart(ctx, pieData, statusLabels);
                    }
                    if (typeof callback == 'function') {
                        callback(printerName);
                    }
				});
		});
};

var makeLineGraph = function (context, dataLabels, dataSets, legend) {
	var constructedDataSets = [],
        finalData,
        newChart,
        i;
	for (i = 0; i < dataSets.length && i < colorStrings.length; i += 1) {
		constructedDataSets[i] = {fillColor: 'rgba(0,0,0,0)',
								  strokeColor: colorStrings[i],
								  pointColor: colorStrings[i],
								  pointStrokeColor: 'rgba(0,0,0,0)',
								  data: dataSets[i]};
	}
	finalData = {
		labels : dataLabels,
		datasets : constructedDataSets
	};
	console.log(legend.toString());
	newChart = new Chart(context).Line(finalData, {animation: false});
};

var makePieChart = function (context, data, legend) {
	var finalData = [],
        newChart,
        i;
	for (i = 0; i < data.length && i < colorStrings.length; i += 1) {
		finalData[i] = {value: data[i], color: colorStrings[i]};
	}
	console.log(legend.toString());
	newChart = new Chart(context).Pie(finalData, {animation: false});
};