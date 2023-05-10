<?php
include "routes.php";

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

function route($uri, $routes) {
    if(array_key_exists($uri, $routes)){
        require_once $routes[$uri];
    }else{
        abort();
    }
}

function abort($code = 404){
     http_response_code($code);
     require_once "../views/{$code}.php";
     die();
}


route($uri, $routes);
?>