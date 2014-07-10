<?php
	include_once 'Singleton.php';
	include_once 'Router.php';
	
	class FrontController extends Singleton {
		private $route;
		public function __construct(){
			$this->route = new Router();
		}
		
		//gets the directory of the controller based on controller Name (xml file)
		private function getControllerDirectory($controller){
			return $this->route->getDirectoryFolder($controller);
		}
		//a static method taking simply a path to a directory containing controllers. It fetches a front controller instance (via getInstance(), 
		//registers the path provided via setControllerDirectory(), and finally dispatches
		private static function run($path){
		
		}

		// checks for registered router and dispatcher objects, instantiating the default versions of each if none is found
		public function dispatch(){			
			//Dispatching
			$dir = $this->getControllerDirectory($this->route->getControllerName());
			include_once "./$dir.'/TestController.php'";
				//some more code for including the controllers file in the front controller .php page
			$controller = $this->route->getControllerName();
			$action = $this->route->getActionName();
			$controller_instance = $controller :: getInstance(); //instance of the required controller
			$params = 1; //some model binder 
			
			//Response
			$response = $controller_instance->$action($params);
			return $response;
		}
	}
	
	$frontController = FrontController :: getInstance();
	$frontController->dispatch();
?>



















