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
                'story-id' => $_POST['story-id'],
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
                    redirect('storypages/add');
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
}