<?php

class admin extends Controller{


    public function profile(){


        $this->view('admin/profile');

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateadmin"])) {
        
            var_dump($_POST);
            
            $id = $_POST['id']; 
            $column = $_POST["col"];
            $updateValue = $_POST["updatevalue"];
            $confirmPassword = $_POST["confirmPassword"];
        
            $adminModel = new AdminModel; 
        
            
            if ($adminModel->updateAdmin($id, $column, $updateValue, $confirmPassword)) {
                exit();
            } else {
                echo("FAIL");
                exit();
            }
        }

       

    }

    public function logout(){
        session_destroy();
        echo "<script> window.location.href='http://localhost/internease/public/home/index';</script>";
    }

    public function complaints(){
        
        $adminModel = new AdminModel;

        $complaintsArray = $adminmodel->getcomplaints();

        $this->view('admin/viewComplaints',array('complaintsArray' => $complaintsArray));

    }

    public function managepdc(){
        $this->view('admin/managepdc');
    }

    public function report(){
        $this->view('admin/report');
    }

    public function editreport(){
        var_dump($_POST);
    }
}



?>