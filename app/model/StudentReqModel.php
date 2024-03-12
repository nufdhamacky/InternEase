<?php

class StudentReqModel{

    public $userId;
    public $firstname;
    public $lastname;
    public $regno;
    // public $cv;

    public function __construct($userId, $firstname, $lastname, $regno){

        $this->userId = $userId;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->regno = $regno;
        // $this->cv = $cv;
    }
}