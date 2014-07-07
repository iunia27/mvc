<?php
	include_once 'Singleton.php';
	include_once 'Router_Route.php';

	$frontController = FrontController :: getInstance();
	$frontController->dispatch();
	
	class FrontController extends Singleton {
		private $controller_directory = 'Controllers';
		
		//Set several module directories (xml file)
		public function setControllerDirectory($controllerName, $controllerDirectory){
			// sets the controller directory path
		}
		
		//add a new module directory in an xml file. 
		public function addControllerDirectory($directory){
			
		}
		
		//gets the directory of the controller based on controller Name (xml file)
		public function getControllerDirectory($controllerName){
			return $this->$controller_directory;
		}
		//a static method taking simply a path to a directory containing controllers. It fetches a front controller instance (via getInstance(), 
		//registers the path provided via setControllerDirectory(), and finally dispatches
		public static function run($path){
		
		}

		// checks for registered router and dispatcher objects, instantiating the default versions of each if none is found
		public function dispatch(){
			//Routing
			$router = new RouteBuilder();
			$route = $router->createRoute();
			
			//Dispatching
			$dir = getControllerDirectory($route[0]);
				//some more code for including the controllers file in the front controller .php page
			$controller_instance = $route[0]::getInstance(); //instance of the required controller
			$function = $route[1];
			$params = 1; //some model binder 
			
			//Response
			$response = $controller_instance->$action($params);
			return $response;
		}
	}
?>



















