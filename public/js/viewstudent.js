function deleteStudent(e) {
    
    if (confirm('Are you sure you want to delete?')) {
        window.location.href = "http://localhost/internease/public/pdc/deleteStudent?id=" + e.value;
    }
}