<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Admin</title>
    <link rel="stylesheet" type="text/css" href="../../../public/css/admin/com.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../../public/css/admin/com.css?v=<?php echo time(); ?>">
</head>
<body>
    
    <div class="container">
        <?php include_once('../app/view/layout/Admin_sidemenu.php') ?>

        <div class="details">
            <div class="description">
                <?php if ($complaintDetails && count($complaintDetails) > 0): ?>
                    <?php foreach ($complaintDetails as $complaint): ?>
                        <div class='desc_detail'>
                           <div class="detail_label">
                                <label> Complaint ID:</label><span><?php echo htmlspecialchars($complaint['complaint_id']); ?></span>
                            </div>

                            <div class="detail_label">
                                <label> User Email:</label><span><?php echo htmlspecialchars($complaint['email']); ?></span>
                            </div>

                            <div class="detail_label">
                                <label>User Type:<span></label><?php echo htmlspecialchars($complaint['user_type']); ?></span>
                            </div>

                            <div class="detail_label">
                                <label>Contact Name:</label><span><?php echo htmlspecialchars($complaint['contact_person']); ?></span>
                            </div>

                            <div class="detail_label">
                                <label>Contact:<span></label><?php echo htmlspecialchars($complaint['contact_no']); ?></span>
                            </div>

                        </div>
                        <p><?php echo htmlspecialchars($complaint['description']); ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>   
            </div>
        </div>
    </div>

</body>
</html>
