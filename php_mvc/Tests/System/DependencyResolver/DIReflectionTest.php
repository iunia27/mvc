<?php

	require_once 'System/DependecyResolver/DIReflection.php';

	class DIReflectionTest extends PHPUnit_Framework_TestCase{
	
		public $reflectionInstance;

		public function setUp(){
			$this->reflectionInstance = new DIReflection();
			$class = get_class($this->reflectionInstance);
	        $this->assertEquals($class, "DIReflection");
		}

		/**
	     * @dataProvider validData
	     */
		public function testValid($value){
			$instance = $this->reflectionInstance->getControllerContext($value);
			$contrClass = get_class($instance);
			print('tttttttttttttttttttttttttttttttttttttttttttttttt '.$contrClass.' ttttttttttttt');
	        $this->assertEquals($contrClass, $value);
		}

		public function validData(){
			return array(array('TestController'),
						 array('TstController')
					);
		}

		/**
	     * @dataProvider invalidData
	     */
		public function testInvalid($value){
			$instance = $this->reflectionInstance->getControllerContext($value);
	        $this->assertEquals($instance, null);
		}

		public function invalidData(){
			return array(array('test'),
						 array('controller'),
						 array('another')
			);		
		}
	}
?>