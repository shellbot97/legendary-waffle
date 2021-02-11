<?php 
	require_once "ParentFeeder.php";

	class Publishers extends ParentFeeder
	{
		
		function __construct()
		{
			
			parent::__construct();
			$this->resource_file = __DIR__."/resources/publishers.csv";
			$this->table_name = "publishers";
		}

		public function insert_data()
		{
			
			$csv_data = $this->get_data_in_csv($this->resource_file);

			foreach ($csv_data as $csv_data_value) 
			{

				$query_column_names = $query_column_values = "";
				$query = "Insert into $this->table_name";

				foreach ($csv_data_value as $column_name => $column_value) 
				{

					if ($column_name != "media") 
					{

						$query_column_names .= " $column_name";
						$query_column_values .= " '$column_value'";

						if (next($csv_data_value)) 
						{

					        $query_column_names .= ", ";
					        $query_column_values .= ", ";
					    }
					}else{

						$media_id = $this->insert_media($column_value);
						$query_column_names .= " media_id";
						$query_column_values .= " $media_id";
					}
				}

				$query .= " ($query_column_names) values ($query_column_values);";

				$res = mysqli_query($this->database_connection , $query);
				echo $query."\n";
			}
		}

		public function get_data()
		{

			$query = "Select publisher_id, publisher_name from publishers where is_active = 1;";
			$data = array();
			$result = mysqli_query($this->database_connection , $query);

			if ($result->num_rows > 0) 
			{

			    while($row = $result->fetch_assoc()) 
			    {

			        $data[] = $row;
			    }
			}
		
			return $data;
		}
	}


?>