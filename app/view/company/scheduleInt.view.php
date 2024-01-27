<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule_I</title>
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
                    
                    <span></span>
                    <ion-icon class="profile-icon" name="person-circle-outline"></ion-icon>
                </div>
        </div>

        <div class="details">
            <div class="compdetails"> 
                <div class = "cardHeader">
                    <h2>Create Interview Schedule</h2>
                </div>   

                    <h4>Date Period:</h4>
                    <div class = "card">
                        <div class = "input-container">
                            <input type = "text" class = "bx1">
                            <ion-icon name="calendar-outline" class = "calendar-icon"></ion-icon>
                        </div>
                        <h4 class = "h4">to</h4>
                        <div class = "input-container">
                            <input type = "text" class = "bx1">
                            <ion-icon name="calendar-outline" class = "calendar-icon"></ion-icon>
                        </div>
                    </div>

                    <h4>Interview Duration:</h4>
                    <div class = "card">
                        <select>
                            <option value = "20">20 min</option>
                            <option value = "30">30 min</option>
                        </select>
                    </div>
    
                    <h4>Select the Day:</h4>
                    <div class = "grid">
                        <div class = "card1">Mon</div>
                        <div class = "card1">Tue</div>
                        <div class = "card1">Wed</div>
                        <div class = "card1">Thu</div>
                        <div class = "card1">Fri</div>
                        <div class = "card1">Sat</div>
                        <div class = "card1">Sun</div>
                    </div>

                    <div class="submit">
                        <button type="submit">SAVE</button>
                    </div>
            </div>
        </div>
        
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>