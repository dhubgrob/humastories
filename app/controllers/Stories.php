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
}