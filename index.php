<?php 

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	$uri = explode('/', $_SERVER['REQUEST_URI']);

	if (strpos(end($uri), '?') !== false) 
	{
		
		$route = explode("?", end($uri))[0];
	}else{

		$route = end($uri);
	}
	

	if ($route != 'login') 
	{

		require_once('./app/AutherController.php');
		require_once('./app/LanguageController.php');
		require_once('./app/LocationController.php');
		require_once('./app/SectionController.php');
		require_once('./app/PublisherController.php');
		require_once('./app/ArticleController.php');

		$Authers = new AutherController();
		$Languages = new LanguageController();
		$Locations = new LocationController();
		$Sections = new SectionController();
		$Publishers = new PublisherController();
		$Articles = new ArticleController();

		switch ($route) {

			case 'getArticle':
				$Articles->get_article($_GET);
				break;

			case 'searchArticles':
				$Articles->search_articles($_GET);
				break;

			case 'createArticle':
				$Articles->create_article($_POST);
				break;

			case 'updateArticle':
				$Articles->update_article($_REQUEST);
				break;

			case 'deleteArticle':
				$Articles->delete_article($_REQUEST);
				break;

			case 'getActiveAuthers':
				$Authers->get_authers();
				break;

			case 'getActivePublishers':
				$Publishers->get_publishers();
				break;

			case 'getActiveLanguages':
				$Languages->get_languages();
				break;

			case 'getActiveLocations':
				$Locations->get_locations();
				break;

			case 'getActiveSections':
				$Sections->get_sections();
				break;
			
			default:
				echo "Page does not exist";
				break;
		}
		
	}else{


		require_once('./app/LoginController.php');
	
		$LoginController = new LoginController();

		$LoginController->get_login_infp($_POST);
	}



?>