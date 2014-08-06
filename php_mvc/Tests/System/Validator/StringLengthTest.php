<?php

require_once 'System/Validator/StringLength.php';

class StringLengthTest extends PHPUnit_Framework_TestCase {

    protected $validator;

    /**
     * @depends setVariables
     */
    protected function setUp() {

        $this->validator = new StringLength();  //create a new router
        $class = get_class($this->validator);
        $this->assertEquals($class, "StringLength");
        $this->validator->setMin(2);
        $this->validator->setMax(10);
    }

    public function testGetMin() {

        $this->assertEquals($this->validator->getMin(), 2);
    }

    public function testSetMin() {
        $this->validator->setMin(1);
        $this->assertEquals($this->validator->getMin(), 1);
        $this->validator->setMin(11);
        $this->assertEquals($this->validator->getMin(), 1);
    }

    public function testGetMax() {

        $this->assertEquals($this->validator->getMax(), 10);
    }

    public function testSetMax() {
        $this->validator->setMax(10);
        $this->assertEquals($this->validator->getMax(), 10);
        var_Dump($this->validator->getMax());
        $this->validator->setMax(0);
        $this->assertEquals($this->validator->getMax(), 10);
    }

    /**
     * @dataProvider validatorValues
     */
    public function testIsValid($value) {

        $this->assertTrue($this->validator->isValid($value));
    }

    public function validatorValues() {
        return array(
            array('abcdef'),
            array('aaaa'),
            array('1234567890'),
            array('aa'),
            array('aaa'),
            array('123456789'),
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
            array('a'),
            array('1989-06-27-10:30'),
            array('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'),
            array('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'),
            array('12345678910'),
            array(array()),
        );
    }

    public function testGetMessages() {
        $this->assertInternalType('array', $this->validator->getMessages());
    }

}