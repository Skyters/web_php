<?php
//тут используется специальная функция spl_autoload_register, которая регистрирует функцию которая 
//будет вызываться когда в коде php будет упоминаться класс который не импортирован явно.
spl_autoload_register(function($class) {
    $fn = __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';
    if (file_exists($fn)) {
	    require_once $fn; 
    }
});