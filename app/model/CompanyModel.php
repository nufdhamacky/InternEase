<?php

class CompanyModel
{

    public $userId;
    public $name;
    public $email;
    public $contact;
    public $contactPerson;
    public $website;
    public $status;


    public function __construct($userId, $name, $email, $contact, $contactPerson, $website, $status)
    {
        $this->userId = $userId;
        $this->name = $name;
        $this->email = $email;
        $this->contact = $contact;
        $this->contactPerson = $contactPerson;
        $this->website = $website;
        $this->status = $status;
    }

}
