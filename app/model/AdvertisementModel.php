<?php

class AdvertisementModel {
    public $position;
    public $requirements;
    public $interns;
    public $workingMode;
    public $fromDate;
    public $toDate;
    public $companyId;
    public $qualification;
    public $otherQualifications; 
    public $status;
    public $imageUrl;
    public $no_of_cvs_required;

    public function __construct(
        $position,
        $requirements,
        $interns,
        $workingMode,
        $fromDate,
        $toDate,
        $companyId,
        $qualification,
        $otherQualifications, // Ensure this field is expected
        $status,
        $imageUrl,
        $no_of_cvs_required
    ) {
        $this->position = $position;
        $this->requirements = $requirements;
        $this->interns = $interns;
        $this->workingMode = $workingMode;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->companyId = $companyId;
        $this->qualification = $qualification;
        $this->otherQualifications = $otherQualifications; // Initialize properly
        $this->status = $status;
        $this->imageUrl = $imageUrl;
        $this->no_of_cvs_required = $no_of_cvs_required; // Initialize this
    }
}