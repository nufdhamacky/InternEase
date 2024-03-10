<?php

class CompanyAdModel
{
    public ?int $adId;
    public string $position;
    public string $requirements;
    public string $noOfIntern;
    public string $workingMode;
    public $fromDate;
    public $toDate;
    public int $companyId;
    public string $qualification;
    public CompanyModel $company;
    public int $status;

    public function __construct($adId, $position, $requirements, $noOfIntern, $workingMode, $fromDate, $toDate, $companyId, $qualification, CompanyModel $company, $status)
    {
        $this->adId = $adId;
        $this->position = $position;
        $this->requirements = $requirements;
        $this->noOfIntern = $noOfIntern;
        $this->workingMode = $workingMode;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->companyId = $companyId;
        $this->qualification = $qualification;
        $this->company = $company;
        $this->status = $status;
    }
}