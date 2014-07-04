<?php 
	class Route{
		
		public function __construct($controller, $action, $params){
			isset($name) ? $this->setControllerName($name) : '';
			isset($action) ? $this->setActionName($name) : '';
			isset($params) && is_array($params) ? $this->setParams($name) : '';
		}
		
		public function __construct($controller, $action){
			isset($name) ? $this->setControllerName($name) : '';
			isset($action) ? $this->setActionName($name) : '';
		}
		
		public function __construct($controller){
			isset($name) ? $this->setControllerName($name) : '';
		}
		
		public function __construct(){}
	
		private $controllerName;
		private $actionName;
		private $params;
		
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
