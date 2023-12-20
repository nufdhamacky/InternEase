<?php

    class Home extends Controller {

        public function index(){
            
            require_once '../app/view/home/home.view.php';

            $this->view('home/home');

        }

        public function login(){
            
            require_once '../app/view/home/login.view.php';

        }

        public function signup(){
            
            require_once '../app/view/home/signup.view.php';

        }

        public function logincheck(){
            
            $username = $_POST['username'];
            $password = $_POST['password'];

            $data['loginError'] = 'Username or password is incorrect !';
            require_once '../app/view/home/login.view.php';


            // $user = $this->model('User');
            // $user->login($username, $password);

        }

    }