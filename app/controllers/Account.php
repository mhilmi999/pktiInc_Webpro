<?php

class Account extends Controller
{
    public function __construct(){
        $this->accountModel = $this->model('Account_model');
    }

    public function login(){

        $this->view('common/login');
    }

    public function checkingLogin(){
        $data = [
            'title' => 'Login page',
            'username' => '',
            'password' => '',
            'usernameError' => '',
            'passwordError' => ''
        ];

        //Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'usernameError' => '',
                'passwordError' => '',
            ];
            //Validate username
            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter a username.';
            }

            //Validate password
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter a password.';
            }

            //$username = $data['username'];

            //Check if all errors are empty
            if (empty($data['usernameError']) && empty($data['passwordError'])) {
                $loggedInUser = $this->model('Account_model')->login($data['username'], $data['password']);
                //$id_user = $this->accountModel->getIDUser($username);
                //var_dump($id_user);
                //die();
                //echo 'enak';
                //die;
                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                    //$this->logout($loggedInUser);
                } else {
                    $data['passwordError'] = 'Password or username is incorrect. Please try again.';
                    $this->view('common/login');
                    }
            }

        } else {
            $data = [
                'username' => '',
                'password' => '',
                'usernameError' => '',
                'passwordError' => ''
            ];
        }
        //$this->view('common/login');
    }

    public function register(){
        $this->view('common/register');
    }

    public function createAccount(){
        $userData = [
            'username'      => $this->input('username'),
            'nama'          => $this->input('nama'),
            'email'         => $this->input('email'),
            'password'      => $this->input('password'),
            'roll'         => $this->input('roll'),
            'usernameError' => '',
            'namaError'     => '',
            'emailError'    => '',
            'passwordError' => ''
        ];

        if(empty($userData['email'])){
            $userData['emailError'] = "Mohon inputkan email Anda";
        }

        if(empty($userData['nama'])){
            $userData['namaError'] = 'Mohon masukan nama Anda';
        }

        if(empty($userData['username'])){
            $userData['usernameError'] = 'Mohon masukan username '; 
        }else{

            $username = $this->accountModel->checkUsername($userData['username']); 
            if(!empty($username)){
               $userData['usernameError'] = "Mohon maaf username telah terdaftar";  
            }
        }

        if(empty($userData['password'])){
            $userData['passwordError'] = "Mohon masukan password karena dibutuhkan";
        }else if(strlen($userData['password'] < 6)){
            $userData['passwordError'] = "Minimal 6 karakter untuk password";
        }

        if(empty($userData['namaError']) && empty($userData['usernameError'] && empty($userData['passwordError']))){
            $password = password_hash($userData['password'], PASSWORD_DEFAULT);
            
            if($this->accountModel->createAccount($userData, $password)){
               
                Flasher::setFlash("Your account has been created successfully, please login","accountCreated", "success");
                header('location:' . BASEURL . '/Account/login' );
            }
        }else{
            $this->view('common/register', $userData);
        }

    }

    public function createUserSession($user) {
        
        //Melakukan set session
        $_SESSION['id_user'] = $user->id_user;
        $_SESSION['username'] = $user->username;
        $_SESSION['email'] = $user->email;
        $_SESSION['roll'] = $user->roll;
        
        if($_SESSION['roll'] == 'peserta'){

            $this->redirect("Peserta", "index");

        }else {

            $this->redirect("Panitia", "index");
        }
      
    }

    public function logout(){
        unset($_SESSION['id_user']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['roll']);
        $this->redirect("Home", "Index");
    }

}