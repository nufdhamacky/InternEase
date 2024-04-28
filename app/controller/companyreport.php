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
        $email = $this->companyBlockReasonRepository->getBlockMail($id);
        $subject = "Your company has been blacklisted";
        $message = "Your company has been blacklisted due to the following reason: " . $reason;
        $mail = new mailer;
        $success = $mail->sendMail($email, $subject, $message);
        if ($success == "Message has been sent") {
            $rejected = 1;
            $data = ['rejected' => $rejected];
            $this->companyBlockReasonRepository->blockCompany($id, $reason);

            echo "<script> window.location.replace('http://localhost/internease/public/pdc/dashboard');</script>";

        } else {
            $rejected = 0;
            $data = ['rejected' => $rejected];
            echo "<script> window.location.replace('http://localhost/internease/public/pdc/dashboard');</script>";

        }

    }

    public function delete()
    {
        $id = $_GET["id"];
        $this->companyRepository->deleteReport($id);
        echo "<script> window.location.replace('http://localhost/internease/public/pdc/blacklistedcompanies');</script>";
    }
}