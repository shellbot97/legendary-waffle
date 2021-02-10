<?php 

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require_once('./app/AutherController.php');
	// require_once('./app/LanguageController.php');
	// require_once('./app/LocationController.php');
	// require_once('./app/SectionController.php');
	// require_once('./app/PublisherController.php');
	// require_once('./app/ArticleController.php');

	$Authers = new AutherController();
	// $Languages = new LanguageController();
	// $Locations = new LocationController();
	// $Sections = new SectionController();
	// $Publishers = new PublisherController();
	// $Articles = new ArticleController();


	$uri = explode('/', $_SERVER['REQUEST_URI']);
	$route = end($uri);

	switch ($route) {
		case 'getActiveAuthers':
			$Authers->get_authers($_REQUEST);
			break;

		case 'getActivePublishers':
			# code...
			break;

		case 'getActiveLanguages':
			# code...
			break;

		case 'getActiveLocations':
			# code...
			break;

		case 'getActiveSections':
			# code...
			break;

		case 'getActiveArticles':
			# code...
			break;
		
		default:
			echo "Page does not exist";
			break;
	}

?>