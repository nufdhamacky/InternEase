<?php
include_once('../app/repository/CompanyRepository.php');
include_once('../app/repository/StudentRepository.php');
include_once('../app/repository/CompanyVisitRepository.php');
include_once('../app/repository/PdcComplaintRepository.php');
include_once('../app/repository/PDCTechTalkRepository.php');
include_once('../app/repository/CompanyBlockReasonRepository.php');
include_once('../app/model/CompanyBlockReasonModel.php');
include_once('../app/model/PdcStudentModel.php');
include_once('../app/model/AddCompanyVisitModel.php');
include_once('../app/model/PdcComplaintModel.php');
include_once('../app/model/PDCTechTalkModel.php');


class Pdc extends Controller
{
    private CompanyRepository $companyRepository;
    private StudentRepository $studentRepository;
    private CompanyVisitRepository $companyVisitRepository;

    private PDCTechTalkRepository $pdcTechTalkRepository;
    private PdcComplaintRepository $pdcComplaintRepository;

    private CompanyBlockReasonRepository $companyBlockReasonRepository;


    public function __construct()
    {
        parent::__construct();
        $this->companyRepository = new CompanyRepository($this->conn);
        $this->studentRepository = new StudentRepository($this->conn);
        $this->companyVisitRepository = new CompanyVisitRepository($this->conn);
        $this->pdcComplaintRepository = new PdcComplaintRepository($this->conn);
        $this->companyBlockReasonRepository = new CompanyBlockReasonRepository($this->conn);
        $this->pdcTechTalkRepository = new PDCTechTalkRepository($this->conn);

    }


    public function getApprovedCompanyCount(): int
    {
        $count = $this->companyRepository->getCountByStatus(1);
        return $count;
    }

    public function getPendingCompanyCount(): int
    {
        $count = $this->companyRepository->getCountByStatus(0);
        return $count;
    }

    public function getBlackListCompanyCount(): int
    {
        $count = $this->companyBlockReasonRepository->getCount();
        return $count;
    }

    public function getStudentCount()
    {
        $count = $this->studentRepository->getCount();
        return $count;
    }


    public function getAllCompany(): array
    {
        return $this->companyRepository->getAll();
    }

    public function getPendingCompany($page): PageDataModel
    {
        return $this->companyRepository->getByStatus($page, 0);
    }

    public function getApprovedCompany($page): PageDataModel
    {
        return $this->companyRepository->getByStatus($page, 1);
    }


    public function getFullApprovedCompany(): array
    {
        return $this->companyRepository->getFullByStatus(1);
    }

    public function getRejectCompany($page): PageDataModel
    {
        return $this->companyRepository->getByStatus($page, 2);
    }

    public function sendEmail()
    {

        $companies = $this->companyRepository->getFullByEmail();
        if (empty($companies)) {
            echo "No companies to send email";
        } else {
            foreach ($companies as $company) {
                $to = $company;
                $subject = "Test Email";
                $body = "This is a test email.";

                $email = new mailer;
                $email->sendMail($to, $subject, $body);
            }
        }

        $this->schedule();
    }

    public function schedule()
    {
        $this->view('pdc/schedule');
    }

    public function rejectCompany()
    {
        $id = $_GET["id"];
        $reason = $_GET["reason"];
        $email = $this->companyRepository->getCompanyMail($id);
        $subject = "Company Request Rejected";
        $body = "Your company request has been rejected. Reason: " . $reason;
        $mail = new mailer;
        $sucess = $mail->sendMail($email, $subject, $body);
        if ($sucess == 'Message has been sent') {
            $rejected = 1;
            $data = ['rejected' => $rejected];
            $this->companyRepository->reject($id, $reason);
            echo "<script> window.location.replace('http://localhost/internease/public/pdc/request');</script>";
        } else {
            $rejected = 0;
            $data = ['rejected' => $rejected];
            echo "<script> window.location.replace('http://localhost/internease/public/pdc/companyrequest');</script>";
        }

    }

