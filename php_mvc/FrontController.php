<?php
	include_once 'Singleton.php';
	include_once 'Route.php';

	$frontController = FrontController :: getInstance();
	$frontController->dispatch();
	
	class FrontController extends Singleton {
		private $route;
		public function __construct(){
			$route = new Route($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
		}
		
		//gets the directory of the controller based on controller Name (xml file)
		public function getControllerDirectory($controller){
			return $this->$route->getDirectoryFolder($controller);
		}
		//a static method taking simply a path to a directory containing controllers. It fetches a front controller instance (via getInstance(), 
		//registers the path provided via setControllerDirectory(), and finally dispatches
		public static function run($path){
		
		}

		// checks for registered router and dispatcher objects, instantiating the default versions of each if none is found
		public function dispatch(){			
			//Dispatching
			$dir = getControllerDirectory($route->getControllerName());
			include $dir;
				//some more code for including the controllers file in the front controller .php page
			$controller = $route->getControllerName();
			$action = $route->getActionName();
			$controller_instance = $controller :: getInstance(); //instance of the required controller
			$params = 1; //some model binder 
			
			//Response
			$response = $controller_instance->$action($params);
			return $response;
		}
	}
?>



















