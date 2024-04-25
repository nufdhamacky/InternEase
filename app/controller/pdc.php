<?php
include_once('../app/repository/CompanyRepository.php');
include_once('../app/repository/StudentRepository.php');
include_once('../app/repository/CompanyVisitRepository.php');
include_once('../app/repository/PdcComplaintRepository.php');
include_once('../app/model/PdcStudentModel.php');
include_once('../app/model/AddCompanyVisitModel.php');
include_once('../app/model/PdcComplaintModel.php');


class Pdc extends Controller
{
    private CompanyRepository $companyRepository;
    private StudentRepository $studentRepository;
    private CompanyVisitRepository $companyVisitRepository;

    private PdcComplaintRepository $pdcComplaintRepository;

    public function __construct()
    {
        parent::__construct();
        $this->companyRepository = new CompanyRepository($this->conn);
        $this->studentRepository = new StudentRepository($this->conn);
        $this->companyVisitRepository = new CompanyVisitRepository($this->conn);
        $this->pdcComplaintRepository = new PdcComplaintRepository($this->conn);

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
        $count = $this->companyRepository->getBlackListCount();
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
        ini_set("SMTP", "tls://smtp.gmail.com");
        ini_set("smtp_port", "587");
        $to = "sayisenthil@gmail.com";
        $subject = "Test Email";
        $message = "This is a test email.";

// Additional headers
        $headers = "From: 2021is033@stu.ucsc.ac.lk.com\r\n";
        $headers .= "Reply-To: 2021is033@stu.ucsc.ac.lk.com\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send email
        $mail_sent = mail($to, $subject, $message, $headers);

        if ($mail_sent) {
            echo "Email sent successfully.";
        } else {
            echo "Email sending failed.";
        }
    }


    public function rejectCompany()
    {
        $id = $_GET["id"];
        $this->companyRepository->reject($id);
        echo "<script> window.location.replace('http://localhost/internease/public/pdc/companyrequest');</script>";
    }

    public function acceptCompany()
    {
        $id = $_GET["id"];
        $this->companyRepository->accept($id);
        echo "<script> window.location.replace('http://localhost/internease/public/pdc/companyrequest');</script>";
    }


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
        $this->companyVisitRepository->reject($id);
        echo "<script> window.location.replace('http://localhost/internease/public/pdc/schedule');</script>";
    }

    public function deleteVisit()
    {
        $id = $_GET["id"];
        $this->companyVisitRepository->delete($id);
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

            while (($row = fgetcsv($file, 10000, ",")) !== FALSE) {
                if ($row[4] === "email") continue;
                $email = mysqli_real_escape_string($this->conn, $row[4]);
                $password = mysqli_real_escape_string($this->conn, $row[5]);
                $firstName = mysqli_real_escape_string($this->conn, $row[0]);
                $lastName = mysqli_real_escape_string($this->conn, $row[1]);
                $regNo = mysqli_real_escape_string($this->conn, $row[2]);
                $indexNo = (int)mysqli_real_escape_string($this->conn, $row[3]);
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $student = new PdcStudentModel(null, $email, $firstName, $lastName, $hashed_password, $regNo, $indexNo, array(), array());
                $this->studentRepository->save($student);

            }
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

    public function schedule()
    {
        $this->view('pdc/schedule');
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

