<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Requests</title>
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/company/companyStudentReq.css">
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
            
          <div class = "secondbar">

            <!-- <form action="" method="GET" class="filter-ads">
                <div>
                    <select name="company_ad" id="company_ad">
                        <option value="all">All</option>

                    </select>
                </div>
            </form> -->

                <div class = "allstudents" id="studentCategory">
                    <select>
                        <option value="all">All</option>
                        <?php foreach($stdrequests as $post):?>
                            <option value = <?php echo htmlspecialchars($post['position']);?> ><?php echo htmlspecialchars($post['position']);?></option>
                        <?php endforeach ?>
                    </select>
                    <ion-icon name="search-outline"></ion-icon>
                </div>
            </div>
            
        <!--student data list-->

        <div id="seTable" class="details">
            <div class="studentdetails">
                <div class = "cardHeader">
                    <h2>Student Requests</h2>
                </div>

                <table>
                        <thead>
                            <tr>
                                <td>Student Name</td>
                                <td>Registration No.</td>
                                <td>Position</td>
                                <td>CV</td>
                                <td>Action</td>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if(isset($stdrequests) && !empty($stdrequests)) {?>
                                <?php foreach ($stdrequests as $req) :?>
                            <tr>
                                <td><?php echo htmlspecialchars($req['first_name']." ".$req['last_name']) ;?></td>
                                <td><?php echo htmlspecialchars($req['reg_no']) ;?></td>
                                <td><?php echo htmlspecialchars($req['position']) ;?></td>
                                <td><a href="path_to_cv_file" class="download-cv-btn"><?php echo htmlspecialchars($req['cv']) ;?>Download CV</a></td>
                                <td>
                                    <select>
                                        <option value = "" selected hidden>--Select Action--</option>
                                        <option value="shortlist">Shortlist</option> 
                                        <option value="reject">Reject</option> 
                                        <option value="pending">Pending</option> 
                                    </select>
                                </td>
                                
                            </tr>
                            <?php endforeach ?>

                            <?php } ?>
                        </tbody>
                </table>

                

            </div>
        </div>

        
        </div>
            
        </div>
    </div>

    <script src="<?=ROOT?>/js/"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>