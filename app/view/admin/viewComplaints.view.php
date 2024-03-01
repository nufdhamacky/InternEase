<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <title>Complaints</title>
     <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/admin/com.css?v=<?php echo time(); ?>">
     <?php
    function compareComplaints($a, $b) {
        if ($a['status'] == $b['status']) {
            return 0;
        }
        return ($a['status'] < $b['status']) ? -1 : 1;
    }

    usort($complaintsArray, 'compareComplaints');
    ?>

</head>
<body>

<div class="container">
    <?php include_once('../app/view/layout/Admin_sidemenu.php') ?>
        <div class="report">
                <div class="report_item">
                    <h2>Complaints</h2>

                    <table>
                        <thead>
                            <tr>
                                <td>Complaint ID</td>
                                <td>Title</td>
                                <td>Complaint Type</td>
                                <td>User</td>
                                <td>Date</td>
                                <td>Description</td>
                                <td>Review-status</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($complaintsArray && count($complaintsArray) > 0): ?>
                        <?php foreach ($complaintsArray as $complaint): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($complaint['complaint_id']); ?></td>
                                <td><?php echo htmlspecialchars($complaint['title']); ?></td>
                                    <?php 
                                        if($complaint['student_id'] == NULL){

                                            $id= $complaint['company_id'];
                                        }else{
                                            $id=$complaint['student_id'];
                                        }
                                    ?>
                                <td><?php echo htmlspecialchars($complaint['type']);?></td>
                                <td><?php echo htmlspecialchars($complaint['user_type']);?></td>
                                <td><?php echo htmlspecialchars($complaint['date']); ?></td>
                                <td><a href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/admin/description/<?php echo $complaint['complaint_id']; ?>" target="_blank"><button class="btn">View</button></a></td>
                                <td>
                                    <?php if ($complaint['status'] == 0): ?>
                                        <span style="color:red;font-weight: bold;">Un-resolved</span>
                                    <?php else: ?>
                                        Resolved
                                    <?php endif; ?>
                                </td>
                                <!--<td><a href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/admin/checkcomplaint/<?php echo $complaint['complaint_id']; ?>" target="_self"><button class="btn">Check</button></a></td>  
                                    -->
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>   
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>
    
</body>
<script>
    // Get all buttons with the 'checkButton' class
    var buttons = document.querySelectorAll('.checkButton');
    
    // Loop through each button and attach a click event listener
    buttons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Get the complaint ID from the button's data attribute
            var complaintId = this.getAttribute('data-complaint-id');
            
            // Send an AJAX request to your server
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '<?php echo dirname($_SERVER['PHP_SELF']); ?>/admin/checkComplaint', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Handle the response from the server if needed
                        console.log(xhr.responseText);
                    } else {
                        // Handle any errors
                        console.error('Error:', xhr.status);
                    }
                }
            };
            xhr.send('complaint_id=' + complaintId);
        });
    });
</script>

</html>