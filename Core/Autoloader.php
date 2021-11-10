<?php
set_exception_handler(function ($exception){
    echo "<br>Exception: " , $exception->getMessage(), "\n";
    echo "<br>Previous: " , $exception->getPrevious(), "\n";
    echo "<br>Code: " , $exception->getCode(), "\n";
    echo "<br>File: " , $exception->getFile(), "\n";
    echo "<br>Line: " , $exception->getLine(), "\n";
});



spl_autoload_register(function ($className){
    $path = str_replace('\\', DIRECTORY_SEPARATOR, dirname(__DIR__).DIRECTORY_SEPARATOR.$className.".php");

    if(!file_exists($path)){
        throw new Exception('Class '.$className.'Not Found !');
    }
    require ($path);
});