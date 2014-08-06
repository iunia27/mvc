<?php

require_once 'System/Validator/Date.php';

class DateTest extends PHPUnit_Framework_TestCase {

    protected $validator;

    /**
     * @depends setVariables
     */
    protected function setUp() {

        $this->validator = new Date();  //create a new router
        $class = get_class($this->validator);
        $this->assertEquals($class, "Date");
    }

    /**
     * @dataProvider validatorValues
     */
    public function testIsValid($value) {
        $this->assertTrue($this->validator->isValid($value));
    }

    public function validatorValues() {
        return array(
            array('1989-06-27'),
            array('2012-02-29'),
            array('1970-05-23'),
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
            array('78'),
            array('2014-02-29'),
            array('aaaa'),
            array('bbbb-cc-pp'),
            array('1'),
            array('2014.02.02'),
            array('02-09-2013'),
            array('2014-23-03'),
            array(''),
        );
    }

    public function testGetMessages() {
        $this->assertTrue(
                ($this->validator->getMessages() === "The date format should be yyyy-mm-dd")
                ||
                ($this->validator->getMessages() === null)
                ||
                ($this->validator->getMessages() === "The provided date is invalid")
        );
    }

}