<?php

require_once 'System/Validator/Password.php';

class PasswordTest extends PHPUnit_Framework_TestCase {

    protected $validator;

    /**
     * @depends setVariables
     */
    protected function setUp() {

        $this->validator = new Password();  //create a new router
        $class = get_class($this->validator);
        $this->assertEquals($class, "Password");
    }

    /**
     * @dataProvider validatorValues
     */
    public function testIsValid($value) {
        $this->assertTrue($this->validator->isValid($value));
    }

    public function validatorValues() {
        return array(
            array('123456Aa'),
            array('As123456'),
            array('AA2012BBCCd'),
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
            array(''),
            array('aaa'),
            array('2a'),
            array('22'),
            array(2.7),
            array('2.7'),
            array('12345678'),
            array('1234567a'),
            array('1234567A'),
            array('AA2012BBCC'),
        );
    }

    public function testGetMessages() {
        $this->assertTrue(
                ($this->validator->getMessages() === "The inserted value is an empty string.")
                ||
                ($this->validator->getMessages() === null)
                ||
                ($this->validator->getMessages() === "The password must be at least 8 characters long and must contain at least a one upper case letter, one lower case letter and one numeric digit."));
    }

}