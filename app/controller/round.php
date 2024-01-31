<?php
include_once('../app/repository/RoundRepository.php');
include_once('../app/model/RoundModel.php');
class Round extends Controller{

    private RoundRepository $roundRepository;
    public function __construct() {
        parent::__construct();
        $this->roundRepository = new RoundRepository($this->conn);
    }


    public function add() {
        $id = mysqli_real_escape_string($this->conn, $_POST['id']);
        $jobRoleCount=1;
        if($id==1)
        {
            $jobRoleCount=mysqli_real_escape_string($this->conn, $_POST['advertisement_count']);
        }
        else{
            $jobRoleCount=mysqli_real_escape_string($this->conn, $_POST['job_role_count']);
        }
        $advertisementCount=mysqli_real_escape_string($this->conn, $_POST['advertisement_count']);
        $startTime = strtotime($_POST['start_date']);
        if($startTime)
        {
            $startDate=date('Y-m-d', $startTime);
            $endTime = strtotime($_POST['end_date']);
            if($endTime)
            {
                $endDate=date('Y-m-d', $endTime);
                $this->roundRepository->save(new RoundModel($id,$advertisementCount,$jobRoleCount,$startDate,$endDate));

                if($id==1)
                {
                    echo "<script> window.location.href='http://localhost/internease/public/pdc/firstround';</script>";
                }
                else{
                    echo "<script> window.location.href='http://localhost/internease/public/pdc/secondround';</script>";
                }
            }
        }
    }
}