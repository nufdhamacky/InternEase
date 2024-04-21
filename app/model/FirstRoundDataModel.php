<?php


class FirstRoundDataModel
{
    public int $status;

    public function __construct($status)
    {
        $this->status = $status;
    }
}