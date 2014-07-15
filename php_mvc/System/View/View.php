<?php

	class View{
		
		private $path;
		
		public function __construct($context){
			$this->path = 'Views/'.get_class($context).'/'.$context->getActionName().'.html';
		}
		
		//setters and getters for views
		public function setPath($path){
			$this->path = $path;
		}
		
		public function getPath(){
			return $this->path;
		}
		
		//render function for view
		public function render($viewModel){
			include $this->path;
		}
	}
?>