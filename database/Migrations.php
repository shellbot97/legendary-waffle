<?php 
	
	/**
	 * This class is dedicated for migrations of db
	 * 1. creating the initial schema
	 * 2. Any ddl commands  
	 */
	
	require_once "Connections.php";

	class Migrations extends Connections
	{
		
		function __construct()
		{

			parent::__construct();

			$files_array = array();

			if ($handle = opendir('.')) 
			{

			    while (false !== ($entry = readdir($handle))) 
			    {

			        if ($entry != "." && $entry != ".." && $entry != "migrations.php" && strpos($entry, 'executed') === false && strpos($entry, '.sql') !== false) {

			            $files_array[] = $entry;
			        }
			    }

			    closedir($handle);

			    sort($files_array);

			    foreach ($files_array as $file_name) 
			    {


			        $query = file_get_contents($file_name);
			        
			        mysqli_query($this->database_connection , $query);

			        echo $query."\n";

			        rename("$file_name","executed-".date('Ymd')."-".$file_name);
			    }

			}

		}
	}


	// Driver code
	$Migrations = new Migrations();

?>