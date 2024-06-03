<?php
class Db {

    public $conn;

    private $select;
    private $where;
    private $from;
    private $update;
    private $insert;

    public function __construct($hostname,$username,$password,$dbname){
        $this->conn = new Mysqli($hostname,$username,$password,$dbname);
    }

    public function last_query(){
       return $this->last_query;
    }
    public function run($query){
        $this->last_query = $query;
        $result = $this->conn->query($query);
        return $result;
    }

    public function result_array($result){
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function row_array($result){
        $data = $result->fetch_array(MYSQLI_ASSOC);
        return $data;
    }

    public function get(){
        $sql = $this->select. $this->from . $this->where;
        return $this->run($sql);
    }

    public function from($from){
        $this->from = " FROM ".$from;
    }

    public function select($select){
        $this->select = "SELECT ".$select;
    }
    
    public function where(){
        $args = func_get_args();
        if(is_array($args[0])){
            foreach($args[0] as $key => $value){
                $this->createWhere([
                    $key,$value
                ]);
            }
        }else{
            $this->createWhere($args);
        }
            
    }
        
    private function createWhere($args){
        // print_r($args); 
        $args[1] = $this->conn->real_escape_string($args[1]);
        if(empty($this->where)){
            $this->where .= " WHERE `".$args[0]."` = '".$args[1]."' ";
        }else{
            $this->where .= "AND `".$args[0]."` = '".$args[1]."' ";
        }
    }

    public function update($table,$data){
        $string = "UPDATE `$table` SET ";
        foreach($data as $col => $value){
            // $string.= "`".$col."` = '".$value."'";
            $string.= "`$col` = '$value' ,";
        }
        $string = rtrim($string,",");
        $this->update = $string;
        return $this->run($this->update . $this->where);
    }

    public function delete($table){
        $this->delete = "DELETE FROM $table ";
        return $this->run($this->delete . $this->where);
    }

    public function insert($table,$data){
        $this->insert = "INSERT INTO $table (";
        $fieldNames = array_keys($data); 
        $this->insert .= "`".implode("`,`",$fieldNames)."`) VALUES(";
        $fieldData = array_values($data); 
        // escape strings here using real escape string
        $this->insert .= "'".implode("','",$fieldData)."') ";
        $this->run($this->insert);
        return $this->conn->insert_id;
    }

    public function __destruct(){
        $this->conn->close();
    }
}
?>