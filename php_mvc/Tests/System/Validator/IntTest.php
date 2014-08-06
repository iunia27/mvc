<?php

require_once 'System/Validator/Int.php';

class IntTest extends PHPUnit_Framework_TestCase {

    protected $validator;

    /**
     * @depends setVariables
     */
    protected function setUp() {

        $this->validator = new Int();  //create a new router
        $class = get_class($this->validator);
        $this->assertEquals($class, "Int");
    }

    /**
     * @dataProvider validatorValues
     */
    public function testIsValid($value) {
        $this->assertTrue($this->validator->isValid($value));
    }

    public function validatorValues() {
        return array(
            array(1),
            array(0),
            array(2012),
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
            array('1989-06-27'),
            array('aaa'),
            array('2a'),
            array('22'),
            array(2.7),
            array('2.7'),
            array('&%'),
        );
    }

    public function testGetMessages() {
        $this->assertTrue(
        ($this->validator->getMessages() === "The inserted value is not an integer.")
        ||
        ($this->validator->getMessages() === null)
        );
    }

}