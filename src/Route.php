<?php

namespace Src;
class Route
{
    public string|int|array|null|false $currentRoute;

    public function __construct()
    {
        $this->currentRoute = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    public static function getRout(): false|array|int|string|null
    {
        return (new static())->currentRoute;
    }
    public static function getResourse($route): false|string
    {
        $resourseIndex = mb_stripos($route, '{id}');

        if (!$resourseIndex) {
            return false;
        }

        $resourseValue = substr(self::getRout(), $resourseIndex);

        if ($limit = mb_stripos($resourseValue, '/')) {
            return substr($resourseValue, 0, $limit);
        }

        return $resourseValue ?: false;
    }

    public static function runCallback(string $route, callable|array $callback, ?string $middleware = null): void
    {
        if (gettype($callback) == 'array') {
            $resourseID = self::getResourse($route);
            if ($resourseID) {
                $route = str_replace('{id}', $resourseID, $route);
                if ($route == self::getRout()) {
                    self::middleware($middleware);
                    (new $callback[0])->{$callback[1]}($resourseID);
                    exit();
                }
            }

            if ($route == self::getRout()) {
                self::middleware($middleware);
                (new $callback[0])->{$callback[1]}();
                exit();
            }
        }
        $resourseID = self::getResourse($route);
        if ($resourseID) {
            $route = str_replace('{id}', $resourseID, $route);
            if ($route == self::getRout()) {
                self::middleware($middleware);
                $callback($resourseID);
                exit();
            }
        }

        if ($route == self::getRout()) {
            self::middleware($middleware);
            $callback();
            exit();
        }
    }

    public static function middleware(?string $middleware = null): void
    {
        if($middleware){
            $middlewareConfig = require '../config/middleware.php';
            if(is_array($middlewareConfig)){
                if (array_key_exists($middleware, $middlewareConfig)) {
                    $middlewareClass = $middlewareConfig[$middleware];
                    (new $middlewareClass)->handle();
                }
            }
        }
    }

    public static function getMethod(string $route, callable|array $callback, ?string $middleware = null): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            self::runCallback($route, $callback, $middleware);
        }
    }

    public static function postMethod(string $route, callable|array $callback, ?string $middleware = null): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            self::runCallback($route, $callback);
        }
    }

    public static function putMethod(string $route, callable|array $callback): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'PUT') {
            if (isset($_POST['_method']) && $_POST['_method'] == 'PUT' || $_SERVER['REQUEST_METHOD'] == 'PUT') {
                self::runCallback($route, $callback);
            }
        }
    }

    public static function deleteMethod(string $route, callable|array $callback): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            self::runCallback($route, $callback);
        }
    }

    public static function isAPIcall(): bool
    {
        return mb_stripos(self::getRout(), '/api') === 0;
    }

    public static function isTelegram(): bool
    {
        return mb_stripos(self::getRout(), '/telegram') === 0;
    }

    public static function NotFound(): void
    {
        if (self::isAPIcall()) {
            APIresponse(['error' => 'Not Found'], 404);
        }
        views('404');
    }
}