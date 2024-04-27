<?php

class Admin extends Controller {


    public function isLoggedIn(){
        if(isset($_SESSION['userId']) && isset($_SESSION['userRole']) && $_SESSION['userRole'] == "admin"){
            return true;
        } else{
            return false; // It's better to return false instead of 0 for a boolean function.
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
            $trend2 = $adminModel->PositionTrend();
            $data=[];
            $empty=0;
            if(empty($trend['companies']) || empty($trend2['companies'])){
                $empty=1;
            }
         
            $data = [
               // '1stData'=> $firstround,
               'companylist'=> $trend['companies'],
               'years' => $trend['years'],
               'internsByYear' => $trend['internsByYear'],
               'Positions'=>$trend2['positions'],
               'companiesP'=>$trend2['companies'],
               'yearsP' =>$trend2['years'],
               'Pyear'=>$trend2['internsByYearP'],
               'total' => $total,
               'companies' => $companies,
               'advertisments' => $advertisments,
                'BL' => $adminModel->blacklisted_companies(),
                'com_count' =>$this->count_complaints(),
                'students' =>  $adminModel->getStudentCounts(),
                'first_round_data' => $adminModel->get_1stround(),
                'second_round_data' => $adminModel->get_2ndround(),
                'empty'=>$empty
               
            ];           
            
            $this->view('admin/index', $data);

    }

    public function search_company(){
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search_company"])) {
            $_SESSION['search_company']=$_POST['company'];
        }
        $_SESSION['filter']=1;
        $this->index();

    }

    public function removefilter(){
        unset($_SESSION['filter']);
        unset( $_SESSION['search_company']);

        $this->index();

    }


//PROFILE - ADMIN

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

                    
                    require_once '../app/controller/helper/validation.php';
                    $validate = new Validation;

                    if($_POST["col"] != 'user_name'){
                        $error = $validate->validate_pwd($data['value'],$data['confirmPassword']);
                        if($error){
                            $data['pwd_error']=$error;
                            $this->view('admin/profile',$data);
                        }
                    }else{
                        $error = $validate->validate_email($data['value']);
                        if($error){
                            $data['email_error']=$error;
                            $this->view('admin/profile',$data);
                            return 0;
                         }

                    }


