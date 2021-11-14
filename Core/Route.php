<?php
namespace App\Core;

class Route {
    private $routes = [];
    protected static array $instances;
    protected string $Home = 'HOME';


    protected function get(array $route) {
        if($route[0] == '/'){
            $route[0] = $this->Home;
        }
        $this->routes['get'][ltrim($route[0], '/')] = $route[1];
    }
    protected function post(array $route) {
        if($route[0] == '/'){
            $route[0] = $this->Home;
        }
        $this->routes['post'][ltrim($route[0], '/')] = $route[1];
    }

    protected function resolve()
    {
        $controller = ltrim($_SERVER['REQUEST_URI'], '/');
        if(empty( $controller) ){
            $controller = $this->Home;
        }
        $method = strtolower(ltrim($_SERVER['REQUEST_METHOD']));
        if (isset($this->routes[$method][$controller])){
            $class = $this->routes[$method][$controller];
            $object =  new $class[0]();
            $object->{$class[1]}();
        }

    }

    public static function __callStatic($method, $args)
    {

        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }
        return self::$instances[$cls]->{$method}($args);

    }

}