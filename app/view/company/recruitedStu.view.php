<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruited Students</title>

    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/company/companyShortlistedStu.css">
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/company/companyRecruitedStu.css">
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
                    <h2>Recruited Details</h2>
                </div>
                
                <input type="radio" name="slider" id="qa" checked>
                <input type="radio" name="slider" id="se">
                <input type="radio" name="slider" id="ba">

                <nav>
                    <label for="qa" class="qa">Quality Assurance</label>
                    <label for="se" class="se">Software Engineer</label>
                    <label for="ba" class="ba">Business Analyst</label>
                    <div class="slider"></div>
                </nav>

                <section>
                    <div class="content content-1">

                        <div class = "cardHeader">
                            <h2>Quality Assurance</h2><br>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <td>Student Name</td>
                                    <td>Registration No.</td>
                                    
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>Hamsayini Senthilrasa</td>
                                    <td>2021/CS/065</td>
                                    
                                    <td>
                                        <a href="scheduleInt"><!--link should redirect to the student's profile-->
                                        <ion-icon name="person-outline"></ion-icon> 
                                        </a>
                                    </td>
                                    
                                    </td>
                                </tr>

                                <tr>
                                    <td>Nufdha Macky</td>
                                    <td>2021/CS/058</td>
                                    
                                    <td>
                                        <a href="scheduleInt">
                                            <ion-icon name="person-outline"></ion-icon>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="delete">
                                            <ion-icon name="trash-outline" class="del"></ion-icon>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Binali Ukwatte</td>
                                    <td>2021/IS/097</td>
                                    
                                    <td>
                                        <a href="scheduleInt">
                                            <ion-icon name="person-outline"></ion-icon>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="delete">
                                            <ion-icon name="trash-outline" class="del"></ion-icon>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Gien Gawesh</td>
                                    <td>2021/IS/024</td>
                                    
                                    <td>
                                        <a href="scheduleInt"> 
                                            
                                            <ion-icon name="person-outline"></ion-icon>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="delete">
                                            <ion-icon name="trash-outline" class="del"></ion-icon>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <a href="path_to_cv_file" class="download-btn">Download List</a>

                        <!-- <a href="path_to_cv_file" class="send-btn">Send List</a> -->

                    </div>

                    <div class="content content-2">
                        <div class = "cardHeader">
                            <h2>Software Engineer</h2><br>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <td>Student Name</td>
                                    <td>Registration No.</td>
                                    
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>Hamsayini Senthilrasa</td>
                                    <td>2021/CS/065</td>
                                    
                                    <td>
                                        <a href="scheduleInt">
                                        <ion-icon name="person-outline"></ion-icon>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="delete">
                                            <ion-icon name="trash-outline" class="del"></ion-icon>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Gien Gawesh</td>
                                    <td>2021/IS/024</td>
                                    
                                    <td>
                                        <a href="scheduleInt">
                                        <ion-icon name="person-outline"></ion-icon>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="delete">
                                            <ion-icon name="trash-outline" class="del"></ion-icon>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Binali Ukwatte</td>
                                    <td>2021/IS/097</td>
                                    
                                    <td>
                                        <a href="scheduleInt">
                                        <ion-icon name="person-outline"></ion-icon>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="delete">
                                            <ion-icon name="trash-outline" class="del"></ion-icon>
                                        </a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                        <a href="path_to_cv_file" class="download-btn">Download List</a>

                        <!-- <a href="path_to_cv_file" class="send-btn">Send List</a> -->

                    </div>

                    <div class="content content-3">

                        <div class = "cardHeader">
                            <h2>Business Analyst</h2><br>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <td>Student Name</td>
                                    <td>Registration No.</td>
                                    
                                </tr>
                            </thead>

                            <tbody>
                                
                                <tr>
                                    <td>Nufdha Macky</td>
                                    <td>2021/CS/058</td>
                                    
                                    <td>
                                        <a href="scheduleInt">
                                        <ion-icon name="person-outline"></ion-icon>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="delete">
                                            <ion-icon name="trash-outline" class="del"></ion-icon>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Gien Gawesh</td>
                                    <td>2021/IS/024</td>
                                   
                                    <td>
                                        <a href="scheduleInt">
                                        <ion-icon name="person-outline"></ion-icon>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="delete">
                                            <ion-icon name="trash-outline" class="del"></ion-icon>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <a href="path_to_cv_file" class="download-btn">Download List</a>

                        <!-- <a href="path_to_cv_file" class="send-btn">Send List</a> -->

                    </div>
                </section>

            </div>
        </div>
            
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>