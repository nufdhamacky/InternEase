<?php
    include_once('../app/controller/Company.php');
    $companyController = new Company();
    $requests = $companyController->getAllReqs();
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
                <div class = "search">
                    <ion-icon name="search-outline"></ion-icon>
                    <input type = "text" placeholder = "Search Student" class = "box1">
                </div>

                <div class = "allstudents" id="studentCategory">
                    <select>
                        <option value = "se">Software Engineer</option>
                        <option value = "qa">Quality Assurance</option>
                        <option value = "ba">Business Analyst</option>
                    </select>
                </div>
            </div>
            
        <!--student data list-->
        <div id="seTable" class="details">
            <div class="studentdetails">
                <div class = "cardHeader">
                    <h2>Student Requests for Software Engineer</h2>
                </div>

                <table>
                        <thead>
                        <tr>
                            <td>Student Name</td>
                            <td>Registration No.</td>
                            <td>CV</td>
                            <td>Profile</td>
                            <td>Action</td>
                        </tr>
                        </thead>

                        <tbody>
                            <?php 
                                foreach($requests as $req){ ?>
                                    <tr>
                                        <td><?php echo $req->firstname . ' ' . $req->lastname; ?></td>
                                        <td><?php echo $req->regno; ?> </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                <!-- <table>
                    <thead>
                        <tr>
                            <td>Student Name</td>
                            <td>Registration No.</td>
                            <td>CV</td>
                            <td>Profile</td>
                            <td>Action</td>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Hamsayini Senthilrasa</td>
                            <td>2021/CS/035</td>
                            <td><a href="path_to_cv_file" class="download-cv-btn">Download CV</a></td>
                            <td><a href="#" span class = "view"></span>View Profile</td>
                            <td>
                                <select>
                                    <option value = "" selected hidden>--Select Action--</option>
                                    <option value="shortlist">Shortlist</option> 
                                    <option value="reject">Reject</option>
                                    <option value="pending">Pending</option>  
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>Nufdha Macky</td>
                            <td>2021/IS/062</td>
                            <td><a href="path_to_cv_file" class="download-cv-btn">Download CV</a></td>
                            <td><a href="#" span class = "view"></span>View Profile</td>
                            <td>
                                <select>
                                    <option value = "" selected hidden>--Select Action--</option>
                                    <option value="shortlist">Shortlist</option> ...
                                    <option value="reject">Reject</option>
                                    <option value="pending">Pending</option>  
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>Gien Gawesh</td>
                            <td>2021/IS/058</td>
                            <td><a href="path_to_cv_file" class="download-cv-btn">Download CV</a></td>
                            <td><a href="#" span class = "view"></span>View Profile</td>
                            <td>
                                <select>
                                    <option value = "" selected hidden>--Select Action--</option>
                                    <option value="shortlist">Shortlist</option> 
                                    <option value="reject">Reject</option>
                                    <option value="pending">Pending</option>  
                                </select>
                            </td>
                            
                        </tr>

                        <tr>
                            <td>Shamah Lafir</td>
                            <td>2021/CS/072</td>
                            <td><a href="path_to_cv_file" class="download-cv-btn">Download CV</a></td>
                            <td><a href="#" span class = "view"></span>View Profile</td>
                            <td>
                                <select>
                                    <option value = "" selected hidden>--Select Action--</option>
                                    <option value="shortlist">Shortlist</option> 
                                    <option value="reject">Reject</option>
                                    <option value="pending">Pending</option>  
                                </select>
                            </td>
                            
                        </tr>

                        <tr>
                            <td>Nufdha Macky</td>
                            <td>2021/IS/056</td>
                            <td><a href="path_to_cv_file" class="download-cv-btn">Download CV</a></td>
                            <td><a href="#" span class = "view"></span>View Profile</td>
                            <td>
                                <select>
                                    <option value = "" selected hidden>--Select Action--</option>
                                    <option value="shortlist">Shortlist</option> 
                                    <option value="reject">Reject</option>
                                    <option value="pending">Pending</option>  
                                </select>
                            </td>
                            
                        </tr>

                        <tr>
                            <td>Hamsayini Senthilrasa</td>
                            <td>2021/CS/025</td>
                            <td><a href="path_to_cv_file" class="download-cv-btn">Download CV</a></td>
                            <td><a href="#" span class = "view"></span>View Profile</td>
                            <td>
                                <select>
                                    <option value = "" selected hidden>--Select Action--</option>
                                    <option value="shortlist">Shortlist</option> 
                                    <option value="reject">Reject</option> 
                                    <option value="pending">Pending</option> 
                                </select>
                            </td>
                            
                        </tr>

                        <tr>
                            <td>Gien Gawesh</td>
                            <td>2021/IS/036</td>
                            <td><a href="path_to_cv_file" class="download-cv-btn">Download CV</a></td>
                            <td><a href="#" span class = "view"></span>View Profile</td>
                            <td>
                                <select>
                                    <option value = "" selected hidden>--Select Action--</option>
                                    <option value="shortlist">Shortlist</option> 
                                    <option value="reject">Reject</option> 
                                    <option value="pending">Pending</option> 
                                </select>
                            </td>
                            
                        </tr>

                        <tr>
                            <td>Shamah Lafir</td>
                            <td>2021/CS/025</td>
                            <td><a href="path_to_cv_file" class="download-cv-btn">Download CV</a></td>
                            <td><a href="#" span class = "view"></span>View Profile</td>
                            <td>
                                <select>
                                    <option value = "" selected hidden>--Select Action--</option>
                                    <option value="shortlist">Shortlist</option> 
                                    <option value="reject">Reject</option> 
                                    <option value="pending">Pending</option> 
                                </select>
                            </td>
                            
                        </tr>
                    </tbody>
                </table> -->

            </div>
        </div>

        <div id="qaTable" class="details">
            <div class="studentdetails">
                <div class="cardHeader">
                    <h2>Student Requests for Quality Assurance</h2>
                </div>
                    <!-- Quality Assurance table content -->
                    <table>
                        <thead>
                            <tr>
                                <td>Student Name</td>
                                <td>Registration No.</td>
                                <td>CV</td>
                                <td>Profile</td>
                                <td>Action</td>
                            </tr>
                        </thead>

                        <tbody>
                            

                            <tr>
                                <td>Nufdha Macky</td>
                                <td>2021/CS/025</td>
                                <td><a href="path_to_cv_file" class="download-cv-btn">Download CV</a></td>
                                <td><a href="#" span class = "view"></span>View Profile</td>
                                <td>
                                    <select>
                                        <option value = "" selected hidden>--Select Action--</option>
                                        <option value="shortlist">Shortlist</option> ...
                                        <option value="reject">Reject</option>
                                        <option value="pending">Pending</option>  
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>Gien Gawesh</td>
                                <td>2021/CS/025</td>
                                <td><a href="path_to_cv_file" class="download-cv-btn">Download CV</a></td>
                                <td><a href="#" span class = "view"></span>View Profile</td>
                                <td>
                                    <select>
                                        <option value = "" selected hidden>--Select Action--</option>
                                        <option value="shortlist">Shortlist</option> 
                                        <option value="reject">Reject</option>
                                        <option value="pending">Pending</option>  
                                    </select>
                                </td>
                                
                            </tr>

                            <tr>
                                <td>Shamah Lafir</td>
                                <td>2021/CS/025</td>
                                <td><a href="path_to_cv_file" class="download-cv-btn">Download CV</a></td>
                                <td><a href="#" span class = "view"></span>View Profile</td>
                                <td>
                                    <select>
                                        <option value = "" selected hidden>--Select Action--</option>
                                        <option value="shortlist">Shortlist</option> 
                                        <option value="reject">Reject</option>
                                        <option value="pending">Pending</option>  
                                    </select>
                                </td>
                                
                            </tr>

                            
                            <tr>
                                <td>Hamsayini Senthilrasa</td>
                                <td>2021/CS/025</td>
                                <td><a href="path_to_cv_file" class="download-cv-btn">Download CV</a></td>
                                <td><a href="#" span class = "view"></span>View Profile</td>
                                <td>
                                    <select>
                                        <option value = "" selected hidden>--Select Action--</option>
                                        <option value="shortlist">Shortlist</option> 
                                        <option value="reject">Reject</option> 
                                        <option value="pending">Pending</option> 
                                    </select>
                                </td>
                                
                            </tr>

                            <tr>
                                <td>Gien Gawesh</td>
                                <td>2021/CS/025</td>
                                <td><a href="path_to_cv_file" class="download-cv-btn">Download CV</a></td>
                                <td><a href="#" span class = "view"></span>View Profile</td>
                                <td>
                                    <select>
                                        <option value = "" selected hidden>--Select Action--</option>
                                        <option value="shortlist">Shortlist</option> 
                                        <option value="reject">Reject</option> 
                                        <option value="pending">Pending</option> 
                                    </select>
                                </td>
                                
                            </tr>

                            <tr>
                                <td>Shamah Lafir</td>
                                <td>2021/CS/025</td>
                                <td><a href="path_to_cv_file" class="download-cv-btn">Download CV</a></td>
                                <td><a href="#" span class = "view"></span>View Profile</td>
                                <td>
                                    <select>
                                        <option value = "" selected hidden>--Select Action--</option>
                                        <option value="shortlist">Shortlist</option> 
                                        <option value="reject">Reject</option> 
                                        <option value="pending">Pending</option> 
                                    </select>
                                </td>
                                
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>

        <div id="baTable" class="details">
            <div class="studentdetails">
                <div class="cardHeader">
                    <h2>Student Requests for Business Analyst</h2>
                </div>
                <!-- Business Analyst table content -->

                <table>
                        <thead>
                            <tr>
                                <td>Student Name</td>
                                <td>Registration No.</td>
                                <td>CV</td>
                                <td>Profile</td>
                                <td>Action</td>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>Hamsayini Senthilrasa</td>
                                <td>2021/CS/025</td>
                                <td><a href="path_to_cv_file" class="download-cv-btn">Download CV</a></td>
                                <td><a href="#" span class = "view"></span>View Profile</td>
                                <td>
                                    <select>
                                        <option value = "" selected hidden>--Select Action--</option>
                                        <option value="shortlist">Shortlist</option> 
                                        <option value="reject">Reject</option> 
                                        <option value="pending">Pending</option> 
                                    </select>
                                </td>
                                
                            </tr>

                            <tr>
                                <td>Gien Gawesh</td>
                                <td>2021/CS/025</td>
                                <td><a href="path_to_cv_file" class="download-cv-btn">Download CV</a></td>
                                <td><a href="#" span class = "view"></span>View Profile</td>
                                <td>
                                    <select>
                                        <option value = "" selected hidden>--Select Action--</option>
                                        <option value="shortlist">Shortlist</option> 
                                        <option value="reject">Reject</option> 
                                        <option value="pending">Pending</option> 
                                    </select>
                                </td>
                                
                            </tr>

                            <tr>
                                <td>Shamah Lafir</td>
                                <td>2021/CS/025</td>
                                <td><a href="path_to_cv_file" class="download-cv-btn">Download CV</a></td>
                                <td><a href="#" span class = "view"></span>View Profile</td>
                                <td>
                                    <select>
                                        <option value = "" selected hidden>--Select Action--</option>
                                        <option value="shortlist">Shortlist</option> 
                                        <option value="reject">Reject</option> 
                                        <option value="pending">Pending</option> 
                                    </select>
                                </td>
                                
                            </tr>
                        </tbody>
                </table>
            </div>
        </div>
            
        </div>
    </div>

    <script src="<?=ROOT?>/js/studentReq.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>