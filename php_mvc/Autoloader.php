<?php

function __autoload($class_name) {
    //class directories
    $directories = array(
        'System/',
        'System/Controllers/',
        'System/Routes/',
        'System/InjectContainer/',
        'Controllers/',
        'Models/',
    );

    //for each directory
    foreach ($directories as $directory) {
        //see if the file exists
        if (file_exists($directory . $class_name . '.php')) {
            require_once($directory . $class_name . '.php');
            //only require the class once
            return;
        }
    }
}

