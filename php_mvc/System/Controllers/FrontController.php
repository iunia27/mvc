<?php

class FrontController {

    private $route;
    private $controllerContext;
    //singleton

    private static $instance = null;

    public function __construct() { //Thou shalt not construct that which is unconstructable!
    }

    private function __clone() {} //Me not like clones! Me smash clones!

    public static function getInstance() {
        if (!isset(static::$instance)) {
            static::$instance = new static;
        }
        return static::$instance;
    }

    /*
    * The entry point method in order to make the dispatch action.
    */
    public function run() {
        $this->route = new Router($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
        $this->dispatch();
    }

    /*
    * Checks for registered router and dispatcher objects, instantiating the default versions of each if none is found.
    */ 
    private function dispatch() {
        $controller = ucfirst($this->route->getControllerName() . 'Controller');
        $action = ucfirst($this->route->getActionName());
		$params = $this->route->getParams();

        $cont = $this->getControllerContext($controller);
		$cont->setActionName($action);
		$cont->setControllerName($controller);
		$cont->setParams($params);
		$cont->setView(new View($cont));

        //Response
        $cont = $this->getControllerContext('Test');
        $cont->$action();
    }

    /*
    * Gets the Controller Context using dependency injection.
    */
    private function getControllerContext($controllerName) {
        $ex = new DIReflection();
        return $ex->getControllerContext($controllerName);
    }

}
?>



















