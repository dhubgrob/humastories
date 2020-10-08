<?php
class Stories extends Controller {
    public function __construct() {
        if(!isLoggedIn()){
        redirect('users/login');
        }

        $this->storyModel = $this->model('Story');
    }

    public function index(){
        $stories = $this->storyModel->getStoriesByUserId($_SESSION['user_id']);
        $data = [
            'stories' => $stories
        ];

        $this->view('stories/index', $data);
    }

    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => trim($_POST['title']),
                'heading' => trim($_POST['heading']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'heading_err' => ''
            ];

            // Validate data
            if(empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }
            if($data['heading'] == 'heading') {
                $data['heading_err'] = 'Please choose heading';
            }

            // Make sure no errors
            if(empty($data['title_err']) && empty($data['heading_err'])){
                // Validated
                if($this->storyModel->addStory($data)){
                    flash('story_message', 'Story Added');
                    redirect('storypages');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load the view with errors
                $this->view('stories/add', $data);
            }

            
        } else {
            $data = [
                'title' => '',
                'heading' => ''
            ];
            $this->view('stories/add', $data);
        }
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Get existing post from model
            $story = $this->storyModel->getStoryById($id);

            // Check for owner
            if($story->user_id != $_SESSION['user_id']){
                redirect('stories');
            }

            if($this->storyModel->deleteStory($id)) {
                flash('post_message', 'Post Removed');
                redirect('stories');
            } else {
                die('Something went wrong');
            }

        } else {
            redirect('stories');
        }
    }
}