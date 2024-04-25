<?php

class AddCompanyVisitModel
{
    public int $companyId;
    public $requestDate;
    public ?string $reason;

    public function __construct($companyId, $requestDate, $reason)
    {
        $this->companyId = $companyId;
        $this->requestDate = $requestDate;
        $this->reason = $reason;
    }
}