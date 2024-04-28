<?php


class STudentRoundModel extends Model{


    protected $table = 'company_ad';

    private $connection;

    public function __construct() {
        $this->connection = $this->connection();
    }

    public function fetchRoundDates() {
        $sql = 'SELECT * FROM round';
        $result = mysqli_query($this->connection, $sql);
        $rounds = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        return $rounds;
    }
}