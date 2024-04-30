<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shortlisted Students</title>
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/company/companyShortlistedStu.css">
</head>
<body>
    
    <div class="container">
        <?php require_once('../app/view/layout/companyMenubar.php') ?>
        <div class ="main">
            <div class = "topbar">

                <div class = "toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class = "user">
                    <span><?php echo $_SESSION['companyName']; ?></span>
                    <ion-icon class="profile-icon" name="person-circle-outline"></ion-icon>
                </div>

            </div>
            
        <!--student data list-->
        <div class="details">
            <div class="studentdetails">
                <div class = "cardHeader">
                    <h2>Shortlisted Students</h2>
                </div>
                
                <table>
                    <thead>
                        <tr>
                            <td>Student Name</td>
                            <td>Degree</td>
                            <td>Index No.</td>
                            <td>Profile</td>
                            <td>Schedule Interview</td>
                            <td>Action</td>
                        </tr>
                    </thead>

                    <tbody>

                    <?php if($shortlistedStudents): ?>
                        <?php foreach($shortlistedStudents as $student): ?>
                        <tr>
                            <td><?php echo $student['first_name'] . ' ' . $student['last_name']; ?></td>
                            <td>BSc. in Computer Science</td>
                            <td><?= $student['reg_no']?></td>
                            <td><a href="#" span class = "view"></span>View Profile</td>
                            <td><a href="scheduleInt" span class = "view"></span>Schedule Interview</td>
                            <td>
<<<<<<< HEAD
                                <select class="status-select">
                                    <option value = "" selected hidden>--Select Action--</option>
                                    <option value="recruited" <?= ($student['status'] == 3) ? 'selected' : '' ?>>Recruited</option> 
                                    <option value="rejected" <?= ($student['status'] == 2) ? 'selected' : '' ?>>Rejected</option>
=======
                            <form action="<?=ROOT?>/company/Shortlist" method="post">
                                <input type="hidden" name="student_reg" value="<?= $student['reg_no'] ?>">
                                <input type="hidden" name="position" value="<?=  $_GET['position'];?>">
                                <select name="status">
                                    <option value="" selected hidden>--Select Action--</option>
                                    <option value="3">Recruited</option>
                                    <option value="1">Shortlist</option>
                                    <option value="2">Rejected</option>
>>>>>>> 36c3f2f93365c3ebc6f2bd70231846d9d04f462b
                                </select>
                                <button type="submit">Update</button>
                            </form>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    <?php else:?>
                        <tr class="no-students">
                            <td colspan="5">No students found</td>
                        </tr>
                    <?php endif;?>
                    
                    </tbody>
                </table>

            </div>
        </div>
            
        </div>
    </div>

    
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script>
    document.querySelectorAll('.status-select').forEach(select => {
        select.addEventListener('change', (event) => {
            const studentId = event.target.getAttribute('data-student-id');
            const selectedValue = event.target.value;

            if (selectedValue) {
                // Define the URL to which you're sending the request (this might be a controller endpoint)
                const url = '/InternEase/public/company/updateStatus'; // Adjust this URL to your endpoint

                // Send the AJAX request using the fetch API
                fetch(url, {
                    method: 'POST', // Use POST method for modifying data
                    headers: {
                        'Content-Type': 'application/json', // JSON content type
                        'X-Requested-With': 'XMLHttpRequest', // Indicate it's an AJAX request
                    },
                    body: JSON.stringify({
                        applied_id: studentId,
                        status: selectedValue, // Map the action to the correct status code
                    }),
                })
                    .then(response => {
                        if (response.ok) {
                            console.log('Status updated successfully.');
                        } else {
                            console.error('Error updating status.');
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
            }
        });
    });
</script>
</body>
</html>