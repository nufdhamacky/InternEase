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
        
        $updateStatement = $this->connection->prepare("UPDATE admins SET $column = ? WHERE Admin_ID = ?");
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
                'complaint_id' => $complaint['com_id'],
                'title' => $complaint['title'],
                'id' => $complaint['id'],
                'description' => $complaint['description'],
                'email' => $complaint['email'],
        ];
        }
        return $complaintsArray;
    }

    public function check_status($id){
        $query = "UPDATE " . $this->getTable() . " SET status = 1 WHERE com_id = $id";
        if($this->query($query)) {
            return true;
        }else{
            return false;
        }
    }

    public function getComplaintDetail($complaintId) {
        $query = "SELECT * FROM " . $this->getTable() . " WHERE com_id = ?";
        $complaints = $this->query($query, [$complaintId]);
    
        $complaintsArray = [];
    
        foreach ($complaints as $complaint) {
            $complaintsArray[] = [
                'status' => ($complaint['status'] == 0) ? 'un-reviewed' : 'reviewed',
                'complaint_id' => $complaint['com_id'],
                'title' => $complaint['title'],
                'id' => $complaint['id'],
                'description' => $complaint['description'],
                'email' => $complaint['email'],
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
    
    
   /* public function getAllProfiles() {
            $sql = 'SELECT Resume,Status,CGPA,Email,FirstName,LastName,Phone FROM Students';
            $result = mysqli_query($this->connection, $sql);
            $profiles = mysqli_fetch_all($result, MYSQLI_ASSOC);
            mysqli_free_result($result);
            return $profiles;
        }
        
    */
        

}
    
