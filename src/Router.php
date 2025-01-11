<?php

namespace Src;

class Router {
    public string|array|int|null|false $currentRoute;
    public function __construct () {
        $this->currentRoute = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
    public static function getRoute (): false|array|int|string|null
    {
        return (new static())->currentRoute;
    }
    public static function getResource ($route): false|string
    {
        $resourceIndex = mb_stripos($route, '{id}');
        if (!$resourceIndex){
            return false;
        }
        $resourceValue = substr(self::getRoute(), $resourceIndex);
        if($limit = mb_stripos($resourceValue, '/')){
            return substr($resourceValue, 0, $limit);
        }
        return $resourceValue ?: false;
    }
    public static function get ($route, $callback,?string $middleware=null): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            self::extracted($route, $callback,$middleware);
        }
    }
    public static function post ($route, $callback,?string $middleware=null): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            self::extracted($route, $callback,$middleware);
        }
    }
    public static function putApi ($route, $callback,?string $middleware=null): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            self::extracted($route, $callback,$middleware);
        }
    }

    public static function put ($route, $callback,?string $middleware=null): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['_method']) && strtoupper($_POST['_method']) === 'PUT') {
            self::extracted($route, $callback,$middleware);
        }
    }
    public static function delete ($route, $callback,?string $middleware=null): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            self::extracted($route, $callback,$middleware);
        }
    }
    public static function extracted($route, $callback,?string $middleware=null): void
    {
        if (gettype($callback) === 'array') {
            $resourceValue = self::getResource($route);
            if ($resourceValue) {
                $resourceRoute = str_replace('{id}', $resourceValue, $route);
                if ($resourceRoute == self::getRoute()) {
                    self::middleware($middleware);
                    (new $callback[0])->{$callback[1]}();
                    exit();
                }
            }
            if ($route == self::getRoute()) {
                (new $callback[0])->{$callback[1]}();
                exit();
            }
        }
        $resourceValue = self::getResource($route);
        if ($resourceValue) {
            $resourceRoute = str_replace('{id}', $resourceValue, $route);
            if ($resourceRoute == self::getRoute()) {
                $callback($resourceValue);
                exit();
            }
        }
        if ($route == self::getRoute()) {
            $callback();
            exit();
        }
    }

    public static function middleware(?string $middleware=null): void{
        if ($middleware){
            $middlewareConfig = require 'config/middleware.php';
            if (is_array($middlewareConfig)){
                if (array_key_exists($middleware, $middlewareConfig)){
                    $middlewareClass = $middlewareConfig[$middleware];
                    (new $middlewareClass())->handle();
                }
            }
        }
    }
    public static function isApiCall(): bool{
        return mb_stripos(self::getRoute(), '/api') === 0;
    }
    public static function notFound(): void{
        if (self::isApiCall()) {
            apiResponse(['error' => 'Not found']);
        }
        view('404');
    }
}