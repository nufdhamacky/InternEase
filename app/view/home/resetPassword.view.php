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
            <form action="<?=ROOT?>/home/passwordResetRequest" method="POST" id="resetForm">
                <h2>Reset Your Password</h2>
                <div class="box">
                    <p>Please enter your email address to receive a link to reset your password.</p>
                    <div class="login-each-field">      
                        <p class="label1">Email:<br></p>
                        <input id="emailInput" name="email" type="email" placeholder="Enter your email" class="box1" required>
                    </div>
                    <div class="submit">
                        <button type="button" id="sendLinkBtn">Send Reset Link</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- OTP Modal -->
    <div class="modal" id="otpModal" style="display:none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form  action="<?=ROOT?>/home/validate_otp" method="POST" id="otpForm">
                <h3>Enter OTP</h3>
                <input type="text" name="otp" placeholder="Enter OTP" required>
                <button type="submit">Verify OTP</button>
            </form>
        </div>
    </div>

    <script src="<?=ROOT?>/js/login.js"></script>
    <script>
        var modal = document.getElementById('otpModal');
        var btn = document.getElementById('sendLinkBtn');
        var emailInput = document.getElementById('emailInput');
        var close = document.querySelector('.close');

        btn.onclick = function() {
            if (emailInput.value === '' || !validateEmail(emailInput.value)) {
                alert('Please enter a valid email address.');
                emailInput.focus();
            } else {
                modal.style.display = 'block';
            }
        }

        close.onclick = function() {
            modal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }

        function validateEmail(email) {
            var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email.toLowerCase());
        }

        document.getElementById('otpForm').onsubmit = function(event) {
            event.preventDefault();
            // Add AJAX call here to verify the OTP
        }
    </script>
</body>
</html>
