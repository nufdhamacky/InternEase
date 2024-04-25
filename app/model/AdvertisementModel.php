<?php

class AdvertisementModel
{

    public $position;
    public $req;
    public $interns;
    public $workMode;
    public $fromDate;
    public $toDate;
    public $companyId;
    public $qualification;


    public function __construct($position, $req, $interns, $workMode, $fromDate, $toDate, $companyId, $qualification)
    {

        $this->position = $position;
        $this->req = $req;
        $this->interns = $interns;
        $this->workMode = $workMode;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->companyId = $companyId;
        $this->qualification = $qualification;
    }


}
