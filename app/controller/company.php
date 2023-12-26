<?php 

    class Company extends Controller {

        public function isLoggedIn(){
            if(isset($_SESSION['userId']) && isset($_SESSION['userRole'])=="company"){
                return 1;
            } else{
                return 0;
            }
        }

        public function dashboard(){

            $isLoggedIn = $this->isLoggedIn();
            
            if($isLoggedIn == 1){
                $this->view('company/dashboard');
            } else{
                $_SESSION['loginError'] = "Please login first !";
                echo "<script> window.location.href='http://localhost/internease/public/home/login';</script>";
            }
        
        }   

        public function logout(){
            session_destroy();
            echo "<script> window.location.href='http://localhost/internease/public/home/index';</script>";
        }

    }