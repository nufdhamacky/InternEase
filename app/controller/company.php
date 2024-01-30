<?php 

    // include_once('../app/repository/AdvertisementRepository.php');
    // include_once('../app/model/AdvertisementModel.php');

    class Company extends Controller {

        //   private $advertisementRepository;

        // public function __construct(){
        //     parent ::__construct();
        //     $this->advertisementRepository = new AdvertisementRepository($this->conn);

        // }
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

        
            // if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //     $position = $_POST['position'];
            //     $requirements = isset($_POST['requirements']) ? $_POST['requirements'] : array();
            //     $qualifications = isset($_POST['qualifications']) ? $_POST['qualifications'] : array();
            //     $start_date = $_POST['start_date'];
            //     $end_date = $_POST['end_date'];
            //     $no_of_intern = $_POST['no_of_intern'];
            //     $working_mode = $_POST['working_mode'];
    
            //     $CompanyModel = $this->model('CompanyModel');
            //     $success = $CompanyModel->addAdvertisement($this->conn, $position, $requirements, $qualifications, $start_date, $end_date, $no_of_intern, $working_mode);
    
            //     if ($success) {
            //         $_SESSION['status'] = "Inserted Successfully";
            //     } else {
            //         $_SESSION['status'] = "Failed to Insert";
            //     }
    
            //     header("Location: addAd.view.php");
            //     exit();
            // } else {
            //     $this->view('company/addAd');
            // }

        


        // public function getAddAd(){
        //     $CompanyModel = $this->model('CompanyModel');
        //     $CompanyModel->getAddAd($this->conn);
        // }        

        public function adView(){
            
            $this->view('company/adView');

        }

        public function addAd(){
            
            $this->view('company/addAd');

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

        // public function addNewAd(){
        //     $adId = mysqli_real_escape_string($this->conn, $_POST['ad_Id']);
        //     $position = mysqli_real_escape_string($this->conn, $_POST['position']);
        //     $req = mysqli_real_escape_string($this->conn, $_POST['requirements']);
        //     $interns = mysqli_real_escape_string($this->conn, $_POST['no_of_intern']);
        //     $workMode = mysqli_real_escape_string($this->conn, $_POST['working_mode']);
        //     $fromDate = mysqli_real_escape_string($this->conn, $_POST['from_date']);
        //     $toDate = mysqli_real_escape_string($this->conn, $_POST['to_date']);
        //     $companyId = mysqli_real_escape_string($this->conn, $_POST['company_id']);
        //     $qualification = mysqli_real_escape_string($this->conn, $_POST['qualification']);
        
        //    $advertisement = new AdvertisementModel($adId, $position,  $req, $interns, $workMode, $fromDate, $toDate, $companyId, $qualification);
        //    $this->advertisementRepository->save($advertisement);
        //    echo "<script> window.location.href='http://localhost/internease/public/company/ad'</script>";

        // }



        public function logout(){
            session_destroy();
            echo "<script> window.location.href='http://localhost/internease/public/home';</script>";
        }

    }