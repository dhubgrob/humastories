<?php
class Pages extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        if (isLoggedIn()) {
            redirect('stories');
        }
        $data = [
            'title' => 'HumaStories',
            'description' => "Un générateur de stories AMP pour L'Humanité"
        ];

        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About Us',
            'description' => 'App to create AMP Stories'
        ];
        $this->view('pages/about', $data);
    }
}