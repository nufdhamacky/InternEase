<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDC Manage Company</title>
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/pdc/com.css">
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
            <div class ="cardBox">
                <div class ="card">
                <a style = "text-decoration: none" href="blacklistedcompanies.html">
                    <div>
                        <div class="number">5</div>
                        <div class="cardName">Black listed Companies</div>
                    </div>
                </a>
                    <div class="iconBx">
                        <ion-icon name="bag-handle-outline"></ion-icon>
                    </div>
                    
                </div>
            </div>


        <!--order data list-->
        <div class="details">
            <div class="companyList">
                <div class = "cardHeader">
                    <h2>Company List</h2>
                    <a href="#" class="btn">Add</a> 
                </div>
                <table>
                    <thead>
                        <tr>
                            <td>Company Name</td>
                            <td>Contact person</td>
                            <td>Email</td>
                            <td>Contact no</td>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Virtusa</td>
                            <td>Nirmal</td>
                            <td>hamsa@gmail.com</td>
                            <td>0763421345</td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>IFS</td>
                            <td>Kasun</td>
                            <td>nufdha@gmail.com</td>
                            <td>0713245678</td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>CodeGen</td>
                            <td>Kaalik</td>
                            <td>shama@gmail.com</td>
                            <td>1230543721</td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>

                       

                        <tr>
                            <td>99X</td>
                            <td>Gopika</td>
                            <td>shama@gmail.com</td>
                            <td>0734576123</td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>Sysco</td>
                            <td>Salama</td>
                            <td>nufdha@gmail.com</td>
                            <td>0754329123</td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>IFS</td>
                            <td>Sakthi</td>
                            <td>gawesh@gmail.com</td>
                            <td>0987655455</td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>Applexus</td>
                            <td>Khalid</td>
                            <td>hamsa@gmail.com</td>
                            <td>0876532123</td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>CodeGen</td>
                            <td>Nirush</td>
                            <td>gawesh@gmail.com</td>
                            <td>0764532123</td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>Virtusa</td>
                            <td>Vikash</td>
                            <td>shama@gmail.com</td>
                            <td>0874532145</td>
                            <td><a href="#" span class = "view"></span>View</td>
                        </tr>

                        <tr>
                            <td>IFS</td>
                            <td>Chamal</td>
                            <td>hamsa@gmail.com</td>
                            <td>0763421567</td>
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