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
            
            $this->view('company/addAd');

        }

        public function adView(){
            
            $this->view('company/adView');

        }

        public function schedule(){
            
            $this->view('company/scheduleInt');

        }

        public function scheduleInt(){
            
            $this->view('company/scheduleInt');

        }

        public function studentReq(){
            
            $this->view('company/studentReq');

        }

        public function tech(){
            
            $this->view('company/tech');

        }

        public function companyVisit(){
            
            $this->view('company/companyVisit');

        }

        public function profile(){
            
            $this->view('company/profile');

        }

        public function totStudents(){
            
            $this->view('company/totStudents');

        }

        public function shortlistedStu(){
            
            $this->view('company/shortlistedStu');

        }

        public function totAd(){
            
            $this->view('company/totAd');

        }

        public function getTotalAd(){
            $CompanyModel = $this->model('CompanyModel');
            $adCount = $CompanyModel->getTotalAd($this->conn);
            return $adCount;
        }

        public function getTotalStudents(){
            $CompanyModel = $this->model('CompanyModel');
            $studentCount = $CompanyModel->getTotalStudents($this->conn);
            return $studentCount;
        }

        public function logout(){
            session_destroy();
            echo "<script> window.location.href='http://localhost/internease/public/home';</script>";
        }

    }