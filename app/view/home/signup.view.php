<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/css/home/signup.css">

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
            
        <form action="<?=ROOT?>/home/signupcheck" class="box" method="POST">
            <h4>Create Account</h4>

            <p class="label1">Company Name: 
                

                    <span class="error"><?= isset($data['signupError']['companyName']) ?></span>
                    <br>
            </p>
            <input type="text" name="companyName" class="box1" value="<?= isset($_POST['companyName']) ? $_POST['companyName'] : '' ?>">
            
            <p class="label1">Email:
                
                
                    <span class="error"><?= isset($data['signupError']['email']) ?></span>
                    <br>
            </p>
            <input type="email" name="email" class="box1" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">

            <p class="label1">Company Website:
                
                
                    <span class="error"><?= isset($data['signupError']['website']) ?></span>
                    <br>
            </p>
            <input type="text" name="compsite" class="box1" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
            
            <p class="label1">Password:
                
                    <span class="error"><?= isset($data['signupError']['password']) ?></span>
                    <br>
            </p>
            <input type="password" name="password" class="box2" value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>">
            <i class='bx bxs-show eye-icon'></i>
            
            <p class="label1">Confirm Password:
                
                    <span class="error"><?= isset($data['signupError']['confirmPassword']) ?></span>
                    <br>
            </p>
            <input type="password" name="confirmPassword" class="box2">
            

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>        
<?php 

if (isset($sent) && $sent == 1) {
    echo "
    <script>
        Swal.fire({
            title: 'Company added to review list!',
            text: 'you will be notified about the status of your account.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '" . ROOT . "/home/login'; // Correctly concatenated
            }
        });
    </script>";
}
?>
</body>
</html>
 