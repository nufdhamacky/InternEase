<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Interview</title>
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/company/companyScheduleInt.css">
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

            <div class="submit">

                <a href="scheduleInt">
                    <button type="submit" class="sbtn">SCHEDULE INTERVIEW</button>
                </a>

                <!-- <a href="tech">
                    <button type="submit" class="sbtn">SCHEDULE TECH-TALK</button>
                </a>

                <a href="companyVisit">
                    <button type="submit"class="sbtn">SCHEDULE COMPANY VISIT</button>
                </a> -->
                
            </div>
        
            <div class="details">
                <div class="compdetails"> 
                    <div class = "cardHeader">
                        <h2>Create Interview Schedule</h2>
                    </div>   

                        <h4>Date Period:</h4>
                        <div class = "card">
                            <div class = "input-container">
                                <input type = "date" class = "bx1">
                            </div>
                            <h4 class = "h4">to</h4>
                            <div class = "input-container">
                                <input type = "date" class = "bx1">
                            </div>
                        </div>

                        <h4>Interview Duration:</h4>
                        <div class = "card">
                            <select>
                                
                                <option value = "30">40 min</option>
                                
                            </select>
                        </div>
        
                        

                        <div class="submit">
                            <a href="schedule"><button type="submit" class="btn">SAVE</button></a>
                        </div>

                        
                </div>
            </div>
        
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>