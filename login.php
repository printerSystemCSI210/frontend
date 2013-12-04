<?php
if(isset($_SESSION)) {
    session_destroy();
}
session_start();
//Start a clean session
unset($_SESSION["loggedIn"]);
unset($_SESSION["userId"]);
unset($_SESSION["organizations"]);
unset($_SESSION["activeOrganization"]);
unset($_SESSION["admin"]);
unset($_SESSION["name"]);
unset($_SESSION["email"]);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Forest&trade; Login</title>
    <meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="stylesheet.css">

	<script language="JavaScript" type="text/javascript">
    	function forgot() {
    		alert("Oh well!");
    	}
 	</script>
</head>

<body>
	<div class="icon">
      <img src="websiteIcon.png" alt="Forest icon">
  	</div>


  	<div class="infobox">
	<h1>Login to Forest</h1>
	<form name="login" action="loginhelper.php" method="post">
	    <p>Email<br/><input name="email" type="email" size="20"/><p>
	    <p>Password<br/><input name="password" type="password" size="20"/></p>
    	<p><input type="submit" name="submit" value="Sign In" /></p>
	</form>
	<br />
	<p> New? Click <a href="registeruser.php">here</a> to create a new account. </p>
	<p> Forgot your username or password? Click <a href="javascript:forgot();">here</a>.</p>
	</div> 
	<br/><br/>
</body>
</html>