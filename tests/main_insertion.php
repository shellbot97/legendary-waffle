<?php 

	require_once('./data_feeder/Authers.php');
	require_once('./data_feeder/Languages.php');
	require_once('./data_feeder/Locations.php');
	require_once('./data_feeder/Sections.php');
	require_once('./data_feeder/Publishers.php');
	require_once('./data_feeder/Articles.php');

	$Authers = new Authers();
	$Languages = new Languages();
	$Locations = new Locations();
	$Sections = new Sections();
	$Publishers = new Publishers();
	$Articles = new Articles();

	$Authers->insert_data();
	$authers_inserted_data = $Authers->get_data();
	echo "Authers inserted \n";

	$Languages->insert_data();
	$languages_inserted_data = $Languages->get_data();
	echo "Langauges inserted \n";

	$Locations->insert_data();
	$locations_inserted_data = $Locations->get_data();
	echo "Locations inserted \n";
	
	$Sections->insert_data();
	$sections_inserted_data = $Sections->get_data();
	echo "Sections inserted \n";

	$Publishers->insert_data();
	$publishers_inserted_data = $Publishers->get_data();
	echo "Publishers inserted \n";

?>