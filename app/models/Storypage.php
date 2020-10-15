<?php
class Storypage
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getStorypagesByStoryId($id)
    {
        $this->db->query('SELECT * FROM story_pages WHERE id_story = :id_story ORDER BY sub_id ASC');
        $this->db->bind(':id_story', $id);

        $results = $this->db->resultSet();

        return $results;
    }


    // Probably useless now :
    public function getLastStoryIdByUserId($id)
    {
        $this->db->query('SELECT id FROM stories WHERE id_user = :id_user ORDER BY created_at DESC LIMIT 1');
        $this->db->bind(':id_user', $id);
        $result = $this->db->single();

        return intval($result->id);
    }

    public function getStorypageById($id)
    {
        $this->db->query('SELECT * FROM story_pages WHERE id = :id');
        $this->db->bind(':id', $id);
        $result = $this->db->single();

        return $result;
    }

    public function addStoryPage($data)
    {
        // Get sub_id

        // get higher sub_id for story

        $this->db->query('SELECT sub_id FROM story_pages WHERE id_story=:id_story ORDER BY sub_id DESC');
        $this->db->bind(':id_story', $data['story-id']);
        $tmp_sub_id = $this->db->singleArr();
        $highest_sub_id = intval($tmp_sub_id[0]);

        $this->db->query('INSERT INTO story_pages (
            id_story,
            sub_id, 
            title, 
            body, 
            filename_background_img,
            credits_background_img, 
            animation_background_img, 
            filename_img, 
            credits_img, 
            animation_img, 
            size_text_block, 
            position_text_block, 
            animation_text_block, 
            id_user) 
            VALUES (
            :id_story,
            :sub_id, 
            :title, 
            :body, 
            :filename_background_img, 
            :credits_background_img,
            :animation_background_img, 
            :filename_img, 
            :credits_img, 
            :animation_img, 
            :size_text_block, 
            :position_text_block, 
            :animation_text_block, 
            :id_user)');

        $this->db->bind(':id_story', $data['story-id']);
        $this->db->bind(':sub_id', $highest_sub_id + 1);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body-text']);
        $this->db->bind(':filename_background_img', $data['background-img']);
        $this->db->bind(':credits_background_img', $data['background-credits']);
        $this->db->bind(':animation_background_img', $data['background-animation']);
        $this->db->bind(':filename_img', $data['picture-img']);
        $this->db->bind(':credits_img', $data['picture-credits']);
        $this->db->bind(':animation_img', $data['picture-animation']);
        $this->db->bind(':size_text_block', $data['text-block-size']);
        $this->db->bind(':position_text_block', $data['text-block-position']);
        $this->db->bind(':animation_text_block', $data['text-block-animation']);
        $this->db->bind(':id_user', $data['id_user']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteStorypage($id)
    {

        $this->db->query('DELETE FROM story_pages WHERE id = :id');
        $this->db->bind(':id', $id);


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function editStoryPage($data)
    {

        $this->db->query('  UPDATE story_pages 
                            SET 
                            title = :title, 
                            body = :body, 
                            filename_background_img = :filename_background_img,
                            credits_background_img = :credits_background_img,
                            animation_background_img = :animation_background_img,
                            filename_img = :filename_img,
                            credits_img = :credits_img,
                            animation_img = :animation_img,
                            size_text_block = :size_text_block,
                            position_text_block = :position_text_block,
                            animation_text_block = :animation_text_block  
                            WHERE id = :id');

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body-text']);
        $this->db->bind(':filename_background_img', $data['background-img']);
        $this->db->bind(':credits_background_img', $data['background-credits']);
        $this->db->bind(':animation_background_img', $data['background-animation']);
        $this->db->bind(':filename_img', $data['picture-img']);
        $this->db->bind(':credits_img', $data['picture-credits']);
        $this->db->bind(':animation_img', $data['picture-animation']);
        $this->db->bind(':size_text_block', $data['text-block-size']);
        $this->db->bind(':position_text_block', $data['text-block-position']);
        $this->db->bind(':animation_text_block', $data['text-block-animation']);


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }



    public function downStorypage($id)
    {
        // get sub_id from clicked storypage

        $id = intval($id);
        $this->db->query('SELECT sub_id FROM story_pages WHERE id = :id');
        $this->db->bind(':id', $id);
        $sub_id = $this->db->singleArr();
        $sub_id_int = intval($sub_id[0]);

        // get sub_id from row below

        $this->db->query('SELECT id, sub_id, title FROM story_pages WHERE sub_id > :sub_id ORDER BY sub_id ASC');
        $this->db->bind(':sub_id', $sub_id_int);
        $below_sub_id = $this->db->singleArr();
        $below_sub_id_int = intval($below_sub_id[1]);
        $below_id_int = intval($below_sub_id[0]);

        if ($below_sub_id != false) {

            // update sub_id of row below
            $this->db->query('UPDATE story_pages SET sub_id = :sub_id WHERE id = :id');
            $this->db->bind(':sub_id', $sub_id_int);
            $this->db->bind(':id', $below_id_int);
            $this->db->execute();

            // update sub_id of clicked row
            $this->db->query('UPDATE story_pages SET sub_id = :sub_id WHERE id = :id');
            $this->db->bind(':sub_id', $below_sub_id_int);
            $this->db->bind(':id', $id);
            $this->db->execute();
        }
    }

    public function upStorypage($id)
    {
        // get sub_id from clicked storypage

        $id = intval($id);
        $this->db->query('SELECT sub_id FROM story_pages WHERE id = :id');
        $this->db->bind(':id', $id);
        $sub_id = $this->db->singleArr();
        $sub_id_int = intval($sub_id[0]);

        // get sub_id from row above

        $this->db->query('SELECT id, sub_id, title FROM story_pages WHERE sub_id < :sub_id ORDER BY sub_id DESC');
        $this->db->bind(':sub_id', $sub_id_int);
        $above_sub_id = $this->db->singleArr();
        $above_sub_id_int = intval($above_sub_id[1]);
        $above_id_int = intval($above_sub_id[0]);

        if ($above_sub_id != false) {

            // update sub_id of row above
            $this->db->query('UPDATE story_pages SET sub_id = :sub_id WHERE id = :id');
            $this->db->bind(':sub_id', $sub_id_int);
            $this->db->bind(':id', $above_id_int);
            $this->db->execute();

            // update sub_id of clicked row
            $this->db->query('UPDATE story_pages SET sub_id = :sub_id WHERE id = :id');
            $this->db->bind(':sub_id', $above_sub_id_int);
            $this->db->bind(':id', $id);
            $this->db->execute();
        }
    }
}