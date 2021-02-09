<?php 
	
	/**
	 * This file is dedicated for migrations of db
	 * 1. creating the initial schema
	 * 2. Any ddl commands  
	 */
	
	include("connection.php");

	if ($handle = opendir('.')) {

	    while (false !== ($entry = readdir($handle))) 
	    {

	        if ($entry != "." && $entry != ".." && $entry != "migrations.php" && strpos($entry, 'executed') === false && strpos($entry, '.sql') !== false) {

	        	echo "Executing $entry\n";

	        	$query = file_get_contents($entry);
	        	
	        	mysqli_query($con , $query);

	        	echo $query."\n";

	        	rename("$entry","executed-".date('Ymd')."-".$entry);
	        }
	    }

	    closedir($handle);
	}

?>