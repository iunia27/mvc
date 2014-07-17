<?php

	class View{
		
		const ROOT = 'Views/';
		private $path;
		private $controller;
		private $action;
		
		public function __construct($context){
			$this->controller = get_class($context);
			$this->action = $context->getActionName();
			$this->path = $this->generateIncludeFilePath();
		}
		
		//setters and getters for views
		public function setPath($action, $controller){
			if (isset($action)){
				$this->action = $action;
			}
			else return;
			if (isset($controller)){
				$this->controller = $controller;
			}
			$this->path = $this->generateIncludeFilePath();
		}
		
		public function getPath(){
			return $this->path;
		}
		
		//render function for view
		public function render($viewModel){
			extract($viewModel);
			include $this->path;
		}
		
		private function generateIncludeFilePath(){
			return self::ROOT. $this->controller .'/'. $this->action .'.html';
		}
	}
?>