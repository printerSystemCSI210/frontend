<!DOCTYPE html>
<head>
  <title>Confirm account - Forest&trade;</title>
  <link rel="stylesheet" href="stylesheet.css">  
</head>
<body>
      <h1>Welcome to Forest.</h1>
      <p> Please fill in the below information. </p>

	<h2>Register</h2>

	<p>First Name: <span> <?php echo $_POST["firstName"]; ?> </span> </p>
	<p>Last Name: <span> <?php echo $_POST["lastName"]; ?> </span> </p>
	<p>Email Adress: <span> <?php echo $_POST["email"]; ?> </span> </p>
	<p>Organization: <span> <?php echo $_POST["organization"]; ?> </span> </p>
	<p>Select one: <span> <?php echo $_POST["position"]; ?> </span> </p>
	<p>Username: <span> <?php echo $_POST["username"]; ?> </span> </p>
	<p>Password: <span> <?php echo $_POST["password"]; ?> </span> </p>

</body>
</html>