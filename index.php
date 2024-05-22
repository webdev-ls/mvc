<?php 
require_once 'core/DefaultModel.php';
require_once 'core/DefaultController.php';
$url = $_SERVER['REQUEST_URI'];
$segments = !empty(trim($url,"/")) ? explode("/",trim($url,"/")) : [];

$controller = $segments[0] ?? 'home';
$method = $segments[1] ?? 'index';

if(file_exists('app/controllers/'.$controller.".php")){
    require_once 'app/controllers/'.$controller.".php";
    $app = new $controller();
    if(method_exists($app,$method)){
        $app->$method();
    }else{
        echo "404";
    }
}else{
    echo "404";
}



?>