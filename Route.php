<?php 
	class Route{
		
		//constructors
		public function __construct($controller, $action, $params){
			isset($controller) ? $this->setControllerName($controller) : '';
			isset($action) ? $this->setActionName($action) : '';
			isset($params) && is_array($params) ? $this->setParams($params) : '';
		}
		
		public function __construct($controller, $action){
			isset($controller) ? $this->setControllerName($controller) : '';
			isset($action) ? $this->setActionName($action) : '';
		}
		
		public function __construct($controller){
			isset($name) ? $this->setControllerName($controller) : '';
		}
		
		public function __construct(){}
	
		//properties declaration
		private $controllerName;
		private $actionName;
		private $params;
		
		//seters and geters for each property
		public function setControllerName($name){
			if (isset($name)){
				$this->$controllerName = $name;
			}
		}
		
		public function getControllerName(){
			return $this->$controllerName;
		}
		
		public function setActionName($name){
			if (isset($name)){
				$this->$actionName = $name;
			}
		}
		
		public function getActionName($name){
			return $this->$actionName;
		}
		
		public function setParams($params){
			if (isset($params) && is_array($params)){
				$this->$params = $params;
			}
		}
		
		public function getParams(){
			return $this->$params;
		}
	}

?>
