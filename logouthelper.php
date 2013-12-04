<?php
unset($_SESSION["loggedIn"]);
unset($_SESSION["userId"]);
unset($_SESSION["organizations"]);
unset($_SESSION["activeOrganization"]);
unset($_SESSION["admin"]);
unset($_SESSION["name"]);
unset($_SESSION["email"]);
session_destroy();
header("Location: login.php");
exit();
?>