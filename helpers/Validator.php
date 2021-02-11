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



			foreach ($this->validations[$api_name] as $validation_param_key => $validation_param_value) 
			{

				if (!empty($param[$validation_param_key])) 
				{

					if (!empty($validation_param_value)) 
					{

						$rules = base64_decode($validation_param_value['rules']);

						if (!empty($rules)) 
						{

							if(!preg_match($rules, $param[$validation_param_key]))
							{
								
								$error_set[] = $validation_param_key." needs to be in format.";
							}	
						}
					}

				}else{

					if ($validation_param_value['is_required']) 
					{
						
						$error_set[] = $validation_param_key." is required.";
					}
				}
			}	

			return $error_set;
		}

	}


?>