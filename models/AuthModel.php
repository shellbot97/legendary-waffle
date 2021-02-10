<?php 

	require_once "ParentModel.php";

	class AuthModel extends ParentModel
	{
		
		function __construct()
		{

			parent::__construct();
			$this->user_table_name = "users";
			$this->session_table_name = "sessions";
		}

		public function get_active_users_by_username_password($filters=array())
		{

			$query = "select user_id, user_name ";
			$query .= "from $this->user_table_name ";
			$query .= "where ";
			foreach ($filters as $column_name => $column_value) 
			{
			
				$query .= "$column_name = '$column_value' ";
				if (next($filters)) 
				{
					
					$query .= " and ";	
				}
			}
			$query .= ";"; 

			$statement = $this->pdo->prepare($query);
			$statement->execute();
			$data = $statement->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		}

		public function insert_session($user_id)
		{

			$active_session = $this->get_active_session_by_user_id($user_id);
			if (empty($active_session)) 
			{

				$user_data = json_encode(array(
							"user_id" => $user_id
						));

				$session_id = $this->generate_session_token();

				$query = "INSERT INTO sessions (session_token, data, created_at, created_by, updated_at, updated_by, remarks) VALUES (?, ?, now(), ?, now(), ?, NULL); ";

				$result= $this->pdo->prepare($query)->execute([$session_id, $user_data, $user_id, $user_id]);
			}else{

				$session_id = $active_session[0]['session_token'];
			}

			return $session_id;
		}


		public function get_active_session_by_session_id($sesion_id="")
		{

			$query = "select session_token, data ";
			$query .= "from $this->session_table_name ";
			$query .= "where session_token = '$sesion_id'";
			$query .= ";"; 

			$statement = $this->pdo->prepare($query);
			$statement->execute();
			$data = $statement->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		}


		public function get_active_session_by_user_id($user_id="")
		{

			$query = "select session_token, data ";
			$query .= "from $this->session_table_name ";
			$query .= "where created_by = $user_id and is_active = 1";
			$query .= ";"; 

			$statement = $this->pdo->prepare($query);
			$statement->execute();
			$data = $statement->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		}


		function generate_session_token($length = 16) 
		{

		    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $characters_length = strlen($characters);
		    $randomString = '';
		    for ($i = 0; $i < $length; $i++) {
		        $randomString .= $characters[rand(0, $characters_length - 1)];
		    }
		    return $randomString;
		}
	}



?>