<?php
    include_once('../app/controller/Company.php');
    $companyController = new Company();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Advertisements</title>
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/company/companyAddAd.css">
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
                    <span><?php //echo $_SESSION['company_name']; ?></span>
                    <ion-icon class="profile-icon" name="person-circle-outline"></ion-icon>
                </div>
                
            </div>

            <form action="<?=ROOT?>/company/addNewAd" method="POST">    
                <div class="details">
                    <div class="heading-advertisement">
                            <h2>Add Advertisements</h2>
                    </div>

                    <div class="compdetails">
                        
                            <h4>Position</h4>
                            <select name="position">
                                <option value = "" selected hidden>Select Position</option>
                                <option value = "se">Sofware Engineer</option>
                                <option value = "qa">Quality Assuarance</option>
                                <option value = "ba">Business Analyst</option>
                            </select>
                            <br>

                            <h4>Requirements</h4>
                            <br>

                            <label for="req1"><input type="checkbox" name="req"> React</label><br>
                            <label for="req2"><input type="checkbox" name="req"> .Net</label><br>
                            <label for="req3"><input type="checkbox" name="req"> Node</label><br>
                            <label for="req4"><input type="checkbox" name="req"> Java</label><br>
                            <label for="req5"><input type="checkbox" name="req"> JavaScript</label><br>
                            <label for="req6"><input type="checkbox" name="req"> DevOps</label><br>
                            <label for="req7"><input type="checkbox" name="req"> C++</label><br>
                            <label for="req8"><input type="checkbox" name="req"> SQL</label><br>
                            <label for="req9"><input type="checkbox" name="req"> Python</label><br>
                           
                            <h4>Qualifications</h4>
                            <br>

                            <select name="qualification">
                                <option value = "" selected hidden>Select Qualification</option>
                                <option value = "cs">BSc. in Computer Science</option>
                                <option value = "is">BSc. in Information systems</option>
                                <option value = "cs-sp">BSc.(Hons) in Computer Science</option>
                                <option value = "is-sp">BSc.(Hons) in Information systems</option>
                            </select>
                            <br>

                            <br>
                            
                            <h4>Internship Period</h4>
                            <div class = "card">
                                <input name="start_date" class="ad-date" type = "month" class = "bx1">
                                <h4 class = "h4">to</h4>
                                <input name="end_date" class="ad-date" type = "month" class = "bx1">
                            </div>
                            <br>

                            <div class = "card">
                                <h4>No. of Interns</h4>
                                <h4 class = "spaceleft" style="margin-left:150px">Working Mode</h4>
                            </div>
                            <div class = "card">
                                <input name="no_of_intern" type = "number" class = "bx1">
                                <select name="working_mode">
                                    <option value = "Online">Online</option>
                                    <option value = "Physical">Physical</option>
                                    <option value = "Hybrid">Hybrid</option>
                                </select>
                            </div>
                            
                            <div class="submit">
                                <button type="submit" name="submit" value="saveAd">SAVE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </form>
        
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>