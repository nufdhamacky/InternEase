<?php

class Notification extends Model{
    protected $table = 'notifications';

    public function fetchNotifs(){
        return $this->findall();
    }
}