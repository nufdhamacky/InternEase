<?php

class BlackCompanyModel
{
    public int $userId;
    public string $name;
    public array $reports;


    public function __construct(int $userId, string $name, array $reports)
    {
        $this->userId = $userId;
        $this->name = $name;
        $this->reports = $reports;
    }
}