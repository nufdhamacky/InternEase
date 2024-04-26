<?php
include_once('../app/repository/CompanyRepository.php');
include_once('../app/repository/CompanyBlockReasonRepository.php');


class CompanyReport extends Controller
{

    private CompanyRepository $companyRepository;

    private CompanyBlockReasonRepository $companyBlockReasonRepository;

    public function __construct()
    {
        parent::__construct();
        $this->companyRepository = new CompanyRepository($this->conn);
        $this->companyBlockReasonRepository = new CompanyBlockReasonRepository($this->conn);
    }

    public function getAll(): array
    {
        return $this->companyRepository->getBlackCompanies();
    }

    public function getBlackCompanies(): array
    {
        return $this->companyBlockReasonRepository->getAll();
    }

    public function getReportCount(): int
    {
        return $this->companyRepository->getCount();
    }

    public function getReportsByCompany($id): array
    {
        return $this->companyRepository->getReportsByCompany($id);
    }

    public function blockCompany()
    {
        $id = $_GET["id"];
        $reason = $_GET["reason"];
        $this->companyBlockReasonRepository->blockCompany($id, $reason);
        echo "<script> window.location.replace('http://localhost/internease/public/pdc/index');</script>";

    }

    public function delete()
    {
        $id = $_GET["id"];
        $this->companyRepository->deleteReport($id);
        echo "<script> window.location.replace('http://localhost/internease/public/pdc/blacklistedcompanies');</script>";
    }
}