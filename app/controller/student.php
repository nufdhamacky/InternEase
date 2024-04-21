<?php

class Student extends Controller{

    public function index(){
        $this->view('_404');
    }

    public function dashboard(){
        
        $userId = $_SESSION['userId'];
        $admodel = $this->model('Ads');
        $ads = $admodel->fetchAds();
        $this->view('student/dashboard', ['data' => $ads]);

    }

    public function wishlist() {
        // Handle AJAX request to add/remove from wishlist
        $userId = $_POST['userId'];
        $adId = $_POST['adId'];
        // $userId = 11;
        // $adId = 4;
    
        // Instantiate the Wishlist model and perform the required operations
        $wishlistModel = $this->model('Wishlist');
        $wishlistModel->addToWishlist($userId, $adId);
    }

    public function advertisement(){
        $userId = $_SESSION['userId'];
        $admodel = $this->model('Ads');
        $ads = $admodel->fetchAds();
        // $adsWithStatus = $admodel->fetchAdsWithStatus($userId);

        // var_dump($_SESSION);
        // var_dump($ads);
        $this->view('student/advertisement', ['data' => $ads]);

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

    public function fetchStudentProfile() {
        $studentModel = $this->model('StudentModel');
        $userId = $_SESSION['userId'];
        $studentData = $studentModel->getStudentByUserId($userId);
        return $studentData;
    }

    public function updateProfile() {
        if(isset($_POST['submit'])) {
            $userId = $_SESSION['userId'];
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
        
            $studentModel = $this->model('StudentModel');
            $studentData = $studentModel->getStudentByUserId($userId);
        
            if ($studentData) {
                // Update first name and last name
                $studentModel->updateStudent($userId, [
                    'firstName' => $firstName,
                    'lastName' => $lastName
                ]);
        
                // Handle file upload
                $cvFile = $_FILES['cv'];
                if ($cvFile['size'] > 0) {
                    $fileName = $this->uploadFile($cvFile);
                    $studentModel->updateStudent($userId, ['cv' => $fileName]);
                }
        
                // Redirect back to the profile page
                try {
                    header("Location: <?= ROOT ?>/student/profile");
                    exit();
                } catch (Exception $e) {
                    echo 'Caught exception: ',  $e->getMessage(), "\n";
                }
            } else {
                echo "Student profile not found.";
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