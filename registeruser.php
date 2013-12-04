<?php
    $url = "https://forest-api.herokuapp.com/organizationList";
    $params = "";

    $ch = curl_init( $url );
    curl_setopt( $ch, CURLOPT_POST, 1);
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt( $ch, CURLOPT_HEADER, 0);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
    
    $message = json_decode( curl_exec ($ch) );
?>
<!DOCTYPE html>
<html>
<head>
  <title>Create account - Forest&trade;</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
	<div class="icon">
      <img src="websiteIcon.png" alt="Forest icon">
    </div>
    <div class="infobox">
      <h1>Welcome to Forest.</h1>
      <p> Please fill in the below information. </p>

	<form name='register' action='register.php' method='post'>
	<h2>Register</h2>

	<!--<input type='hidden' name='submitted' id='submitted' value='1'/>-->

	<p>First Name: <input type="text" name="firstName" id="firstName" maxlength="50"></p>
	<p>Last Name: <input type="text" name="lastName" id="lastName" maxlength="50"></p>
	<p>Email Address: <input type="email" name="email" id="email" maxlength="50"></p>
	<p>Organization: <select name="organization">
	    <?php
	        $orgs = $message->organizations;
	        foreach($orgs as $org)
	        {
	            $orgName = $org->name;
	            echo "<option value=\"$orgName\">$orgName</option>";
	        }
	    ?>
	    </select>
	</p>
	<p>Password: <input type="password" name="password" maxlength="50"> </p>

	<p><input type='submit' name='Submit' value='Register' /></p>

 	</form>
 	<p>Already have a Forest account? <a href="login.php">Login here</a>.</p>
    </div>
</body>
</html>
