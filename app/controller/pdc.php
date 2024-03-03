<?php
include_once('../app/repository/CompanyRepository.php');
include_once('../app/repository/StudentRepository.php');
include_once('../app/model/StudentModel.php');

class Pdc extends Controller
{

    private $companyRepository;
    private $studentRepository;

    public function __construct()
    {
        parent::__construct();
        $this->companyRepository = new CompanyRepository($this->conn);
        $this->studentRepository = new StudentRepository($this->conn);

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
        $pdcModel = $this->model('PdcModel');
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

    public function getRejectCompany($page): PageDataModel
    {
        return $this->companyRepository->getByStatus($page, 2);
    }

    public function rejectCompany()
    {
        $id = $_GET["id"];
        $this->companyRepository->reject($id);
        echo "<script> window.location.href='http://localhost/internease/public/pdc/companyrequest';</script>";
    }

    public function acceptCompany()
    {
        $id = $_GET["id"];
        $this->companyRepository->accept($id);
        echo "<script> window.location.href='http://localhost/internease/public/pdc/companyrequest';</script>";
    }


    public function getAllStudent($page): PageDataModel
    {
        return $this->studentRepository->getAll($page);
    }

    public function filterByCourse($course, $page): PageDataModel
    {

        if ($course == "all") {
            return $this->studentRepository->getAll($page);
        }
        return $this->studentRepository->filterByCourse($course, $page);
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

        $student = new StudentModel(null, $email, $firstName, $lastName, $hashed_password, $regNo, $indexNo, array());
        $this->studentRepository->save($student);
        echo "<script> window.location.href='http://localhost/internease/public/pdc/managestudent';</script>";
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
                $student = new StudentModel(null, $email, $firstName, $lastName, $hashed_password, $regNo, $indexNo, array());
                $this->studentRepository->save($student);

            }
        }


        echo "<script> window.location.href='http://localhost/internease/public/pdc/managestudent';</script>";
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

    public function logout()
    {
        session_destroy();
        echo "<script> window.location.href='http://localhost/internease/public/home';</script>";
    }
}
