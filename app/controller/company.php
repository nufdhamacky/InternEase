<?php

include_once('../app/repository/AdvertisementRepository.php');
include_once('../app/model/AdvertisementModel.php');

include_once('../app/repository/TechTalkRepository.php');
include_once('../app/model/TechTalkModel.php');

include_once('../app/repository/CompanyStudentRepository.php');
//include_once('../app/model/CompanyStudentModel.php');

include_once('../app/repository/CompanyDetailsRepository.php');


class Company extends Controller
{

    private $advertisementRepository;
    private $techTalkRepository;
    private $companyStudentRepository;
    private $companyDetailsRepository;


    public function __construct()
    {

        parent::__construct();
        $this->advertisementRepository = new AdvertisementRepository($this->conn);
        $this->techTalkRepository = new TechTalkRepository($this->conn);
        $this->companyDetailsRepository = new CompanyDetailsRepository($this->conn);
        $this->companyStudentRepository = new CompanyStudentRepository($this->conn);

    }

    public function dashboard()
    {

        $isLoggedIn = $this->isLoggedIn();

        if ($isLoggedIn == 1) {
            $this->view('company/dashboard');
        } else {
            $_SESSION['loginError'] = "Please login first!";
            echo "<script> window.location.href='http://localhost/internease/public/home/login';</script>";
        }

    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['userId']) && $_SESSION['userRole'] == "company") {
            return true;
        } else {
            return false;
        }
    }

    public function ad()
    {

        $advertisements = $this->advertisementRepository->getAllAdvertisements();
        $this->view('company/ad', ['advertisements' => $advertisements]);

    }

    public function adView()
    {
        $advertisements = $this->advertisementRepository->getAllAdvertisements();
        $this->view('company/adView', ['advertisements' => $advertisements]);
    }

    public function addAd()
    {

        $this->view('company/addAd');

    }


    public function scheduleInt()
    {
        $this->view('company/scheduleInt');

    }

    public function recruitedStu()
    {

        $this->view('company/recruitedStu');

    }

    // public function studentReq(){
    //     $std = new CompanyStudentRepository;
    //     $data=['stdrequests'=>$std->getStudentRequests()];

    //     $this->view('company/studentReq',$data);

    // }

    public function studentReq()
    {
        $ads = $this->getAllApprovedAds();
        $students = array();

        if (isset($_GET["ad_id"]) && $_GET["ad_id"] !== "all") {
            $students = $this->companyStudentRepository->getStudentRequestsByAd($_GET["ad_id"]);
        } else {
            $students = $this->companyStudentRepository->getStudentRequests();
        }

        $this->view('company/studentReq', ['ads' => $ads, 'students' => $students]);
    }

    public function getAllApprovedAds(): array
    {
        return $this->companyStudentRepository->getAds();
    }

    public function updateStatus()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        // Log the received data for debugging
        error_log("Received input: " . json_encode($input));

        if (!isset($input['applied_id']) || !isset($input['status'])) {
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'Invalid input parameters']);
            return;
        }

        $appliedId = intval($input['applied_id']);
        $status = $input['status']; // Keep status as a string for mapping

        // Mapping the status
        $statusMapping = [
            'pending' => 0,
            'shortlist' => 1,
            'reject' => 2,
            'recruit' => 3
        ];

        // Validate that the status exists in the mapping
        if (!array_key_exists($status, $statusMapping)) {
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'Invalid status: ' . $status]);
            return;
        }

        // Update status in the database
        $updateResult = $this->companyStudentRepository->updateStudentStatus($appliedId, $statusMapping[$status]);

        if ($updateResult) {
            http_response_code(200);
            echo json_encode(['message' => 'Status updated successfully']);
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(['error' => 'Failed to update status']);
        }
    }

    public function getAllStudents(?int $ad_id = null): array
    {
        return $this->companyStudentRepository->getStudentRequests($ad_id);
    }

    public function filterStudents(): array
    {
        return $this->companyStudentRepository->getStudentRequests();
    }


    public function tech()
    {

        $this->view('company/tech');

    }

    public function companyVisit()
    {

        $this->view('company/companyVisit');

    }

    public function profile()
    {
        $userDetails = $this->companyDetailsRepository->getCompanyDetails($_SESSION['userId']);
        $this->view('company/profile', ["userDetails" => $userDetails]);

    }

    public function editProfile()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userId = $_SESSION['userId']; // Assuming you have userId in session

            $companyName = $_POST['companyName'];
            $description = $_POST['description'];
            $website = $_POST['website'];
            $contactPerson = $_POST['contactPerson'];
            $contactNo = $_POST['contactNo'];
            $address = $_POST['address'];
            $company_site = $_POST['company_site'];

            // Create a CompanyDetailsModel object
            $companyDetails = new CompanyDetailsModel($userId, $companyName, $contactPerson, $_SESSION['userEmail'], $website, $contactNo, $address, $description, $company_site);

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

    public function profileview()
    {
        $userDetails = $this->companyDetailsRepository->getCompanyDetails($_SESSION['userId']);
        $this->view('company/profileview', ["userDetails" => $userDetails]);
    }

    public function totStudents()
    {

        $this->view('company/totStudents');

    }

    public function shortlistedStu()
    {

        $companyId = $_SESSION['userId'];
        $positions = $this->companyStudentRepository->getCompanyPosWithCounts($companyId);

        $data = [
            'positions' => $positions
        ];
        $this->view('company/shortlistedStu', $data);

    }

    public function shortlistedQA()
    {
        if (isset($_GET['position'])) {
            $position = urldecode($_GET['position']); // Ensure the parameter is decoded properly
        } else {
            throw new Exception("Position parameter is missing");
        }

        $companyId = $_SESSION['userId'] ?? null; // Get companyId from session

        if ($companyId) {
            $shortlistedStudents = $this->companyStudentRepository->fetchShortlistedStuByPos($companyId, $position);

            $data = [
                'shortlistedStudents' => $shortlistedStudents
            ];

            $this->view('company/shortlistedQA', $data);
        } else {
            throw new Exception("User not logged in");
        }
    }
    public function schedule()
    {
        $get = new TechTalkModel;
        $data = [];
        $data = ['schedule' =>$get->tt_schedule()];
        $this->model('CompanyVisitCompany');
        $companyvisit = new CompanyVisitCompany;
        $data = ['rows' =>$companyvisit->get_CompanyVisit()];
        $this->view('company/schedule',$data);

    }

    public function send_action() {

        $rawData = file_get_contents("php://input");
    

        $data = json_decode($rawData, true);
        var_dump($data);
        $reason = $data['reason'];

        if($data['status']=='Accepted')
        {   
            $status = 1;
            $reason ="";
        }else{
            $status = 0;
        }

        $date = $data['rejectedDate'].":00";
        $date = explode("T",$date);
       
        $rdate =  $data['requestedDate'];
        $rtime =  $data['requestedTime'];
      
        $user_id = $_SESSION['userId'];
        
       
        $requested_date = $rdate." ".$rtime;
        if($status == 1){
           $visit_date = $requested_date;
        }else{
            $visit_date = $date[0]." ".$date[1];
        }

       
        echo "user: $user_id<br>";
        echo "req: $requested_date<br>";
        echo "visit: $visit_date<br>";

        echo "status: $status<br>";
        echo "reason: $reason<br>";



       
        $this->model('CompanyVisitCompany');
        $companyvisit = new CompanyVisitCompany;
        $companyvisit->send_visit_data($user_id,$requested_date,$visit_date,$status,$reason);
    
        echo json_encode(["message" => "Success", "status" => $status, "reason" => $reason]);
    }
    
    public function schedule_tech_talk(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'company_id' => $_SESSION['userId'] ?? 'default_id',
                'topic' => $_POST['title'] ?? '',
                'from_date' => $_POST['start'] ?? '',
                'to_date' => $_POST['end'] ?? '',
                'status' => 0,
            ];


            echo "<pre>";

            foreach ($data as $d) {
                echo "<br>";
                var_dump($d);
                echo "<br>";
            }

            echo "</pre>";
            if (ob_get_level() > 0) {
                ob_flush();
            }
            flush();


            $this->model('TechTalkModel');
            $schedule = new TechTalkModel;
            $schedule->store_techtalk($data);


        } else {
            // Handle the error for non-POST requests
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
        }

        exit;

    }

    public function request_techtalks()
    {
        header('Content-Type: application/json');
        $TechModel = new TechTalkModel;
        echo $TechModel->get_techtalks();
    }


    public function shortlistedSE()
    {

        $this->view('company/shortlistedSE');

    }

    public function shortlistedBA()
    {

        $this->view('company/shortlistedBA');

    }

    public function totAd()
    {

        $this->view('company/totAd');

    }

    public function addTechtalk()
    {
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


    public function getTotalAd()
    {
        // Get the user ID from the session
        $userId = $_SESSION['userId'] ?? 0;
        $CompanyModel = $this->model('CompanyModel');
        return $CompanyModel->getTotalAd($this->conn, $userId);
    }

    public function getTotalStudents()
    {
        $CompanyModel = $this->model('CompanyModel');
        $studentCount = $CompanyModel->getTotalStudents($this->conn);
        return $studentCount;
    }

    public function addNewAd()
    {
        // Collect data and handle form submissions
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $position = mysqli_real_escape_string($this->conn, $_POST['position']);
            $requirements = isset($_POST['req']) ? implode(", ", $_POST['req']) : '';
            $interns = intval($_POST['no_of_intern'] ?? 0);
            $workingMode = mysqli_real_escape_string($this->conn, $_POST['working_mode'] ?? 'Remote');
            $fromDate = mysqli_real_escape_string($this->conn, $_POST['start_date']);
            $toDate = mysqli_real_escape_string($this->conn, $_POST['end_date']);
            $companyId = $_SESSION['userId'];
            $qualification = mysqli_real_escape_string($this->conn, $_POST['qualification']);
            $otherQualifications = mysqli_real_escape_string($this->conn, $_POST['description'] ?? '');
            $no_of_cvs_required = intval($_POST['no_of_cvs_required'] ?? 0);
            $status = 'Open';
            $imageUrl = ''; // If there are no image uploads, you can leave this empty.

            // Create AdvertisementModel
            $advertisement = new AdvertisementModel(
                $position,
                $requirements,
                $interns,
                $workingMode,
                $fromDate,
                $toDate,
                $companyId,
                $qualification,
                $otherQualifications,
                $status,
                $no_of_cvs_required
            );

            // Save to repository
            $result = $this->advertisementRepository->save($advertisement);

            if ($result) {
                header("Location: /internease/public/company/ad");
                exit();
            } else {
                echo "Data Insertion Unsuccessful";
            }
        } else {
            echo "Invalid Request Method";
        }
    }


    public function logout()
    {
        session_destroy();
        echo "<script> window.location.href='http://localhost/internease/public/home';</script>";
    }

}