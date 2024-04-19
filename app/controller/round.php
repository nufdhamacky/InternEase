<?php
include_once('../app/repository/RoundRepository.php');
include_once('../app/repository/StudentRepository.php');
include_once('../app/model/RoundModel.php');

class Round extends Controller
{

    private RoundRepository $roundRepository;
    private StudentRepository $studentRepository;

    public function __construct()
    {
        parent::__construct();
        $this->roundRepository = new RoundRepository($this->conn);
        $this->studentRepository = new StudentRepository($this->conn);
    }

    public function addOrUpdate()
    {
        $round = $this->roundRepository->findById(1);
        if ($round) {
            $this->update();
        } else {
            $this->add();
        }
    }

    public function update()
    {
        $id = mysqli_real_escape_string($this->conn, $_POST['id']);
        $count = 1;
        if ($id == 1) {
            $count = mysqli_real_escape_string($this->conn, $_POST['advertisement_count']);
        } else {
            $count = mysqli_real_escape_string($this->conn, $_POST['job_role_count']);
        }
        //$advertisementCount = mysqli_real_escape_string($this->conn, $_POST['advertisement_count']);
        $startTime = strtotime($_POST['start_date']);
        if ($startTime) {
            $startDate = date('Y-m-d', $startTime);
            $endTime = strtotime($_POST['end_date']);
            if ($endTime) {
                $endDate = date('Y-m-d', $endTime);
                $this->roundRepository->update(new RoundModel($id, $count, $startDate, $endDate));

                if ($id == 1) {
                    echo "<script> window.location.replace('http://localhost/internease/public/pdc/firstround');</script>";
                } else {
                    echo "<script> window.location.replace('http://localhost/internease/public/pdc/secondround');</script>";
                }
            }
        }
    }

    public function add()
    {
        $id = mysqli_real_escape_string($this->conn, $_POST['id']);
        $count = 1;
        if ($id == 1) {
            $count = mysqli_real_escape_string($this->conn, $_POST['advertisement_count']);
        } else {
            $count = mysqli_real_escape_string($this->conn, $_POST['job_role_count']);
        }
        //$advertisementCount = mysqli_real_escape_string($this->conn, $_POST['advertisement_count']);
        $startTime = strtotime($_POST['start_date']);
        if ($startTime) {
            $startDate = date('Y-m-d', $startTime);
            $endTime = strtotime($_POST['end_date']);
            if ($endTime) {
                $endDate = date('Y-m-d', $endTime);
                $this->roundRepository->save(new RoundModel($id, $count, $startDate, $endDate));

                if ($id == 1) {
                    echo "<script> window.location.replace('http://localhost/internease/public/pdc/firstround');</script>";
                } else {
                    echo "<script> window.location.replace('http://localhost/internease/public/pdc/secondround');</script>";
                }
            }
        }
    }

    public function getFirstRound(): ?RoundModel
    {
        return $this->roundRepository->findById(1);
    }

    public function getFirstRoundStudents(): array
    {
        return $this->studentRepository->findAllByFirstRound();
    }

    public function filterFirstRoundStudents($companyId): array
    {
        return $this->studentRepository->filter(1, $companyId);
    }

    public function getSecondRound(): ?RoundModel
    {
        return $this->roundRepository->findById(2);
    }

    public function getSecondRoundStudents(): array
    {
        return $this->studentRepository->findAllBySecondRound();
    }


}