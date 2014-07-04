<?php
class Singleton //update singleton pattern in order to can obtain more singleton instances for different classes
{
    private static $instances = array();
    protected function __construct() {}

    public static function getInstance()
    {
        $cls = get_called_class(); // late-static-bound class name
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static;
        }
        return self::$instances[$cls];
    }
}
?>