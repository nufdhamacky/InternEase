<?php require_once("../app/view/inc/header.php"); ?>
<body>
    
    <div class="container">
        <?php require_once("../app/view/inc/sidebar.php"); ?>
        <div class="details">
            <div class="description">
                <?php if ($complaintDetails && count($complaintDetails) > 0): ?>
                    <?php foreach ($complaintDetails as $complaint): ?>
                        <div class='desc_detail'>
                           <div class="detail_label">
                           <?php $id = $complaint['complaint_id']; // Define $id here ?>
                                <label> Complaint ID:</label><span><?php echo htmlspecialchars($complaint['complaint_id']);?></span>
                            </div>

                            <div class="detail_label">
                                <label> User Email:</label><span><?php echo htmlspecialchars($complaint['email']); ?></span>
                            </div>

                            <div class="detail_label">
                                <label>User Type:<span></label><?php echo htmlspecialchars($complaint['user_type']); ?></span>
                            </div>

                            <?php if ($complaint['index_no'] != NULL) { ?>
                                <div class="detail_label">
                                    <label>index number:</label><span><?php echo htmlspecialchars($complaint['index_no']); ?></span>
                                </div>
                            <?php } ?>
                           
                                                        

                            <div class="detail_label">
                                <label>Contact Name:</label><span><?php echo htmlspecialchars($complaint['contact_person']); ?></span>
                            </div>
                            <?php if ($complaint['contact_no'] != NULL || !empty($complaint['contact_no'])) { ?>
                                <div class="detail_label">
                                    <label>Contact:<span></label><?php echo ($complaint['contact_no']); ?></span>
                                </div>
                            <?php } ?>
                            
                            <div class="detail_label">
                                <label>Subject:<span></label><?php echo htmlspecialchars($complaint['title']); ?></span>
                            </div>
                        
                        </div>
    
                        <h3>Message</h3>
                        <p><?php  echo htmlspecialchars($complaint['description']) ?></p>
                    <?php endforeach; ?> 
                <?php endif; ?>   
            </div>
        </div>

        <div class='details'>
            <form class="reply-form" method="post" action="../checkcomplaint">
                <input type="hidden" name="complaint_id" value="<?php echo $id; ?>">
                    <?php if (!empty($complaint['reply'])): ?>
                       
                        <div class="formgroup">
                            <label for="reply">Admin's Reply:</label>
                            <p><?php echo htmlspecialchars($complaint['reply']); ?></p>
                        </div>
                    <?php else: ?>
                        <label for="reply">Your Reply:</label>
                      
                        <div class="formgroup">
                            <textarea id="reply" name="reply" placeholder="Enter your reply here..." required></textarea>
                        </div>
                        <div class="form-group">
                        <input class="btn" type="submit" name="send_reply" value="Send Reply">
                    </div>
           
                    <?php endif; ?>
            </form>
                   
</div>

    

</body>
</html>
