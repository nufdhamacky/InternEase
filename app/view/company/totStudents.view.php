<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Students Applied</title>
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/company/companyTotStudents.css">
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
                    <h2>Total Students Applied</h2>
                </div>
                <table>
                    <thead>
                        <tr>
                            <td>Student Name</td>
                            <td>Degree</td>
                            <td>Email</td>
                            <td></td>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Hamsayini Senthilrasa</td>
                            <td>CS</td>
                            <td>hamsayini@gmail.com</td>
                            <td><a href="#" span class = "view"></span>View Profile</td>
                        </tr>

                        <tr>
                            <td>Nufdha Macky</td>
                            <td>IS</td>
                            <td>nufdha@gmail.com</td>
                            <td><a href="#" span class = "view"></span>View Profile</td>
                        </tr>

                        <tr>
                            <td>Gien Gawesh</td>
                            <td>CS</td>
                            <td>gien@gmail.com</td>
                            <td><a href="#" span class = "view"></span>View Profile</td>
                        </tr>

                        <tr>
                            <td>Shamah Lafir</td>
                            <td>IS</td>
                            <td>shamah@gmail.com</td>
                            <td><a href="#" span class = "view"></span>View Profile</td>
                        </tr>

                        <tr>
                            <td>Binali Ukwatte</td>
                            <td>IS</td>
                            <td>binali@gmail.com</td>
                            <td><a href="#" span class = "view"></span>View Profile</td>
                        </tr>

                        <tr>
                            <td>Sathurshika Manoharajan</td>
                            <td>CS</td>
                            <td>sathu@gmail.com</td>
                            <td><a href="#" span class = "view"></span>View Profile</td>
                        </tr>

                        <tr>
                            <td>Himasha Senevirathne</td>
                            <td>CS</td>
                            <td>himasha@gmail.com</td>
                            <td><a href="#" span class = "view"></span>View Profile</td>
                        </tr>

                        <tr>
                            <td>Achchuthan Kalanithy</td>
                            <td>IS</td>
                            <td>achchu@gmail.com</td>
                            <td><a href="#" span class = "view"></span>View Profile</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
            
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>