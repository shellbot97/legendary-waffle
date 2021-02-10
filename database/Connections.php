<?php
  
    /**
     * This class is dedicated for a database connections
     */
    class Connections
    {
        
        protected $database_connection;

        function __construct()
        {

            $ini_array = parse_ini_file("../envs/local.ini");

            $server = $ini_array["server"];
            $username = $ini_array["username"];
            $password = $ini_array["password"];
            $database = $ini_array["database"];

            // Create A Connection
            $this->database_connection = mysqLi_connect($server, $username, $password, $database);

             // Check For Connection
             if(!$this->database_connection){
                die ("Connection Terminated! Errors:". mysqLi_connect_error());
               
            }
        }
    }


?>