    public function acceptCompany()
    {
        $id = $_GET["id"];
        $email = $this->companyRepository->getCompanyMail($id);
        $subject = "Company Request Accepted";
        $body = "Your company request has been accepted. You can now login to your account.";
        $mail = new mailer;
        $sucess = $mail->sendMail($email, $subject, $body);
        if ($sucess == 'Message has been sent') {
            $pending = 1;
            $data = ['pending' => $pending];

            $this->companyRepository->accept($id);

            $this->view('pdc/companyrequest', $data);
        } else {
            $pending = 0;
            $data = ['pending' => $pending];
            $this->view('pdc/companyrequest', $data);

        }

    }


//    public function acceptEmail()
//    {
//        if (empty($companies)) {
//            echo "No companies to send email";
//        } else {
//            foreach ($companies as $company) {
//                $to = $company;
//                $subject = "Test Email";
//                $body = "This is a test email.";
//
//                $email = new mailer;
//                $email->sendMail($to, $subject, $body);
//            }
//        }
//    }

    public function getAllStudent($page): PageDataModel
    {
        return $this->studentRepository->getAll($page);
    }

    public function findStudentById($id): ?PdcStudentModel
    {
        return $this->studentRepository->findById($id);
    }

    public function deleteStudentById($id): void
    {
        $this->studentRepository->delete($id);
    }

    public function deleteStudent(): void
    {
        $id = $_GET["id"];
        $this->studentRepository->delete($id);
        echo "<script> window.location.replace('http://localhost/internease/public/pdc/managestudent');</script>";
    }

    public function filterByCourse($course, $page): PageDataModel
    {

        if ($course == "all") {
            return $this->studentRepository->getAll($page);
        }
        return $this->studentRepository->filterByCourse($course, $page);
    }

    public function getAllCompanyVisits($page): PageDataModel
    {
        return $this->companyVisitRepository->getAll($page);
    }

    public function searchAllCompanyVisits($query, $page): PageDataModel
    {
        return $this->companyVisitRepository->search($query, $page);
    }

    public function acceptVisit()
    {
        $id = $_GET["id"];
        $this->companyVisitRepository->accept($id);
        echo "<script> window.location.replace('http://localhost/internease/public/pdc/schedule');</script>";
    }

    public function rejectVisit()
    {
        $id = $_GET["id"];
        $reason = $_GET["reason"];
        $this->companyVisitRepository->reject($id, $reason);
        echo "<script> window.location.replace('http://localhost/internease/public/pdc/schedule');</script>";
    }

    public function deleteVisit()
    {
        $id = $_GET["id"];
        $this->companyVisitRepository->delete($id);
        echo "<script> window.location.replace('http://localhost/internease/public/pdc/schedule');</script>";
    }

    public function getVisitByStatus()
    {
        return $this->companyVisitRepository->getByStatus(1);
    }

    public function getAllTechTalks()
    {
        return $this->pdcTechTalkRepository->getAll();
    }

    public function acceptTechTalk()
    {
        $id = $_GET["id"];
        $this->pdcTechTalkRepository->accept($id);
        echo "<script> window.location.replace('http://localhost/internease/public/pdc/schedule');</script>";

    }

    public function rejectTechTalk()
    {
        $id = $_GET["id"];
        $reason = $_GET["reason"];
        $this->pdcTechTalkRepository->reject($id, $reason);
        echo "<script> window.location.replace('http://localhost/internease/public/pdc/schedule');</script>";

    }

    public function addVisitRequest()
    {
        $companyIds = $_POST['company'];
        // $userId=$_SESSION["userId"];
        $reason = mysqli_real_escape_string($this->conn, $_POST['reason']);
        $requestDate = mysqli_real_escape_string($this->conn, $_POST['request_date']);

        foreach ($companyIds as $companyId) {
            $companyVisit = new AddCompanyVisitModel($companyId, $requestDate, $reason);

            $this->companyVisitRepository->save($companyVisit);
        }

        echo "<script> window.location.replace('http://localhost/internease/public/pdc/schedule');</script>";
    }

    public function addNewStudent()
    {

        // $userId=$_SESSION["userId"];
        $email = mysqli_real_escape_string($this->conn, $_POST['email']);
        $password = mysqli_real_escape_string($this->conn, $_POST['password']);
        $firstName = mysqli_real_escape_string($this->conn, $_POST['first_name']);
        $lastName = mysqli_real_escape_string($this->conn, $_POST['last_name']);
        $regNo = mysqli_real_escape_string($this->conn, $_POST['reg_no']);
        $indexNo = mysqli_real_escape_string($this->conn, $_POST['index_no']);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $student = new PdcStudentModel(null, $email, $firstName, $lastName, $hashed_password, $regNo, $indexNo, array(), array());
        $this->studentRepository->save($student);
        echo "<script> window.location.replace('http://localhost/internease/public/pdc/managestudent');</script>";
    }

