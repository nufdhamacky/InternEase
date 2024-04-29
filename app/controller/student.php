<?php

class Student extends Controller
{

    public function index()
    {
        $this->view('_404');
    }

    public function dashboard()
    {

        $userId = $_SESSION['userId'];
        $admodel = $this->model('Ads');
        $appliedModel = $this->model('Applied');
        $wishlistModel = $this->model('Wishlist');

        // Retrieve applied ad IDs and their statuses
        $appliedAdIds = $appliedModel->fetchAppliedAdIds($_SESSION['studentId']);
        $appliedAds = $admodel->fetchAdsWithId($appliedAdIds);
        $appliedAdsCount = $appliedModel->fetchAppliedAdsCount($_SESSION['studentId']);

        // Fetch and attach application status to each applied ad
        foreach ($appliedAds as &$ad) {
            $status = $appliedModel->fetchApplicationStatus($_SESSION['studentId'], $ad['ad_id']);
            $ad['applicationStatus'] = $status;
        }

        // Prepare data to be passed to the view
        $data = [
            'appliedAds' => $appliedAds,
            'appliedAdsCount' => $appliedAdsCount
        ];

        // Load the view with the data
        $this->view('student/dashboard', $data);


    }

    public function addCalendarEvent()
    {

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $date = $_POST["date"];
            $title = $_POST["title"];
            $description = $_POST["description"];

            $calendarModel = $this->model('CalendarModel');

            $result = $calendarModel->addEvent($date, $title, $description);

            // Check the result of the operation
            if ($result === "Event added successfully") {
                echo json_encode(["message" => $result]);
            } else {
                http_response_code(500); // Set HTTP status code to indicate internal server error
                echo json_encode(["error" => $result]);
            }
        } else {
            http_response_code(405); // Set HTTP status code to indicate method not allowed
            echo json_encode(["error" => "Method not allowed"]);
        }
    }

    public function deleteCalendarEvent()
    {

        if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
            $eventId = $_GET["id"];

            $calendarModel = $this->model('CalendarModel');

            $result = $calendarModel->deleteEvent($eventId);

            // Check the result of the operation
            if ($result === "Event deleted successfully") {
                echo json_encode(["message" => $result]);
            } else {
                http_response_code(500); // Set HTTP status code to indicate internal server error
                echo json_encode(["error" => $result]);
            }
        } else {
            http_response_code(405); // Set HTTP status code to indicate method not allowed
            echo json_encode(["error" => "Method not allowed"]);
        }
    }

    public function secondRoundApp(){
        $studentId = $_SESSION['studentId'];

        $prefernces = $_POST;
        
    }


    public function apply()
    {
        // Handle AJAX request to apply for a job
        $userId = $_POST['userId'];
        $adId = $_POST['adId'];

        // Instantiate the Applied model and perform the required operations
        $appliedModel = $this->model('Applied');
        $result = $appliedModel->apply($_SESSION['studentId'], $adId, 1);

        // Return a JSON response
        if ($result['success']) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => $result['message']]);
        }
    }


    public function wishlist()
    {
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

    public function removeFromWishlist()
    {
        $userId = $_SESSION['userId'];
        $adId = $_POST['adId'];

        $wishlistModel = $this->model('Wishlist');
        $success = $wishlistModel->deleteFromWishlist($userId, $adId);

        if ($success) {
            echo json_encode(['success' => true, 'message' => 'Item deleted from wishlist successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete item from wishlist']);
        }
    }

    public function hasApplied()
    {
        $studentId = $_SESSION['studentId'];
        $adId = $_GET['adId'];

        $appliedModel = $this->model('Applied');

        $hasApplied = $appliedModel->alreadyApplied($studentId, $adId);
        echo json_encode(['hasApplied' => $hasApplied]);
    }


    public function advertisement()
    {
        $userId = $_SESSION['userId'];
        $admodel = $this->model('Ads');
        $ads = $admodel->fetchAds();

        $roundModel = $this->model('StudentRoundModel');
        $roundData = $roundModel->fetchRoundDates();
        // $adsWithStatus = $admodel->fetchAdsWithStatus($userId);
        $secondRoundCount = $roundModel->countround2();

        $data = [
            'ads' => $ads,
            'roundData' => $roundData,
            'secondRoundCount' => $secondRoundCount
        ];


        $this->view('student/advertisement', $data);

    }


    public function profile()
    {
        $this->view('student/profile');

    }

    public function schedule()
    {
        $this->view('student/schedule');

    }

    public function selectionlist()
    {
        $this->view('student/selectionlist');
        $this->model('User');

    }

    public function notification()
    {
        $this->view('student/notification');
    }

    public function applied()
    {
        $adsModel = $this->model('Ads');
        $appliedModel = $this->model('Applied');
        $appliedAdids = $appliedModel->fetchappliedAdIds($_SESSION['studentId']);
        $appliedAds = $adsModel->fetchAdsWithId($appliedAdids);

        $data = [
            'ads' => $appliedAds
        ];

        $this->view('student/applied', $data);
    }

    public function wishlisted()
    {
        $adsModel = $this->model('Ads');
        $wishlistModel = $this->model('Wishlist');

        try {
            $wishlistedAdids = $wishlistModel->fetchWishlistedAdIds($_SESSION['userId']);
            $wishlistedAds = $adsModel->fetchAdsWithId($wishlistedAdids);

            $data = [
                'ads' => $wishlistedAds
            ];

            $this->view('student/wishlist', $data);
        } catch (InvalidArgumentException $e) {
            // Pass the exception object to the view
            $this->view('student/wishlist', ['exception' => $e]);
        }
    }


    public function fetchStudentProfile()
    {
        $studentModel = $this->model('StudentModel');
        $userId = $_SESSION['userId'];
        $studentData = $studentModel->getStudentByUserId($userId);
        return $studentData;
    }

    public function updateProfile()
    {
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
                echo json_encode($updatedStudentData);
                $this->redirect("profile");

            } else {
                echo json_encode(['error' => 'Student profile not found.']);
            }
        }
    }

    // private function uploadFile($file) {
    //     $uploadDir = ROOT . '/uploads/';  // Concatenate ROOT into the string
    //     $fileName = uniqid() . '_' . basename($file['name']);
    //     $uploadPath = $uploadDir . $fileName;

    //     var_dump($fileName);
    //     if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
    //         return $fileName;
    //     }

    //     return null;
    // }

    private function uploadFile($file)
    {
        $uploadDir = __DIR__ . '/../../public/uploads/'; // Use the correct file system path
        $fileName = uniqid() . '_' . basename($file['name']);
        $uploadPath = $uploadDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            return $fileName;
        }

        return null;
    }

    public function companyprofile(){

        $companyId = $_GET['companyId'];

        $companyModel = $this->model('StudentCompanyModel');
        $company = $companyModel->getCompanyById($companyId);

        $data = [
            'company' => $company
        ];

        $this->view('student/companyprofile', $data);
    }

    public function logout()
    {
        session_destroy();
        echo "<script> window.location.href='http://localhost/internease/public/home';</script>";
    }
}

    