<?php

namespace SimplePhp\Controller;

class HomeController{
	/**
	 * PAGE: Index
	 * This method handles what happends when you move to http://yourproject.name/home/index
	 */
	public function index(){
		require APP . 'view/_templates/header.php';
		require APP . 'view/home/index.php';
		require APP . 'view/_templates/footer.php';
	}

	/**
	 * PAGE: exampleone
	 * This method handles what happends when you move to http://yourproject.name/home/exampleone
	 * The camelcase writing is just for better readability. The method name is case-insensitive.
	 */
	public function exampleOne(){
		require APP . 'view/_templates/header.php';
		require APP . 'view/home/example_one.php';
		require APP . 'view/_templates/footer.php';
	}
}