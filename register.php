<!DOCTYPE html>
<html>
<body>

	<?php
	    # Load classes from ./classes folder
        set_include_path ( "./classes" );
        spl_autoload_register ();

        $user = new User ($_POST["firstName"] . " " . $_POST["lastName"],
                           $_POST["email"],
                           $_POST["organization"],
                           $_POST["username"],
                           $_POST["password"]);


        $url = "https://forest-api.herokuapp.com/userCreate?";
        $params = $user->getParams();

        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

        echo curl_exec( $ch );
	?>
</body>
</html>