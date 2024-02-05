<?php
    include_once('../app/controller/pdc.php');
    $pdController=new Pdc();
    $students=$pdController->getAllStudent();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDC Manage Student</title>
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/pdc/stu.css">
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
            <div class="studentList">
                <div class = "cardHeader">
                    <h2>Students List</h2>
                    <a href="addstudent" class="btn">Add</a> 
                </div>
                <table>
                    <thead>
                        <tr>
                            <td>Student Name</td>
                            <td>Registration No</td>
                            <td>Email</td>
                            <td>Index no</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        foreach ($students as $student){ ?>
                            <tr>
                                <td><?php echo $student->firstName." ".$student->lastName; ?></td>
                                <td><?php echo $student->regNo; ?></td>
                                <td><?php echo $student->email; ?></td>
                                <td><?php echo $student->indexNo; ?></td>
                                <td>
                                   
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
        <div class = "selection">
            <div class = "first">
                
            </div>
        </div>
        
        
            
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="<?=ROOT?>/js/managestudent.js"></script>
</body>
</html>