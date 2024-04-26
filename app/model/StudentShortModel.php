<?php

class StudentShortModel
{
    public int $id;
    public int $userId;
    public string $firstName;
    public string $lastName;
    public string $regNo;


    public function __construct(int $id, int $userId, string $firstName, string $lastName, string $regNo)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->regNo = $regNo;
    }
}