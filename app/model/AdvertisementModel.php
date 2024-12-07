<?php

class AdvertisementModel
{
    public $position;
    public $requirements;
    public $interns;
    public $workingMode;
    public $fromDate;
    public $toDate;
    public $companyId;
    public $qualification;
    public $other_qualifications;
    public $status;
    public $no_of_cvs_required;
    public $scale;

    public function __construct(
        $position,
        $requirements,
        $interns,
        $workingMode,
        $fromDate,
        $toDate,
        $companyId,
        $qualification,
        $other_qualifications, // Ensure this field is expected
        $status,
        $no_of_cvs_required,
        $scale
    )
    {
        $this->position = $position;
        $this->requirements = $requirements;
        $this->interns = $interns;
        $this->workingMode = $workingMode;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->companyId = $companyId;
        $this->qualification = $qualification;
        $this->other_qualifications = $other_qualifications; // Initialize properly
        $this->status = $status;
        $this->no_of_cvs_required = $no_of_cvs_required; // Initialize this
        $this->scale = $scale;
    }
}