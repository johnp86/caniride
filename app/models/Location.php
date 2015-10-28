<?php

class Location {


	public static function get_by_ip()
	{
		$curl = new anlutro\cURL\cURL;
		$response = json_decode($curl->get('http://freegeoip.net/json/'.$_SERVER['REMOTE_ADDR']));

		return $response;
	}

	public static function get_by_str($str)
	{
		$curl = new anlutro\cURL\cURL;
		$response = json_decode($curl->get('http://nominatim.openstreetmap.org/search?accept-language=en-gb&addressdetails=1&limit=4&format=json&q='.urlencode($str)));

		return $response;
	}

}
