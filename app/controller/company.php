<?php 

    include_once('../app/repository/AdvertisementRepository.php');
    include_once('../app/model/AdvertisementModel.php');

    include_once('../app/repository/TechTalkRepository.php');
    include_once('../app/model/TechTalkModel.php');

    include_once('../app/repository/CompanyStudentRepository.php');
    // include_once('../app/model/StudentReqModel.php');

    include_once('../app/repository/CompanyDetailsRepository.php');
    // include_once('../app/model/CompanyDetailsModel.php');

    class Company extends Controller {

        private $advertisementRepository;
        private $techTalkRepository;
        private $companyStudentRepository;
        private $companyDetailsRepository;

        public function __construct(){

            parent ::__construct();
            $this->advertisementRepository = new AdvertisementRepository($this->conn);
            $this->techTalkRepository = new TechTalkRepository($this->conn);
            $this->companyStudentRepository = new CompanyStudentRepository($this->conn);
            $this->companyDetailsRepository = new CompanyDetailsRepository($this->conn);

        }
        public function isLoggedIn() {
            if(isset($_SESSION['userId']) && $_SESSION['userRole'] == "company") {
                return true;
            } else {
                return false;
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
            return $this->companyStudentRepository->getStudentRequests();
        }

        public function tech(){
            
            $this->view('company/tech');

        }

        public function companyVisit(){
            
            $this->view('company/companyVisit');

        }

        public function profile(){
            $userDetails = $this->companyDetailsRepository->getCompanyDetails($_SESSION['userId']);
            $this->view('company/profile', ["userDetails" => $userDetails]);
        }

        public function editProfile(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $userId = $_SESSION['userId']; // Assuming you have userId in session

                $companyName = $_POST['companyName'];
                $description = $_POST['description'];
                $website = $_POST['website'];
                $contactPerson =$_POST['contactPerson'];
                $contactNo = $_POST['contactNo'];
                $address = $_POST['address'];
                $company_site = $_POST['company_site'];
        
                // Create a CompanyDetailsModel object
                $companyDetails = new CompanyDetailsModel($userId, $companyName, $contactPerson,$_SESSION['userEmail'], $website, $contactNo, $address, $description, $company_site);

                // Pass $companyDetails to repository method for database insertion
                $result = $this->companyDetailsRepository->editCompanyDetails($companyDetails);
        
                if ($result) {
                    // Redirect after successful submission
                    header("Location: /internease/public/company/profileview");
                    exit();
                } else {
                    // Handle insertion failure
                    echo "Data Insertion Failed";
                }
            } else {
                // Handle GET request if needed
            }
        }

        public function profileview(){
            $userDetails = $this->companyDetailsRepository->getCompanyDetails($_SESSION['userId']);
            $this->view('company/profileview', ["userDetails" => $userDetails]);
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
            
            $this->view('company/shortlistedBA');

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
        
        public function addNewAd() {
            $position = mysqli_real_escape_string($this->conn, $_POST['position']);
    
            // Initialize an empty array to store selected requirements
            $requirements = array();
    
            // Check if any checkboxes are checked
            if (isset($_POST['req'])) {
                // Loop through each selected checkbox value and store it in the array
                foreach ($_POST['req'] as $requirement) {
                    $requirements[] = mysqli_real_escape_string($this->conn, $requirement);
                }
            }
    
            // Convert the array of selected requirements into a comma-separated string
            $requirementsString = implode(", ", $requirements);
    
            // Check if each field is set, otherwise assign a default value
            $interns = isset($_POST['no_of_intern']) ? mysqli_real_escape_string($this->conn, $_POST['no_of_intern']) : 0;
            $workMode = isset($_POST['working_mode']) ? mysqli_real_escape_string($this->conn, $_POST['working_mode']) : 'Online';
            $fromDate = isset($_POST['start_date']) ? mysqli_real_escape_string($this->conn, $_POST['start_date']) : '';
            $toDate = isset($_POST['end_date']) ? mysqli_real_escape_string($this->conn, $_POST['end_date']) : '';
            $qualification = isset($_POST['qualification']) ? mysqli_real_escape_string($this->conn, $_POST['qualification']) : '';
            $status = isset($_POST['status']) ? mysqli_real_escape_string($this->conn, $_POST['status']) : 'Open';
            $image_url = isset($_POST['image_url']) ? mysqli_real_escape_string($this->conn, $_POST['image_url']) : '';
            $no_of_cvs_required = isset($_POST['no_of_cvs_required']) ? mysqli_real_escape_string($this->conn, $_POST['no_of_cvs_required']) : 0;
    
            // Assuming you have a company_id available somewhere
            $companyId = $_SESSION['userId'];
             
             $advertisement = new AdvertisementModel($position,  $requirementsString, $interns, $workMode, $fromDate, $toDate, $companyId, $qualification, $status, $image_url, $no_of_cvs_required); 

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