    public function updateStudent()
    {

        // $userId=$_SESSION["userId"];
        $id = $_POST['id'];
        $email = mysqli_real_escape_string($this->conn, $_POST['email']);

        $firstName = mysqli_real_escape_string($this->conn, $_POST['first_name']);
        $lastName = mysqli_real_escape_string($this->conn, $_POST['last_name']);
        $regNo = mysqli_real_escape_string($this->conn, $_POST['reg_no']);
        $indexNo = mysqli_real_escape_string($this->conn, $_POST['index_no']);

        $student = new PdcStudentModel($id, $email, $firstName, $lastName, null, $regNo, $indexNo, array(), array());
        $this->studentRepository->update($student);
        echo "<script> window.location.replace('http://localhost/internease/public/pdc/managestudent');</script>";
    }

    public function addBulkStudent()
    {
        $filename = $_FILES["csv"]["tmp_name"];
        if ($_FILES["csv"]["size"] > 0) {
            $file = fopen($filename, "r");
            $list = [];

            while (($row = fgetcsv($file, 10000, ",")) !== FALSE) {
                if ($row[4] === "email") continue;
                if (trim($row[4]) == "") continue;
                $email = mysqli_real_escape_string($this->conn, $row[4]);
                $password = mysqli_real_escape_string($this->conn, $row[5]);
                $firstName = mysqli_real_escape_string($this->conn, $row[0]);
                $lastName = mysqli_real_escape_string($this->conn, $row[1]);
                $regNo = mysqli_real_escape_string($this->conn, $row[2]);
                $indexNo = (int)mysqli_real_escape_string($this->conn, $row[3]);
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $student = new PdcStudentModel(null, $email, $firstName, $lastName, $hashed_password, $regNo, $indexNo, array(), array());
                $this->studentRepository->save($student);
                $list[] = $email;

            }
            $subject = "Welcome to InternEase";
            $body = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Welcome to InternEase</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #007bff;
            text-align: center;
        }
        p {
            margin-bottom: 20px;
        }
        .info {
            margin-bottom: 10px;
        }
        .info strong {
            font-weight: bold;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class='container'>
        <h1>Welcome to InternEase</h1>
        <p>Your account has been created successfully. You can now login to your account.</p>
        <p>Your username is your email and the password is your first four letters and the @ sign with your registration number.</p>
        <div class='info'>lo
            <strong>Example:</strong><br>
            <strong>Email:</strong> 2021is033@stu.ucsc.cmb.ac.lk<br>
            <strong>Name:</strong> Valarmathy<br>
            <strong>Registration No:</strong> 2021/IS/033<br>
            <strong>Password:</strong> Vala@033
        </div>
    </div>
</body>
</html>";


            $mail = new mailer;
            $sucess = $mail->sendBulkMail($list, $subject, $body);

        }


        echo "<script> window.location.replace('http://localhost/internease/public/pdc/managestudent');</script>";
    }

    public function getStudentRequest($order): array
    {
        return $this->pdcComplaintRepository->getAll($order);
    }

    public function getStudentRequestById($id): PdcComplaintModel
    {
        return $this->pdcComplaintRepository->findById($id);
    }

    public function getStudentRequestCount(): int
    {
        return $this->pdcComplaintRepository->getCount();
    }

    public function filterStudentRequest($status, $order): array
    {
        return $this->pdcComplaintRepository->filter($status, $order);
    }

    public function replyComplaint()
    {
        $id = $_POST["id"];
        $reply = mysqli_real_escape_string($this->conn, $_POST['reply']);
        $this->pdcComplaintRepository->reply($id, $reply);
        echo "<script> window.location.replace('http://localhost/internease/public/pdc/studentrequest');</script>";
    }

    public function index()
    {

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

    public function complaintdes()
    {
        $this->view('pdc/complaintdes');
    }

    public function ads()
    {
        $this->view('pdc/ads');
    }

    public function addstudent()
    {
        $this->view('pdc/addstudent');
    }

    public function firstround()
    {
        $this->view('pdc/firstround');
    }

    public function secondround()
    {
        $this->view('pdc/secondround');
    }

    public function companyreport()
    {
        $this->view('pdc/companyreport');
    }

    public function companyreportpercentage()
    {
        $this->view('pdc/companyreportpercentage');
    }

    public function addschedule()
    {
        $this->view('pdc/addschedule');
    }


    public function logout()
    {
        session_destroy();
        echo "<script> window.location.href='http://localhost/internease/public/home';</script>";
    }

}

