<?php

include_once("RouterInterface.php");

class Router implements RouterInterface {

    //properties declaration
    private $schema = null;
    private $controllerName = null;
    private $actionName = null;
    private $params = array();
    private $requestType = null;

    //constructors
    public function __construct($url, $requestType) {
        $this->requestType = $requestType;
        $this->createRoute($url);
    }

    /**
     * this function manipulates an url that has the following pattern:
     * http(s)://www.index.com?controller="controllerName"&action="actionName"&
     * param1="param1"&...&paramN="paramN"
     */
    private function createRoute($url) {
        if (isset($url)) {
            $parsed_url = parse_url($url);
            if (isset($parsed_url['scheme'])){
            $this->setSchema($parsed_url['scheme']);
            }
            if (isset($parsed_url['query'])){
            $get_params = explode('&', $parsed_url['query']);
            $params = array();
            foreach ($get_params as $get_param) {
                $param = explode('=', $get_param);
                if ($param[0] == 'controller') {
                    $this->setControllerName($param[1]);
                } elseif ($param[0] == 'action') {
                    $this->setActionName($param[1]);
                }else{
                 $params[$param[0]]=$param[1];   
                }
            }
            $this->setParams($params);
        }
        }
    }

    //seters and geters for each property
    public function setSchema($schema) {
        $this->schema = $schema;
    }

    public function getSchema() {
        if (isset($this->schema)) {
            return $this->schema;
        }
        return null;
    }

    public function setControllerName($name) {
        $this->controllerName = $name;
    }

    public function getControllerName() {
        if (isset($this->controllerName)) {
            return $this->controllerName;
        }
        return null;
    }

    public function setActionName($name) {
        $this->actionName = $name;
    }

    public function getActionName() {
        if (isset($this->actionName)) {
            return $this->actionName;
        }
        return null;
    }

    public function setParams($params) {
        $this->params = $params;
    }

    public function getParams() {
        if (isset($this->params)) {
            return $this->params;
        }
        return null;
    }

    public function setRequestType($request) {
        $this->requestType = $requestType;
    }

    public function getRequestType() {
        if (isset($this->requestType)) {
            return $this->requestType;
        }
        return null;
    }

}

?>
