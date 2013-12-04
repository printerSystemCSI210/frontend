<!DOCTYPE html>
<html>
    <head>
        <title>Forest&trade; Creating Account</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>
    <body>

        <?php
            # Load classes from ./classes folder
            set_include_path ( "./classes" );
            spl_autoload_register ();

            $user = new User ($_POST["firstName"] . " " . $_POST["lastName"],
                               $_POST["email"],
                               $_POST["organization"],
                               $_POST["password"]);


            $url = "https://forest-api.herokuapp.com/userCreate?";
            $params = $user->getParams();

            $ch = curl_init( $url );
            curl_setopt( $ch, CURLOPT_POST, 1);
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt( $ch, CURLOPT_HEADER, 0);
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

            $message = json_decode( curl_exec ($ch) );


            if ( isset($message->error) ) {  # If there was an error ?>
            <div class="errorbox">
                <p><?php echo $message->error; ?></p>
                <form><input type="button" value="Back" onclick="history.go(-1);return true;" /></form>
            </div>
            <?php
            } else { ?>
            <div class="infobox">
                <p>Welcome to Forest, <?php echo $message->name; ?>!</p>
                <p><a href="login.php">Login to Forest</a></p>
            </div>
                <?php
            }
        ?>
    </body>
</html>
