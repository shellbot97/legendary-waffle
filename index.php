<?php 

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require_once('./app/AutherController.php');
	require_once('./app/LanguageController.php');
	require_once('./app/LocationController.php');
	require_once('./app/SectionController.php');
	require_once('./app/PublisherController.php');
	require_once('./app/ArticleController.php');
	require_once('./app/LoginController.php');

	$Authers = new AutherController();
	$Languages = new LanguageController();
	$Locations = new LocationController();
	$Sections = new SectionController();
	$Publishers = new PublisherController();
	$Articles = new ArticleController();
	$LoginController = new LoginController();

	$uri = explode('/', $_SERVER['REQUEST_URI']);

	if (strpos(end($uri), '?') !== false) 
	{
		
		$route = explode("?", end($uri))[0];
	}else{

		$route = end($uri);
	}
	
	
	switch ($route) {

		case 'login':
			$LoginController->get_login_infp($_POST);
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

		case 'getActiveArticles':
			$Articles->get_articles();
			break;
		
		default:
			echo "Page does not exist";
			break;
	}

?>