<?php
class Stories extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->storyModel = $this->model('Story');
    }

    public function index()
    {
        $stories = $this->storyModel->getStoriesByUserId($_SESSION['user_id']);
        $data = [
            'stories' => $stories
        ];

        $this->view('stories/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            // Image Upload

            if (isset($_FILES['linked_content_img'])) {
                if ($_FILES['linked_content_img']['error'] === 0) {
                    if ($_FILES['linked_content_img']['type'] == 'image/jpeg' or $_FILES['linked_content_img']['type'] == 'image/png') {
                        if ($_FILES['linked_content_img']['size'] < 3000000) {
                            $fileNameArray = explode('/', $_FILES['linked_content_img']['tmp_name']);
                            $fileName = $fileNameArray[count($fileNameArray) - 1];
                            move_uploaded_file($_FILES['linked_content_img']['tmp_name'], APPROOT2 . '/public/uploads/' . $fileName . '.' . pathinfo($_FILES['linked_content_img']['name'], PATHINFO_EXTENSION));
                            $fileNameImg = $fileName . '.' . pathinfo($_FILES['linked_content_img']['name'], PATHINFO_EXTENSION);
                        }
                    }
                } else {
                    $fileNameImg = '';
                }
            }

            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => htmlspecialchars(trim($_POST['title'])),
                'heading' => trim($_POST['heading']),
                'user_id' => $_SESSION['user_id'],
                'linked_content_title' => $_POST['linked_content_title'],
                'linked_content_url' => $_POST['linked_content_url'],
                'linked_content_img' => $fileNameImg,
                'title_err' => '',
                'heading_err' => ''
            ];

            // Validate data
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }
            if ($data['heading'] == 'heading') {
                $data['heading_err'] = 'Please choose heading';
            }

            // Make sure no errors
            if (empty($data['title_err']) && empty($data['heading_err'])) {
                // Validated
                if ($this->storyModel->addStory($data)) {
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

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get existing post from model
            $story = $this->storyModel->getStoryById($id);

            // Check for owner
            if ($story->user_id != $_SESSION['user_id']) {
                redirect('stories');
            }

            if ($this->storyModel->deleteStory($id)) {
                flash('post_message', 'Post Removed');
                redirect('stories');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('stories');
        }
    }

    public function preview($id)
    {

        // Get existing post from model
        echo 'hello this is story ' . $id;
    }



    public function edit($id)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Image Upload

            if (isset($_FILES['linked_content_img'])) {
                if ($_FILES['linked_content_img']['error'] === 0) {
                    if ($_FILES['linked_content_img']['type'] == 'image/jpeg' or $_FILES['linked_content_img']['type'] == 'image/png') {
                        if ($_FILES['linked_content_img']['size'] < 3000000) {
                            $fileNameArray = explode('/', $_FILES['linked_content_img']['tmp_name']);
                            $fileName = $fileNameArray[count($fileNameArray) - 1];
                            move_uploaded_file($_FILES['linked_content_img']['tmp_name'], APPROOT2 . '/public/uploads/' . $fileName . '.' . pathinfo($_FILES['linked_content_img']['name'], PATHINFO_EXTENSION));
                            $fileNameImg = $fileName . '.' . pathinfo($_FILES['linked_content_img']['name'], PATHINFO_EXTENSION);
                        }
                    }
                } else {
                    // Get unchanged picture filename
                    $story = $this->storyModel->getStoryById($id);
                    $fileNameImg = $story->linked_content_img;
                }
            }

            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $id,
                'title' => htmlspecialchars(trim($_POST['title'])),
                'heading' => trim($_POST['heading']),
                'user_id' => $_SESSION['user_id'],
                'linked_content_title' => $_POST['linked_content_title'],
                'linked_content_url' => $_POST['linked_content_url'],
                'linked_content_img' => $fileNameImg,
                'title_err' => '',
                'heading_err' => ''
            ];
            var_dump($_FILES);
            echo '<br>';
            var_dump($data);
            // Validate data
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }
            if (empty($data['heading'])) {
                $data['heading_err'] = 'Please enter heading';
            }

            // Make sure no errors
            if (empty($data['title_err']) && empty($data['heading_err'])) {
                // Validated
                if ($this->storyModel->editStory($data)) {
                    flash('story_message', 'Story Updated');
                    redirect('stories');
                } else {
                    die('Something went wrong');
                }
            }
        } else {
            $story = $this->storyModel->getStoryById($id);
            // inject story data in simple array

            $data = [
                'story-id' => intval($id),
                'story-title' => $story->title,
                'story-heading' => $story->heading,
                'story-userid' => $story->id_user,
                'story-linked-content-title' => $story->linked_content_title,
                'story-linked-content-url' => $story->linked_content_url,
                'story-linked-content-img' => $story->linked_content_img
            ];

            // Check for owner
            if ($story->id_user != $_SESSION['user_id']) {
                redirect('stories');
            }

            // prepare form for updating

            $this->view('stories/edit', $data);
        }
    }

    public function deletepic($id)
    {
        // check if owner
        $story = $this->storyModel->getStoryById($id);

        if ($story->id_user != $_SESSION['user_id']) {
            redirect('stories');
        }
        $this->storyModel->deletePic($id);
        redirect('stories/edit/' . $story->id);
    }
}