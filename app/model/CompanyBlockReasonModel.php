<?php

include_once("MyCompanyModel.php");      // Include StudentShortModel.php file

class CompanyBlockReasonModel
{
    public int $id;
    public MyCompanyModel $company;
    public string $reason;
    public $date;

    public function __construct(int $id, MyCompanyModel $company, string $reason, $date)
    {
        $this->id = $id;
        $this->company = $company;
        $this->reason = $reason;
        $this->date = $date;

    }
}
