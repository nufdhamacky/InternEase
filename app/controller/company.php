<?php 

    include_once('../app/repository/AdvertisementRepository.php');
    include_once('../app/model/AdvertisementModel.php');

    include_once('../app/repository/TechTalkRepository.php');
    include_once('../app/model/TechTalkModel.php');

    include_once('../app/repository/StudentReqRepository.php');
    include_once('../app/model/StudentReqModel.php');

    class Company extends Controller {

        private $advertisementRepository;
        private $techTalkRepository;
        private $studentReqRepository;

        public function __construct(){
            parent ::__construct();
            $this->advertisementRepository = new AdvertisementRepository($this->conn);
            $this->techTalkRepository = new TechTalkRepository($this->conn);
            $this->studentReqRepository = new StudentReqRepository($this->conn);

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
            
            $advertisements = $this->advertisementRepository->getAllAdvertisements();
            $this->view('company/ad', ['advertisements' => $advertisements]);

        }

        public function getAllAds(): array{
            return $this->advertisementRepository->getAllAdvertisements();
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

        public function recruitedStu(){

            $this->view('company/recruitedStu');
            
        }

        public function studentReq(){
            
            $this->view('company/studentReq');

        }

        public function getAllReqs(): array{
            return $this->studentReqRepository->getAllRequests();
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

        public function addTechtalk(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $userId = $_SESSION['userId']; // Assuming you have userId in session
        
                $date = isset($_POST['date']) ? mysqli_real_escape_string($this->conn, $_POST['date']) : '';
                $duration = isset($_POST['duration']) ? mysqli_real_escape_string($this->conn, $_POST['duration']) : '';
                $startTime = isset($_POST['start_time']) ? mysqli_real_escape_string($this->conn, $_POST['start_time']) : '';
                $endTime = isset($_POST['end_time']) ? mysqli_real_escape_string($this->conn, $_POST['end_time']) : '';

                // Create a TechTalkModel object
                $techTalk = new TechTalkModel($userId, $date, $duration, $startTime, $endTime);
        
                // Pass $techTalk to repository method for database insertion
                $result = $this->techTalkRepository->addTechTalk($techTalk);

                if ($result) {
                    // Redirect after successful submission
                    header("Location: /internease/public/company/tech");
                    exit();
                } else {
                    // Handle insertion failure
                    echo "Data Insertion Failed";
                }
            } else {
                // Handle GET request if needed
            }
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

            // Initialize an empty array to store selected requirements
            $requirements = array();

            // Check if any checkboxes are checked
            if(isset($_POST['req'])) {
                
                // Loop through each selected checkbox value and store it in the array
                foreach($_POST['req'] as $requirement) {
                    
                    // Perform any necessary validation and sanitization here
                    $requirements[] = $requirement;

                }
            }

            // Convert the array of selected requirements into a comma-separated string
            $requirementsString = implode(", ", $requirements);

            $interns = mysqli_real_escape_string($this->conn, $_POST['no_of_intern']);
            $workMode = mysqli_real_escape_string($this->conn, $_POST['working_mode']);
            $fromDate = mysqli_real_escape_string($this->conn, $_POST['start_date']); // Correct the input name
            $toDate = mysqli_real_escape_string($this->conn, $_POST['end_date']); // Correct the input name
            $qualification = mysqli_real_escape_string($this->conn, $_POST['qualification']);
            

             // Assuming you have a company_id available somewhere
             $companyId = $_SESSION['userId'];
             
             $advertisement = new AdvertisementModel($position,  $requirementsString, $interns, $workMode, $fromDate, $toDate, $companyId, $qualification);
             
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