<html>
<head>
    <link rel="stylesheet" href="<?=ROOT?>/css/student/complaints.css">
</head>
<body>
    
    <div class="container">
        <?php require_once("../app/view/inc/sidebar.php"); ?>
        <div class="main">

        <div class="details">
            <div class="description">
                <?php if (!empty($complaintDetails)): ?>
                    <?php foreach ($complaintDetails as $complaint): ?>
                        <div class='desc_detail'>
                           <div class="detail_label">
                                <label>Complaint ID:</label><span><?php echo htmlspecialchars($complaint['complaint_id']); ?></span>
                            </div>

                            <div class="detail_label">
                                <label>Your Email:</label><span><?php echo htmlspecialchars($complaint['email']); ?></span>
                            </div>

                            <?php if (!empty($complaint['index_no'])): ?>
                                <div class="detail_label">
                                    <label>Index number:</label><span><?php echo htmlspecialchars($complaint['index_no']); ?></span>
                                </div>
                            <?php endif; ?>

                            
                            <div class="detail_label">
                                <label>Subject:</label><span><?php echo htmlspecialchars($complaint['title']); ?></span>
                            </div>
                        
                        </div>
    
                        <h3>Message</h3>
                        <p><?php echo htmlspecialchars($complaint['description']); ?></p>
                        <?php if (!empty($complaint['reply'])): ?>
                            <div class='details'>
                                <form class="reply-form" method="post" action="../checkcomplaint">
                                    <input type="hidden" name="complaint_id" value="<?php echo htmlspecialchars($complaint['complaint_id']); ?>">
                                    
                                        <div class="formgroup">
                                            <label for="reply">Reply:</label>
                                            <p style="color:black;"><?php echo htmlspecialchars($complaint['reply']); ?></p>
                                        </div>
                                    
                                </form>     
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </div

</body>
</html>
