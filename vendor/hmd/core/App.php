<?php


namespace vendor\hmd\core;

use vendor\hmd\core\Registry;

/**
 * Description of App
 *
 * @author eugenie
 */
class App {
    
    public static $app;
    
    public function __construct() {
        self::$app = Registry::instance();
        new ErrorHandler();
    }
}
