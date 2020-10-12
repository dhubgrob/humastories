<?php
class Users extends Controller {
    public function __construct() {
        $this->userModel = $this->model('User');
    }

    public function register() {
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process form
        
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'username_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Validate name
            if(empty($data['username'])) {
                $data['username_err'] = "please enter username";
            }

            // Validate password
            if(empty($data['password'])) {
                $data['password_err'] = "please enter password";
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = "Password must be at least 6 characters";
            }

            // Validate confirm password
            if(empty($data['confirm_password'])) {
                $data['confirm_password_err'] = "please confirm password";
            } else {
                if($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = "Passwords do not match";   
                }
            }

            // Make sure errors are empty
            if(empty($data['username_err']) && empty($data['password_err']) &&  empty($data['confirm_password_err'])) {
                // Validated
                

                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register User
                if($this->userModel->register($data)){
                    flash('register_success', 'You are registered and can log in');
                    redirect('users/login');
                } else {
                    die('Something went wrong');
                }
                
                
            } else {
                // Load view with errors
                $this->view('users/register', $data);
            }

        } else {
            // Init data
            $data = [
                'username' => '',
                'password' => '',
                'confirm_password' => '',
                'username_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Load view
            $this->view('users/register', $data);
        }
    }

    public function login() {
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //process form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'username_err' => '',
                'password_err' => ''
            ];

               // Validate username
               if(empty($data['username'])) {
                $data['username_err'] = "please enter username";
            }

             // Validate password
            if(empty($data['password'])) {
                $data['password_err'] = "please enter password";
            }

            // Check for user/email
            if($this->userModel->findUserByUsername($data['username'])) {
                // User found
            } else  {
                $data['email_err'] = 'No user found';
            }

            // Make sure errors are empty
            if(empty($data['username_err']) && empty($data['password_err'])) {
                // Validated
                
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data['username'], $data['password']);

                if($loggedInUser) {
                    // create session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Password incorrect';

                    $this->view('users/login', $data);
                }


            } else {
                // Load view with errors
                $this->view('users/login', $data);
            }

        } else {
            // Init data
            $data = [
              
                'username' => '',
                'password' => '',
                'username_err' => '',
                'password_err' => ''
                
            ];

            // Load view
            $this->view('users/login', $data);
        }
    }

    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_username'] = $user->username;
        redirect('stories');
    }

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_username']);
        session_destroy();
        redirect('users/login');
    }

}
