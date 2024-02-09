<?php

class Admin extends Controller {


    public function profile(){

        $this->model('AdminModel');


        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateadmin"])) {
            
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

    public function report(){
        $this->view('admin/report');
    }

    public function logout(){
        session_destroy();
        echo "<script> window.location.href='http://localhost/internease/public/home/index';</script>";
    }

    public function complaints(){
        $this->model('AdminModel');
        $adminModel = new AdminModel;
        $adminModel->setTable('complaint');
        $complaintsArray = $adminModel->getComplaints();
        $this->view('admin/viewComplaints',array('complaintsArray' => $complaintsArray));

    }

    public function checkcomplaint($complaintID){
        $this->model('AdminModel');
        $adminModel = new AdminModel;
        $adminModel->setTable('complaint');
        $adminModel->check_status($complaintID);
        $this->redirect('../complaints');
    }

    public function managepdc(){
        $this->model('AdminModel');

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insertpdc'])) {
                
                $data =[
                    
                'id' => $_POST["pdc_id"],
                'first_name' => $_POST["pdc_fname"],
                'last_name' => $_POST["pdc_lname"],
                'email' => $_POST["pdc_email"],
                'password' => $_POST["pdc_pwd"],
            
            ];

            $confirmPassword = $_POST["pdc_rpwd"] ;
            
            $adminModel = new AdminModel; 
            $adminModel->setTable('pdc_user');
            
                if ($adminModel->insertPDC($confirmPassword,$data)) {
                    echo '<script type="text/javascript">';
                    echo 'alert("Inserted PDC User Successfully");';
                    echo 'window.location.href = "'.dirname($_SERVER['PHP_SELF']).'/admin/managepdc";';
                    echo '</script>';
                    exit();
                } else {
                    echo '<script type="text/javascript">';
                    echo 'alert("Unsucessful PDC user insertion");';
                    echo 'window.location.href = "'.dirname($_SERVER['PHP_SELF']).'/admin/managepdc";';
                    echo '</script>';
                    exit();
                }
       
            
        }else{
            $this->view('admin/managepdc');
        }

    }

    public function description($complaintId) {
        $this->model('AdminModel');
        $adminModel = new AdminModel;
        $adminModel->setTable('complaint');
        $complaintDetails = $adminModel->getComplaintDetail($complaintId);
        $this->view('admin/description', array('complaintDetails' => $complaintDetails));
    }
    public function editreport(){
    }
}



?>