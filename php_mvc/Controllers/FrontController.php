<?php
	include_once '../Route.php';
	include_once '../CustomInject.php';
	include_once '../DIReflection.php';
	
	class FrontController{
		private $route;				
		private $itest;
		private $controllerContext;
		//singleton
		
		private static $instance = null;

		private function __construct(){ //Thou shalt not construct that which is unconstructable!
			/*$container = CustomInject :: getInstance();
			$this->itest = $container :: resolve('ITest');
			var_dump($this->itest->show());*/
		}

		private function __clone(){} //Me not like clones! Me smash clones!

		public static function getInstance()
		{
			if (!isset(static::$instance)) {
				static::$instance = new static;
			}
			return static::$instance;
		}		
				
		public function run(){
			$this->route = new Route();
			$this->dispatch();
		}

		// checks for registered router and dispatcher objects, instantiating the default versions of each if none is found
		private function dispatch(){			
			$controller = 'TestController';//$this->route->getControllerName();
			$action = 'Index';//$this->route->getActionName();
			
			$this->__autoload($controller);
			
			//Response
			$response = $controllerContext->$action();
			echo $response;
		}
		
		private function __autoload($controllerName)
		{
			$filename = "./". $controllerName .".php";
			include_once($filename);
			
			$ex = new DIReflexion($controllerName);
			$this->controllerContext = $ex->getControllerContext();
		}
	}
	
	$frontController = FrontController :: getInstance();
	$frontController -> run();
?>



















