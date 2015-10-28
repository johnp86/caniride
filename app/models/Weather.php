<?php

class Weather {

	public $lat;
	public $lng;
	public $windspeed;
	public $temperature;
	public $weather;
	public $weather_detailed;


	public function set_current()
	{
		$curl = new anlutro\cURL\cURL;
		$response = json_decode($curl->get('http://api.openweathermap.org/data/2.5/weather?units=metric&lat='.$this->lat.'&lon='.$this->lng.'&APPID=6cfd180eeb2bd61dbaf2be616d347544')->body);
		$this->windspeed 		= $response->wind->speed;
		$this->temperature 		= number_format($response->main->temp);
		$this->ride	= false;
		$this->weather_detailed = $response->weather[0]->description;
		$this->location = $response->name;

		$rideweather = false;

		switch (strtolower($response->weather[0]->description)) {
			case 'thunderstorm with light rain':
			case 'thunderstorm with rain':
			case 'thunderstorm with heavy rain':
			case 'light thunderstorm':
			case 'thunderstorm':
			case 'heavy thunderstorm':
			case 'ragged thunderstorm':
			case 'thunderstorm with light drizzle':
			case 'thunderstorm with drizzle':
			case 'thunderstorm with heavy drizzle':
			case 'moderate rain';
			case 'heavy intensity rain';
			case 'very heavy rain';
			case 'extreme rain';
			case 'freezing rain';
			case 'shower rain';
			case 'heavy intensity shower rain';
			case 'ragged shower rain';	 
			case 'light snow':
			case 'snow':
			case 'heavy snow':
			case 'sleet':
			case 'shower sleet':
			case 'light rain and snow':
			case 'rain and snow':
			case 'light shower snow':
			case 'shower snow':
			case 'heavy shower snow':
			case 'tornado':
			case 'tropical storm':
			case 'hurricane':
			case 'sand/Dust Whirls':
			case 'fog':
			case 'sand':
			case 'dust':
			case 'VOLCANIC ASH':
			case 'SQUALLS':
			case 'TORNADO':
			case 'windy':
			case 'hail':
			case 'drizzle':
			case 'heavy intensity drizzle':
			case 'drizzle rain':
			case 'heavy intensity drizzle rain':
			case 'shower rain and drizzle':
			case 'heavy shower rain and drizzle':
			case 'shower drizzle':
			case 'light intensity drizzle rain':
			case 'light intensity drizzle':
			case 'light intensity shower rain';
			case 'light rain';
				 $this->weather = 'bad';
				 $this->descriptive = 'bad';
				 $rideweather = 'bad';
				 break;


			case 'sky is clear':
			case 'few clouds':
			case 'scattered clouds':
			case 'broken clouds';
			case 'overcast clouds':
				 $this->weather = 'good';
				 $rideweather = 'good';
				 $this->descriptive = 'good';
				 break;

			
			case 'mist':
			case 'smoke':
			case 'haze':
				$this->weather = 'maybe';
				$rideweather = 'maybe';
				$this->descriptive = 'maybe';
				 break;

		
		}

		if($this->temperature > 14 && $rideweather === 'good')
		{
			$this->ride = 'good';
		}
		elseif ($this->temperature > 10 && ($rideweather === 'maybe' || $rideweather === 'good')) {
			$this->ride = 'maybe';
		}
		else {
			$this->ride = 'bad';
		}
	}

}
