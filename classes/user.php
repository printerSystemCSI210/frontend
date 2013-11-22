<?php

    /*
     * TODO:
     *    error checking
     */

    class User {
		    # The url of the api
	        private $apiUrl = "https://forest-api.herokuapp.com/";

			private $name     = "";
			private $email    = "";
			private $org      = "";
			private $orgId    = "";
			private $password = "";
			private $admin    = False;

			public function __construct($name, $email, $org,
			                              $password, $admin=False) {
			    $this->name     = $name;
			    $this->email    = $email;
			    $this->org      = $org;
			    $this->orgId    = $this->getOrgId($org);
			    $this->password = $password;
			    $this->admin    = $admin;
			}

			# Gets the parameters which can be passed to the api
            # Returns a string which can be appended to the end of a url
			public function getParams() {
			    $url = "";

			    $url .= "organizationId=" . $this->orgId;
			    $url .= "&name="     . $this->name;
			    $url .= "&email="    . $this->email;
			    $url .= "&password=" . $this->password;

			    # Get the string representation of admin
			    $adminString = $this->admin ? "true" : "false";
			    $url .= "&admin=" . $adminString;

			    return $url;
			}

			# Gets the ID for a given organization
			private function getOrgId($orgName) {
			    # Get the list of organizations from the api
                $url = "https://forest-api.herokuapp.com/organizationList";
                $json = file_get_contents($url);

	            $organizations = json_decode($json); # Decode the json
	            $orgs = $organizations->organizations;

                # Search for the organization
                foreach ($orgs as $org) {
                    if ($org->name == $orgName) # If the organization is found
	                    return $org->id; # Return the id
	            }

	            return null;# If the organization isn't found, return null
			}


		} # End class
?>
