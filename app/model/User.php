<?php

    class User {

        public function login($username, $password, $conn){

            $sql = "SELECT * FROM users WHERE user_name = '$username'";

            $result = $conn->query($sql);

            $row = $result->fetch_assoc();

            if($result->num_rows > 0){

                if($row['user_role'] == 'company'){

                    if(password_verify($password, $row['password'])){
                    

                    
                        $sql = "SELECT * FROM pdc_user WHERE id = {$row['user_id']}";
                        $result1 = $conn->query($sql);  
    
                        $_SESSION['userId']= $row['user_id'];
                        $_SESSION['userRole']= $row['user_role'];
                        $_SESSION['userStatus']= $row['user_status'];
                        $_SESSION['userName']= $row['user_name'];
                        return 1;
                        
                    }
                 }else if($row['user_role'] == 'admin'){
                        if(password_verify($password, $row['password'])){
                        
                            $sql = "SELECT * FROM admin WHERE admin_id = {$row['user_id']}";
                            $result1 = $conn->query($sql);  
        
                            $_SESSION['userId']= $row['user_id'];
                            $_SESSION['userRole']= $row['user_role'];
                            $_SESSION['userStatus']= $row['user_status'];
                            $_SESSION['userName']= $row['user_name'];
                            return 1;
                            
                        }else {
                            return 0;
                        }
                }
        
            }else{
                return 2;
            }
            
        }

        public function signup($company, $email, $password, $conn){

            $hasedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "SELECT * FROM users WHERE user_name = '$email'";

            $result = $conn->query($sql);

            if($result->num_rows > 0){
            
                return 0;

            }else{

                $sql = "INSERT INTO users (user_name, user_role, password)
                        VALUES ('$email', 'company', '$hasedPassword')";

                $result1 = $conn->query($sql);

                if($result1){

                    $lastId = $conn->insert_id;

                    $sql = "INSERT INTO company (company_name, user_id,)
                            VALUES ('$company', '$lastId')";
                    
                    $result2 = $conn->query($sql);

                    if($result2){

                        $_SESSION['userId']= $lastId;
                        $_SESSION['companyName']= $company;
                        $_SESSION['userRole']= 'company';
                        $_SESSION['userProfile']= "default.png";
                        $_SESSION['userStatus']= "0";
                        return 1;
                    }
                    else{
                        
                        $sql = "DELETE FROM users WHERE id = '$lastId'";
                        $conn->query($sql);
                        return 2;
                        
                    }
                }   
                else{
                    return 2;
                }
            }
            
        }

        public function signupStudent($username, $email, $password, $conn){

            $hasedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "SELECT * FROM users WHERE user_name = '$email'";

            $result = $conn->query($sql);

            if($result->num_rows > 0){
            
                return 0;

            }else{

                $sql = "INSERT INTO users (user_name, user_role, password)
                        VALUES ('$email', 'student', '$hasedPassword')";

                $result1 = $conn->query($sql);

                
            }
            
        }

}