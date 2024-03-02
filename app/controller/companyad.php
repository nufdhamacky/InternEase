<?php
include_once('../app/repository/CompanyAdRepository.php');
include_once('../app/repository/StudentRepository.php');
include_once('../app/model/CompanyAdModel.php');

class CompanyAd extends Controller
{

    private CompanyAdRepository $companyAdRepository;

    public function __construct()
    {
        parent::__construct();
        $this->companyAdRepository = new CompanyAdRepository($this->conn);
    }

    public function getAll(): array
    {
        return $this->companyAdRepository->getAll();
    }

    public function reject()
    {
        $id = $_GET["id"];
        $this->companyAdRepository->reject($id);
        echo "<script> window.location.href='http://localhost/internease/public/pdc/advertisement';</script>";
    }

    public function accept()
    {
        $id = $_GET["id"];
        $this->companyAdRepository->accept($id);
        echo "<script> window.location.href='http://localhost/internease/public/pdc/advertisement';</script>";
    }
}