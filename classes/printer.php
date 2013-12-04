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
    private $model        = "";
    private $sn           = "";
    
    # ID- only valid for printers which have been accessed from the database
    private $id = "";

    # An organization object
    private $organization;

    # Constructor
    public function __construct( $name, $orgName, $ip, $location="",
                                 $model="", $sn="" ) {
        
        $this->name         = $name;
        $this->ip           = $ip;
        $this->location     = $location;
        $this->model        = $model;
        $this->sn           = $sn;
         
        $this->organization = new Organization( $orgName );
    }
    
    # Constructor which only takes and id and sets all of the other values
    # Because php does not allow overloading, this function returns an object
    # Can be called to initialize an object by calling "$printer = Printer::contrcut_ID( id );"
    public static function construct_ID( $id ) {
        # Url to get the printer
        $url =  "https://forest-api.herokuapp.com/printerGet?printerId=";
        $url .= $id; # Pass the printer's ID to the url
        
        $json = file_get_contents($url); # Get the json from the api
        $printer = json_decode($json);   # Decode the json

        # If the printer was found
        if ( isset($printer) ) {
            $newPrinter = new Printer( $printer->name, $printer->orgName,
                                       $printer->ip, $printer->location,
                                       $printer->model, $printer->serial );
            $printer->setID( $id );
            
            return $printer;
        } else {
            echo "Printer not found";
            return null;
        }


    }

    public function setID( $id ) {
        $this->id = $id;
    }

    # Gets the parameters which can be passed to the api
    # Returns a string which can be appended to the end of a url
    public function getParams() {
        $url = "";

        $url .= "organizationId=" . $this->organization->getId();
        $url .= "&name="          . $this->name;
        $url .= "&ipAddress="     . $this->ip;

        # Optional parameters
        if ( $this->location != "" )
            $url .= "&location=" . $this->location;
        
        if ( $this->manufacturer != "" )
            $url .= "&manufacturer=" . $this->manufacturer;
    
        if ( $this->model != "" )
            $url .= "&model=" . $this->model;
    
        if ( $this->sn != "" )
            $url .= "&serial=" . $this->sn;

        return $url;
    }


#------------------------------------------------------------------------------
# Static Methods
#------------------------------------------------------------------------------
    # Returns an array of consumables for the printer with a given id
    public static function getConsumables( $id ) {
        return null;
    }


} # End class
?>
