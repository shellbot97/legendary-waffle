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

	print_r("Logging in...");

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://localhost/interviews/media%5Bdot%5Dnet/index.php/login",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "username=hitest&password=abc456",
	));

	$response = curl_exec($curl);

	curl_close($curl);
	$token_array = json_decode($response, true);

	if (isset($token_array['payload']['session_token']) && !empty($token_array['payload']['session_token'])) 
	{
		$token = $token_array['payload']['session_token'];	
	}else{

		die("Something went wrong!");
	}

	$authers_inserted_data = $Authers->get_data();
	$languages_inserted_data = $Languages->get_data();
	$locations_inserted_data = $Locations->get_data();
	$sections_inserted_data = $Sections->get_data();
	$publishers_inserted_data = $Publishers->get_data();

	print_r($authers_inserted_data);
	$insert_data['auther_id'] = readline('Enter auther id: ');

	print_r($languages_inserted_data);
	$insert_data['language_id'] = readline('Enter language id: ');

	print_r($locations_inserted_data);
	$insert_data['location_id'] = readline('Enter location id: '); 

	print_r($sections_inserted_data);
	$insert_data['section_id'] = readline('Enter section id: '); 

	print_r($publishers_inserted_data);
	$insert_data['publisher_id'] = readline('Enter Publihser id: '); 

	$insert_data['article_image_url'] = readline('Enter Article Image URL: '); 	

	$insert_data['headline'] = readline('Enter headline: ');

	$insert_data['article_url'] = readline('Enter article url: ');

	$insert_data['publish_date'] = readline('Enter Publish date: ');

	$insert_data['content'] = readline('Enter content: ');

	$insert_data['keywords'] = readline('Enter keywords saperated by |: ');

	$curl = curl_init();

	$post_str = "";

	foreach ($insert_data as $insert_key => $insert_value) 
	{

		$post_str .= $insert_key."=".urlencode($insert_value);
		
		if (next($insert_data)) 
		{
			
			$post_str .= "&";
		}
	}

	curl_setopt_array($curl, array(
		CURLOPT_URL => "http://localhost/interviews/media%5Bdot%5Dnet/index.php/createArticle",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => $post_str,
		CURLOPT_HTTPHEADER => array(
		"Auth: $token"
	  ),
	));

	$response = curl_exec($curl);

	$CURL_response['response'] = !empty(json_decode($response, true)) ? json_decode($response, true) : $response;
	$CURL_response['err'] = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	$CURL_response['time'] = curl_getinfo($curl, CURLINFO_TOTAL_TIME);

	curl_close($curl);

	print_r( $CURL_response);

	if (isset($CURL_response['response']['payload']) && !empty($CURL_response['response']['payload'])) 
	{
	
		$article_id = $CURL_response['response']['payload'];
	}else{

		die("something went wrong");
	}


	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://localhost/interviews/media%5Bdot%5Dnet/index.php/getArticle?id='.$article_id,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
		"Auth: $token"
		),
	));

	$response = curl_exec($curl);

	$CURL_response['response'] = !empty(json_decode($response, true)) ? json_decode($response, true) : $response;
	$CURL_response['err'] = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	$CURL_response['time'] = curl_getinfo($curl, CURLINFO_TOTAL_TIME);

	curl_close($curl);

	if (isset($CURL_response['response']['payload']['headline']) && !empty($CURL_response['response']['payload']['headline'])) 
	{
	
		$headline = $CURL_response['response']['payload']['headline'];
	}else{

		die("Something went wrong");
	}

	if ($headline != $insert_data['headline']) 
	{

		print_r("Failed at "); die('at line '.__LINE__);
	}

	$updated_headline = "updated article";

	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://localhost/interviews/media%5Bdot%5Dnet/index.php/updateArticle?id=1',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'PUT',
		CURLOPT_POSTFIELDS =>"{
			'headline': $updated_headline
		}",
		CURLOPT_HTTPHEADER => array(
		"Auth: $token",
		'Content-Type: text/plain'
		),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	echo $response;



?>