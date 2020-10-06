<?php
class Story {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getStoriesByUserId($id){
        $this->db->query('SELECT * FROM stories WHERE id_user = :id_user');
        $this->db->bind(':id_user', $id);

        $results = $this->db->resultSet();

        return $results;
    }

}