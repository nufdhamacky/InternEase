function deleteStudent(userId) {
   
    if(confirm('Are you sure you want to delete?')) {
        
        window.location.href="controller/deletestudent_controller.php?id="+userId;
    }
}
