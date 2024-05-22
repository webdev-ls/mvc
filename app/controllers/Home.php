<?php

class Home extends DefaultController {

    public function __construct(){
        parent::__construct();
        $this->loadDatabase();
        $this->loadModel([
            "AppUi" => "ui"
        ]);
    }

    public function index(){
        $visitors = $this->ui->getVisitorCount();
        $this->loadView("homepage",[
            "visitors" => $visitors
        ]);
    }

    public function dashboard(){
        echo "Dashboard";
    }

    public function editProfile($id){
        echo "Edit Profile";
    }
}

?>