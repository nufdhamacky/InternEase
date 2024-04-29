<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/css/home/login.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <title>Password Reset</title>
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
            <form action="<?=ROOT?>/home/password_reset_request" method="POST" id="resetForm">
                <h2>Reset Your Password</h2>
                <div class="box">
                    <p>Please enter your email address to receive a link to reset your password.</p>
                    <div class="login-each-field">      
                        <p class="label1">Email:<br></p>
                        <input id="emailInput" name="email" type="email" placeholder="Enter your email" class="box1" required>
                    </div>
                    <div class="submit">
                        <input type="submit" class="btn" value="Reset" name="otp_req">
                    </div>
                    <?php if(isset($errors) && !empty($errors)){ ?>
                        <?php foreach ($errors as $err): ?>
                        <p><?php echo $err; ?></p>
                        <?php endforeach; ?>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>

    <div class="modal" id="otpModal" style="display:none;">
        <div class="modal-content">
            <form action="<?=ROOT?>/home/validate_otp" method="POST" id="otpForm">
                <h3>OTP has been sent to <?php echo $_SESSION['resetEmail'] ;?></h3>
                <input type="text" name="otp" placeholder="Enter OTP" required>
                <input type="submit" class="btn" value="Submit OTP" name="submit_otp">
            </form>
        </div>
    </div>

    <script src="<?=ROOT?>/js/login.js"></script>
    <script>
    otp();  

    function otp() {
        var modal = document.getElementById('otpModal');
        var otp = <?php echo json_encode(isset($otp) ? $otp : null); ?>;
        var sent = <?php echo json_encode(isset($sent) ? $sent : null); ?>;
        console.log("OTP:", otp);
        if (otp === 1 || sent==0) {
            modal.style.display = 'block';
        }
    }

    var modal = document.getElementById('otpModal');
    var emailInput = document.getElementById('emailInput');
    var close = document.querySelector('.close');


    close.onclick = function() {
        modal.style.display = 'none';
    };

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };

    function validateEmail(email) {
        var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email.toLowerCase());
    }

    </script>
<?php
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
</body>
</html>
