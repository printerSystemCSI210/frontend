<?php

    class User {
		    # The url of the api
	        private $apiUrl = "https://forest-api.herokuapp.com/";
	        
			private $name     = "";
			private $email    = "";
			private $password = "";
			private $admin    = False;
			
			# An organization object
			private $organization;

			public function __construct($name, $email, $orgName,
			                            $password, $admin=False) {
			    $this->name     = $name;
			    $this->email    = $email;
			    $this->orgName  = $orgName;
			    $this->password = $password;
			    $this->admin    = $admin;
			    
			    $this->organization = new Organization($orgName);
			}

			# Gets the parameters which can be passed to the api
            # Returns a string which can be appended to the end of a url
			public function getParams() {
			    $url = "";

			    $url .= "organizationId=" . $this->organization->getId();
			    $url .= "&name="     . $this->name;
			    $url .= "&email="    . $this->email;
			    $url .= "&password=" . $this->password;

			    # Get the string representation of admin
			    $adminString = $this->admin ? "true" : "false";
			    $url .= "&admin=" . $adminString;

			    return $url;
			}


		} # End class
?>
