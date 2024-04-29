<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/css/home/signup.css">
    <link rel="stylesheet" href="<?=ROOT?>/css/home/otp.css">
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

        <div class="modal" id="otpModal" style="display:block;">
        <div class="modal-content">
            <form action="<?=ROOT?>/home/validate_otp" method="POST" id="otpForm">
                <h3>Enter OTP</h3>
                <input type="text" name="otp" placeholder="Enter OTP" required>
                <input type="submit" class="btn" value="Submit OTP" name="submit_otp">
            </form>
        </div>


  
    <script src="<?=ROOT?>/js/login.js"></script>
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


if (isset($sent) && $sent == 0) {
    echo "
    <script>
        Swal.fire({
            title: 'OTP incorrect or expired',
            text: 'Please try again or sign-up again to get a new otp',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    </script>";
}
?>

</body>

</html>
