<!DOCTYPE html>
<html>
<body>

	<?php
	# Load classes from ./classes folder
        set_include_path ( "./classes" );
        spl_autoload_register ();

        $printer = new Printer ($_POST["printerName"],
	                        $_POST["organization"],
                                $_POST["ip"],
			        $_POST["location"],
			        $_POST["manufacturer"],
			        $_POST["model"],
				$_POST["serial"]);


        $url = "https://forest-api.herokuapp.com/printerCreate?";
        $params = $printer->getParams();

        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

        $message = json_decode( curl_exec ($ch) );

        if ( isset($message->error) ) { # If there was an error
            echo $message->error; # Print out the error

            #Print a go back button
            $backButton = "<FORM><INPUT Type=\"button\" VALUE=\"Back\" onClick=\"history.go(-1);return true;\"></FORM>";
            echo $backButton;
        } else {
            echo "The printer, " . $message->name . ", was successfully added.";
        }
	?>
</body>
</html>
