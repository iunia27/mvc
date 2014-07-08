<?php

	class TestController extends FrontController{
		private $variable = 'Name';
		
		public function Index(){
			return $this->variable;
		}
	}

?>