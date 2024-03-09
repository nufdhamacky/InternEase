<?php

class CompanyVisitModel
{
    public int $id;
    public int $companyId;
    public string $companyName;
    public $requestDate;
    public $visitDate;
    public ?string $reason;
    public int $status;

    public function __construct($id, $companyId, $companyName, $requestDate, $visitDate, $reason, $status)
    {
        $this->id = $id;
        $this->companyId = $companyId;
        $this->companyName = $companyName;
        $this->requestDate = $requestDate;
        $this->visitDate = $visitDate;
        $this->reason = $reason;
        $this->status = $status;
    }
}