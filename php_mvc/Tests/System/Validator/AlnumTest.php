<?php

require_once 'System/Validator/Alnum.php';

class AlnumTest extends PHPUnit_Framework_TestCase {

    protected $validator;

    /**
     * @depends setVariables
     */
    protected function setUp() {

        $this->validator = new Alnum();  //create a new router
        $class = get_class($this->validator);
        $this->assertEquals($class, "AlNum");
    }

    /**
     * @dataProvider validatorValues
     */
    public function testIsValid($value) {
        $this->assertTrue($this->validator->isValid($value));
    }

    public function validatorValues() {
        return array(
            array('1a'),
            array('a2'),
            array('a2b'),
            array('A2'),
            array('2A'),
            array('AB2'),
            array('aa'),
            array('12'),
            array('Aa'),
            array('AB'),
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
            array('a&a'),
            array('a a'),
            array('a-2'),
            array('&%'),
            array('A.2'),
            array(1.7),
            array('')
        );
    }

    public function testGetMessages() {
        $this->assertTrue(($this->validator->getMessages() === "The inserted value does not contain only alphanumeric characters") OR ($this->validator->getMessages() === null));
    }

}

