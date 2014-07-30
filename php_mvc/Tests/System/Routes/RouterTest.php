<?php

require_once 'System/Routes/Router.php';

class RouterTest extends PHPUnit_Framework_TestCase {

    protected $router;

    /**
     * @depends setVariables
     */
    protected function setUp() {
        $this->setVariables('GET', array("schema" => "http", "controller" => "Test", "action" => "index", "requestType" => "get", 'name' => 'Ghita'), null);
        $this->router = new Router();  //create a new router
        $this->setVariables('POST', null, array("schema" => "http", "controller" => "Test", "action" => "index", "requestType" => "get", 'name' => 'Ghita'));
        $this->router = new Router();  //create a new router
        $this->setVariables('GET', array(), null);
        $this->router = new Router();  //create a new router
        $this->setVariables('GET', array("schema" => "http", "requestType" => "get"), null);
        $this->router = new Router();  //create a new router
        $class = get_class($this->router);
        $this->assertEquals($class, "Router");
    }

    /**
     * @param String $requestMethod - GET/POST
     * @param array $get An array that contains the get request variables
     * @param array $post An array that contains the post request variables
     * 
     * @dataProvider setUpProvider
     */
    public function setVariables($requestMethod, $get, $post) {
        $_SERVER['REQUEST_METHOD'] = $requestMethod;
        $_GET = $get;
        $_POST = $post;
    }

    /*
      public function setUpProvider() {
      return array(
      array('GET', array("schema" => "http", "controller" => "Test", "action" => "index", "requestType" => "get", 'name' => 'Ghita'), null),
      array('POST', null, array("schema" => "http", "controller" => "Test", "action" => "index", "requestType" => "get", 'name' => 'Ghita')),
      array('GET', null, array("schema" => "http","requestType" => "get", 'name' => 'Ghita')),
      array('GET', array(), null),
      );
      }
     */

    public function testCreateRoute() {
        
    }

    public function testGetSchema() {

        $this->assertEquals($this->router->getSchema(), 'http');
    }

    public function testSetSchema() {
        $this->router->setSchema("https");
        $this->assertEquals($this->router->getSchema(), 'https');
        $this->router->setSchema(null);
        $this->assertNull($this->router->getSchema());
    }

    public function testGetControllerName() {

        $this->assertNull($this->router->getControllerName());
    }

    public function testSetControllerName() {
        $this->router->setControllerName("Test");
        $this->assertEquals($this->router->getControllerName(), 'Test');
    }

    public function testGetActionName() {

        $this->assertNull($this->router->getActionName());
    }

    public function testSetActionName() {
        $this->router->setActionName("index");
        $this->assertEquals($this->router->getActionName(), 'index');
    }

    public function testGetParams() {

        $this->assertEmpty($this->router->getParams());
    }

    public function testSetParams() {
        $this->router->setParams(array("schema" => "http", "controller" => "Test", "action" => "index", "requestType" => "get"));
        $this->assertEquals($this->router->getParams(), array("schema" => "http", "controller" => "Test", "action" => "index", "requestType" => "get"));
        $this->router->setParams(null);
        $this->assertNull($this->router->getParams());
    }

    public function testGetRequestType() {

        $this->assertEquals($this->router->getRequestType(), $_SERVER['REQUEST_METHOD']);
        $this->router->setRequestType(null);
        $this->assertNull($this->router->getRequestType());
    }

    public function testSetRequestType() {
        $this->router->setRequestType("POST");
        $this->assertEquals($this->router->getRequestType(), 'POST');
    }

}
