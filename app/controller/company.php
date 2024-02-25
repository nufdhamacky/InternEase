<?php 

    include_once('../app/repository/AdvertisementRepository.php');
    include_once('../app/model/AdvertisementModel.php');

    class Company extends Controller {

        private $advertisementRepository;

        public function __construct(){
            parent ::__construct();
            $this->advertisementRepository = new AdvertisementRepository($this->conn);

        }
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
    
        public function adView(){
            $advertisements = $this->advertisementRepository->getAllAdvertisements();
            $this->view('company/adView', ['advertisements' => $advertisements]);
        }        

        public function addAd(){
            
            $this->view('company/addAd');

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

        public function shortlistedQA(){
            
            $this->view('company/shortlistedQA');

        }

        public function shortlistedSE(){
            
            $this->view('company/shortlistedSE');

        }

        public function shortlistedBA(){
            
            $this->view('company/shortlistedBA',);

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
        
        public function addNewAd(){

            $position = mysqli_real_escape_string($this->conn, $_POST['position']);
             $interns = mysqli_real_escape_string($this->conn, $_POST['no_of_intern']);
             $workMode = mysqli_real_escape_string($this->conn, $_POST['working_mode']);
             $fromDate = mysqli_real_escape_string($this->conn, $_POST['start_date']); // Correct the input name
             $toDate = mysqli_real_escape_string($this->conn, $_POST['end_date']); // Correct the input name
             $qualification = mysqli_real_escape_string($this->conn, $_POST['qualification']);
             
            // Handle requirements checkbox
            $req = '';
            if (isset($_POST['req']) && is_array($_POST['req'])) {
                $req = implode(', ', $_POST['req']);
            }

             // Assuming you have a company_id available somewhere
             $companyId = $_SESSION['userId'];
             
             $advertisement = new AdvertisementModel($position,  $req, $interns, $workMode, $fromDate, $toDate, $companyId, $qualification);
             $result = $this->advertisementRepository->save($advertisement);
            if($result){
                echo "<script> window.location.href='http://localhost/internease/public/company/ad'</script>";
            }  else {
                echo "Data Inserted Unsuccessful";
            }
         }
        



        public function logout(){
            session_destroy();
            echo "<script> window.location.href='http://localhost/internease/public/home';</script>";
        }

    }