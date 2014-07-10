<?php
	
	class TestController{
		private $variable = 'Name';
		private $itest;
		
		public function __construct(ITest $itest){
			$this->itest = $itest;
		}
		
		public function Index(){
			$methodCalled = $this->itest->show()." + ".$this->variable." + </br> This was made using dependency injection";
			return $methodCalled;
		}
	}

?>