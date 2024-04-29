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
            <a href="../home"><img src="<?=ROOT?>/assets/images/logo.png" alt="Logo" class="img1"></a>
            <h1>Internship</h1>
            <h1>Management</h1>
            <h1>System</h1>
            <img src="<?=ROOT?>/assets/images/loginimage.png" alt="Login Image" class="img2">                
        </div>
        <div class="rightpart">
            <form action="<?=ROOT?>/home/signupcheck" class="box" method="POST">
                <h4>Create Account</h4>
                <label for="companyName">Company Name:</label>
                <input type="text" id="companyName" name="companyName" class="box1" value="<?= $_POST['companyName'] ?? '' ?>"  required>
                <span class="error"><?php if(isset($errors['company'])){ foreach ($errors['company'] as $err){ echo $err; }} ?></span>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="box1" value="<?= $_POST['email'] ?? '' ?>"   required >
                <span class="error"><?php if(isset($errors['email'])){foreach ($errors['email'] as $err){ echo $err; }} ?></span>

                <label for="compsite">Company Website:</label>
                <input type="text" id="compsite" name="compsite" class="box1" value="<?= $_POST['compsite'] ?? '' ?>"   required>
                <span class="error"></span>

                <label for="contactPerson">Contact Person:</label>
                <input type="text" id="contactPerson" name="contactPerson" class="box1" value="<?= $_POST['contactPerson'] ?? '' ?>"   required>
                <span class="error"><?php if(isset($errors['contact_person'])){foreach ($errors['contact_person'] as $err){ echo $err; }} ?></span>

                <label for="contactNo">Contact No:</label>
                <input type="text" id="contactNo" name="contactNo" class="box1" value="<?= $_POST['contactNo'] ?? '' ?>"   required>
                <span class="error"></span>

                <label for="address">Address:</label>
                <input type="text" id="address" name="address" class="box1" value="<?= $_POST['address'] ?? '' ?>"   required>
                <span class="error"></span>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="box2" value="<?= $_POST['password'] ?? '' ?>"  required>
                <i class='bx bxs-show eye-icon'></i>
                <span class="error"></span>

                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" class="box2"  required>
                <?php if(isset($errors['password'])){ ?>
                    
                    <?php foreach ($errors['password'] as $err){ ?>
                        <p class="error"> <?php echo $err; ?>  </p>
                        
                   
                        
                    <?php }} ?>

                <div class="member">
                    <p class="mem">Already a member? <a href="./login" class="login">Log In</a></p>
                </div>
                <div class="submit" align="center">
                   <input type='submit' name='submitcompany'> 
                </div>
            </form>
        </div>  
    </div>

  
    <script src="<?=ROOT?>/js/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>        

   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>        

<?php 
if (isset($sent) && $sent == 1) {
    echo "
    <script>
        Swal.fire({
            title: 'Company Signed up and now is pending.',
            text: 'Your request will be reviewd',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '" . ROOT . "/home/'; // Correctly concatenated
            }
        });
    </script>";
}


if (isset($failure) && $failure == 1) {
    echo "
    <script>
        Swal.fire({
            title: 'Something went wrong!',
            text: 'Please try again later',
            icon: 'error',
            confirmButtonText: 'Close'
        });
    </script>";
}
?>


</body>

</html>
