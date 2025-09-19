<?php

namespace lib;

class Route{
    private static $routes = [];
    private static $URL_BASE = "mvc_clase/public/";

    public static function get($url,$callback){
        self::$routes["GET"][self::$URL_BASE.$url]=$callback;

    }
    public static function post($url,$callback){
        self::$routes["POST"][self::$URL_BASE.$url]=$callback;

    }

    public static function dispatch(){
        $url = $_SERVER["REQUEST_METHOD"];
        $method = $_SERVER["REQUEST_METHOD"];

        echo $url;
        echo $method;

        foreach (self::$routes[$method] as $url=>$funcion) {
            if($url == $url){
                $funcion();
                return;
            }

            echo "404";
        }
    }
    
}


?>