<?php

namespace SimplePhp\Core;

class Application{
	private $url_controller = null;
	private $url_action = null;
	private $url_params = array();

	/**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method or the fallback
     */
	public function __construct(){
		// create array with URL parts in $url
		$this->splitUrl();

		// check for controller: no controller given? then load start-page
		if(!$this->url_controller) {

			$page = new \SimplePhp\Controller\HomeController();
			$page->index();
			
		} elseif (file_exists(APP . 'Controller/' . ucfirst($this->url_controller) . 'Controller.php')) {
			// check for controller: does such controller exist?
			// if so, then load this file and create this controller

			$controller = "\\SimplePhp\\Controller\\" . ucfirst($this->url_controller) . 'Controller';
			$this->url_controller = new $controller();

			if(method_exists($this->url_controller, $this->url_action) && is_callable(array($this->url_controller, $this->url_action))) {
				
				if(!empty($this->url_params)) {
					// call the method and pass argument to it
					call_user_func_array(array($this->url_controller, $this->url_action), $this->url_params);
				} else {
					$this->url_controller->{$this->url_action}();
				}

			} else {
				if(strlen($this->url_action) == 0) {
						// no action defined: call the default index() method of a selected controller
						$this->url_controller->index();
				} else {
					header('location: ' . URL . 'error');
				}
			}
		} else {
			header('location: ' . URL . 'error');
		}
	}

		/**
		 * Get and split the URL
		 */
	private function splitUrl() {
		if(isset($_GET['url'])) {
			// split url
			$url = trim($_GET['url'], '/');
			$url = filter_var($url, FILTER_SANITIZE_URL);
			$url = explode('/', $url);

			// Put URL parts into according properties
			$this->url_controller = isset($url[0]) ? $url[0] : null;
			$this->url_action = isset($url[1]) ? $url[1] : null;

			// Remove controller and action from the split URL
			unset($url[0], $url[1]);

			// Rebase array keys and store the URL params
			$this->url_params = array_values($url);

			// for debugging. uncomment this if you have problems with the URL
			//echo 'Controller: ' . $this->url_controller . '<br>';
			//echo 'Action: ' . $this->url_action . '<br>';
			//echo 'Parameters: ' . print_r($this->url_params, true) . '<br>';
			}
	}
}