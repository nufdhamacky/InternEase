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
                    <h2>Shortlisted Details</h2>
                </div>
                <table>
                    <thead>
                        <tr>
                            <td>Position</td>
                            <td >No. of Shortlisted Students</td>
                            <td></td>
                        </tr>
                    </thead>

                    <tbody>

                    <?php if($positions): ?>
                        <?php foreach($positions as $position): ?>
                        <tr>
                            <td><?= htmlspecialchars($position['position']) ?></td>
                            <td><?= $position['application_count']?></td>
                            <td><a href="shortlistedQA?position=<?= urlencode($position['position']) ?>" span class = "view"></span>View List</a></td>
                        </tr>
                        <?php endforeach;?>
                            
                        <?php else: ?>
                            <tr>
                                <td colspan="5">No positions found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>
            
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>