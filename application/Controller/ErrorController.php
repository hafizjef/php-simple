<?php

namespace SimplePhp\Controller;

class ErrorController{
	/**
	 * PAGE: Index
	 * This method handles the error page that will be shown when a page is not found
	 */
	public function index(){
		// load views
		require APP . 'view/_templates/header.php';
		require APP . 'view/error/index.php';
		require APP . 'view/_templates/footer.php';
	}
}