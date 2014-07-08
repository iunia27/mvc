<?php
	include_once 'Singleton.php';
	include_once 'Route.php';
	
	class FrontController extends Singleton {
		private $route;
		private $baseUrl = 'C:/wamp/www/';
		protected function __construct(){
			
		}
		
		//gets the directory of the controller based on controller Name (xml file)
		private function getControllerDirectory($controller){
			return $this->route->getDirectoryFolder($controller);
		}
		
		private static function run(){
			$this->route = new Route($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
			$this->dispatch();
		}

		// checks for registered router and dispatcher objects, instantiating the default versions of each if none is found
		public function dispatch(){			
			//Dispatching
			$dir = $this->getControllerDirectory($this->route->getControllerName());
			include_once $this->baseUrl.'MVCRamp-upProject/php_mvc/Controllers/TestController.php';
				//some more code for including the controllers file in the front controller .php page
			$controller = 'TestController';//$this->route->getControllerName();
			$action = $this->route->getActionName();
			$controller_instance = $controller :: getInstance(); //instance of the required controller
			$params = 1; //a model binder 
			
			//Response
			$response = $controller_instance->$action($params);
			echo $response;
		}
	}
	
	$frontController = FrontController :: getInstance();
	$frontController->run();
?>



















