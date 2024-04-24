function deleteStudent(userId) {

    if (confirm('Are you sure you want to delete?')) {

        window.location.href = "controller/deletestudent_controller.php?id=" + userId;
    }
}


function uploadCsvStudents(e) {

    const form = document.getElementById("csvForm");
    const nameLabel = document.getElementById("csvName");
    const fileInput = document.getElementById("csv");
    nameLabel.textContent = fileInput.files[0].name;
    const confirmation = confirm('Are you sure you want to upload?');
    if (confirmation) {
        form.submit();
    } else {
        nameLabel.textContent = "";
    }

}