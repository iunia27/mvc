<?php

require_once 'System/Validator/InArray.php';

class InArrayTest extends PHPUnit_Framework_TestCase {

    protected $validator;

    /**
     * @depends setVariables
     */
    protected function setUp() {

        $this->validator = new InArray();  //create a new router
        $class = get_class($this->validator);
        $this->assertEquals($class, "InArray");
        $this->validator->setHaystack(array('Iunia', array('casa', array('masa', array('cevreitu')))));
    }

    public function testGetHaystack() {

        $this->assertEquals($this->validator->getHaystack(), array('Iunia', array('casa', array('masa', array('cevreitu')))));
    }

    public function testSetHaystack() {
        $this->validator->setHaystack(array());
        $this->assertEquals($this->validator->getHaystack(), array());
    }

    /**
     * @dataProvider validatorValues
     */
    public function testIsValid($value) {

        $this->assertTrue($this->validator->isValid($value));
    }

    public function validatorValues() {
        return array(
            array('casa'),
            array('Iunia'),
            array('masa'),
            array('cevreitu'),
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