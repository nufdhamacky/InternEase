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
                $_SESSION['loginError'] = "Please login first!";
                echo "<script> window.location.href='http://localhost/internease/public/home/login';</script>";
            }
        
        }   

        public function ad(){
            
            $this->view('company/ad');

        }

        public function addAd(){
            
            $this->view('company/addAdd');

        }

        public function adView(){
            
            $this->view('company/adView');

        }

        public function schedule(){
            
            $this->view('company/schedule');

        }

        public function scheduleInt(){
            
            $this->view('company/scheduleInt');

        }

        public function studentReq(){
            
            $this->view('company/studentReq');

        }

        public function techTalk(){
            
            $this->view('company/techTalk');

        }

        public function logout(){
            session_destroy();
            echo "<script> window.location.href='http://localhost/internease/public/home';</script>";
        }

    }