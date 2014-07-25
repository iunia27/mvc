<?php

class DIReflection {

    public function __construct() {
        
    }

    /* 
     * retrieves controller/service instance based on its dependencies.
     * $controller -> a variable that stores the name of the class that should be instanced.
     * returns the required service with all its dependencies based on dependency injection tool.
     */

    public function getControllerContext($controllerName) {
        $params;
        $instClass = new ReflectionClass($controllerName);
        if ($instClass->isInstantiable()) {
            $params = $instClass->getConstructor()->getParameters();
        }
		
        $paramsForInstance = array();
        foreach ($params as $current) {

            if (isset($current->getClass()->name)) {
                $interfaceToInstanciate = $current->getClass()->name; //get the name of the interface that should be instantiated
                $concreteInterface = $this->getConcreteClass($interfaceToInstanciate); //gets the name of the class that implements the interface
                $instance = $this->getControllerContext($concreteInterface);
                array_push($paramsForInstance, $instance);
            }
        }
        $controllerInstance = $instClass->newInstanceArgs($paramsForInstance);
        return $controllerInstance;
    }

    private function getConcreteClass($interfaceName) {
        return substr($interfaceName, 1);
    }
}

?>