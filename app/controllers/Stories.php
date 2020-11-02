<?php
class Stories extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->storyModel = $this->model('Story');
        $this->storypageModel = $this->model('Storypage');
    }

    public function index()
    {
        if ($_SESSION['user_username'] != 'fchaillou') {
            $stories = $this->storyModel->getStoriesByUserId($_SESSION['user_id']);
        } else {
            $stories = $this->storyModel->getAllStoriesWithUsernames();
        }
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
                    if (in_array(mime_content_type($_FILES['linked_content_img']['tmp_name']), ['image/png', 'image/jpeg'])) {
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
                'heading_err' => '',
                'linked_content_title_err' => '',
                'linked_content_url_err' => ''
            ];

            // Validate data
            if (empty($data['title'])) {
                $data['title_err'] = 'Oups ! Merci de choisir un titre...';
            }
            if (($data['heading']) == 'rubrique') {
                $data['heading_err'] = 'On dirait que vous avez oublié de choisir une rubrique...';
            }
            if (empty($data['linked_content_title'])) {
                $data['linked_content_title_err'] = 'Merci de choisir un article de l\'Humanité ;-)';
            }
            if (empty($data['linked_content_url'])) {
                $data['linked_content_url_err'] = 'Houston, il nous faut une URL pour l\'article !';
            }

            // Make sure no errors
            if (empty($data['title_err']) && empty($data['heading_err']) && empty($data['linked_content_title_err']) && empty($data['linked_content_url_err'])) {
                // Validated
                if ($this->storyModel->addStory($data)) {
                    $storyId = $this->storyModel->getHighestStoryId();
                    flash('story_message', 'Story créée avec succès !');
                    redirect('storypages/' . $storyId);
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
            if ($_SESSION['user_username'] != 'fchaillou' and $story->id_user != $_SESSION['user_id']) {
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

        $storypages = $this->storypageModel->getStorypagesByStoryId($id);
        $story = $this->storyModel->getStoryById($id);
        $scriptTagOpen = 'script type="application/json"';
        $scriptTagClose = 'script';

        $data = [
            'storypages' => $storypages,
            'story' => $story,
            'script-tag-open' => $scriptTagOpen,
            'script-tag-close' => $scriptTagClose
        ];


        $this->view('stories/preview', $data);
    }



    public function edit($id)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Image Upload

            if (isset($_FILES['linked_content_img'])) {
                if ($_FILES['linked_content_img']['error'] === 0) {
                    if (in_array(mime_content_type($_FILES['linked_content_img']['tmp_name']), ['image/png', 'image/jpeg'])) {
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
                'heading_err' => '',
                'linked_content_title_err' => '',
                'linked_content_url_err' => ''
            ];

            // Validate data
            if (empty($data['title'])) {
                $data['title_err'] = 'Oups ! Merci de choisir un titre...';
            }
            if (($data['heading']) == 'rubrique') {
                $data['heading_err'] = 'On dirait que vous avez oublié de choisir une rubrique...';
            }
            if (empty($data['linked_content_title'])) {
                $data['linked_content_title_err'] = 'Merci de choisir un article de l\'Humanité ;-)';
            }
            if (empty($data['linked_content_url'])) {
                $data['linked_content_url_err'] = 'Houston, il nous faut une URL pour l\'article !';
            }


            // Make sure no errors
            if (empty($data['title_err']) && empty($data['heading_err']) && empty($data['linked_content_title_err']) && empty($data['linked_content_url_err'])) {
                // Validated
                if ($this->storyModel->editStory($data)) {
                    flash('story_message', 'Story modifiée avec succès !');
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
            if ($_SESSION['user_username'] != 'fchaillou' and $story->id_user != $_SESSION['user_id']) {
                redirect('stories');
            }

            // prepare form for updating

            $this->view('stories/edit', $data);
        }
    }

    public function deletepic($id)
    {
        $story = $this->storyModel->getStoryById($id);
        // Check for owner
        if ($_SESSION['user_username'] != 'fchaillou' and $story->id_user != $_SESSION['user_id']) {
            redirect('stories');
        }
        $this->storyModel->deletePic($id);
        redirect('stories/edit/' . $story->id);
    }
}