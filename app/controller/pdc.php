<?php 

    class Pdc extends Controller {

        // public function isLoggedIn(){
        //     if(isset($_SESSION['userId']) && isset($_SESSION['userRole'])=="company"){
        //         return 1;
        //     } else{
        //         return 0;
        //     }
        // }


        public function getCompanyCount(){
            $pdcModel = $this->model('PdcModel');
            $companyCount=$pdcModel->getCompanyCount($this->conn);
            return $companyCount;
        }

        public function getBlackListCompanyCount(){
            $pdcModel = $this->model('PdcModel');
            $companyCount=$pdcModel->getBlackListCount($this->conn);
            return $companyCount;
        }

        public function getStudentCount(){
            $pdcModel = $this->model('PdcModel');
            $count=$pdcModel->getStudentCount($this->conn);
            return $count;
        }

        public function index(){

            //$isLoggedIn = $this->isLoggedIn();
            
           //if($isLoggedIn == 1){
            
            $this->view('pdc/dashboard');
           // } else{
                //$_SESSION['loginError'] = "Please login first !";
                //echo "<script> window.location.href='http://localhost/internease/public/home/login';</script>";
            //}
            
        }   
        public function managestudent()
        {
            $this->view('pdc/managestudent');
        }

        public function managecompany()
        {
            $this->view('pdc/managecompany');
        }

        public function roundselection()
        {
            $this->view('pdc/roundselection');
        }

        public function advertisement()
        {
            $this->view('pdc/advertisement');
        }

        public function request()
        {
            $this->view('pdc/request');
        }

        public function viewstudent()
        {
            $this->view('pdc/viewstudent');
        }

        public function companylist()
        {
            $this->view('pdc/companylist');
        }

        public function blacklistedcompanies()
        {
            $this->view('pdc/blacklistedcompanies');
        }

        public function addblacklist()
        {
            $this->view('pdc/addblacklist');
        }

        public function companyrequest()
        {
            $this->view('pdc/companyrequest');
        }

        public function studentrequest()
        {
            $this->view('pdc/studentrequest');
        }

        public function ads()
        {
            $this->view('pdc/ads');
        }
        public function logout(){
            session_destroy();
            echo "<script> window.location.href='http://localhost/internease/public/home';</script>";
        }
    }
