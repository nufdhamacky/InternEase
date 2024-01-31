<?php 
    include_once('../app/repository/CompanyRepository.php');
    include_once('../app/repository/StudentRepository.php');
    include_once('../app/model/StudentModel.php');
    class Pdc extends Controller {

        private $companyRepository;
        private $studentRepository;

        public function __construct() {
            parent::__construct();
            $this->companyRepository = new CompanyRepository($this->conn);
            $this->studentRepository = new StudentRepository($this->conn);

        }


        public function getCompanyCount():int{
            $count=$this->companyRepository->getCount();
            return $count;
        }

        public function getBlackListCompanyCount():int{
            $count=$this->companyRepository->getBlackListCount();
            return $count;
        }

        public function getStudentCount(){
            $pdcModel = $this->model('PdcModel');
            $count=$pdcModel->getStudentCount($this->conn);
            return $count;
        }

        public function getAllCompany():array{
            
            return $this->companyRepository->getAll();;
        }

        public function getAllStudent():array{
            
            return $this->studentRepository->getAll();;
        }

        public function addNewStudent(){
           
            $userId=$_SESSION["userId"];
            $email = mysqli_real_escape_string($this->conn, $_POST['email']);
			$password = mysqli_real_escape_string($this->conn, $_POST['password']);
            $firstName=mysqli_real_escape_string($this->conn, $_POST['first_name']);
            $lastName=mysqli_real_escape_string($this->conn, $_POST['last_name']);
            $regNo=mysqli_real_escape_string($this->conn, $_POST['reg_no']);
            $indexNo=mysqli_real_escape_string($this->conn, $_POST['index_no']);
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $student=new StudentModel($userId,$email,$firstName,$lastName,$hashed_password,$regNo,$indexNo);
            $this->studentRepository->save($student);
            echo "<script> window.location.href='http://localhost/internease/public/pdc/managestudent';</script>";
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

        public function addstudent(){
            $this->view('pdc/addstudent');
        }

        public function firstround(){
            $this->view('pdc/firstround');
        }
        public function logout(){
            session_destroy();
            echo "<script> window.location.href='http://localhost/internease/public/home';</script>";
        }
    }
