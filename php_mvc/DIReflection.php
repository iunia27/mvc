<?php	
	class DIReflexion{
	
		private $controllerName;
		private $instClass;
		
		public function __construct($controllerName){
			$this->controllerName = $controllerName;
			$this->instClass = new ReflectionClass($this->controllerName);
			
		}
		
		public function getControllerContext(){
			$params = $this->getConstructorParams();
			$paramsToSent = array();
			foreach($params as $current)
			{
				if (isset($current->getClass()->name)){
					$classToIns = $current->getClass()->name;
					$container = CustomInject :: getInstance();
					$instance = $container->resolve($classToIns);
					array_push($paramsToSent, $instance);
				}
				else{
					array_push($paramsToSent, '');
				}
			}
			$instance = $this->instClass->newInstanceArgs($paramsToSent);
			return $instance;
		}
		
		public function getConstructorParams(){
			$this->__autoload($this->controllerName);
			if ($this->instClass->isInstantiable()){
				return $this->instClass->getConstructor()->getParameters();
			}
		}
		
		private function __autoload($controllerName) {
			$filename = "./".$controllerName.".php";
			include_once($filename);
		}
	}
?>