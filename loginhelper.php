<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Forest&trade; Logging In...</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>
<body>
	<?php
        spl_autoload_register ();

        $url = "https://forest-api.herokuapp.com/authenticate?";
        $params = "email=" . $_POST["email"] . "&password=" . $_POST["password"];

        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

        $message = json_decode( curl_exec ($ch) );

        if ( isset($message->error) ) { # If there was an error ?>
            <div class="errorbox">
                <p><?php echo $message->error; ?></p>
                <form><input type="button" value="Back" onClick="history.go(-1);return true;" /></form>
            </div>
            <?php
            //echo $message->error; # Print out the error
// 
//             #Print a go back button
//             $backButton = "<form><input type=\"button\" value=\"Back\" onClick=\"history.go(-1);return true;\"></form>";
//             echo $backButton;
        } else {
            $_SESSION["loggedIn"] = true;
            $_SESSION["userId"] = $message->id;
            $_SESSION["organizations"] = $message->organizations;
            $_SESSION["activeOrganization"] = $message->organizations[0];
            $_SESSION["admin"] = $message->admin;
            $_SESSION["name"] = $message->name;
            $_SESSION["email"] = $message->email;
            header("Location: home.php");
            exit();
        }
	?>
</body>
</html>
