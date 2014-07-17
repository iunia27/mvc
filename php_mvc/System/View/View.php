<?php

	class View{
		
		const ROOT = 'Views/';
		private $path = array();
		private $controller;
		private $action;
		private $defaultPath;
		
		public function __construct($context){
			$this->controller = get_class($context);
			$this->action = $context->getActionName();
			$this->defaultPath = $this->controller.'/'.$this->action;
			$this->setPath($this->defaultPath);
			//array_push($this->path, $this->defaultPath => $this->generateIncludeFilePath($this->defaultPath));
		}
		
		//setters and getters for views
		public function setPath($path){
			if (isset($path)){
				$components = explode('/',$path);
				if (count($components) == 1){
					$path = $this->controller.'/'.$path;
				}
				if (!in_array($path, $this->path)){
					$this->path = $this->array_push_assoc($this->path, $path, $this->generateIncludeFilePath($path));
				}
			}
		}
		
		public function getPath(){
			return $this->path;
		}
		
		//render function for view
		public function render($viewModel){
			extract($viewModel);
			foreach ($this->path as $currentKey => $currentValue){
				include $currentValue;
			}
		}
		
		private function generateIncludeFilePath($path){
			return self::ROOT. $path .'.html';
		}
		
		private function array_push_assoc($array, $key, $value){
			$array[$key] = $value;
			return $array;
		}
	}
?>