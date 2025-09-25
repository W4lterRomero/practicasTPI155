<?php
namespace lib;


class Route{
    private static $routes = [];
    private static $URL_BASE="/mvc_clase/public";


    public static function get($uri, $callback){
        self::$routes["GET"][self::$URL_BASE.$uri]=$callback;
    }
    public static function post($uri, $callback){
        self::$routes["POST"][self::$URL_BASE.$uri]=$callback;
    }


   public static function dispatch(){
        $uri = $_SERVER["REQUEST_URI"];
       
        $method = $_SERVER["REQUEST_METHOD"];
        //echo "Url".$uri."<br>";
        //var_dump(self::$routes);
        foreach(self::$routes[$method] as $url=>$funcion){
            if(strpos($url, ":")!==false){
                $url = preg_replace("#:[a-zA-Z]+#","([a-zA-Z]+)",$url);
                //echo $url;
                //return;
            }


            if(preg_match("#^$url$#",$uri, $matches)){
                $params = array_slice($matches,1);
                //echo json_encode($params);
                $funcion(...$params);
                return;
            }
        }
        echo "404";
    }


}




?>
