<?php
class Storypages extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->storypageModel = $this->model('Storypage');
        $this->storyModel = $this->model('Story');
    }

    public function index($id)
    {


        $storypages = $this->storypageModel->getStorypagesByStoryId($id);
        $story = $this->storyModel->getStoryById($id);

        if ($storypages != false) {

            $data = [
                'story-id' => $story->id,
                'story-title' => $story->title,
                'story-heading' => $story->heading,
                'story-linked-content-title' => $story->linked_content_title,
                'story-linked-content-url' => $story->linked_content_url,
                'story-user-id' => $story->id_user,
                'storypages' => $storypages
            ];
        } else {
            $data = [
                'story-id' => $story->id,
                'story-title' => $story->title,
                'story-heading' => $story->heading,
                'story-linked-content-title' => $story->linked_content_title,
                'story-linked-content-url' => $story->linked_content_url,
                'story-user-id' => $story->id_user
            ];
        }

        $this->view('storypages/index', $data);
    }

    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            // Sanitize POST array

            // Media uploads
            if (isset($_FILES['background-img'])) {
                if ($_FILES['background-img']['error'] === 0) {
                    if (in_array(mime_content_type($_FILES['background-img']['tmp_name']), ['image/png', 'image/jpeg'])) {
                        if ($_FILES['background-img']['size'] < 3000000) {
                            $fileNameArray = explode('/', $_FILES['background-img']['tmp_name']);
                            $fileName = $fileNameArray[count($fileNameArray) - 1];
                            move_uploaded_file($_FILES['background-img']['tmp_name'], APPROOT2 . '/public/uploads/' . $fileName . '.' . pathinfo($_FILES['background-img']['name'], PATHINFO_EXTENSION));
                            $fileNameBackground = $fileName . '.' . pathinfo($_FILES['background-img']['name'], PATHINFO_EXTENSION);
                        }
                    }
                } else {
                    $fileNameBackground = '';
                }
            }

            // Deal with cover bool

            if ($this->storypageModel->countStorypagesForStory(intval($_POST['story-id']))) {
                $cover = 0;
            } else {
                $cover = 1;
            }

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'story-id' => intval($_POST['story-id']),
                'cover' => $cover,
                'title' => $_POST['title'],
                'body-text' => $_POST['body-text'],
                'background-credits' => $_POST['background-credits'],
                'background-animation' => $_POST['background-animation'],
                'background-animation-duration' => $_POST['background-animation-duration'],
                'background-size' => $_POST['background-size'],
                'text-block-size-position' => $_POST['text-block-size-position'],
                'text-block-animation' => $_POST['text-block-animation'],
                'text-block-animation-duration' => $_POST['text-block-animation-duration'],
                'background-img' => $fileNameBackground,
                'id_user' => intval($_SESSION['user_id'])
            ];


            // Make sure no errors
            if (empty($data['title_err']) && empty($data['heading_err'])) {
                // Validated
                if ($this->storypageModel->addStorypage($data)) {
                    flash('storypage_message', 'Story Page Added');
                    redirect('storypages/' . $data['story-id']);
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

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo 'yo';
            // Get existing post from model
            $storypage = $this->storypageModel->getStorypageById($id);

            // Check for owner
            if ($_SESSION['user_username'] != 'fchaillou' and $storypage->id_user != $_SESSION['user_id']) {
                redirect('storypages');
            }

            if ($this->storypageModel->deleteStorypage($id)) {
                flash('post_message', 'Post Removed');
                redirect('storypages/' . $storypage->id_story);
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('storypages');
        }
    }

    public function edit($id)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Deal with image upload
            if (isset($_FILES['background-img'])) {
                if ($_FILES['background-img']['error'] === 0) {
                    if (in_array(mime_content_type($_FILES['background-img']['tmp_name']), ['image/png', 'image/jpeg'])) {
                        if ($_FILES['background-img']['size'] < 3000000) {
                            $fileNameArray = explode('/', $_FILES['background-img']['tmp_name']);
                            $fileName = $fileNameArray[count($fileNameArray) - 1];
                            move_uploaded_file($_FILES['background-img']['tmp_name'], APPROOT2 . '/public/uploads/' . $fileName . '.' . pathinfo($_FILES['background-img']['name'], PATHINFO_EXTENSION));
                            $fileNameBackground = $fileName . '.' . pathinfo($_FILES['background-img']['name'], PATHINFO_EXTENSION);
                        }
                    }
                } else {
                    $storypage = $this->storypageModel->getStorypageById($id);
                    $fileNameBackground = $storypage->filename_background_img;
                }
            }



            $data = [
                'id' => $_POST['id'],
                'story-id' => intval($_POST['story-id']),
                'title' => $_POST['title'],
                'body-text' => $_POST['body-text'],
                'background-size' => $_POST['background-size'],
                'background-credits' => $_POST['background-credits'],
                'background-animation' => $_POST['background-animation'],
                'background-animation-duration' => $_POST['background-animation-duration'],
                'text-block-size-position' => $_POST['text-block-size-position'],
                'text-block-animation' => $_POST['text-block-animation'],
                'text-block-animation-duration' => $_POST['text-block-animation-duration'],
                'background-img' => $fileNameBackground,
                'id_user' => intval($_SESSION['user_id'])
            ];



            // Validate data


            // Make sure no errors

            // Validated
            if ($this->storypageModel->editStorypage($data)) {
                flash('storypage_message', 'Storypage added Updated');
                redirect('storypages/' . $data['story-id']);
            } else {
                die('Something went wrong');
            }
        } else {
            $storypage = $this->storypageModel->getStorypageById($id);
            // inject story data in simple array



            $data = [
                'id' => $storypage->id,
                'story-id' => $storypage->id_story,
                'sub-id' => $storypage->sub_id,
                'title' => $storypage->title,
                'body-text' => $storypage->body,
                'background-size' => $storypage->size_background_img,
                'background-credits' => $storypage->credits_background_img,
                'background-animation' => $storypage->animation_background_img,
                'background-animation-duration' => $storypage->animation_background_img_duration,
                'text-block-size-position' => $storypage->size_position_text_block,
                'text-block-animation' => $storypage->animation_text_block,
                'text-block-animation-duration' => $storypage->animation_text_block_duration,
                'background-img' => $storypage->filename_background_img,
                'id_user' => $storypage->id_user
            ];

            // Check for owner
            if ($_SESSION['user_username'] != 'fchaillou' and $storypage->id_user != $_SESSION['user_id']) {
                redirect('storypages');
            }

            // prepare form for updating

            $this->view('storypages/edit', $data);
        }
    }

    public function preview($id)
    {

        $storypage = $this->storypageModel->getStorypageById($id);

        $data = [
            'id' => $storypage->id,
            'story-id' => $storypage->id_story,
            'title' => $storypage->title,
            'body-text' => $storypage->body,
            'background-credits' => $storypage->credits_background_img,
            'background-animation' => $storypage->animation_background_img,
            'text-block-size-position' => $storypage->size_position_text_block,
            'text-block-animation' => $storypage->animation_text_block,
            'text-block-animation-duration' => $storypage->animation_text_block_duration,
            'background-img' => $storypage->filename_background_img,
            'background-size' => $storypage->size_background_img,
            'id_user' => $storypage->id_user
        ];

        $this->view('storypages/preview', $data);
    }

    public function up($id)
    {
        $storyId =  $this->storypageModel->getStoryIdFromStorypage($id);
        $this->storypageModel->upStorypage($id);
        redirect('storypages/' . $storyId[0]);
    }

    public function down($id)
    {
        $storyId =  $this->storypageModel->getStoryIdFromStorypage($id);
        $this->storypageModel->downStorypage($id);
        redirect('storypages/' . $storyId[0]);
    }

    public function deletebg($id)
    {

        $storypage = $this->storypageModel->getStorypageById($id);

        // Check for owner
        if ($_SESSION['user_username'] != 'fchaillou' and $storypage->id_user != $_SESSION['user_id']) {
            redirect('storypages');
        }
        $this->storypageModel->deleteBg($id);
        redirect('storypages/edit/' . $storypage->id);
    }

    public function deletepic($id)
    {

        $storypage = $this->storypageModel->getStorypageById($id);

        // Check for owner
        if ($_SESSION['user_username'] != 'fchaillou' and $storypage->id_user != $_SESSION['user_id']) {
            redirect('storypages');
        }
        $this->storypageModel->deletePic($id);
        redirect('storypages/edit/' . $storypage->id);
    }
}