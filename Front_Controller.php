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

		//builds the route
		public function dispatch(){
		
		}
	}
?>