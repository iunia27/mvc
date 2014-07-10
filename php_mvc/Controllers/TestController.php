<?php
include_once('FrontController.php');
	class TestController extends FrontController{
		private $variable = 'Name';
		
		public function Index(){
			return $variable;
		}
	}

?>