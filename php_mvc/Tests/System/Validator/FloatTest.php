<?php
	include_once 'System/Validator/FloatValidator.php';

	class FloatTest extends PHPUnit_Framework_TestCase{

		public function setUp(){
			$this->validator = new FloatValidator();  //create a new router
	        $class = get_class($this->validator);
	        $this->assertEquals($class, "FloatValidator");
		}

		/**
	    * @dataProvider validatorValues
	    */
	    public function testIsValid($value) {
	        $this->assertTrue($this->validator->isValid($value));
	    }

	    public function validatorValues() {
	        return array(
	            array(13.2),
	            array(13),
	            array('16.85'),
	            array(2.02),
	            array('2556.2')
	        );
	    }

	    /**
	    * @dataProvider validatorBadValues
	    */
	    public function testIsNotValid($value) {
	        $this->assertFalse($this->validator->isValid($value));
	    }

	    public function validatorBadValues() {
	        return array(
	            array('17.2a'),
	            array('17.a'),
	            array('1a.25'),
	            array('a.78'),
	            array('a,b'),
	            array('a'),
	            array('')
	        );
	    }

	    public function testGetMessages() {
	        $this->assertTrue(($this->validator->getMessages() === "The value is not in a float format!") 
	        	OR (count($this->validator->getMessages()) == 0));
	    }
	}
?>