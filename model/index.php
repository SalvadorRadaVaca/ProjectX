<?php

class Model{
    private $Model;
    private $db;
    private $data;

    public function __construct(){
        $this->Model = array();
        $this->db = mysqli_connect('localhost', 'root', '', 'projectx');
    }

    public function insert($table, $data){
        $sql = "INSERT INTO " . $table . " VALUES (NULL, " . $data . ")";
        return mysqli_query($this->db, $sql);
    }

    public function select($table, $condition){
        $sql = "SELECT * FROM " . $table . " WHERE " . $condition . ";";
        return mysqli_query($this->db, $sql);
    }

    public function update($table, $data, $condition){
        $sql = "UPDATE " . $table . " SET " . $data . " WHERE " . $condition;
        return mysqli_query($this->db, $sql);
    }

}

?>