<?php

class HomeController extends BaseController {

	protected $layout = 'layout';

	public function getIndex($location = '')
	{	
		$loading_arr = Config::get('loading');

		$loading = $loading_arr[array_rand($loading_arr)];

		View::share('location', $location);

		$this->layout->content = View::make('index', compact('loading'));
	}

}
