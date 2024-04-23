<?php

class PdcStudentModel
{
    public ?int $userId;
    public string $email;
    public string $firstName;
    public string $lastName;
    public ?string $password;
    public string $regNo;
    public int $indexNo;
    public ?array $ads;
    public ?array $jobRoles;

    public function __construct($userId, $email, $firstName, $lastName, $password, $regNo, $indexNo, $ads, $jobRoles)
    {
        $this->userId = $userId;
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->password = $password;
        $this->regNo = $regNo;
        $this->indexNo = $indexNo;
        $this->ads = $ads;
        $this->jobRoles = $jobRoles;
    }
}