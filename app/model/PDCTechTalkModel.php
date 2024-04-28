<?php

include_once("MyCompanyModel.php.php");

class PDCTechTalkModel
{
    public int $techTalkId;
    public MyCompanyModel $company;
    public string $topic;
    public $fromDate;
    public $toDate;
    public int $status;

    public function __construct(int $techTalkId, MyCompanyModel $company, string $topic, $fromDate, $toDate, int $status)
    {
        $this->techTalkId = $techTalkId;
        $this->company = $company;
        $this->topic = $topic;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->status = $status;
    }

}