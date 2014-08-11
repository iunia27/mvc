<?php
	require_once 'System/Validator/EmailValidator.php';

	class EmailTest extends PHPUnit_Framework_TestCase{

		public function setUp(){
			$this->validator = new EmailValidator();  //create a new router
	        $class = get_class($this->validator);
	        $this->assertEquals($class, "EmailValidator");
		}

		/**
	     * @dataProvider validatorValues
	     */
		public function testIsValid($value) {
	        $this->assertTrue($this->validator->isValid($value));
	    }

	    public function validatorValues() {
	        return array(
	            array('catalisanalex@yahoo.com'),
	            array('catalisanalex@yahoo.ro'),
	            array('catalisanalex@gmail.ro')
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
	            array('catalisan'),
	            array('catalisan@'),
	            array('catalisan@.'),
	            array('catalisan@yahoo'),
	            array('@yahoo.com'),
	            array('catalisan@.com'),
	            array('')
	        );
	    }

		 public function testGetMessages() {
	        $this->assertTrue(($this->validator->getMessages() === "The e-mail address you entered is not in a correct format!") 
	        	OR (count($this->validator->getMessages()) == 0));
	    }
	}
?>