                    $adminModel = new AdminModel; 
                    $adminModel->setTable('users');

                   
                    if($_POST["col"] !=='password'){
                            $inputotp = new Mailer;
                            $Otp = $inputotp->sendOTPEmail($data['value'],'Email Verification');
                            $_SESSION['newEmail'] =  $data['value'] ;
                            $data =['otp'=> 1];
                            $this->view('admin/profile',$data);
                        }else{ 
                            if($adminModel->updateAdmin($data)){
                                $pwd = 1;
                                $data =['pwd'=>   $pwd];  
                            }else{
                                $pwd = 0;
                                $data =['pwd'=>   $pwd];  
                            }

                            $this->view('admin/profile',$data);
                        }

                       
                } else {
                    $this->view('admin/profile');
                    
                }

                

    }

    public function validate_otp(){
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_otp"])){
                $smtp = new Mailer;
                $email = $_SESSION['newEmail'];
                $otp = $_POST['otp'];
                if($smtp->validateOTP($email,$otp)){

                    $data = [
                        'id' => $_SESSION["userId"],
                        'column' => 'user_name',
                        'value' => $email,
                        'confirmPassword' => NULL
                    ];

                    $this->model('AdminModel');
                    $admin=new AdminModel;
                    if($admin->updateAdmin($data)){
                        $data=['email'=> 1];
                        $this->view('admin/profile',$data);
                    }else{
                        $data=['email'=> 0];
                        $this->view('admin/profile',$data);
                    }
                    
                }else{

                    $data =['otp_fail'=>0];
                    $this->view('admin/profile',$data);
                }

            }


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
        $headers = array('company_name', 'email', 'contact_person', 'contact_no');
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

    //Report functions

    public function hash(){
        $pwd = password_hash('12345', PASSWORD_DEFAULT);
        echo $pwd;
    }

    public function reports(){
        if (!$this->isLoggedIn()){return;}
      
            $this->model('AdminModel');
            $adminModel = new AdminModel;
        
            $adminModel->setTable('company');
            $companies = $adminModel->getCompany();
        
            $adminModel->setTable('company_ad');
            $advertisments = $adminModel->getCompanyAD();
            $data = [
            
                 'companies' => $companies,
                 'advertisments' => $advertisments,
  
             ];           
             



        $this->view('admin/reports',$data); 
    }

    //COMPLAINT FUNCTIONS

    function count_complaints(){
        $this->model('AdminModel');
        $adminModel = new AdminModel;
        $adminModel->setTable('complaint');
        $com_count = $adminModel->getComplaintsCount();
        return $com_count;
    }

    public function complaints(){
        if (!$this->isLoggedIn()){return;}
                
            $this->model('AdminModel');
            $adminModel = new AdminModel;
            $adminModel->setTable('complaint');
            $complaintsArray = $adminModel->getComplaints();
            $this->view('admin/viewComplaints',array('complaintsArray' => $complaintsArray)); 
    }

    function checkcomplaint(){
        
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

        $pdc_users = $adminModel->getPDC();
        $data=[];

        $count =0;
        foreach ($pdc_users as $user) {
            $count+=1;
        }

        $limit=0;
        if($count>10){
            $limit = 1;
        }

        $data = [
            'pdc_users' => $pdc_users,
            'limit' =>$limit
        ];
        

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insertpdc'])) {
            $data = [
                'password' =>$this->generateStrongString(10),
                'first_name' => $_POST["pdc_fname"],
                'last_name' => $_POST["pdc_lname"],
                'email' => $_POST["pdc_email"],
            ];


           

            require_once '../app/controller/helper/validation.php';
            $validate = new Validation;
            $errorlist = [

            $error_email = $validate->validate_email($data['email']),
            $error_firstname = $validate->validate_name("First Name",$data['first_name']),
            $error_lastname = $validate->validate_name("Last Name", $data['last_name']) 
            ];

 
            $errors=[];
            foreach ($errorlist as $err){
                if(!empty($err)){
                    $errors[]=$err;
                }
            }
          
            $email = $_POST["pdc_email"];
            $pwd =$data['password'];
            $add = NULL;
            
            if(empty($errorlist)){
                if ($adminModel->insertPDC($data)) {
                    $add = 1;
                    $smtp = new Mailer;
                    $body = 
                    "<h2> PDC user created Sucessfully</h2>
                    <p>Your user name for InternEase is $email <b></b></p>
                    <p>Your Password:$pwd</p>
                    <p style='color:red;'>Please change your password after logging in</p>
                    ";
                    $smtp->sendMail($email,"PDC Account info",$body);
    
                } else {
                    $add = 0;
                }
            }
           
            $adminModel = new AdminModel; 
            $adminModel->setTable('pdc_user');
            $pdc_users = $adminModel->getPDC();
            $data =['pdc_users'=> $pdc_users,
                        'add' => $add,
                        'errors' => $errors,
                        'limit' =>$limit
                    ];

        }

       
        $this->view('admin/managepdc', $data);
        return 0;

    }

    public function generateStrongString($length = 8) {
        $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = "";
        $characterSets = [
          'lowercase' => str_split(str_split($characters)[array_rand(range(0, 25))]),
          'uppercase' => str_split(str_split($characters)[array_rand(range(26, 51))]),
          'numeric' => str_split(str_split($characters)[array_rand(range(52, 61))]),
        ];
      
        // Ensure at least one character from each set
        foreach ($characterSets as $type => $charSet) {
          $password .= $charSet[0];
        }
      
        // Fill remaining characters randomly
        $remainingLength = $length - strlen($password);
        $password .= substr(str_shuffle($characters), 0, $remainingLength);
      
        // Validate and regenerate if necessary
        if (!preg_match("/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/", $password)) {
          return $this->generateStrongString($length);
        }
      
        return $password;
      }
     
    public function pwd(){
      // Example usage
      $strongString = $this->generateStrongString(10);
      echo $strongString; // Output: aB2dEf3Gh1jK
    
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

}



