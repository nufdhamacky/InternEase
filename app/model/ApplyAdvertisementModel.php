<?php
include_once("RoundModel.php");
include_once("FirstRoundDataModel.php");

class ApplyAdvertisement{
    public int $id;
    public RoundModel $round;
    public $appliedDate;
    public FirstRoundDataModel $data;


    public function __construct($id,$round,$appliedDate,$data) {
        $this->id=$id;
       
        $this->round=$round;
        $this->appliedDate=$appliedDate;
        $this->data=$data;
    }
}