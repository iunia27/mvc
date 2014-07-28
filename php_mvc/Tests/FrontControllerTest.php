<?php
	class FrontControllerTest extends PHPUnit_Framework_TestCase{

		public $frontController;

		public function setUp(){
			$this->frontController = $this->getMockBuilder('FrontController')
										  ->setMethods(array('getInstance'))
										  ->getMock();
		}

		public function checkInstances(){
			$this->frontController->run();
		}

	}
?>