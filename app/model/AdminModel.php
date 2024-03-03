<?php

class AdminModel extends model {

    private $connection;
    
    

    public function __construct() {
        $this->connection = $this->connection();
    }

//PROFILE
public function updateAdmin($data) {

    if ($data['column'] === 'password') {
        $data['value'] = password_hash($data['confirmPassword'], PASSWORD_DEFAULT);
    }

    $query = "UPDATE users SET {$data['column']} = ? WHERE user_id = ?";
    $params = array($data['value'], $data['id']);

    $update = $this->query($query, $params);

    if ($update) {
        return true;
    } else {
        return false;
    }
}



//MANAGE PDC FUNCS
    
    public function insertPDC($confirmPassword,$data = []) {
        if ($data['password'] !== $confirmPassword) {
            return false;
        } else {
            $data['password'] = password_hash($confirmPassword, PASSWORD_DEFAULT);

            $this->setTable('pdc_user');   
            $insertResult = $this->insert($data);
            $user = [
                'user_name' => $data['email'],
                'user_role' => 'pdc',
                'password' => $data['password'],
                'user_profile' => 'pdc.jpg',
                'user_status' => 1,

            ];

            $this->setTable('users');   
            $insertUser = $this->insert($user);
            
            if ($insertResult) {
                return 1;
            } else {
               return 0;
            }
            
        }
    }
    
//REPORT/DASHBOARD FUNCTIONS

    public function getCompany() {
        return $this->findall();
    }

    public function get_1stround() {
        $this->setTable('1stro');
        return $this->findall();
    }

    public function getPDC() {
        return $this->findall();
    }

    public function totalstudents() {
        $this->setTable('student');
        $results = $this->findall();

        if (is_array($results)) {
           
            if (!empty($results)) {
                $count = count($results); 
                return $count;
            } else {
                return 0;
            }
        } else {
            return 0; 
        }
    }



    public function getCompanyAD() {
        $query = "SELECT * FROM company_ad ";
        return $this->query($query);
    }

/*   public function companyInternTrend() {
        $query = "SELECT company.user_id, company.company_name, company_ad.from_date, company_ad.to_date, company_ad.no_of_intern
                  FROM company
                  JOIN company_ad ON company.user_id = company_ad.company_id";
    
        $results = $this->query($query);
    
        // Initialize arrays to store data for each year
        $companies = []; // Array to store company names
        $interns2022 = []; // Array to store number of interns for 2022
        $interns2023 = []; // Array to store number of interns for 2023
    
        // Process the fetched data
        foreach ($results as $row) {
            $companyName = $row['company_name'];
            $fromDate = $row['from_date'];
            $toDate = $row['to_date'];
            $noOfInterns = $row['no_of_intern'];
    
            // Check if the company_ad falls within 2022
            if (strpos($fromDate, '2022') !== false || strpos($toDate, '2022') !== false) {
                if (!isset($interns2022[$companyName])) {
                    $interns2022[$companyName] = 0;
                }
                $interns2022[$companyName] += $noOfInterns;
            }
    
            // Check if the company_ad falls within 2023
            if (strpos($fromDate, '2023') !== false || strpos($toDate, '2023') !== false) {
                if (!isset($interns2023[$companyName])) {
                    $interns2023[$companyName] = 0;
                }
                $interns2023[$companyName] += $noOfInterns;
            }
    
            // Add company name to the list
            if (!in_array($companyName, $companies)) {
                $companies[] = $companyName;
            }
        }
    
        return [
            'companies' => $companies,
            'interns2022' => $interns2022,
            'interns2023' => $interns2023
        ];
    }
*/

public function companyInternTrend() {
    $query = "SELECT company.user_id, company.company_name, company_ad.from_date, company_ad.to_date, company_ad.no_of_intern
              FROM company
              JOIN company_ad ON company.user_id = company_ad.company_id";

    $results = $this->query($query);

    // Initialize arrays to store data for each year
    $companies = []; // Array to store company names
    $years = []; // Array to store distinct years
    $internsByYear = []; // Array to store number of interns by year for each company

    // Process the fetched data
    foreach ($results as $row) {
        $companyName = $row['company_name'];
        $fromDate = $row['from_date'];
        $toDate = $row['to_date'];
        $noOfInterns = $row['no_of_intern'];

        // Extract the year from from_date and to_date
        $fromYear = date('Y', strtotime($fromDate));
        $toYear = date('Y', strtotime($toDate));

        // Add the years to the years array
        if (!in_array($fromYear, $years)) {
            $years[] = $fromYear;
        }
        if (!in_array($toYear, $years)) {
            $years[] = $toYear;
        }

        // Add company name to the list
        if (!in_array($companyName, $companies)) {
            $companies[] = $companyName;
        }

        // Store interns count by year for each company
        for ($year = $fromYear; $year <= $toYear; $year++) {
            if (!isset($internsByYear[$companyName][$year])) {
                $internsByYear[$companyName][$year] = 0;
            }
            $internsByYear[$companyName][$year] += $noOfInterns;
        }
    }

    return [
        'companies' => $companies,
        'years' => $years,
        'internsByYear' => $internsByYear
    ];
}

    


//COMPLAINTS FUNCTIONS ADMIN
    public function getComplaints() {
        $query = "SELECT * FROM " . $this->getTable()." WHERE type ='system_complaint'";
        $complaints = $this->query($query);
        $complaintsArray = [];
        foreach ($complaints as $complaint) {
            $complaintsArray[] = [
                'status' => $complaint['status'],
                'complaint_id' => $complaint['complaint_id'],
                'title' => $complaint['title'],
                'type' => $complaint['type'],
                'student_id' => $complaint['student_id'],
                'user_type' => $complaint['user_type'],
                'description' => $complaint['description'],
                'company_id' => $complaint['company_id'],
                'date' => $complaint['created_at']
            ];
        }
        return $complaintsArray;
    }

    public function check_status($data =[]){
    
        $query = "UPDATE " . $this->getTable() . " SET status = 1, reply = '{$data['reply']}' WHERE complaint_id = {$data['id']}";
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
            $MoreDetail_s = $this->query("SELECT * FROM student WHERE id = ?", [$complaint['student_id']]);

            if (!empty($MoreDetail)) {
                
                $id =$complaint['company_id'];
                $email = $MoreDetail[0]['Email'];
                $index = NULL;
                $contact_no = $MoreDetail[0]['contact_no'];
                $contact_person = $MoreDetail[0]['contact_person'];
                $user_type = 'Company';

            } else if(!empty($MoreDetail_s)){

                $id = $MoreDetail_s[0]['id'];
                $index = $MoreDetail_s[0]['index_no'];
                $email = $MoreDetail_s[0]['email'];
                $contact_no = NULL;
                $contact_person = $MoreDetail_s[0]['first_name'] . ' ' . $MoreDetail_s[0]['last_name']; // Concatenate first name and last name
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
                'index_no' => $index,
                'description' => $complaint['description'],
                'email' => $email,
                'reply' => $complaint['reply'],
                'contact_no' => ($contact_no != NULL) ? $contact_no : null,
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
        $this->update($complaintID, $status, 'complaint_id');
    }

    public function blacklisted_companies() {

        $query = "SELECT * FROM users WHERE user_status  = 2 AND user_role = 'company'";
        $results = $this->query($query);

        
        if (is_array($results)) {
            // Check if the array is not empty
            if (!empty($results)) {
                $count = count($results); // Count the number of rows in the array
                return $count;
            } else {
                return 0; // No rows found
            }
        } else {
            return 0; // Query execution failed
        }
    }


//INSERT ADMIN on configuration

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
    
