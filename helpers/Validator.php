<?php 

	class Validator
	{

		function __construct()
		{

			$this->validations = json_decode(file_get_contents(__DIR__."/../envs/field_validations.json"), true);
		}
		
		public function validate_fields($api_name = "", $param=array())
		{

			$error_set = array();

			if(!empty($this->validations[$api_name]))
			{

				foreach ($param as $param_key => $param_value) 
				{
					
					if (!empty($this->validations[$api_name][$param_key])) 
					{
						
						$rules = base64_decode($this->validations[$api_name][$param_key]['rules']);

						if(!preg_match($rules, $param_value))
						{
							
							$error_set[] = $param_key." needs to be in format.";
						}
					}
					
				}	
			}

			return $error_set;
		}

	}


?>