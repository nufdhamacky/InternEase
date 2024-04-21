<?php

class PageDataModel
{
    public int $currentPage;
    public int $totalPages;
    public array $data;

    public function __construct(int $currentPage, int $totalPages, array $data)
    {
        $this->currentPage = $currentPage;
        $this->totalPages = $totalPages;
        $this->data = $data;
    }
}