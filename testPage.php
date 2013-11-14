<!DOCTYPE html>
<!--
Michael Borowsky
11/13/13

Sample php program. Gets a list of the organizations in the database in JSON,
and prints out their id's

This program will be hosted at: http://mathcs.muhlenberg.edu/~mb247142/forest/frontend/testpage.php
-->

<head>
<title>Test Page</title>
</head>
<body>
	<?php
	$url="http://forest-api.herokuapp.com/api/organizations";
	$json = file_get_contents($url);
	$organizations = json_decode($json);
	#var_dump($organizations);
	
	echo '<h3>Organizations</h3><br>';
	foreach ($organizations->organizations as $org)
	{
		echo '<b>' . $org->name . '</b><br>';
		echo 'id: ' . $org->id;
		echo '<br><br>';
	}
	?>
</body>
</html>
