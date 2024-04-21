<?php

class StudentShortModel
{
    public int $userId;
    public string $firstName;
    public string $lastName;
    public string $regNo;


    public function __construct(int $userId, string $firstName, string $lastName, string $regNo)
    {
        $this->userId = $userId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->regNo = $regNo;
    }
}