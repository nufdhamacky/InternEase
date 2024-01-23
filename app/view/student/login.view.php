<?php require_once("../app/views/inc/header.php"); ?>

    <div class="container">
        <?php require_once("../app/views/inc/sidebar.php"); ?>

        
        <div class="leftpart">
            <img src="images/InternEaseLogo.png" alt="" class="img1">
            <h1>Internship</h1>
            <h1>Management</h1>
            <h1>System</h1>
            <img src="images/image.png" alt="" class="img2">                
        </div>

        <div class="rightpart">
            <form class="box" action="controller/login_controller.php" method="post">
                <h2>Welcome to InternEase</h2>
                <p class="label1">Email:<br></p>
                <input type="text" name="email" placeholder="Enter your username" class="box1">
                <p class="label1">Password:<br></p>
                <input type="password" name="password" placeholder="Enter your password" class="box2">
                <i class='bx bxs-show eye-icon'></i>
                <P class="fp">Forgot password?</P>
           
                <div class="submit">
                    <button name="submit" type="submit">Login</button>
                </div>
                
                <div class="dontacc">
                    Don't have an acoount? <a href="signup.php" class="su">Sign Up</a>
                </div>
           
            </form>
        </div>  
    </div>

    <?php require_once("../app/views/inc/footer.php"); ?>