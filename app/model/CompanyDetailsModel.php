<?php

class CompanyDetailsModel{
    public $userId;
    public $companyname;
    public $contactperson;
    public $email;
    public $website;
    public $contactno;
    public $address;
    public $description;
    public $company_site;

    public function __construct($userId, $companyname, $contactperson, $email, $website, $contactno, $address, $description, $company_site){

        $this->userId = $userId;
        $this->companyname = $companyname;
        $this->contactperson = $contactperson;
        $this->email = $email;
        $this->website = $website;
        $this->contactno = $contactno;
        $this->address = $address;
        $this->description = $description;
        $this->company_site = $company_site;
    }
}