<?php

function fetchUrl($url){

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 20);
 // You may need to add the line below
 // curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);

	$feedData = curl_exec($ch);
	curl_close($ch);

 	return $feedData;

}

$profile_id = "497438503779212";

//App Info, needed for Auth
$app_id = "1966386066922099";
$app_secret = "71985bb10b34c8b3b0c9253f3a876347";

//Retrieve auth token
$authToken = fetchUrl("https://graph.facebook.com/oauth/access_token?grant_type=client_credentials&client_id={$app_id}&client_secret={$app_secret}");

$tokenString = json_decode($authToken)->access_token;

$json_object = fetchUrl("https://graph.facebook.com/{$profile_id}/feed?access_token={$tokenString}&fields=attachments,link,message,full_picture,created_time,name&limit=25");

$feedarray = json_decode($json_object);

$array = array();

foreach ( $feedarray->data as $feed_data )
{
  $tempArray = array();
  $tempArray["message"] = $feed_data->message;
  $tempArray["link"] = html_entity_decode($feed_data->link, ENT_COMPAT, 'UTF-8');
  $tempArray["picture"] = html_entity_decode($feed_data->picture, ENT_COMPAT, 'UTF-8');
  $tempArray["time"] = date("F j, Y", strtotime($feed_data->created_time));
  $tempArray["time_raw"] = strtotime($feed_data->created_time);
  $array[] = $tempArray;
}

echo json_encode($array);
