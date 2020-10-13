<?php
class Upload
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllUploads()
    {

        $this->db->query('SELECT id, id_story, filename_background_img, filename_picture_img FROM story_pages');

        $results = $this->db->resultSet();

        return $results;
    }

    public function getPictureByFileName($filename)
    {
        $this->db->query('SELECT id, id_story, filename_background_img FROM story_pages WHERE filename_background_img = :filename_background_img');
        $this->db->bind(':filename_background_img', $filename);
        $result = $this->db->single();

        if ($result == false) {
            $this->db->query('SELECT id, id_story, filename_picture_img FROM story_pages WHERE filename_picture_img = :filename_picture_img');
            $this->db->bind(':filename_picture_img', $filename);
            $result = $this->db->single();
        }

        return $result;
    }
}