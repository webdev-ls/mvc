<?php
class AppUi extends DefaultModel {


    public function __construct(){
        parent::__construct();
        $this->loadDatabase();
    }


    public function getVisitorCount(){
        $this->db->select("*");
        $this->db->from("users");
        $query = $this->db->get();
        $result = $this->db->result_array($query);
        return count($result);
    }
}


?>