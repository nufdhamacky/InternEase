<?php

class Admin extends Controller {


    public function profile(){

        $this->model('AdminModel');


        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateadmin"])) {
        
            var_dump($_POST);
            
            $id = $_POST['id']; 
            $column = $_POST["col"];
            $updateValue = $_POST["updatevalue"];
            $confirmPassword = $_POST["confirmPassword"];
        
            $adminModel = new AdminModel; 
        
            
            if ($adminModel->updateAdmin($id, $column, $updateValue, $confirmPassword)) {
                echo '<script type="text/javascript">';
                echo 'alert("Updated Successfully");';
                echo 'window.location.href = "'.dirname($_SERVER['PHP_SELF']).'/admin/profile";';
                echo '</script>';
                exit();
            } else {
                echo '<script type="text/javascript">';
                echo 'alert("Unsucessful Update");';
                echo 'window.location.href = "'.dirname($_SERVER['PHP_SELF']).'/admin/profile";';
                echo '</script>';
                exit();
            }
        }else{
            $this->view('admin/profile');
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