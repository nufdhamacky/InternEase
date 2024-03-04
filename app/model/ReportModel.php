<?php

class ReportModel
{
    public int $id;

    public StudentShortModel $student;
    public string $reason;
    public $date;

    public function __construct(int $id, StudentShortModel $student, string $reason, $date)
    {
        $this->id = $id;
        $this->student = $student;
        $this->reason = $reason;
        $this->date = $date;
    }
}