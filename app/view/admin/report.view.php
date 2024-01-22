<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <title>Manage Admin</title>
    <link rel="stylesheet" type="text/css" href="../../../public/css/com.css?v=<?php echo time(); ?>">

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

        <div class="notification">
                    <div class="notibutton">
                        <a href="">
                            <div>
                                <div>Download</div>
                                <div>advertisement</div>
                                <div>report</div>
                            </div>
                        </a>
                        <div class="iconBx">
                            <ion-icon name="document-text" size="large"></ion-icon>
                        </div>
                    </div>
                    <div class="notibutton">
                        <a href="">
                            <div>
                                <div>Download</div>
                                <div>Registration</div>
                                <div>report</div>
                            </div>
                        </a>
                        <div class="iconBx">
                            <ion-icon name="document-text" size="large"></ion-icon>
                        </div>
                    </div>  
                    <div class="notibutton">
                        <a href="">
                            <div>
                                <div>Most employed Position: </div>
                                <div>Software Enginner</div>
                                <div>Company with the highest recruit rate</div>
                                <div>99x</div>
                            </div>
                            <div class="iconBx">
                                <ion-icon  name="man-outline" size="large"></ion-icon>
                            </div>
                        </a>
                    </div>  
                         
        </div>
    

    <div class="details">
        <div class="companyList">
                <div class = "cardHeader">
                    <h2>Advertisment Report</h2>
                    <!-- <a href="#" class="btn">View All</a>  -->
                </div>
            <table>
                <thead>
                    <tr>
                        <td>Company name</td>
                        <td>job position</td>
                        <td>interns</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>99x</td>
                        <td>Network Enginner</td>
                        <td>6</td>
                    </tr>

                    <tr>
                        <td>WSO2</td>
                        <td>Cyber secruity</td>
                        <td>4</td>
                    </tr>

                    <tr>
                        <td>Virtusa</td>
                        <td>IT officer</td>
                        <td>1</td>
                    </tr>

                    <tr>
                        <td>CodeGen</td>
                        <td>Software Enginner</td>
                        <td>12</td>
                    </tr>
                        <td class="td-left" colspan="3">TOTAL = 23</td>
                    <tr>
                </tbody>
            </table>
        </div>

        <div class="companyList">
                <div class = "cardHeader">
                    <h2>Registration report</h2>
                    <!-- <a href="#" class="btn">View All</a>  -->
                </div>

            <table>
                <thead>
                    <tr>
                        <td>Company</td>
                        <td>Contact Name</td>
                        <td>Contact</td>
                        <td>email</td>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>99x</td>
                        <td>Ruwan</td>
                        <td>077-8982122</td>
                        <td>Ruwan@gmail.com</td>
                    </tr>

                    <tr>
                        <td>WSO2</td>
                        <td>Ajitd</td>
                        <td>077-8982122</td>
                        <td>Ajitd@gmail.com</td>
                    </tr>

                    <tr>
                        <td>Virtusa</td>
                        <td>fernando</td>
                        <td>077-8982122</td>
                        <td>fernando@gmail.com</td>
                    </tr>

                    <tr>
                        <td>CodeGen</td>
                        <td>kanitd</td>
                        <td>077-8982122</td>
                        <td>kanitd@gmail.com</td>
                </tbody>

            </table>
        </div>
    </div>
    

</div>   
    
</body>
</html>
