<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/css/home/login.css">

    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <title>Login</title>
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
            <form action="<?=ROOT?>/home/logincheck" method="POST">
            <h2>Welcome to InternEase</h2>
                <div class="box">

                   
                    <p class="error">
                        
                         
                    
                    </p>
                   
                    <div class="login-each-field">      
                        <p class="label1">Username:<br></p>
                        <input name="username" type="text" placeholder="Enter your email" class="box1">
                    </div>

                    <div class="login-each-field">
                        <p class="label1">Password:<br></p>
                        <div class="eye-icon-class">
                            <input name="password" type="password" placeholder="Enter your password" class="box2">
                            <i class='bx bxs-show eye-icon'></i>
                        </div>
                    </div>

                    <P class="fp">Forgot password?</P>

                </div>
                <div class="submit">
                    <button type="submit" name="submit" value="login">Login</button>
                </div>
            </form>
            <div class="dontacc">
                Don't have an acoount? <a href="./signup" class="">Sign Up</a>
            </div>
            </div>
        </div>  
    </div>

    <script src="<?=ROOT?>/js/login.js"></script>

</body>
</html>