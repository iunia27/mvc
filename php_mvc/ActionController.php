<?php

class ActionController{
    protected $_model;
    protected $controller;
    protected $action;
    protected $view;
    
    function __construct($model,$controller,$action){
        $this->_model = $model;
        $this->action = $action;
        $this->controller = $controller;
        
        $this->$model = new $model;
        $this->view = new View($controller,$action);
    }
    
    function set($name,$value){
        $this->view->set($name,$value);
    }
    
    function __destruct() {
        $this->view->render();
    }
}

?>