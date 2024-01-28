<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Advertisments</title>
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/company/companyTotAd.css">
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
                    <span></span>
                    <ion-icon class="profile-icon" name="person-circle-outline"></ion-icon>
                </div>

            </div>
            
        <div class="details">
            <div class="studentdetails">
                <div class = "cardHeader">
                    <h2>Advertisements</h2>
                </div>
                <table>
                    <thead>
                        <tr>
                            <td>Position</td>
                            <td>Requirements</td>
                            <td>Qualifications</td>
                            <td>Internship Period</td>
                            <td>No. of Interns</td>
                            <td>Working Mode</td>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>Software Engineer</td>
                            <td>React<br>Node<br>Java<br>DevOps</td>
                            <td>BSc. in Computer Science</td>
                            <td>Dec - May</td>
                            <td>2</td>
                            <td>Online</td>
                        </tr>

                        <tr>
                            <td>Software Engineer</td>
                            <td>React<br>Node<br>Java</td>
                            <td>BSc. in Information Systems</td>
                            <td>Dec - May</td>
                            <td>2</td>
                            <td>Online</td>
                        </tr>

                        <tr>
                            <td>Quality Assuarance</td>
                            <td>Java<br>C++<br>Python<br>JavaScript</td>
                            <td>BSc. in Computer Science</td>
                            <td>Dec - May</td>
                            <td>3</td>
                            <td>Hybrid</td>
                        </tr>

                        <tr>
                            <td>Quality Assuarance</td>
                            <td>Java<br>C++<br>Python<br>JavaScript</td>
                            <td>BSc. in Information Systems</td>
                            <td>Dec - May</td>
                            <td>3</td>
                            <td>Hybrid</td>
                        </tr>

                        <tr>
                            <td>Business Analyst</td>
                            <td>Java<br>SQL<br>Python<br>JavaScript</td>
                            <td>BSc. in Information Systems</td>
                            <td>Dec - May</td>
                            <td>3</td>
                            <td>Physical</td>
                        </tr>

                        <tr>
                            <td>Business Analyst</td>
                            <td>Java<br>SQL<br>Python<br>JavaScript</td>
                            <td>BSc. in Information Systems</td>
                            <td>Dec - May</td>
                            <td>4</td>
                            <td>Physical</td>
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