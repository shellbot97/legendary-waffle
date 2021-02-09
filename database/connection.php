<?php
  

    $ini_array = parse_ini_file("../envs/local.ini");

    $server = $ini_array["server"];
    $username = $ini_array["username"];
    $password = $ini_array["password"];
    $database = $ini_array["database"];

    // Create A Connection
    $con = mysqLi_connect($server, $username, $password, $database);

     // Check For Connection
     if(!$con){
        die ("Connection Terminated! Errors:". mysqLi_connect_error());
       
    }
    else {
        echo "Connected Succefully! \n";
    }


    ?>