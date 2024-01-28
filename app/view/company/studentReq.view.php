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
                    <span></span>
                    <ion-icon class="profile-icon" name="person-circle-outline"></ion-icon>
                </div>

            </div>
            
            <div class = "secondbar">
                <div class = "search">
                    <ion-icon name="search-outline"></ion-icon>
                    <input type = "text" placeholder = "Search Student" class = "box1">
                </div>

                <div class = "allstudents">
                    <select>
                        <option value = "se">Software Engineer</option>
                        <option value = "qa">Quality Assuarance</option>
                        <option value = "ba">Business Analyst</option>
                    </select>
                </div>
            </div>
            
        <!--student data list-->
        <div class="details">
            <div class="studentdetails">
                <div class = "cardHeader">
                    <h2>Student Requests for Software Engineer</h2>
                </div>
                <table>
                    <thead>
                        <tr>
                            <td>Student Name</td>
                            <td>Student Degree</td>
                            <td>Action</td>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Hamsayini Senthilrasa</td>
                            <td>CS</td>
                            <td>
                                <select>
                                    <option value="shortlist">Shortlist</option> 
                                    <option value="reject">Reject</option> 
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>Nufdha Macky</td>
                            <td>IS</td>
                            <td>
                                <select>
                                    <option value="shortlist">Shortlist</option> ...
                                    <option value="reject">Reject</option> 
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>Gien Gawesh</td>
                            <td>CS</td>
                            <td>
                                <select>
                                    <option value="shortlist">Shortlist</option> 
                                    <option value="reject">Reject</option> 
                                </select>
                            </td>
                            
                        </tr>

                        <tr>
                            <td>Shamah Lafir</td>
                            <td>IS</td>
                            <td>
                                <select>
                                    <option value="shortlist">Shortlist</option> 
                                    <option value="reject">Reject</option> 
                                </select>
                            </td>
                            
                        </tr>

                        <tr>
                            <td>Nufdha Macky</td>
                            <td>IS</td>
                            <td>
                                <select>
                                    <option value="shortlist">Shortlist</option> 
                                    <option value="reject">Reject</option> 
                                </select>
                            </td>
                            
                        </tr>

                        <tr>
                            <td>Hamsayini Senthilrasa</td>
                            <td>CS</td>
                            <td>
                                <select>
                                    <option value="shortlist">Shortlist</option> 
                                    <option value="reject">Reject</option> 
                                </select>
                            </td>
                            
                        </tr>

                        <tr>
                            <td>Gien Gawesh</td>
                            <td>CS</td>
                            <td>
                                <select>
                                    <option value="shortlist">Shortlist</option> 
                                    <option value="reject">Reject</option> 
                                </select>
                            </td>
                            
                        </tr>

                        <tr>
                            <td>Shamah Lafir</td>
                            <td>IS</td>
                            <td>
                                <select>
                                    <option value="shortlist">Shortlist</option> 
                                    <option value="reject">Reject</option> 
                                </select>
                            </td>
                            
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