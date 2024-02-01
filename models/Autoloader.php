<?php

namespace App\Models;

class Autoloader
{
    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    static function autoload($class)
    {
        // echo $class;
        if (strpos($class, __NAMESPACE__ . '\\') === 0) {
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            // echo $class;
            $class = str_replace('\\', '/', $class);
            // echo $class;
            require __DIR__ . '/' . $class . '.php';
        }
    }
}