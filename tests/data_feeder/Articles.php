<?php 
	require_once "ParentFeeder.php";

	class Articles extends ParentFeeder
	{
		
		function __construct()
		{
			
			parent::__construct();
			$this->resource_file = __DIR__."/resources/languages.csv";
			$this->table_name = "languages";
		}

		public function insert_data()
		{
			

		}

		public function get_data()
		{

			
		}
	}


?>