<?php

    require_once 'Controllers/TestController.php';
    require_once 'Controllers/TstController.php';
    require_once 'Models/Test.php';
    require_once 'Models/DBConnector.php';
    require_once 'Models/DBService.php';

class DIReflection {

    public function __construct() {}

    /* 
     * retrieves controller/service instance based on its dependencies.
     * $controller -> a variable that stores the name of the class that should be instanced.
     * returns the required service with all its dependencies based on dependency injection tool.
     */

    public function getControllerContext($controllerName) {
        $params;

        try{
            $instClass = new ReflectionClass($controllerName);
            if ($instClass->isInstantiable()) {
                $params = $instClass->getConstructor()->getParameters();
            }
    		
            $paramsForInstance = array();
            foreach ($params as $current) {

                if (isset($current->getClass()->name)) {
                    $interfaceToInstanciate = $current->getClass()->name; //get the name of the interface that should be instantiated
                    $concreteInterface = $this->getConcreteClass($interfaceToInstanciate); 

                    //recursive call in order to instantiate the other dependencies
                    $instance = $this->getControllerContext($concreteInterface);

                    array_push($paramsForInstance, $instance);
                }
            }
            $controllerInstance = $instClass->newInstanceArgs($paramsForInstance);
            return $controllerInstance;
        }catch (Exception $e) {
            return null;
        }
    }

    /*
    * Builds the concrete class name in order to be instantiate.
    */
    private function getConcreteClass($interfaceName) {
        return substr($interfaceName, 1);
    }
}

?>