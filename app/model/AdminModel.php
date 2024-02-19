<?php

class AdminModel extends model {

    private $connection;
    
    

    public function __construct() {
        $this->connection = $this->connection();
    }


    public function updateAdmin($id, $column, $value, $confirmPassword) {
       
        if ($column === 'password') {
            $value = password_hash($confirmPassword, PASSWORD_DEFAULT);
        }
        
        $updateStatement = $this->connection->prepare("UPDATE admin SET $column = ? WHERE Email = ?");
        $updateStatement->bind_param("ss", $value, $id);

        if ($updateStatement->execute()) {
            return true;
        } else {
            return false;   
        }
    }

    public function insertPDC($confirmPassword,$data = []) {
        if ($data['password'] !== $confirmPassword) {
            return false;
        } else {
            $data['password'] = password_hash($confirmPassword, PASSWORD_DEFAULT);
            if ($this->query("INSERT INTO " . $this->getTable() . " (id, first_name, last_name, email, password) VALUES (?, ?, ?, ?, ?)", array_values($data))) {
                return true;
            } else {
                return false;
            }
        }
    }
    

    public function getCompany() {
        if ($this->query("INSERT INTO " . $this->getTable() . " (id, first_name, last_name, email, password) VALUES (?, ?, ?, ?, ?)", array_values($data))) {
                 return true;
            } else {
                return false;
            }
       
    }

    public function getComplaints() {
        $query = "SELECT * FROM " . $this->getTable();
        $complaints = $this->query($query);
        $complaintsArray = [];
        foreach ($complaints as $complaint) {
            $complaintsArray[] = [
                'status' => $complaint['status'],
                'complaint_id' => $complaint['complaint_id'],
                'title' => $complaint['title'],
                'student_id' => $complaint['student_id'],
                'user_type' => $complaint['user_type'],
                'description' => $complaint['description'],
                'company_id' => $complaint['company_id'],
                'date' => $complaint['created_at']
            ];
        }
        return $complaintsArray;
    }

    public function check_status($id){
        $query = "UPDATE " . $this->getTable() . " SET status = 1 WHERE complaint_id = $id";
        if($this->query($query)) {
            return true;
        }else{
            return false;
        }
    }

    public function getComplaintDetail($complaintId) {
        $query = "SELECT * FROM " . $this->getTable() . " WHERE complaint_id = ?";
             
        $complaints = $this->query($query, [$complaintId]);
    
        $complaintsArray = [];

        foreach ($complaints as $complaint) {
            $MoreDetail = $this->query("SELECT * FROM company WHERE user_id = ?", [$complaint['company_id']]);
            if (!empty($MoreDetail)) {
                $id =$complaint['company_id'];
                $email = $MoreDetail[0]['Email'];
                $contact_no = $MoreDetail[0]['contact_no'];
                $contact_person = $MoreDetail[0]['contact_person'];
                $user_type = 'Company';
            } else if(!empty($this->query("SELECT * FROM student WHERE registration_no = ?", [$complaint['student_id']]))){
                $id =$complaint['student_id'];
                $email = $MoreDetail['Email'];
                $contact_no = $MoreDetail['contact_no'];
                $contact_person = $MoreDetail['f_name'];
                $user_type = 'Student';
            }else{
                
                $user_type = 'Not available';
                $contact_no = 'Not available';
                $contact_person = 'Not available';
            }

            $complaintsArray[] = [
                'status' => ($complaint['status'] == 0) ? 'un-reviewed' : 'reviewed',
                'complaint_id' => $complaint['complaint_id'],
                'title' => $complaint['title'],
                'id' => $id,
                'description' => $complaint['description'],
                'email' => $email,
                'contact_no' =>  $contact_no ,
                'contact_person' => $contact_person,
                'user_type' => $user_type
            ];
        }

        
    
        return $complaintsArray;
    }
    

    public function updateStatus($complaintID) {
        $status = array(
            'status' => 1 
        );
        // Assuming $this refers to the current class instance where the 'update()' method is available
        $this->update($complaintID, $status, 'complaint_id');
    }

    public function insertadmin($data =[]){

        $hasedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['password'] = $hasedPassword;
        if($this->query("INSERT INTO " . $this->getTable() . "(user_name,user_role,user_profile,user_status,password) VALUES (?,?,?,?,?)", array_values($data))){
            echo "1";
        }else{

            echo "0";
        }
        
    }


    
    
   /* public function getAllProfiles() {
            $sql = 'SELECT Resume,Status,CGPA,Email,FirstName,LastName,Phone FROM Students';
            $result = mysqli_query($this->connection, $sql);
            $profiles = mysqli_fetch_all($result, MYSQLI_ASSOC);
            mysqli_free_result($result);
            return $profiles;
        }
        
    */
        

}
    
