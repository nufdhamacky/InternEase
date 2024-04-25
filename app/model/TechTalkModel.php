<?php

class TechTalkModel{

    public $userId;
    public $date;
    public $duration;
    public $start_time;
    public $end_time;   

    public function __construct( $userId, $date, $duration, $start_time, $end_time){

        $this->userId = $userId;
        $this->date = $date;
        $this->duration = $duration;
        $this->start_time = $start_time;
        $this->end_time = $end_time;
    }


}
