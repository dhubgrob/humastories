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

    public function countStorypagesForStory($id)
    {
        $this->db->query('SELECT COUNT(*) FROM story_pages WHERE id_story = :id_story');
        $this->db->bind(':id_story', $id);
        $results = $this->db->singleArr();
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

        $this->db->query('SELECT sub_id FROM story_pages WHERE id_story=:id_story ORDER BY sub_id DESC');
        $this->db->bind(':id_story', $data['story-id']);
        $tmp_sub_id = $this->db->singleArr();
        if ($tmp_sub_id == false) {
            $sub_id = 1;
        } else {
            $sub_id = intval($tmp_sub_id[0]) + 1;
        }



        $this->db->query('INSERT INTO story_pages (
            id_story,
            cover,
            sub_id, 
            title, 
            body, 
            filename_background_img,
            credits_background_img, 
            animation_background_img, 
            animation_background_img_duration,
            size_background_img, 
            size_position_text_block, 
            animation_text_block,
            animation_text_block_duration, 
            id_user) 
            VALUES (
            :id_story,
            :cover,
            :sub_id, 
            :title, 
            :body, 
            :filename_background_img, 
            :credits_background_img,
            :animation_background_img,
            :animation_background_img_duration,
            :size_background_img, 
            :size_position_text_block,  
            :animation_text_block,
            :animation_text_block_duration, 
            :id_user)');

        $this->db->bind(':id_story', $data['story-id']);
        $this->db->bind(':cover', $data['cover']);
        $this->db->bind(':sub_id', $sub_id);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body-text']);
        $this->db->bind(':filename_background_img', $data['background-img']);
        $this->db->bind(':size_background_img', $data['background-size']);
        $this->db->bind(':credits_background_img', $data['background-credits']);
        $this->db->bind(':animation_background_img', $data['background-animation']);
        $this->db->bind(':animation_background_img_duration', $data['background-animation-duration']);
        $this->db->bind(':size_position_text_block', $data['text-block-size-position']);
        $this->db->bind(':animation_text_block', $data['text-block-animation']);
        $this->db->bind(':animation_text_block_duration', $data['text-block-animation-duration']);
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
                            size_background_img = :size_background_img,
                            credits_background_img = :credits_background_img,
                            animation_background_img = :animation_background_img,
                            animation_background_img_duration = :animation_background_img_duration,
                            size_position_text_block = :size_position_text_block,
                            animation_text_block = :animation_text_block,
                            animation_text_block_duration = :animation_text_block_duration  
                            WHERE id = :id');

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body-text']);
        $this->db->bind(':filename_background_img', $data['background-img']);
        $this->db->bind(':size_background_img', $data['background-size']);
        $this->db->bind(':credits_background_img', $data['background-credits']);
        $this->db->bind(':animation_background_img', $data['background-animation']);
        $this->db->bind(':animation_background_img_duration', $data['background-animation-duration']);
        $this->db->bind(':size_position_text_block', $data['text-block-size-position']);
        $this->db->bind(':animation_text_block', $data['text-block-animation']);
        $this->db->bind(':animation_text_block_duration', $data['text-block-animation-duration']);


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

        if ($above_sub_id != false && $sub_id_int > 2) {

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

    public function deleteBg($id)
    {
        $this->db->query('UPDATE story_pages SET filename_background_img = :filename_background_img WHERE id = :id');
        $this->db->bind(':filename_background_img', '');
        $this->db->bind(':id', $id);
        $this->db->execute();

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}