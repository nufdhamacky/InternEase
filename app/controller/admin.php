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
        
  

    //DASHBOARD / INDEX
    public function index(){
        if (!$this->isLoggedIn()){return;}
      
            $this->model('AdminModel');
            $adminModel = new AdminModel;
        
            $adminModel->setTable('company');
            $companies = $adminModel->getCompany();
        
            $adminModel->setTable('company_ad');
            $advertisments = $adminModel->getCompanyAD();

            //$firstround = $adminModel->get_1stround();
            $total = $adminModel->totalstudents();

            $trend = $adminModel->companyInternTrend();
        
            $data = array(
               // '1stData'=> $firstround,
               'companylist'=> $trend['companies'],
               'years' => $trend['years'],
               'internsByYear' => $trend['internsByYear'],
               'total' => $total,
                'count' => $adminModel->blacklisted_companies(),
                'companies' => $companies,
                'advertisments' => $advertisments
            );           
            
            $this->view('admin/index', $data);

    }

    function max_width($pdf,$headers,$data =[]){
        $max_column = 0;
        foreach ($headers as $header) {
            $cellWidth = $pdf->GetStringWidth($header);
            if($cellWidth>$max_column){
                $max_column = $cellWidth;
            }
        }
        $max = 0;
        foreach ($data as $dat) {
            foreach ($headers as $header) {
                $cellWidth = $pdf->GetStringWidth($dat[$header]);
                if($cellWidth> $max){
                    $max = $cellWidth;
                }
            }
        }
        if($max<$max_column){
            $max =$max_column;
            return $max+5;
        }
        return $max + 5;
    }

    function ad_report(){
        $advertisments = isset($_GET['data']) ? json_decode(urldecode($_GET['data']), true) : [];
        $companies = isset($_GET['companies']) ? json_decode(urldecode($_GET['companies']), true) : [];
        
        $headers = array('company_id','position', 'requirements', 'no_of_intern', 'working_mode', 'from_date', 'to_date', 'qualification');
        $numColumns = count($headers);
       
        $pdf =  new FPDF('P','mm',array(297,50* ($numColumns-1)));
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 11);

        $pdf->SetFillColor (178,215,243);

        foreach ($advertisments as &$ad) {
            foreach ($companies as $company) {
                if ($company['user_id'] == $ad['company_id']) {
                    $ad['company_id'] = $company['company_name'];
                    break;
                }
            }
        }
        unset($ad); 
        $max=$this->max_width($pdf,$headers,$advertisments);

        $pdf->Cell($max, 10, 'Company', 0, 0,'C',true); 
        $pdf->Cell($max, 10, 'Position', 0, 0,'C',true); 
        $pdf->Cell($max, 10, 'Requirements', 0, 0,'C',true); 
        $pdf->Cell($max, 10, 'No. of interns', 0, 0,'C',true); 
        $pdf->Cell($max, 10, 'Working Mode', 0, 0,'C',true); 
        $pdf->Cell($max, 10, 'From Date', 0, 0,'C',true); 
        $pdf->Cell($max, 10, 'To Date', 0, 0,'C',true); 
        $pdf->Cell($max, 10, 'Qualification', 0, 1,'C',true);

        $pdf->Cell($numColumns*30, 0, '', 'T'); //BOTTOM Border
        
        $pdf->Ln();
      
        $pdf->SetFont('Arial','', 10);
        
        $pdf->SetFillColor(255, 255, 255); // White background
        foreach ($advertisments as $ad) {
            foreach ($headers as $header) {
                $pdf->Cell($max, 10, $ad[$header], 1, 0, 'C', true);
            }
  
        $pdf->Ln();
        }
        $pdf->Output();
    }

    function reg_report(){
        $companies = isset($_GET['data']) ? json_decode(urldecode($_GET['data']), true) : [];
        $headers = array('company_name', 'Email', 'contact_person', 'contact_no');
        $numColumns = count($headers);
        $pdf =  new FPDF('P','mm',array(297,50 * $numColumns));
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 11);

        $pdf->SetFillColor (178,215,243); 


        $max=$this->max_width($pdf,$headers,$companies);

        $pdf->Cell($max, 10, 'Company Name', 1, 0, 'C', true); 
        $pdf->Cell($max, 10, 'Email', 1, 0, 'C', true); 
        $pdf->Cell($max, 10, 'Contact Person', 1, 0, 'C', true); 
        $pdf->Cell($max, 10, 'Contact No', 1, 1, 'C', true); 

        $pdf->Cell($numColumns*$max, 0, '', 'T'); //BOTTOM Border
        $pdf->Ln();


        $pdf->SetFont('Arial','', 10);
        $pdf->SetFillColor(255, 255, 255); // White background

        foreach ($companies as $reg) {
            foreach ($headers as $header) {
                $pdf->Cell($max , 10, $reg[$header], 1, 0, 'C', true);
            }
  
        $pdf->Ln();
        }
        $pdf->Output();
    }

    

    //COMPLAINT FUNCTIONS

    public function complaints(){
        if (!$this->isLoggedIn()){return;}
                
            $this->model('AdminModel');
            $adminModel = new AdminModel;
            $adminModel->setTable('complaint');
            $complaintsArray = $adminModel->getComplaints();
            $this->view('admin/viewComplaints',array('complaintsArray' => $complaintsArray)); 
    }

    public function checkcomplaint(){
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["send_reply"])) {
                
                $data = [
                    'id' => $_POST["complaint_id"],
                    'reply' => $_POST["reply"],
                ];

            $this->model('AdminModel');
            $adminModel = new AdminModel;
            $adminModel->setTable('complaint');

            if($adminModel->check_status($data)){
                echo "WTF";
                $this->redirect('../admin/complaints');
            }else{
                echo "NO";  
            
            }
        }
    }

    function description($complaintId) {
        $this->model('AdminModel');
        $adminModel = new AdminModel;
        $adminModel->setTable('complaint');
        $complaintDetails = $adminModel->getComplaintDetail($complaintId);
        $this->view('admin/description', array('complaintDetails' => $complaintDetails));
    }


//ADD PDC User
    public function managepdc() {
        $this->model('AdminModel');
        $adminModel = new AdminModel; 
        $adminModel->setTable('pdc_user');

        if (!$this->isLoggedIn()) {
            return; 
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insertpdc'])) {
            $data = [
                'first_name' => $_POST["pdc_fname"],
                'last_name' => $_POST["pdc_lname"],
                'email' => $_POST["pdc_email"],
                'password' => $_POST["pdc_pwd"],
            ];

            $confirmPassword = $_POST["pdc_rpwd"];
            
            if ($adminModel->insertPDC($confirmPassword, $data)) {
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
        }

        $pdc_users = $adminModel->getPDC();
        $data = [
            'pdc_users' => $pdc_users,
        ];
        $this->view('admin/managepdc', $data);
    }
 

    function company_report(){
        $this->model('AdminModel');
        $adminModel = new AdminModel;
        $adminModel->setTable('complaint');
    }



    public function logout(){
        session_destroy();
        $this->redirect('..');
    }

    function blacklisted(){
        $this->model('AdminModel');
        $adminModel = new AdminModel;
        return $adminModel->blacklisted_companies();
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

    /*
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
*/
}



