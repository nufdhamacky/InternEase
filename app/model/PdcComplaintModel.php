<?php

include_once("StudentShortModel.php");      // Include StudentShortModel.php file

class PdcComplaintModel
{
    public int $id;
    public StudentShortModel $student;
    public string $type;
    public string $title;
    public string $description;
    public ?string $reply;
    public int $status;
    public $date;

    public function __construct(int $id, StudentShortModel $student, string $type, string $title, string $description, ?string $reply, int $status, $date)
    {
        $this->id = $id;
        $this->student = $student;
        $this->type = $type;
        $this->title = $title;
        $this->description = $description;
        $this->reply = $reply;
        $this->status = $status;
        $this->date = $date;
    }
}