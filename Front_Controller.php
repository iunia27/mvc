<?php
	class FrontController extends Singleton {
		private $defaultAction = 'Index';
		private $defaultController = 'Home';
		private $controller_directory = 'test';
		
		// Set the default controller directory
		public function setControllerDirectory($directory){
			$this->$controller_directory = 'test2';
		}
		
		//add a new directory for controller
		public function addControllerDirectory($directory){
			$this->$controller_directory = 'test2';
		}
		
		//gets all controllers directory
		public function getControllerDirectory($directory){
			return $this->$controller_directory;
		}
		
		public static function run($path){
		
		}
		
		//sets the default action name
		public function setDefaultActionName($actionName){
			$this->$defaultAction = 'test2';
		}
		
		//sets the default controller name
		public function setDefaultControllerName($actionName){
			$this->$defaultController = 'test2';
		}
		//gets the default action name
		public function getDefaultActionName(){
			return $this->$defaultAction;
		}
		
		//gets the default controller name
		public function getDefaultControllerName(){
			$this->$defaultController;
		}
		
		//builds the route
		public function dispatch(){
		
		}
	}
?>