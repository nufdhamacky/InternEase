<?php

class BlackCompanyModel
{
    public int $userId;
    public string $name;
    public array $reports;
    public int $totalRecruitments;

    public function __construct(int $userId, string $name, array $reports, int $totalRecruitments)
    {
        $this->userId = $userId;
        $this->name = $name;
        $this->reports = $reports;
        $this->totalRecruitments = $totalRecruitments;
    }


}