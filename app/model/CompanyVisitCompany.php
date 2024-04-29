<?php 

Class CompanyVisitCompany extends Model{

    public function get_CompanyVisit(){
        $user_id = $_SESSION['userId'];
        $query = "SELECT * FROM company_visit WHERE company_id = $user_id";
        $results = $this->query($query);
        $rows = [];
        foreach ($results as $r) {
            if ($r['status'] == 1) {
                $r['status'] = 'Approved';
            } else if ($r['status'] == 0) {
                $r['status'] = 'Pending';
            } else {
                $r['status'] = 'Rejected';
            }
    
            $r['request_date'] = explode(' ', $r['request_date']);
            $r['visit_date'] = explode(' ', $r['visit_date']);

            $rows[] = [
                'status' => $r['status'],
                'requested_date' => $r['request_date'][0],
                'requested_time' => $r['request_date'][1],
                'visit_date' => $r['visit_date'][0],
                'visit_time' => $r['visit_date'][1],
            ];
        }
    
    

        if(empty($results)){
            return false;
        }else{
            return $rows;
        }
       

    }

    public function send_visit_data($user_id,$requested_date,$visit_date,$status,$reason){
       
        $query = "UPDATE company_visit SET visit_date = '$visit_date', status = $status, reason='$reason'
        WHERE company_id = $user_id AND request_date = '$requested_date'";
        $results = $this->query($query);
       
        if($results){
            return true;
        }else{
            return false;
        }
       

    }
}