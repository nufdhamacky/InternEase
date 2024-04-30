<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?=ROOT?>/css/home/landingpg.css">

    <title>Landing Page</title>
</head>
<body>
    <div class="container">
        <div class="main-left">
            <div class="img">
                <img src = "<?=ROOT?>/assets/images/logo.png" alt="">
            </div>
            
            <div class="box">
                <div class="welcome-part">
                    <h1>WELCOME TO</h1>
                    <h2>InternEase</h2>
                </div>
                <div class="ims-part">
                    <p>Internship Management System</p>
                    <p>for Undergraduates</p>
                </div>
                <div class="submit">
                <a href="<?=ROOT?>/home/login"><button type="submit">Login</button></a>
                </div>
            </div>
        </div>

        <div class="main-right">
            <div class="topbar">
                <a href="home"><div class="card active">Home</div></a>
                <a href="home/about"><div class="card">About Us</div></a>
                <a href="home/service"><div class="card">Services</div></a>
                <a href="home/contact"><div class="card" style="color: #0B5A6F;">Contact Us</div></a>

                <!-- <a href="home/contact"><div class="card"><style color="#0B5A6F">Contact Us </style></div></a> -->
            </div>
            <img src="<?=ROOT?>/assets/images/landing-img.PNG" alt="">
        </div>
    </div>

    <script src="<?=ROOT?>/js/topbar.js"></script>
</body>
</html>