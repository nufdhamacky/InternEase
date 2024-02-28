<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDC Advertisement</title>
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/pdc/ad.css">
</head>
<body>
    <div class="container">
    <?php include_once('../app/view/layout/pdcSidemenu.php') ?>
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

        <!--order data list-->
        <div class="details">
            <div class="internshipAds">
                <div class = "cardHeader">
                    <h2>Internship Advertisements</h2>
                </div>
                <table>
                    <thead>
                        <tr>
                            <td>Company Name</td>
                            <td>No of Interns</td>
                            <td>Job</td>
                            <td>Status</td>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>WSO2</td>
                            <td>5</td>
                            <td>Software Engineering</td>
                            <td>
                                <select class="status-select">
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </td>
                            <td><a href="ads" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>99X</td>
                            <td>2</td>
                            <td>QA</td>
                            <td>
                                <select class="status-select">
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </td>
                            <td><a href="ads" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>Virtusa</td>
                            <td>2</td>
                            <td>Web Development</td>
                            <td>
                                <select class="status-select">
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </td>                            
                            <td><a href="ads" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>CodeGen</td>
                            <td>1</td>
                            <td>Software Engineering</td>
                            <td>
                                <select class="status-select">
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </td>
                            <td><a href="ads" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>IFS</td>
                            <td>2</td>
                            <td>QA</td>
                            <td>
                                <select class="status-select">
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>99X</td>
                            <td>3</td>
                            <td>Software Engineering</td>
                            <td>
                                <select class="status-select">
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>Virtusa</td>
                            <td>3</td>
                            <td>Web Development</td>
                            <td>
                                <select class="status-select">
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>CodeGen</td>
                            <td>5</td>
                            <td>QA</td>
                            <td>
                                <select class="status-select">
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>Virtusa</td>
                            <td>4</td>
                            <td>Software Engineering</td>
                            <td>
                                <select class="status-select">
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>IFS</td>
                            <td>3</td>
                            <td>Web Development</td>
                            <td>
                                <select class="status-select">
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>CodeGen</td>
                            <td>4</td>
                            <td>QA</td>
                            <td>
                                <select class="status-select">
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>Virtusa</td>
                            <td>5</td>
                            <td>QA</td>
                            <td>
                                <select class="status-select">
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>
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