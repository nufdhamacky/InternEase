<?php
include_once("CompanyAdModel.php");

class FirstRoundDataModel{
    public int $id;
    public CompanyAdModel $company;

    public function __construct($id,$company) {
        $this->id = $id;
        $this->company = $company;
    }
}