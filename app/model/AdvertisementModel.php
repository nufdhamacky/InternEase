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
    public $status;
    public $image_url;
    public $no_of_cvs_required;


    public function __construct( $position, $req, $interns, $workMode, $fromDate, $toDate, $companyId, $qualification, $status, $image_url, $no_of_cvs_required){


        $this->position = $position;
        $this->req = $req;
        $this->interns = $interns;
        $this->workMode = $workMode;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->companyId = $companyId;
        $this->qualification = $qualification;
        $this->status = $status;
        $this->image_url = $image_url;
        $this->no_of_cvs_required = $no_of_cvs_required;
    }


}
