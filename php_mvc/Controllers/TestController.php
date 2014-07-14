<?php

class TestController {

    private $itest;
    private $idbs;

    public function __construct(ITest $itest, IDBService $idbs) {
        $this->itest = $itest;
        $this->idbs = $idbs;
    }

    public function index() {
        echo 'Third: a request to the instantiated interface for each one. <br/><br/> ';
        $method = $this->itest->show() . $this->idbs->store() . '</br> This was made using dependency injection';
        echo 'Four: Here is the response from the services: <br/><br/>';
        echo $method;
        return '';
    }

}

?>