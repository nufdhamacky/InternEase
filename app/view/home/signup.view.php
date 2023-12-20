<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/css/signup.css">

    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <title>Sign Up</title>
</head>

<body>
    <div class="main-div">
        <div class="leftpart">
        <a href="../home"><img src="<?=ROOT?>/assets/images/logo.png" alt="" class="img1"></a>
            <h1>Internship</h1>
            <h1>Management</h1>
            <h1>System</h1>
            <img src="<?=ROOT?>/assets/images/loginimage.png" alt="" class="img2">                
        </div>

        <div class="rightpart">
            
        <form class="box" method="POST">
            <h4>Create Account</h4>
                    <?php if (isset($error)) { ?>
                        <p class="error"><?= $error ?></p>
                    <?php } ?>
                    <?php if(isset($_SESSION['error_msg'])){ ?>
                        <p class="error"><?= $_SESSION["error_msg"]; ?></p>
                    <?php } ?>
            <p class="label1">Company Name: 
                <?php if (isset($errors['company_name'])) { ?>
                    <span class="error"><?= $errors['company_name'] ?></span>
                <?php } ?><br></p>
            <input type="text"  name="company_name" class="box1" value="<?= isset($_POST['company_name']) ? $_POST['company_name'] : '' ?>">
            
            <p class="label1">Email:
                <?php if (isset($errors['email'])) { ?>
                    <span class="error"><?= $errors['email'] ?></span>
                <?php } ?><br></p>
            <input type="email"  name="email" class="box1" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
            
            <p class="label1">Password:
                <?php if (isset($errors['password'])) { ?>
                    <span class="error"><?= $errors['password'] ?></span>
                <?php } ?><br></p>
            <input type="password" name="password"  class="box2">
           
            <i class='bx bxs-show eye-icon'></i>
            <p class="label1">Confirm Password:
                <?php if (isset($errors['confirm_password'])) { ?>
                    <span class="error"><?= $errors['confirm_password'] ?></span>
                <?php } ?><br></p>
            <input type="password"  name="confirm_password" class="box2">
            

            <div class="member">
                <p class="mem">Already a member? <a href="./login" class="login">Log In</a></p>
            </div>

            <div class="submit" align="center">
                <button type="submit">Sign Up</button>
            </div>

        </form>
        </div>  
    </div>
    
    <script src="<?=ROOT?>/js/login.js"></script>
    <!-- <script src= "./auth.js"></script> -->

</body>
</html>
 