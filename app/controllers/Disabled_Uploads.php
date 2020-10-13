<?php
class Uploads extends Controller
{
    public function __construct()
    {
        $this->uploadModel = $this->model('Upload');
    }

    public function index($filename)
    {
        $picture = $this->uploadModel->getPictureByFileName($filename);

        $data = [
            'picture' => $picture
        ];

        $this->view('uploads/index', $data);
    }
}