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

    public function getStoryById($id){
        $this->db->query('SELECT * FROM stories WHERE id = :id');
        $this->db->bind(':id', $id);

        $results = $this->db->resultSet();

        return $results;
    }

    public function addStory($data){

        $this->db->query('INSERT INTO stories (title, heading, id_user) VALUES (:title, :heading, :id_user)');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':heading', $data['heading']);
        $this->db->bind(':id_user', $_SESSION['user_id']);

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }   
    }

    public function deleteStory($id) {  
        $this->db->query('DELETE FROM stories WHERE id = :id');
        $this->db->bind(':id', $id);


        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }   
    }

    public function editStory($data) { 

            $this->db->query('UPDATE stories SET title = :title, heading = :heading WHERE id = :id');
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':heading', $data['heading']);
            
    
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
    }

}