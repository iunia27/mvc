<?php

class FrontController {

    public $controllerDirectory = null;
    protected $instance = null;
    protected $router;
    
    

    protected function __construct() {
        $this->router = new Router();
        
    }

    private function __clone() {
        
    }

    /**
     * 
     * @return type FrontController 
     */
    public static function getInstance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function addControllerDirectory($directory) {
        $this->router->addControllerDirectory($directory);
    }
    
    public function setControllerDirectory($directory) {
        $this->router->setControllerDirectory($directory);
    }
    
     public function getControllerDirectory($name = null)
    {
        return $this->router->getControllerDirectory($name);
    }
    
     public function removeControllerDirectory($directory)
    {
        $this->router->removeControllerDirectory($directory);
        return $this;
    }
    
     public function setDefaultControllerName($controller)
    {
        $this->router->setDefaultControllerName($controller);
    }


    public function getDefaultControllerName()
    {
        return $this->router->getDefaultControllerName();
    }


    public function setDefaultAction($action)
    {
        $this->router->setDefaultAction($action);
        return $this;
    }

 
    public function getDefaultAction()
    {
        return $this->router->getDefaultAction();
    }
    
    //set, get Response
    //set, get Request
    //get BaseUrl

    public function dispatch() {
        
    }


//    public function run(){
//        
//    }
}