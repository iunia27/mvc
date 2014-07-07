<?php
	include_once 'Route.php';
	
	class RouterBuilder{
		
		private static $default_controller = 'Home';
		private static $default_action;
		private static $default_params;
		
		public function __construct(){}
		
		public function createRoute($url){
			if (isset($url)){
				$route_values = explode('/', $url);
				if (isset($route_values) && is_array($route_values)){
					$route_count = count($route_values);
					$controller = $route_values[1];
					$action = $this->setAction();
					$params = $this->setParameters();
					return new Route($controller, $action, $params);
				}
			}
			return false;
		}
		
		private function getAction($route_count, $route_values){
			$action;
			if ($route_count > 2){
				$action = $route_values[2];
			} else {
				$action = $this->$default_action;
			}
			return $action;
		}
		
		private function getParamaters($route_count, $route_values){
			$params = new array();
			if ($route_count > 3){
				for($i = 3; $i < $route_count = count($route_values); $i++){
					array_push($params, $route_values[$i]);
				}
			}
			return $params;
		}
	}
?>