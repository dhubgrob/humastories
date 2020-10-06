<?php
    class Pages extends Controller {
        public function __construct() {
           
        }

        public function index() {

            $data = [
                'title' => 'HumaStories',
                'description' => "AMP Story generator for L'Humanité"
            ];

            $this->view('pages/index', $data);
        }

        public function about() {
            $data = ['title' => 'About Us',
            'description' => 'App to create AMP Stories'
        ];
            $this->view('pages/about', $data);
        }

    }
