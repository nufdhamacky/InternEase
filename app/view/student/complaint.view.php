
<?php require_once("../app/view/inc/header.php"); ?>
<body>


<div class="container">
    <?php require_once("../app/view/inc/sidebar.php"); ?>
    <div class ="main">
    <div class="content">        

<div class="report_item">
    <h2>Your complaints</h2>
    <table>
        <thead>
            <tr>
                <td>Complaint ID</td>
                <td>Subject</td>
                <td>Date</td>
                <td>View</td>
                <td>Status</td>
            </tr>
            </tr>
        </thead>

        <tbody>
        <?php if ($stdcomplaints && count($stdcomplaints)> 0): ?>
            <?php foreach ($stdcomplaints as $complaint): ?>

                <tr>
                <td><?php echo isset($complaint['complaint_id']) ? htmlspecialchars($complaint['complaint_id']) : ''; ?></td>
                <td><?php echo isset($complaint['title']) ? htmlspecialchars($complaint['title']) : ''; ?></td>
                <td><?php echo isset($complaint['date']) ? htmlspecialchars($complaint['date']) : ''; ?></td>
                <td><a href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/student/description/<?php echo $complaint['complaint_id']; ?>" target="_blank"><button class="btn">View</button></a></td></td>
                <td><?php if ($complaint['status'] == 0): ?>
                                    <span style="color:red;font-weight: bold;">Waiting for response</span>
                                <?php else: ?>
                                    Resolved
                                <?php endif; ?></td>
                </tr>

            <?php endforeach; ?>
        <?php endif;?>   
        </table>
</div>

      <div class="report_item" style="width:fit-content;">
        <h2>Send a complaint</h2>

        <form class="insert-form" id="insertform" method="post" action="complaint">

                        <div class="formgroup">
                        <label for="std_username"><?php echo isset($_SESSION['userName']) ? $_SESSION['userName'] : 'Guest'; ?></label>
                        </div>


                        <label for="type">Type of Complaint:</label>
                        <select id="type" name="type" required>
                            <option value="system_complaint">System issue</option>
                            <option value="user_complaint">Complaint about workplace</option>
                  
                        </select><br><br>

                        <div class="formgroup">
                        <label for="title">Subject: </label>
                        </div>   

                        <div class="formgroup">
                        <input class="input-text" type="text" name="subject" id="subject" cols="">
 

                        </div>
                        
                        <div class="formgroup">
                        <label for="details">Complaint Details (Please state your full name, your index number and a contact number ):</label>
                        
                        </div>
                        <div class="formgroup">
                        <textarea id="details" name="details" rows="8" cols="80" required style="padding:2vw;"></textarea><br><br>

                                </div>
                        <p >
                            <?php  /*     
                              if (isset($data['errors']) && is_array($data['errors'])) {
                                foreach ($data['errors'] as $errorKey => $errorMessages) {
                                    if (is_array($errorMessages)) {
                                        // Loop through each error message if it's an array
                                        foreach ($errorMessages as $errorMessage) {
                                            echo htmlspecialchars($errorMessage) . '<br>';
                                        }
                                    } else {
                                        // It's a string, so just echo it out
                                        echo htmlspecialchars($errorMessages) . '<br>';
                                    }
                                }
                            }
                            */
                            ?>      
                        </p>
                        <center><input type="submit"  class="btn" value="Send complaint" name="sendcomplaint"></center>
                    </form>

       
    </div>
    </div>
</div>
   



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>


</script>
</body>
</html>
