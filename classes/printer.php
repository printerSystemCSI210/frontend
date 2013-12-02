<?php

    class Printer {
		    # The url of the api
	        private $apiUrl = "https://forest-api.herokuapp.com/";
	        
	        # Required
			private $name     = "";
			private $ip       = "";
			private $password = "";
			
			# Optional
			private $location     = "";
			private $manufacturer = "";
			private $model        = "";
			private $sn           = "";
			
			# An organization object
			private $organization;

			public function __construct($name, $orgName, $ip,
										$location="", $manufacturer="",
										$model="", $sn="") {
											
			    $this->name         = $name;
			    $this->ip           = $ip;
			    $this->location     = $location;
			    $this->manufacturer = $manufacturer;
			    $this->model        = $model;
			    $this->sn           = $sn;
			    
			    $this->organization = new Organization($orgName);
			}

			# Gets the parameters which can be passed to the api
            # Returns a string which can be appended to the end of a url
			public function getParams() {
			    $url = "";

			    $url .= "organizationId=" . $this->organization->getId();
			    $url .= "&name="          . $this->name;
                            $url .= "&location="      . $this->location;
                            $url .= "&ipAddress="     . $this->ip;
                            $url .= "&manufacturer="  . $this->manufacturer;
                            $url .= "&model="         . $this->model;
                            $url .= "&serial="        . $this->sn;

			    return $url;
			}


		} # End class
?>
