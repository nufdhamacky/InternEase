<?php

class AdvertisementModel{

    public $adId;
    public $position;
    public $req;
    public $interns;
    public $workMode;
    public $fromDate;
    public $toDate;
    public $companyId;
    public $qualification;

    public function __construct($adId, $position, $req, $interns, $workMode, $fromDate, $toDate, $companyId, $qualification){
        $this->adId = $adId;
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
