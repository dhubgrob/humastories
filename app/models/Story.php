<?php
class Story
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllStoriesWithUsernames()
    {
        $this->db->query('SELECT stories.id, stories.title, stories.heading, stories.linked_content_title, stories.linked_content_url, stories.linked_content_img, stories.id_user, stories.created_at, users.username FROM stories INNER JOIN users ON stories.id_user = users.id');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getStoriesByUserId($id)
    {
        $this->db->query('SELECT * FROM stories WHERE id_user = :id_user');
        $this->db->bind(':id_user', $id);

        $results = $this->db->resultSet();

        return $results;
    }

    public function getStoryById($id)
    {
        $this->db->query('SELECT * FROM stories WHERE id = :id');
        $this->db->bind(':id', $id);

        $results = $this->db->single();

        return $results;
    }

    public function getHighestStoryId()
    {
        $this->db->query('SELECT id FROM stories ORDER BY id DESC LIMIT 1');
        $results = $this->db->singleArr();
        return intval($results[0]);
    }

    public function addStory($data)
    {

        $this->db->query('INSERT INTO stories (title, heading, id_user, linked_content_title, linked_content_url, linked_content_img) VALUES (:title, :heading, :id_user, :linked_content_title, :linked_content_url, :linked_content_img)');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':heading', $data['heading']);
        $this->db->bind(':id_user', $_SESSION['user_id']);
        $this->db->bind(':linked_content_title', $data['linked_content_title']);
        $this->db->bind(':linked_content_url', $data['linked_content_url']);
        $this->db->bind(':linked_content_img', $data['linked_content_img']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteStory($id)
    {
        $this->db->query('DELETE FROM stories WHERE id = :id');
        $this->db->bind(':id', $id);


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function editStory($data)
    {
        $this->db->query('UPDATE stories SET title = :title, heading = :heading, linked_content_title = :linked_content_title, linked_content_url = :linked_content_url, linked_content_img =  :linked_content_img WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':heading', $data['heading']);
        $this->db->bind(':linked_content_title', $data['linked_content_title']);
        $this->db->bind(':linked_content_url', $data['linked_content_url']);
        $this->db->bind(':linked_content_img', $data['linked_content_img']);


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePic($id)
    {
        $this->db->query('UPDATE stories SET linked_content_img = :linked_content_img WHERE id = :id');
        $this->db->bind(':linked_content_img', '');
        $this->db->bind(':id', $id);
        $this->db->execute();

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}