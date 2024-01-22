<?php
include ("../core/connection.php");


class AdminModel {
    private $connection;

    public function __construct($conn) {
        $this->connection = $conn;
         $this->connection = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    }

    public function updateAdmin($id, $column, $value, $confirmPassword) {
       
        if ($column === 'password') {
            $value = password_hash($confirmPassword, PASSWORD_DEFAULT);
        }

      
        $updateStatement = $this->connection->prepare("UPDATE admins SET $column = ? WHERE Admin_ID = ?");
        $updateStatement->bind_param("ss", $value, $id);

        if ($updateStatement->execute()) {
            echo '<script type="text/javascript">';
            echo 'alert("Updated Sucessfully");';
            echo 'window.location.href = "'.$_SERVER['PHP_SELF'].'";'; 
            echo '</script>';
            return true;
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Updated Sucessfully");';
            echo 'window.location.href = "'.$_SERVER['PHP_SELF'].'";'; 
            echo '</script>';
            return false;   
        }
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
        
   /* public function getComplaints() {
        $sql = 'SELECT * FROM complaints';
        $result = mysqli_query($this->connection, $sql);
        $complaints = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        return $complaints;
    }
    */
}
    

?>
