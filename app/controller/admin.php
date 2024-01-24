<?php

class admin extends Controller{

    public function profile(){

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateadmin"])) {
        
            var_dump($_POST);
            
            $id = $_POST['id']; 
            $column = $_POST["col"];
            $updateValue = $_POST["updatevalue"];
            $confirmPassword = $_POST["confirmPassword"];
        
            
            $dbconnection = new Database;
            $adminModel = new AdminModel(connect()); 
        
            
            if ($adminModel->updateAdmin($id, $column, $updateValue, $confirmPassword)) {
                exit();
            } else {
                echo("FAIL");
                exit();
            }
        }

        $this->view('admin/profile');

    }

    public function logout(){
        session_destroy();
        echo "<script> window.location.href='http://localhost/internease/public/home/index';</script>";
    }

    public function complaints(){
        $this->view('admin/viewComplaints');
    }

    public function managepdc(){
        $this->view('admin/managepdc');
    }

    public function report(){
        $this->view('admin/report');
    }
}


?>