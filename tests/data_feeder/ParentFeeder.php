<?php 

	require_once "../database/Connections.php";

	class ParentFeeder extends Connections
	{
		
		function __construct()
		{
			
			parent::__construct();
		}

		protected function get_data_in_csv($file_location='')
		{

			$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv', 'application/octet-stream');
			$data = array();
			$headers = array();
			$column_header = 1;
			

			if (!empty($file_location) && filesize($file_location) != 0) 
			{
			
				if (($handle = fopen($file_location, "r")) !== FALSE)
				{
				
					while (($getData = fgetcsv($handle, 10000, ",")) !== FALSE)
		            {

		            	$column_count = 0;
		                
		                //this will validate if the file is empty
		                if (!empty($getData[1])) 
		                {

		                	$temp = array();

		                	//this will validate if the current row is headers
		                    if($column_header == 1)
		                    { 

		                    	for ($i=0; $i < 10; $i++) 
		                    	{ 
		                    		if (isset($getData[$i]) && !empty($getData[$i])) 
		                    		{
		                    		
		                    			$headers[] = $getData[$i];
		                    		}
		                    	}

		                    	$column_header++; 
		                    	continue; 
		                    }  

		                	foreach ($headers as $headers_value) 
		                	{
		                		
		                		$temp[$headers_value] = $getData[$column_count];
		                		$column_count++;
		                	}

		                	$data[] = $temp;

		                }else{

		                    $data[] = "Please upload files with minimum 1 record";
		                }
		            }	
				}else{

					$data[] = "error accessing the file";
				}
			}else{

				$data[] = "Invalid Files";
			}

			return $data;
		}


		protected function insert_media($media_json="")
		{

			$result = 0;
			$media_array = json_decode(str_replace("'", "", $media_json), true);
			
			$query = "Insert into media (media_type, source, extra_params) values (";
			$query .= "'".$media_array['type']."', '";
			$query .= $media_array['url']."', '";
			$query .= json_encode($media_array['extra_params'])."');";

			if (mysqli_query($this->database_connection , $query) === TRUE) 
			{

				$result = $this->database_connection->insert_id;
			} 

			return $result;
		}
	}


?>