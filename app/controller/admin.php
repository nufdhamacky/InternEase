<?php

class Admin extends Controller {


    public function isLoggedIn(){
        if(isset($_SESSION['userId']) && isset($_SESSION['userRole'])=="admin"){
            return true;
        } else{
            $_SESSION['loginError'] = "Please login first!";
            echo "<script> window.location.href='http://localhost/internease/public/home/login';</script>";
            return 0;
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


//PROFILE UPDATE ADMIN

    public function profile() {
        if (!$this->isLoggedIn()){return;}
                $this->model('AdminModel');

                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateadmin"])) {
                
                    $data = [
                        'id' => $_SESSION["userId"],
                        'column' => $_POST["col"],
                        'value' => $_POST["updatevalue"],
                        'confirmPassword' => $_POST["confirmPassword"]
                    ];

                    $adminModel = new AdminModel; 
                    $adminModel->setTable('users');

                    if ($adminModel->updateAdmin($data)) {
                        if($_POST["col"] !='password'){
                            $_SESSION["userName"] =$data['value'];
                            echo '<script type="text/javascript">';
                            echo 'alert("Updated Successfully");';
                            echo 'window.location.href = "'.dirname($_SERVER['PHP_SELF']).'/admin/profile";';
                            echo '</script>';
                        }else{ 
                            echo '<script type="text/javascript">';
                            echo 'alert("Updated Successfully");';
                            echo 'window.location.href = "'.dirname($_SERVER['PHP_SELF']).'/admin/logout";';
                            echo '</script>';
                        }

                        exit();
                    } else {
                        echo '<script type="text/javascript">';
                        echo 'alert("Unsuccessful Update");';
                        echo 'window.location.href = "'.dirname($_SERVER['PHP_SELF']).'/admin/profile";';
                        echo '</script>';
                        exit();
                    }
                } else {
                    $this->view('admin/profile');
                }

    }
        
  


   /* public function insertAdmin(){
        
        $this->model('AdminModel');
        $adminModel = new AdminModel;  
        if ($adminModel->updateAdmin('admin@gmail.com', 'password', '12345', '12345')) {
            echo "1";
        } else {
                echo "0";
        }

    }
    */
    public function index(){
        if (!$this->isLoggedIn()){return;}
            $this->model('AdminModel');
            $adminModel = new AdminModel;
        
            $adminModel->setTable('company');
            $companies = $adminModel->getCompany();
        
            $adminModel->setTable('company_ad');
            $advertisments = $adminModel->getCompanyAD();
        
            $data = array(
                'companies' => $companies,
                'advertisments' => $advertisments
            );
        
            $this->view('admin/index', $data);

    }
    

    public function logout(){
        session_destroy();
        $this->redirect('..');
    }

    public function complaints(){
        if (!$this->isLoggedIn()){return;}
                
            $this->model('AdminModel');
            $adminModel = new AdminModel;
            $adminModel->setTable('complaint');
            $complaintsArray = $adminModel->getComplaints();
            $this->view('admin/viewComplaints',array('complaintsArray' => $complaintsArray)); 
    }

    function checkcomplaint($complaintID){

        $this->model('AdminModel');
        $adminModel = new AdminModel;
        $adminModel->setTable('complaint');
        $adminModel->check_status($complaintID);
        $this->redirect('../complaints');
    }

    public function managepdc(){

        if (!$this->isLoggedIn()){return;}
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

     function description($complaintId) {
        $this->model('AdminModel');
        $adminModel = new AdminModel;
        $adminModel->setTable('complaint');
        $complaintDetails = $adminModel->getComplaintDetail($complaintId);
        $this->view('admin/description', array('complaintDetails' => $complaintDetails));
    }

    function company_report(){
        $this->model('AdminModel');
        $adminModel = new AdminModel;
        $adminModel->setTable('complaint');
    }


}



?>