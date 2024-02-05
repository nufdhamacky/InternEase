<?php

class RoundModel{
    public int $id;
    public int $advertisementCount;
    public int $jobRoleCount;
    public $startDate;
    public $endDate;


    public function __construct(int $id, int $advertisementCount,int $jobRoleCount, $startDate, $endDate) {
        $this->id = $id;
        $this->advertisementCount = $advertisementCount;
        $this->jobRoleCount = $jobRoleCount;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }


}