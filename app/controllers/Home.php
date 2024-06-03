<?php

class Home extends DefaultController {

    public function __construct(){
        parent::__construct();
        $this->loadDatabase();
        $this->loadModel([
            "AppUi" => "ui"
        ]);
        $this->loadHelper("visitor");
    }

    public function index(){
        helper();
        $visitors = $this->ui->getVisitorCount();
        $this->loadView("homepage",[
            "visitors" => $visitors
        ]);
    }

    public function dashboard(){
        // $this->db->select("*");
        // $this->db->from("users");
        // $this->db->where(["uid"=> 1, "name" => 1,"role" => "iser"]);
        // $result = $this->db->get();
        $this->db->insert("users",[
            "uid" => 1,
            "role" => 200,
            "name" => "varinder",
            "sakjbv" => "sfbfe",
            "adsvdsv" => "Dsvfrebre"
        ]);
        echo $this->db->last_query();
        echo "   Dashboard";
    }

    public function editProfile($id){
        echo "Edit Profile";
    }
}

?>