<?php 

class CompanyModel {

    public $userId;
    public $name;
    public $email;
    public $contact;
    public $contactPerson;


    public function __construct($userId,$name, $email, $contact,$contactPerson) {
        $this->userId = $userId;
        $this->name = $name;
        $this->email = $email;
        $this->contact = $contact;
        $this->contactPerson = $contactPerson;
    }

}
