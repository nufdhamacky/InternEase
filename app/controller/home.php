<?php

    class Home extends Controller {
        public function index(){
            
            $this->view('home/home');

        }

        public function about(){ 

           $this->view('home/aboutus');

        }

        public function service(){
            
            $this->view('home/services');

        }

        public function login(){
            
            $this->view('home/login');

        }

        public function signup(){
            
            $this->view('home/signup');

        }
        
        public function logincheck(){
            
            //store psot varialble in local variable
            $username = $_POST['username'];
            $password = $_POST['password'];

            //including validation file
            require_once '../app/controller/helper/validation.php';

            //creating validation object
            $validation = new Validation();

            $errors = $validation->validateLogin($username, $password);

            if(!$errors){

                //creating user model object
                $user = $this->model('User');

                //calling login function from user model to check login
                $loginAccess = $user->login($username, $password, $this->conn);

                if($loginAccess == 1){
                    
                    if($_SESSION['userStatus']== 1){    
                        if($_SESSION['userRole'] == 'company' )
                            echo "<script> window.location.href='http://localhost/internease/public/company/dashboard';</script>";
                        else if($_SESSION['userRole'] == 'student')
                            echo "<script> window.location.href='http://localhost/internease/public/student/dashboard';</script>";
                        else if($_SESSION['userRole'] == 'admin')
                            echo "<script> window.location.href='http://localhost/internease/public/admin/index';</script>";
                        else
                            echo "<script> window.location.href='http://localhost/internease/public/pdc/dashboard';</script>";
                    }
                    else{
                        $data['loginError'] = 'Your account is not activated yet !';
                        $this->view('home/login', $data);
                    }
                }
                else if($loginAccess == 0){
                    $data['loginError'] = 'Username or password is incorrect !';
                    $this->view('home/login', $data);
                } else {
                    $data['loginError'] = 'Username not registered !';
                    $this->view('home/login', $data);
                }

            } else {
                $data['loginError'] = $errors;
                $this->view('home/login', $data);
            }

        }

        public function signupcheck(){
            
            //store psot varialble in local variable
            $company = $_POST['companyName'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];


            //including validation file
            require_once '../app/controller/helper/validation.php';

            //creating validation object
            $validation = new Validation();

            $errors = $validation->validateSignup($company, $email, $password, $confirmPassword);

            if(!$errors){

                //creating user model object
                $user = $this->model('User');

                //calling signup function from user model to check signup
                $signupAccess = $user->signup($company, $email, $password, $this->conn);

                if($signupAccess == 0){
                    $data['signupError'] = 'Email already registered !';
                    $this->view('home/signup', $data);
                }
                else if($signupAccess == 2){
                    $data['signupError'] = 'Something went wrong. Try again later !';
                    $this->view('home/signup', $data);
                    
                } else {
                    echo "<script> window.location.href='http://localhost/internease/public/comapany/index';</script>";
                }

            } else {
                $data['signupError'] = $errors;
                $this->view('home/signup', $data);
            }

        }

    }

