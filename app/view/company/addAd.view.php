<?php
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
        
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class="user">
                    <span><?php echo $_SESSION['companyName'] ?? ''; ?></span>
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
                        <select name="position" required>
                            <option value="" selected hidden>Select Position</option>
                            <option value="Sofware Engineer(Front-End)">Sofware Engineer(Front-End)</option>
                            <option value="Sofware Engineer(Back-End)">Sofware Engineer(Back-End)</option>
                            <option value="QA(Manual Testing)">QA(Manual Testing)</option>
                            <option value="Business Analyst">Business Analyst</option>
                            <option value="Data Analayst">Data Analyst</option>
                            <option value="Graphic Design">Graphic Design</option>
                            <option value="Product Management">Product Management</option>
                            <option value="Software Test Automation">Software Test Automation</option>
                            <option value="Digital Marketiing">Digital Marketing</option>
                        </select>
                        <br>

                        <h4>Requirements</h4>
                        <div class="check">
                            <input type="checkbox" name="req[]" value="React"> React<br>
                            <input type="checkbox" name="req[]" value=".Net"> .Net<br>
                            <input type="checkbox" name="req[]" value="Node"> Node<br>
                            <input type="checkbox" name="req[]" value="Java"> Java<br>
                            <input type="checkbox" name="req[]" value="JS"> JavaScript<br>
                            <input type="checkbox" name="req[]" value="DevOps"> DevOps<br>
                            <input type="checkbox" name="req[]" value="C++"> C++<br>
                            <input type="checkbox" name="req[]" value="SQL"> SQL<br>
                            <input type="checkbox" name="req[]" value="Python"> Python<br>
                        </div>
                       <br>
                       
                        <h4>Qualification</h4>
                        <select name="qualification" required>
                            <option value="" selected hidden>Select Qualification</option>
                            <option value="BSc. in Computer Science">BSc. in Computer Science</option>
                            <option value="BSc. in Information systems">BSc. in Information systems</option>
                            <option value="BSc.(Hons) in Computer Science">BSc.(Hons) in Computer Science</option>
                            <option value="BSc.(Hons) in Information systems">BSc.(Hons) in Information systems</option>
                        </select>
                        <br>

                        <h4>Other Qualifications</h4>
                        <textarea name="other_qualifications" rows="4" cols="50" placeholder="Enter additional qualifications or descriptions..." class="qualification-textarea"></textarea>
                        <br>

                        <h4>Internship Period</h4>
                        <div class="card">
                            <input name="start_date" class="ad-date" type="month" required>
                            <h4 class="h4">to</h4>
                            <input name="end_date" class="ad-date" type="month" required>
                        </div>
                        <!-- <br> -->

                        <div class="card">
                            <h4>No. of Interns</h4>
                            <h4 class="spaceleft">No. of CVs Required</h4>
                        </div>
                        <div class="card">
                            <input name="no_of_intern" type="number" required>
                            <input name="no_of_cvs_required" type="number" required>
                        </div>

                        <div class="card"> 
                            <h4 class="spaceleft">Working Mode</h4>
                        </div>
                        <div class="card">
                            <select name="working_mode" required>
                                <option value="Remote">Remote</option>
                                <option value="Onsite">Onsite</option>
                                <option value="Hybrid">Hybrid</option>
                            </select>
                        </div>
                        
                        <div class="submit">
                            <button type="submit" name="submit" value="saveAd">SAVE</button>
                        </div>
                    </div>
                </div>
            </form>
        
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
