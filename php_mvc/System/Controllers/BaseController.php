<?php

	abstract class BaseController {
		
		private $controllerName;
		private $actionName;
		private $params;
		private $view;
		
		protected function __construct() {}

		abstract function Index();
		
		//getter and setter for controller
		public function getControllerName(){
			return $this->controllerName;
		}
		public function setControllerName($controller){
			$this->controllerName = $controller;
		}
		
		//getter and setter for action
		public function getActionName(){
			return $this->actionName;
		}
		public function setActionName($action){
			$this->actionName = $action;
		}
		
		//getter and setter for parameters
		public function getParams(){
			return $this->params;
		}
		public function setParams($params){
			$this->params = $params;
		}
		
		//getter and setter for view
		public function getView(){
			return $this->view;
		}
		public function setView($view){
			$this->view = $view;
		}
		
		//gets the view
		public function ReturnView($viewModel, $fullView){
			return $this->view->render($viewModel, $fullView);
		}
	}

?>