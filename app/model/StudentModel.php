<?php

class StudentModel
{
    public ?int $userId;
    public string $email;
    public string $firstName;
    public string $lastName;
    public ?string $password;
    public string $regNo;
    public int $indexNo;
    public ?array $ads;

    public function __construct($userId, $email, $firstName, $lastName, $password, $regNo, $indexNo, $ads)
    {
        $this->userId = $userId;
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->password = $password;
        $this->regNo = $regNo;
        $this->indexNo = $indexNo;
        $this->ads = $ads;
    }
}