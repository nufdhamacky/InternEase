<?php 

    class Validation extends Controller {

        public function validateLogin($username, $password) {
            $errors = [];

            // Validate Username
            if (empty($username) || empty($password)) {
                $errors = "Username and password is required.";
            }

            return $errors;
        }

        public function validateSignup($company, $email, $password, $confirmPassword) {
            $errors = [];

            // Validate Company Name
            if (empty($company)) {
                $errors['companyName'] = "Company name is required.";
            }

            // Validate Email
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Invalid email address.";
            }

            if (strlen($password) < 8 ) {
                $errors['password_length'] = "Password must be at least 8 characters.";
            }

            if(!preg_match("/[0-9]/", $password)){
                $errors['password_numerical'] = "Password must be at least contain a Number";
            }

            if(!preg_match("/[A-Z]/", $password)){
                $errors['password_uppercase'] = "Passwords must contain a upper-case letter.";
            }

            if(!preg_match("/[a-z]/", $password)){
                $errors['password_lowercase'] = "Passwords must contain a lower-case letter.";
            

            // Validate Confirm Password
            if ($password !== $confirmPassword) {
                $errors['confirmPassword'] = "Passwords do not match.";
            }

            return $errors;
        }
    }
    
        public function validate_password($password, $confirmPassword) {
            $errors = [];

            // Validate Company Name
            if (empty($password || $confirmPassword )) {
                $errors[''] = "Company name is required.";
            }

            // Validate Email
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Invalid email address.";
            }

            // Validate Password
            if (strlen($password) < 8 ||
                !preg_match("/[0-9]/", $password) ||
                !preg_match("/[A-Z]/", $password) ||
                !preg_match("/[^a-zA-Z0-9]/", $password)
            ) {
                $errors['password'] = "Password must be at least 8 characters.";
            }

            // Validate Confirm Password
            if ($password !== $confirmPassword) {
                $errors['confirmPassword'] = "Passwords do not match.";
            }

            return $errors;
        }

        
        public function validate_pwd($password, $confirmPassword) {
            $errors = [];

            // Validate Password
            if (strlen($password) < 8 ) {
                $errors['password_length'] = "Password must be at least 8 characters.";
            }

            if(!preg_match("/[0-9]/", $password)){
                $errors['password_numerical'] = "Password must be at least contain a Number";
            }

            if(!preg_match("/[A-Z]/", $password)){
                $errors['password_uppercase'] = "Passwords must contain a upper-case letter.";
            }

            if(!preg_match("/[a-z]/", $password)){
                $errors['password_lowercase'] = "Passwords must contain a lower-case letter.";
            }


            // Validate Confirm Password
            if ($password !== $confirmPassword) {
                $errors['confirmPassword'] = "Passwords do not match.";
            }

            return $errors;
        }

        public function validate_email($email) {
            $errors = [];

                if (empty($email)) {
                    $errors['emptyemail'] = "Email address is required.";
                    return $errors;
                }
              
          
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['invalidemail'] = "Invalid email format.";
                }
                $this->model('User');
                $Email_validate = new User;
                if($Email_validate->validate_email($email)){
                    $errors['Email_exist'] = "Email Already registered";
                }
            

            return $errors;
        }

        public function validate_name($name,$string){
            $errors =[];

            if(empty($string)){
                $errors['empty_letters']= $name." is required.";
                return $errors;
            }

            if (!ctype_alpha($string)) {
                $errors['non_letters']= $name." must contain only letters.";
            }

            

            return $errors;
        }

        public function digit($string) {
            $errors = [];
            // Check if the string contains only digits
            if (!preg_match("/^[0-9]+$/", $string)) {
                $errors['contact_err'] = "conatct number must contain only numbers.";
            }
            return $errors;
        }
        

        
    }

        
