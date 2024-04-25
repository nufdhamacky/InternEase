<?php
include_once('../app/repository/CompanyRepository.php');


class CompanyReport extends Controller
{

    private CompanyRepository $companyRepository;

    public function __construct()
    {
        parent::__construct();
        $this->companyRepository = new CompanyRepository($this->conn);
    }

    public function getAll(): array
    {
        return $this->companyRepository->getBlackCompanies();
    }

    public function getReportsByCompany($id): array
    {
        return $this->companyRepository->getReportsByCompany($id);
    }

    public function blockCompany()
    {
        $id = $_GET["id"];
        $this->companyRepository->blockCompany($id);
        echo "<script> window.location.replace('http://localhost/internease/public/pdc/index');</script>";

    }


    public function delete()
    {
        $id = $_GET["id"];
        $this->companyRepository->deleteReport($id);
        echo "<script> window.location.replace('http://localhost/internease/public/pdc/blacklistedcompanies');</script>";
    }


}