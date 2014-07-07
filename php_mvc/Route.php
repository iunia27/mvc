<?php 
	include_once 'ControllerRouting.php';
	
	class Route{
		
		//properties declaration
		private $directoryFolder = 'Controllers';
		private $controllerName = 'Home';
		private $actionName = 'Index';
		private $params = array();
		private $routes;
		private $requestType;
		
		//constructors
		public function __construct($url, $requestType){
			$this->requestType = $requestType;
			$routes = array('test' => 'TestController.php');
			$this->createRoute($url);
		}
		
		private function createRoute($url){
			if (isset($url)){
				$parsed_url = parse_url($url);
				$route_values = explode('/', $parsed_url['path']);
				if (isset($route_values) && is_array($route_values)){
					$this->setControllerName($this->getControllerFromUrl($route_values));
					$this->setActionName($this->getActionValue($route_values));
					$this->setParams($this->getParamatersFromUrl($route_values));
					return true;
				}
				return true;
			}
			return false;
		}
		
		//seters and geters for each property
		public function setControllerName($name){
			if (isset($name)){
				$this->controllerName = $name;
			}
		}
		
		public function getControllerName(){
			return $this->controllerName;
		}
		
		public function setActionName($name){
			if (isset($name)){
				$this->actionName = $name;
			}
		}
		
		public function getActionName(){
			return $this->actionName;
		}
		
		public function setParams($params){
			if (isset($params)){
				$this->params = $params;
			}
		}
		
		public function getParams(){
			return $this->$params;
		}
		
		public function getDirectoryFolder($controller){
			if (isset($routes[$controller])){
				$this->$directoryFolder = $routes[$controller];
			}
			return $this->directoryFolder;
		}	
		
		//private methods to obtain the parameters
		private function getControllerFromUrl($route_values){
			return count($route_values) > 3 ? $route_values[3] : $this->$controllerName;
		}
		
		private function getActionValue($route_values){
			return count($route_values) > 4 ? $route_values[4] : $this->actionName;
		}
		
		private function getParamatersFromUrl($route_values){
			$params = array();
			if (count($route_values) > 4){
				for($i = 5; $i < count($route_values); $i++){
					array_push($params, $route_values[$i]);
				}
			}
			return $params;
		}
	}

?>
