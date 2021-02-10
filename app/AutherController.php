<?php 
	require_once "SecureArea.php";

	class AutherController extends SecureArea
	{
		
		function __construct()
		{

			parent::__construct();
		}


		public function get_authers($params=array())
		{

			$sql = "Select auther_name, url from authers where is_Active = :is_active;";
			$statement = $this->pdo->prepare($sql);
			$statement->execute(array(':is_active' => 1));
			$data = $statement->fetchAll(PDO::FETCH_ASSOC);
			echo  $this->response_helper->give_success_response_by_array($data);
		}
	}


?>