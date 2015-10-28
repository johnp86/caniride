<?php

class ApiController extends BaseController {

	
	public function postWeather()
	{	
		$weather = new Weather();
		

		if(Input::get('lat') == false) 
		{
			$location = Location::get_by_ip();
			$weather->lat = $location->latitude; 
			$weather->lng = $location->longitude;
		}
		else
		{
			$weather->lat = Input::get('lat'); 
			$weather->lng = Input::get('lng');
		}

		$weather->set_current();
		
		return Response::json($weather);
	}

	public function postLocation()
	{
		$locationStr = Input::get('location');

		$locations = Location::get_by_str($locationStr);

		foreach($locations as $row)
		{
			if(isset($row->address->village))
			{
				$row->address->city = $row->address->village;
			}
			elseif(isset($row->address->town))
			{
				$row->address->city = $row->address->town;
			}
			elseif(!isset($row->address->city) && isset($row->address->county))
			{
				$row->address->city = $row->address->county;
			}
		}

		return Response::json($locations);
	}

	public function postSlack()
	{
		$weather = new Weather();

		$locationStr = Input::get('text');

		$locations = Location::get_by_str($locationStr);

		if(empty($locations)) {
			return "Hmmm, we can't seem to find that place";
		}

		$weather->lat = $locations[0]->lat;
		$weather->lng = $locations[0]->lon;



		$weather->set_current();

		//dd($weather);

		if($weather->ride) {
			return "Hell Yeah it's ride time! Looks like it's " . $weather->temperature . "C and " . $weather->descriptive;
		} else {
			return "Nope, no ride for you. Looks like it's " . $weather->temperature . "C and " . $weather->descriptive;
		}
		
	}

}
