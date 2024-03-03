<?php

class Ads extends Model{

    protected $table = 'ads';

    public function fetchAds(){
        return $this->findall();
    }
}