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

    public function __construct($userId, $companyname, $contactperson, $email, $website, $contactno, $address, $description){

        $this->userId = $userId;
        $this->companyname = $companyname;
        $this->contactperson = $contactperson;
        $this->email = $email;
        $this->website = $website;
        $this->contactno = $contactno;
        $this->address = $address;
        $this->description = $description;
    }
}