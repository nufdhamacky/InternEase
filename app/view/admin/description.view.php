<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <title>Manage Admin</title>
    <link rel="stylesheet" type="text/css" href="../../../public/css/admin/com.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../../public/css/admin/com.css?v=<?php echo time(); ?>">

</head>
<body>
    
<div class="container">
        <?php include_once('../app/view/layout/Admin_sidemenu.php') ?>
    <div class ="main">
            <div class = "topbar">
                <div class = "toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class = "user">
                    <ion-icon name="notifications-circle-outline"></ion-icon>
                    <span>Hamsayini</span>
                    <ion-icon name="person-circle-outline"></ion-icon>
                    
                </div>

            </div>

        <div class="details">
                    <div class="description">
                        <?php if ($complaintDetails && count($complaintDetails) > 0): ?>
                        <?php foreach ($complaintDetails as $complaint): ?>
                            <h3>Complaint ID :  <?php echo htmlspecialchars($complaint['complaint_id']); ?> </h3>
                            <h3>User Email :  <?php echo htmlspecialchars($complaint['email']); ?> </h3>
                            <p><?php echo htmlspecialchars($complaint['description']); ?></p>
                        <?php endforeach; ?>
                        <?php endif; ?>   
                    </div>
                </div>
        </div>
    </div>

</div>
</body>
</html>
