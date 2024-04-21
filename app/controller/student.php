<?php

class Student extends Controller{

    public function index(){
        $this->view('_404');
    }

    public function dashboard(){
        $this->view('student/dashboard');

    }
    public function advertisement(){
        $this->view('student/advertisement');

    }
    public function profile(){
        $this->view('student/profile');

    }
    public function schedule(){
        $this->view('student/schedule');

    }
    public function selectionlist(){
        $this->view('student/selectionlist');
        $this->model('User');
        
    }

    public function notification(){
        $this->view('student/notification');
    }

    public function enterstd(){
            $this->model('StdComplaintModel');
            $student = new StdComplaintModel;
            $student->setTable('users');
            $pwd = password_hash("123", PASSWORD_DEFAULT);
            $data =[
                        
                'user_name' => 'teststudent@gmail.com' ,
                'user_role' => 'student',
                'user_profile' => 'admin.jpg',
                'user_Status' => 1 ,

                'password' => $pwd ,
            
            ];
    
           $student->insert($data);
        }
    // Complaint Functions

    public function complaint(){
        //if (!$this->isLoggedIn()){return;}
            $this->model('StdComplaintModel');
            $stdmodel = new StdComplaintModel; 
            $stdcomplaints = $stdmodel->getComplaints();
            $data = [];
            $data = ['stdcomplaints' => $stdcomplaints

             ];
            
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sendcomplaint"])) {
                  
                $data = [
                    'id' => $_SESSION["userId"],
                    'type' => $_POST["type"],
                    'title' =>$_POST["subject"],
                    'description' => $_POST["details"],
                ];

                $stdmodel->setTable('complaint');

                if($stdmodel->insertcomplaint($data)){
                    echo "SUCESS";
                }else{
                    echo "NO";  
                
                }
             }
                
        $this->view('student/complaint',$data);

  
    }

    function description($complaintId) {
        $this->model('StdComplaintModel');
        $stdmodel = new StdComplaintModel; 
        $stdmodel->setTable('complaint');
        $complaintDetails = $stdmodel->getComplaintDetail($complaintId);
        $this->view('student/description', array('complaintDetails' => $complaintDetails));
    }


  

    
    public function logout(){
        session_destroy();
        echo "<script> window.location.href='http://localhost/internease/public/home';</script>";
    }       
    }