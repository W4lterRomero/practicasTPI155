<?php
namespace core;
    class Route{

        private static $routes = [];
        public static function get($url, $callback){
            self::$routes["GET"][$url] = $callback;
        }
        public static function post($url,$callback){
            self::$routes["POST"][$url] = $callback;
        }

        public static function dispatch(){
            $uri = $_SERVER["REQUEST_URI"];
            $method = $_SERVER["REQUEST_METHOD"];

            // Quitar el path base
            $base = "/practicaMVC/public";
            if (strpos($uri, $base) === 0) {
                $uri = substr($uri, strlen($base));
            }
            // Quitar parámetros GET
            $uri = strtok($uri, '?');
            if ($uri === "") $uri = "/";

            foreach(self::$routes[$method] as $url => $funcion){
                if($uri == $url){
                    $funcion();
                    return;
                }
            }
            echo "404";
        }
    };

?>