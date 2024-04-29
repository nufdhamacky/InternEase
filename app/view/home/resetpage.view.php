<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/css/home/login.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <title>Set New Password</title>
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
            <form action="<?=ROOT?>/home/resetPassword" method="POST" id="newPasswordForm">
                <h2>Set New Password</h2>
                <div class="box">
                    <p>Please enter your new password.</p>
                    <div class="login-each-field">      
                        <p class="label1">New Password:<br></p>
                        <input id="password" name="password" type="password" placeholder="Enter new password" class="box1" required>
                    </div>
                    <div class="login-each-field">
                        <p class="label1">Confirm Password:<br></p>
                        <input id="confirmPassword" name="confirmPassword" type="password" placeholder="Confirm new password" class="box1" required>
                    </div>
                    <div class="submit">
                    <input type="submit" class="btn" value="Reset" name="pwd_reset">
                    </div>
                </div>
                    <p >
                        <?php       
                            if (isset($errors)) {
                                foreach ($errors as $err) {
                                    echo htmlspecialchars($err) . '<br>';
                                }
                            }
                        ?>      
                    </p>
            </form>
        </div>
    </div>

    <script src="<?=ROOT?>/js/login.js"></script>
    <script>
        document.getElementById('newPasswordForm').onsubmit = function(event) {
            var newPassword = document.getElementById('newPassword').value;
            var confirmPassword = document.getElementById('confirmPassword').value;

            if (newPassword !== confirmPassword) {
                alert('Passwords do not match.');
                event.preventDefault();  // Prevent form submission
            }
            // Optionally add more validation for password strength
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>    
<?php
if (isset($pwd) && $pwd == 1) {
    echo "
    <script>
        Swal.fire({
            title: 'Updated Successful',
            text: 'Your Password has been updated successfully!',
            icon: 'success',
            confirmButtonText: 'Done'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '" . ROOT . "/home'; // Correctly concatenated
            }
        });
    </script>";
}


if (isset($sent) && $sent == 0) {
    echo "
    <script>
        Swal.fire({
            title: 'OTP incorrect or expired',
            text: 'Please try again',
            icon: 'error',
            confirmButtonText: 'Close'
        });
    </script>";
}
?>
</html>
