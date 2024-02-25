<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/css/pdc/main2.css">
    <title>Add Student</title>
</head>
<body>
<div class="main-div">
        <div class="leftpart">
            <img src="<?=ROOT?>/assets/images/logo.png" alt="" class="img1">
            <h1>Internship</h1>
            <h1>Management</h1>
            <h1>System</h1>
            <img src="<?=ROOT?>/assets/images/loginimage.png" alt="" class="img2">                
        </div> 
        <div class="rightpart">
            <form class="box" action="<?=ROOT?>/pdc/addNewStudent" method="post">
                <h2>Welcome to InternEase</h2>
                    <p class="label1">First Name:<br></p>
               
                <input type="text" required name="first_name" placeholder="Enter your first name" class="box1">
                    <p class="label1">Last Name:<br></p>
                <input type="text" required name="last_name" placeholder="Enter your last name" class="box2">
                    <p class="label1">Reg.No:<br></p>
                <input type="text" required name="reg_no" placeholder="Enter your Reg.No" class="box1">
                    <p class="label1">Index No:<br></p>
                <input type="text" required name="index_no" placeholder="Enter your index no" class="box2">
                    <p class="label1">Email:<br></p>
                <input type="email" required name="email" placeholder="Enter your email" class="box1">
                    <p class="label1">Password:<br></p>
                <input type="password" required name="password" placeholder="Enter your password" class="box2">
                    <i class='bx bxs-show eye-icon'></i>
            
                <div class="submit">
                    <button id="signup_btn" name="submit" type="submit">Save</button>
                   </div>
                
       
            </form>
        </div>
    </div>
</body>
</html>

