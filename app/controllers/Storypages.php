<?php
class Storypages extends Controller {
    public function __construct() {
        if(!isLoggedIn()){
        redirect('users/login');
        }

        $this->storypageModel = $this->model('Storypage');
        $this->storyModel = $this->model('Story');
    }

    public function index(){

        // if story already created previously...
        if(count(explode("/", $_GET['url']))>= 2) {
            $storyId = intval(explode("/", $_GET['url'])[1]);
        } else {
            $storyId = $this->storypageModel->getLastStoryIdByUserId($_SESSION['user_id']);
        }

        $storypages = $this->storypageModel->getStorypagesByStoryId($storyId);
        $story = $this->storyModel->getStoryById($storyId);
        
        $data = [
            'story' => $story,
            'storypages' => $storypages
        ];

        $this->view('storypages/index', $data);
    }

    public function add(){

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            
            $storyId = intval(getLastElementOfUrl());
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'story-id' => intval($_POST['story-id']),
                'title' => $_POST['title'],
                'body-text' => $_POST['body-text'],
                'background-credits' => $_POST['background-credits'],
                'background-animation' => $_POST['background-animation'],
                'picture-credits' => $_POST['picture-credits'],
                'picture-animation' => $_POST['picture-animation'],
                'text-block-size' => $_POST['text-block-size'],
                'text-block-position' => $_POST['text-block-position'],
                'text-block-animation' => $_POST['text-block-animation'],
                'background-img' => $_FILES['background-img']['tmp_name'],  
                'picture-img' => $_FILES['picture-img']['tmp_name'],
                'id_user' => intval($_SESSION['user_id'])         
            ];

            var_dump($data);
      
            // Make sure no errors
            if(empty($data['title_err']) && empty($data['heading_err'])){
                // Validated
                if($this->storypageModel->addStorypage($data)){
                    flash('storypage_message', 'Story Page Added');
                    redirect('storypages');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load the view with errors
                $this->view('storypages/add', $data);
            }

            
        } else {
            $data = [
                'title' => '',
                'heading' => ''
            ];
            $this->view('storypages/add', $data);
        }
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            echo'yo';
            // Get existing post from model
            $storypage = $this->storypageModel->getStorypageById($id);
            var_dump($storypage);
            // Check for owner
            if($storypage->user_id != $_SESSION['user_id']){
                redirect('storypages');
            }

            if($this->storypageModel->deleteStorypage($id)) {
                flash('post_message', 'Post Removed');
                redirect('storypages');
            } else {
                die('Something went wrong');
            }

        } else {
            redirect('storypages');
        }
    }

    public function edit($id){

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'id' => $_POST['id'],
                'story-id' => intval($_POST['story-id']),
                'title' => $_POST['title'],
                'body-text' => $_POST['body-text'],
                'background-credits' => $_POST['background-credits'],
                'background-animation' => $_POST['background-animation'],
                'picture-credits' => $_POST['picture-credits'],
                'picture-animation' => $_POST['picture-animation'],
                'text-block-size' => $_POST['text-block-size'],
                'text-block-position' => $_POST['text-block-position'],
                'text-block-animation' => $_POST['text-block-animation'],
                'background-img' => $_FILES['background-img']['tmp_name'],  
                'picture-img' => $_FILES['picture-img']['tmp_name'],
                'id_user' => intval($_SESSION['user_id'])         
            ];

            var_dump($data);
            // Validate data
            

            // Make sure no errors
            
                // Validated
                if($this->storypageModel->editStorypage($data)){
                    flash('storypage_message', 'Storypage added Updated');
                    redirect('storypages/'.$data['story-id']);
                } else {
                    die('Something went wrong');
                }
            
        } else {
        $storypage = $this->storypageModel->getStorypageById($id);
        // inject story data in simple array
 
       
      
        $data = [
            'id' => $storypage->id,
            'story-id' => $storypage->id_story,
            'title' => $storypage->title,
            'body-text' => $storypage->body,
            'background-credits' => $storypage->credits_background_img,
            'background-animation' => $storypage->animation_background_img,
            'picture-credits' => $storypage->credits_img,
            'picture-animation' => $storypage->animation_img,
            'text-block-size' => $storypage->size_text_block,
            'text-block-position' => $storypage->position_text_block,
            'text-block-animation' => $storypage->animation_text_block,
            'background-img' => $storypage->filename_background_img,  
            'picture-img' => $storypage->filename_img,
            'id_user' => $storypage->id_user      
        ];

        // Check for owner
        if($storypage->id_user != $_SESSION['user_id']){
            redirect('storypages');
        }

        // prepare form for updating

        $this->view('storypages/edit', $data);

        }







    }
    
}

    
