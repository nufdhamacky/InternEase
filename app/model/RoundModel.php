<?php

class RoundModel
{
    public int $id;
    public int $count;
    public $startDate;
    public $endDate;


    public function __construct(int $id, int $count, $startDate, $endDate)
    {
        $this->id = $id;
        $this->count = $count;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }


}