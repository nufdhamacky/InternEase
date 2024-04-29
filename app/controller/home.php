<?php

    class Home extends Controller {
        public function index(){
            
            $this->view('home/home');

        }

        public function about(){ 

           $this->view('home/aboutus');

        }

        public function service(){
            
            $this->view('home/services');

        }

        public function contactus(){
            
            $this->view('home/contactus');

        }

        public function login(){
            
            $this->view('home/login');

        }

        public function signup(){
            
            $this->view('home/signup');

        }

        public function signupStudent(){
            
            $this->view('home/signupStd');

        }
        
        public function logincheck(){
            
            //store psot varialble in local variable
            $username = $_POST['username'];
            $password = $_POST['password'];

            //including validation file
            require_once '../app/controller/helper/validation.php';

            //creating validation object
            $validation = new Validation();

            $errors = $validation->validateLogin($username, $password);
            
            if(!$errors){

                //creating user model object
                $user = $this->model('User');

                //calling login function from user model to check login
                $loginAccess = $user->login($username, $password, $this->conn);

                if($loginAccess == 1){
                   
                    if($_SESSION['userStatus']== 1){    
                        if($_SESSION['userRole'] == 'company' )
                            echo "<script> window.location.href='http://localhost/internease/public/company/dashboard';</script>";
                        else if($_SESSION['userRole'] == 'student')
                            echo "<script> window.location.href='http://localhost/internease/public/student/dashboard';</script>";
                        else if($_SESSION['userRole'] == 'admin')
                            echo "<script> window.location.href='http://localhost/internease/public/admin/index';</script>";
                        else
                            echo "<script> window.location.href='http://localhost/internease/public/pdc/dashboard';</script>";
                    }
                    else{
                        $data['loginError'] = 'Your account is not activated yet !';
                        $this->view('home/login', $data);
                    }
                }
                else if($loginAccess == 0){
                    $data['loginError'] = 'Username or password is incorrect !';
                    $this->view('home/login', $data);
                } else {
                    $data['loginError'] = 'Username not registered !';
                    $this->view('home/login', $data);
                }

            } else {
                $data['loginError'] = $errors;
                $this->view('home/login', $data);
            }

        }

        public function signupcheck(){
            
            //store psot varialble in local variable
            $company = $_POST['companyName'];
            $contactPerson = $_POST['contactPerson'];
            $contactNo = $_POST['contactNo'];    
            $compsite = $_POST['compsite'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];


            //creating validation object
            $validation = new Validation();
           
            $errors = [
                'email' => $validation->validate_email($email),
                'company_name' => $validation->validate_name('Company Name', $company),
                'password' => $validation->validate_pwd($password, $confirmPassword),
                'contact_person' => $validation->validate_name('Contact Person', $contactPerson),
            ];
            

            $errors = array_filter($errors);

            if(empty($errors)){
               
                
                $_SESSION['company'] = $_POST['companyName'] ?? null;
                $_SESSION['contact_person'] = $_POST['contactPerson'] ?? null;
                $_SESSION['contact_no'] = $_POST['contactNo'] ?? null;
                $_SESSION['company_site'] = $_POST['compsite'] ?? null;
                $_SESSION['email'] = $_POST['email'] ?? null;
                $_SESSION['password'] = $_POST['password'] ?? null;
                $_SESSION['address'] = $_POST['password'] ?? null;
                
                $smtp = new Mailer;
                $error = $smtp->sendOTPEmail($email,"Your OTP for company Registration!");
                if ($error == false){
                    $errors['OTP_failed'] = "OTP failure, try again";
                    $data = ['errors'=>$errors];
                    $this->view('home/signup',$data);
                    return 0;
                }

                $this->view('home/companyotp');
                return 0;
                

            } else {
                $data['errors'] = $errors;
                $this->view('home/signup', $data);
                return 0;
            }

        }

        public function proceed_signup(){

            $user = $this->model('User');
            //calling signup function from user model to check signup
            $signupAccess = $user->signup( $_SESSION['company'],   $_SESSION['email'], $_SESSION['password'], $_SESSION['company_site'],
            $_SESSION['address'],$_SESSION['contact_person'],$_SESSION['contact_no'] , $this->conn);

            if($signupAccess == 0){
                $data['signupError'] = 'Email already registered !';
                $this->view('home/signup', $data);
            }
            else if($signupAccess == 2){
                $data['signupError'] = 'Something went wrong. Try again later !';
                $this->view('home/signup', $data);
                
            }else{
                $data = ['sent'=>1];
                $this->view('home/signup', $data);

            }
            unset($_SESSION['company'] );
            unset($_SESSION['contact_person']) ;
            unset($_SESSION['contact_no'] );
            unset($_SESSION['company_site'] );
            unset( $_SESSION['email'] );
            unset($_SESSION['password'] );
            unset($_SESSION['address']) ;
            return 0;
        }

        public function signupcheck_student(){
            
            //store psot varialble in local variable
            $username = $_POST['userName'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];


            //including validation file
            require_once '../app/controller/helper/validation.php';

            //creating validation object
            $validation = new Validation();

            $errors = $validation->validateSignup($username, $email, $password, $confirmPassword);

            if(!$errors){

            
                $this->view('home/resetPassword',$data);

                //creating user model object
                $user = $this->model('User');

                //calling signup function from user model to check signup
                $signupAccess = $user->signupStudent($username, $email, $password, $this->conn);

                if($signupAccess == 0){
                    $data['signupError'] = 'Email already registered !';
                    $this->view('home/signupStd', $data);
                }
                else if($signupAccess == 2){
                    $data['signupError'] = 'Something went wrong. Try again later !';
                    $this->view('home/signupStd', $data);
                    
                } else {
                   ;
                }

            } else {
                $data['signupError'] = $errors;
                $this->view('home/signupStd', $data);
            }

        }

        public function resetPassword(){
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pwd_reset"])){
                $data = [ 'password' => $_POST['password'],'confirmPassword' => $_POST['confirmPassword']];
                require_once "helper/Validation.php";
                $validatePWD = new Validation;
                $errors = $validatePWD->validate_pwd($data['password'],$data['confirmPassword']);
                if(!empty($errors)){
                    $data = ['errors' => $errors];
                    $this->view('home/resetpage',$data);
                    return 0;
                }

                $this->model('User');
                $reset = new User;
                if($reset->resetPassword($data)){
                    $data = ['pwd'=>1];
                    $this->view('home/resetpage',$data);
                }else{
                    $errors['Email_notfound'] = "No user registered for the email entered.";
                    $data = ['errors'=>$errors];
                    $this->view('home/resetpage',$data);
                    return 0;
                }
            }else{
                echo "ERR";  
            }
        }

        public function sendEmailOTP(){
            $this->view('home/resetPassword');
        }


        public function password_reset_request(){
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["otp_req"])){
                $email = $_POST['email'];
                $_SESSION['resetEmail'] = $email;
                $this->model('User');
                $validate = new User;
                if($validate->validate_email($email)){
                    $smtp = new Mailer;
                    if(!$smtp->sendOTPEmail($email,"Password Reset OTP")){
                        $errors['OTP_failed'] = "OTP failure, try again";
                        $data = ['errors'=>$errors];
                        $this->view('home/resetPassword',$data);
                        return 0;
                    }else{
                        $data = ['otp'=>1];
                        $this->view('home/resetPassword',$data);
                    }

                }else{
                    $errors['Email_notfound'] = "No user registered for the email entered.";
                    $data = ['errors'=>$errors];
                    $this->view('home/resetPassword',$data);
                    return 0;
                }
            }
        }

        public function validate_otp(){
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_otp"])){
                $smtp = new Mailer;
                if(isset($_SESSION['resetEmail'])){
                    $email = $_SESSION['resetEmail'];
                }else{
                    $email = $_SESSION['email'];
                }
               
                $otp = $_POST['otp'];
                if($smtp->validateOTP($email,$otp)){
                    $data=['email'=> $email];
                    if(isset($_SESSION['resetEmail'])){
                        $this->view('home/resetpage',$data);
                    }
                    else{
                        $this->proceed_signup();
                    }
                }else{
                    if(isset($_SESSION['email'])){
                        $data=['sent'=> 0];
                        
                        $this->view('home/companyotp',$data);
                    }else{
                        $data=['sent'=> 0];
                        $this->view('home/resetPassword',$data);
                    }
                }

            }
    

        }

}