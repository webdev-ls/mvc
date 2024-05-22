<?php 

require_once 'config.php';
require_once 'Db.php';

class App {

    public function __construct(){

    }
    
    public function loadDatabase(){
        global $config;
        if(!isset($this->db)){
            $this->db = new Db($config['hostname'],$config['username'],$config['password'],$config['dbname']);
        }
    }

    public function loadModel($models){
        /* Sample
        $model = [
            "AppUi" => "ui",
            "Users" => "temp"
        ]
        **/
        foreach($models as $model => $instanceName){
            require_once 'app/models/'.$model.'.php';
            $this->{$instanceName} = new $model();
        }
    }

    public function loadView($viewName,$data = []){
        require_once 'app/views/'.$viewName.'.php';
    }

    public function getConfigItem($item){
        global $config;
        return isset($config[$item]) ? $config[$item] : false;
    }

    public function baseUrl(){
        global $config;
        return isset($config['baseUrl']) ? $config['baseUrl'] : false;
    }

}



?>