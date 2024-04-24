<?php

class Student extends Controller{

    public function index(){
        $this->view('_404');
    }

    public function dashboard(){
        
        $userId = $_SESSION['userId'];
        $admodel = $this->model('Ads');
        $appliedModel = $this->model('Applied');
        $studentModel = $this->model("StudentModel");

        $studentId = $studentModel->get_student_id_with_user_id($userId);
        
        $appliedAdids = $appliedModel->fetchAppliedAdIds($studentId);

        $appliedAds = $admodel->fetchAdsWithId($appliedAdids);
        $appliedAdsCount = $appliedModel->fetchAppliedAdsCount($studentId);

        $data = [
            'appliedAds' => $appliedAds,
            'appliedAdsCount' => $appliedAdsCount
        ];

        $this->view('student/dashboard', $data);

    }

    public function apply()
{
    // Handle AJAX request to apply for a job
    $userId = $_POST['userId'];
    $adId = $_POST['adId'];
    
    //instantiate student model and get student id
    $studentModel = $this->model("StudentModel");
    $studentId = $studentModel->get_student_id_with_user_id($userId);

    // Instantiate the Applied model and perform the required operations
    $appliedModel = $this->model('Applied');
    $success = $appliedModel->apply($studentId, $adId);


    // Return a JSON response
    if ($success) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error applying for job']);
    }
}


    public function wishlist() {
        // Handle AJAX request to add/remove from wishlist
        $userId = $_POST['userId'];
        $adId = $_POST['adId'];

        // var_dump($_POST);

        // Instantiate the Wishlist model and perform the required operations
        $wishlistModel = $this->model('Wishlist');
        $success = $wishlistModel->addToWishlist($userId, $adId);

        // Return a JSON response
        if ($success) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error adding job to wishlist']);
        }

        // $this->view('student/wishlist');
    }

    public function advertisement(){
        $userId = $_SESSION['userId'];
        $admodel = $this->model('Ads');
        $ads = $admodel->fetchAds();
        // $adsWithStatus = $admodel->fetchAdsWithStatus($userId);

        
        $this->view('student/advertisement', array('ads' => $ads));

    }
    public function profile(){
        $this->view('student/profile');

    }
    public function schedule(){
        $this->view('student/schedule');

    }
    public function selectionlist(){
        $this->view('student/selectionlist');
        $this->model('User');
        
    }

    public function notification(){
        $this->view('student/notification');
    }

    public function applied(){
        $adsModel = $this->model('Ads');
        $appliedModel = $this->model('Applied');
        $appliedAdids = $appliedModel->fetchappliedAdIds($_SESSION['userId']);
        $appliedAds = $adsModel->fetchAdsWithId($appliedAdids);

        $data = [
            'ads' => $appliedAds
        ];

        $this->view('student/wishlist', $data);
    }

    public function wishlisted(){

        $adsModel = $this->model('Ads');
        $wishlistModel = $this->model('Wishlist');
        $wishlistedAdids = $wishlistModel->fetchWishlistedAdIds($_SESSION['userId']);
        $wishlistedAds = $adsModel->fetchAdsWithId($wishlistedAdids);

        $data = [
            'ads' => $wishlistedAds
        ];

        $this->view('student/wishlist', $data);
    }


    public function fetchStudentProfile() {
        $studentModel = $this->model('StudentModel');
        $userId = $_SESSION['userId'];
        $studentData = $studentModel->getStudentByUserId($userId);
        return $studentData;
    }

    public function updateProfile() {
        if (isset($_POST['submit'])) {
            $userId = $_SESSION['userId'];
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
    
            $studentModel = $this->model('StudentModel');
            $studentData = $studentModel->getStudentByUserId($userId);
    
            if ($studentData) {
                // Update first name and last name
                $studentModel->updateStudent($userId, [
                    'first_name' => $firstName,
                    'last_name' => $lastName
                ]);
    
                // Handle file upload
                $cvFile = $_FILES['cv'];
                if ($cvFile['size'] > 0) {
                    $fileName = $this->uploadFile($cvFile);
                    $studentModel->updateStudent($userId, ['cv' => $fileName]);
                }
    
                // Return the updated student data as a JSON response
                $updatedStudentData = $studentModel->getStudentByUserId($userId);
                // echo json_encode($updatedStudentData);
                $this->redirect("profile");
                
            } else {
                echo json_encode(['error' => 'Student profile not found.']);
            }
        }
    }
    
    private function uploadFile($file) {
        $uploadDir = '<?=ROOT?>/uploads/'; 
        $fileName = uniqid() . '_' . basename($file['name']);
        $uploadPath = $uploadDir . $fileName;
    
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            return $fileName;
        }
    
        return null;
    }

    
    public function logout(){
        session_destroy();
        echo "<script> window.location.href='http://localhost/internease/public/home';</script>";
    }       
    }

    