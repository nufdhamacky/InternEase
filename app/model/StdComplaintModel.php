<?php

Class StdComplaintModel extends model{

    private $connection;
    
    

    public function __construct() {
        $this->connection = $this->connection();
    }

    function getComplaints() {
        $userId = $_SESSION['userId'];
        $query = "SELECT * FROM complaint WHERE type = 'user_complaint' AND student_id = {$userId}";
        $insert = $this->query($query);
        $complaints = [];
        foreach ($insert as $complaint) {
            $complaints[] = [
                'status' => $complaint['status'],
                'complaint_id' => $complaint['complaint_id'],
                'title' => $complaint['title'],
                'type' => $complaint['type'],
                'student_id' => $complaint['student_id'],
                'description' => $complaint['description'],
                'reply' =>$complaint['reply'],
                'date' => $complaint['created_at']
            ];
        }
        return $complaints;
    }

    function insertcomplaint($data){
        $complaint = [
            'student_id' => $data['id'],
            'user_type' => 'student',
            'title' => $data['title'],
            'type' => $data['type'],
            'description' => $data['description'],
            'status' => 0,
        ];

        $insertResult = $this->insert($complaint);
        if($insertResult){
            return 1;
        }else{
            return 0;
        }
    }


    public function getComplaintDetail($complaintId) {
        $query = "SELECT * FROM " . $this->getTable() . " WHERE complaint_id = ?";
             
        $complaints = $this->query($query, [$complaintId]);
    
        $complaintsArray = [];

        foreach ($complaints as $complaint) {
           
            $MoreDetail_s = $this->query("SELECT * FROM student WHERE id = ?", [$complaint['student_id']]);


            if(!empty($MoreDetail_s)){

                $id = $MoreDetail_s[0]['id'];
                $index = $MoreDetail_s[0]['index_no'];
                $email = $MoreDetail_s[0]['email'];
                $contact_no = NULL;
                $contact_person = $MoreDetail_s[0]['first_name'] . ' ' . $MoreDetail_s[0]['last_name']; // Concatenate first name and last name
            
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
                'index_no' => $index,
                'description' => $complaint['description'],
                'email' => $email,
                'reply' => $complaint['reply'],
            ];
            
        }

        
    
        return $complaintsArray;
    }


    

    public function updateStatus($complaintID) {
        $status = array(
            'status' => 1 
        );
        $this->update($complaintID, $status, 'complaint_id');
    }




}