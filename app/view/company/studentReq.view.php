<?php
    include_once('../app/controller/Company.php');
    $companyController = new Company();

    $ads = $companyController->getAllApprovedAds();
    if (isset($_GET["ads"]) && $_GET["ads"] != "all") {
        $students = $companyController->filterStudents($_GET["ads"]);
    } else {
        $students = $companyController->getAllStudents();
    }

?>

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

            <form action="" method="GET" class="allstudents">
                <div>
                    <select name="ad_id" id="ads">
                        <option value="all" <?php if (!isset($_GET['ad_id']) || $_GET['ad_id'] == 'all') echo 'selected'; ?>>All</option>
                        <?php foreach ($ads as $ad): ?>
                            <option value="<?php echo htmlspecialchars($ad['ad_id']); ?>" 
                                <?php if (isset($_GET['ad_id']) && $_GET['ad_id'] == $ad['ad_id']) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($ad['position']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn"><ion-icon name="search-outline"></ion-icon></button>
                </div>
            </form>

           </div>
            
        <!--student data list-->

        <div id="seTable" class="details">
            <div class="studentdetails">
                <div class = "cardHeader">
                    <h2>Student Applications</h2>
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
                            <?php if(isset($ad) && !empty($ad)) {?>
                                <?php foreach ($students as $student) :?>
                            <tr>
                            <td><?php echo $student->firstName . " " . $student->lastName; ?></td>
                            <td><?php echo $student->regNo; ?></td>
                            <td><?php echo $student->position; ?></td>
                                <td><a href="path_to_cv_file" class="download-cv-btn"><?php echo $student->cv; ?>Download CV</a></td>
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

    <!-- <script src="<?=ROOT?>/js/"></script> -->

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>