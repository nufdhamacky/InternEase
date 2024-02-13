<?php

class Admin extends Controller {


    public function isLoggedIn(){
        if(isset($_SESSION['userId']) && isset($_SESSION['userRole'])=="admin"){
            return 1;
        } else{
            return 0;
        }
    }

    public function dashboard(){

        $isLoggedIn = $this->isLoggedIn();
        
        if($isLoggedIn == 1){
            $this->view('admin/report');
        } else{
            $_SESSION['loginError'] = "Please login first!";
            echo "<script> window.location.href='http://localhost/internease/public/home/login';</script>";
        }
    
    }   

    public function add_admin(){
        $this->model('AdminModel');
        $admin = new adminmodel;
        $admin->setTable('users');
        $data =[
                    
            'user_name' => 'admin@gmail.com' ,
            'user_role' => 'admin',
            'user_profile' => 'admin.jpg',
            'user_Status' => 1 ,
            'password' => '12345' ,
        
        ];

       $admin->insertadmin($data);
    }


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
        $this->redirect('..');
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