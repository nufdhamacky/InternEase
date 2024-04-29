<?php

class User extends Model
{ 

    public function login($username, $password, $conn)
    {

        $sql = "SELECT * FROM users WHERE user_name = '$username'";

        $result = $conn->query($sql);

        $row = $result->fetch_assoc();

        if ($result->num_rows > 0) {

            if ($row['user_role'] == 'company') {

                if (password_verify($password, $row['password'])) {

                    $sql = "SELECT * FROM company WHERE user_id = {$row['user_id']}";
                    $result1 = $conn->query($sql);
                    if ($result1->num_rows > 0) {
                        $_SESSION['userId'] = $row['user_id'];
                        $_SESSION['companyName'] = $result1->fetch_assoc()['company_name'];
                        $_SESSION['userRole'] = $row['user_role'];
                        $_SESSION['userProfile'] = $row['user_profile'];
                        $_SESSION['userStatus'] = $row['user_status'];
                        return 1;
                    } else {
                        return 0;
                    }
                } else {
                    return 0;
                }

            } else if ($row['user_role'] == 'pdc') {
                if (password_verify($password, $row['password'])) {

                    $sql = "SELECT * FROM pdc_user WHERE id = {$row['user_id']}";
                    $result1 = $conn->query($sql);

                    $_SESSION['userId'] = $row['user_id'];
                    $_SESSION['userRole'] = $row['user_role'];
                    $_SESSION['userStatus'] = $row['user_status'];
                    $_SESSION['userName'] = $row['user_name'];
                    return 1;

                }else{
                    return 0;
                }
            } else if ($row['user_role'] == 'admin') {
                if (password_verify($password, $row['password'])) {

                    $sql = "SELECT * FROM admin WHERE admin_id = {$row['user_id']}";
                    $result1 = $conn->query($sql);

                    $_SESSION['userId'] = $row['user_id'];
                    $_SESSION['userRole'] = $row['user_role'];
                    $_SESSION['userStatus'] = $row['user_status'];
                    $_SESSION['userName'] = $row['user_name'];
                    return 1;

                } else {
                    return 0;
                }
            }else if ($row['user_role'] == 'student') {
                if (password_verify($password, $row['password'])) {

                    $sql = "SELECT * FROM student WHERE user_id = {$row['user_id']}";
                    $result1 = $conn->query($sql);

                    $student = $result1->fetch_assoc();

                    $_SESSION['userId'] = $row['user_id'];
                    $_SESSION['studentId'] = $student['id'];
                    $_SESSION['userRole'] = $row['user_role'];
                    $_SESSION['userStatus'] = $row['user_status'];
                    $_SESSION['userName'] = $row['user_name'];
                    return 1;

                } else {
                    return 0;
                }
            }

        } else {
            return 2;
        }

    }

    public function signup($company, $email, $password, $companySite, $address, $contactPerson, $contactNo) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $conn = $this->connection(); // Use this single connection for all queries within this function
    
        // Check if the email already exists
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE user_name = ? AND user_role ='company'");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            echo "EMAIL EXISTS";
            return 0;
        } else {
            // Insert into users table
            $stmt = $conn->prepare("INSERT INTO users (user_name, user_role, password) VALUES (?, 'company', ?)");
            $stmt->bind_param('ss', $email, $hashedPassword);
            $userInsertion = $stmt->execute();
    
            if ($userInsertion) {
                // Retrieve the last inserted ID
                $lastId = $conn->insert_id;
    
                // Insert into company table
                $stmt = $conn->prepare("INSERT INTO company (company_name, user_id, contact_person, email, contact_no, company_site, address) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param('sisssss', $company, $lastId, $contactPerson, $email, $contactNo, $companySite, $address);
                $companyInsertion = $stmt->execute();
    
                if ($companyInsertion) {
                    // Set session variables
                    $_SESSION['userId'] = $lastId;
                    $_SESSION['companyName'] = $company;
                    $_SESSION['userRole'] = 'company';
                    $_SESSION['userProfile'] = "profile.png";
                    $_SESSION['userStatus'] = "0";
                    $_SESSION['userEmail'] = $email;
                    return 1;
                } else {
                    // If inserting into company table failed, remove the user entry
                    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
                    $stmt->bind_param('i', $lastId);
                    $stmt->execute();
                    return 2;
                }
            } else {
                return 2;
            }
        }
    }
    
      
    

    public function signupStudent($username, $email, $password, $conn)
    {

        $hasedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM users WHERE user_name = '$email'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            return 0;

        } else {

            $sql = "INSERT INTO users (user_name, user_role, password)
                        VALUES ('$email', 'student', '$hasedPassword')";

            $result1 = $conn->query($sql);


        }

    }

    function validate_email($email){
        $query = "SELECT user_name from users where user_name = '{$email}'";
        $result = $this->query($query);
        if(empty($result)){
            return false;
        }else{
            return true;
        }
    }

    public function resetPassword($data) {
        extract($data);
        $password = password_hash($confirmPassword, PASSWORD_DEFAULT);
        $query = "UPDATE users SET password = ? WHERE user_name= ?";
        $params = array($password, $_SESSION['resetEmail']);

        $update = $this->query($query, $params);

        if ($update) {
            return true;
        } else {
            return false;
        }
    }

}