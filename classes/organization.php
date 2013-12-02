<?php
    class Organization {
			private $name     = "";
			private $orgId    = "";

			public function __construct($name) {
			    $this->name     = $name;
			    $this->orgId    = $this->getOrgId($name);
			}

			# Gets the ID for a given organization
			public static function getOrgId($orgName) {
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

	            return null; # If the organization isn't found, return null
			}
			
			# Gets the ID for the organization
			public function getId() {
				return $this->orgId;
			}


		} # End class
?>
