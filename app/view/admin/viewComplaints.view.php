<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <title>Manage Admin</title>
    <link rel="stylesheet" type="text/css" href="../../../public/css/com.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../../public/css/com.css?v=<?php echo time(); ?>">


</head>
<body>


<div class="container">
        <?php include_once('sidemenu.php') ?>
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
                <div class="companyList">
                        <div class = "cardHeader">
                            <h2>Complaints</h2>
                            <!-- <a href="#" class="btn">View All</a>  -->
                        </div>
                    <table>
                    
                        <thead>
                            <tr>
                                <td>Review-status</td>
                                <td>complaint ID</td>
                                <td>title</td>
                                <td>Description</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($complaintsArray && count($complaintsArray) > 0): ?>
                        <?php foreach ($complaintsArray as $complaint): ?>
                            <tr>

                                <td><?php echo $complaint['status']; ?></td>
                                <td><?php echo htmlspecialchars($complaint['complaint_id']); ?></td>
                                <td><?php echo htmlspecialchars($complaint['title']); ?></td>
                                <td> <a href="description.php?id=<?php echo $complaint['description']; ?>">View </a></td>
                                <td><button>Check</button> <td>

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
</html>