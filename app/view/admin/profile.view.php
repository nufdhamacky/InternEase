<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin profile</title>
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/admin/com.css?v=<?php echo time(); ?>">

</head>
<body>


<div class="container">
    <?php include('../app/view/layout/Admin_sidemenu.php') ?>
        <div class="content">
            <div class="toggle-bar" onclick="toggleContent('edit')" id="toggleE">Edit Email Address <ion-icon  id="editI" name="caret-down-outline" size="small" ></ion-icon></div>  
                <div class="toggle" id="editToggle">

                    <form class="update-form" method="POST" action='profile' id="form1">
                        <label>Please Enter your New Email Below</label>
                        <div class="formgroup">
                            <input type="hidden" name="col" value="user_name">
                            <div id="updatevalue">
                                <label for="updatevalue">Enter your new Email</label>
                                <input class="input-text" type="text" name="updatevalue" id="updatevalue">
                            </div>

                            <div id="confirmPassword" style="display: none;">
                                <label for="confirmPassword">Retype Password:</label>
                                <input class="input-text" type="password" name="confirmPassword">
                            </div>
                        </div>
                        <p >
                            <?php       
                                if (isset($data['email_error']) && is_array($data['email_error'])) {
                                    foreach ($data['email_error'] as $err) {
                                        echo htmlspecialchars($err) . '<br>';
                                    }
                                }
                            ?>      
                        </p>


                        <div class="formgroup">
                            <input type="submit" class="btn" value="Update" name="updateadmin">
                        </div>
                    </form>

                </div>

            <div class="toggle-bar" onclick="toggleContent('reset')" id="toggleR">Reset Password <ion-icon id="resetI" name="caret-down-outline"  size="small"></ion-icon></div>  
            <div class="toggle" id="resetToggle">

            <form class="update-form" method="POST" action='profile'>
                <label>Please Enter your Password Below: A password must contain a lower-case,upper-case letter,a numerical character and have at least 8 characters.</label>
                <div class="formgroup">
                <input type="hidden" name="col" value="password">
                <!--<select name="col" id="col" onchange="togglePasswordFields()">
                    <option value="user_name" selected>Email</option>
                    <option value="password">password</option>
                </select>
-->          

                <div id="updatevalue">
                    <label for="updatevalue">New Password</label>
                    <input class="input-text" type="text" name="updatevalue" id="updatevalue">
                </div>

                <div id="confirmPassword">
                    <label for="confirmPassword">Re-type Password:</label>
                    <input class="input-text" type="password" name="confirmPassword">
                </div>
                </div>
                    <p >
                        <?php       
                            if (isset($data['pwd_error']) && is_array($data['pwd_error'])) {
                                foreach ($data['pwd_error'] as $err) {
                                    echo htmlspecialchars($err) . '<br>';
                                }
                            }
                        ?>      
                    </p>

                <div class="formgroup">
                <input type="submit" class="btn" value="Update" name="updateadmin">
                </div>
                </form>


            </div>

        </div>
</div>
   



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>



function toggleContent(type) {
        var toggleId = type + "Toggle";
        var content = document.getElementById(toggleId);
        var icon = document.getElementById(type + "I");

        if (content.style.display === "none" || content.style.display === "") {
            content.style.display ="block";
            icon.setAttribute("name", "caret-up-outline");
            fadeInElement(toggleId);
            if(type === 'reset') {
                document.getElementById('toggleE').style.display = "none";
            } else {
                document.getElementById('toggleR').style.display = "none";
            }
        } else {
            content.style.display = "none";
            icon.setAttribute("name", "caret-down-outline");  
 
            if(type === 'reset') {
                document.getElementById('toggleE').style.display = "block";
            } else {
                document.getElementById('toggleR').style.display = "block";
            }
        }
    }
    
    // When the document is ready, check for errors and open the relevant toggle.
    $(document).ready(function() {
        <?php if (isset($data['pwd_error']) && $data['pwd_error']) { ?>
            toggleContent('reset');
        <?php } elseif (isset($data['email_error']) && $data['email_error']) { ?>
            toggleContent('edit');
        <?php } ?>
    });

   function fadeInElement(element) {
        const targetElement = typeof element === 'string' ? document.getElementById(element) : element;
        targetElement.style.opacity = 0;  
        let opacity = 0.0;
        const timer = setInterval(() => {
            opacity += 0.05; //5%
            targetElement.style.opacity = opacity;

            if (opacity >= 1) {
            clearInterval(timer); // Stop timer when opacity reaches 1
            }
        }, 10); // Update opacity every 10 milliseconds
    }



</script>
<?php 

if (isset($pwd) && $pwd == 1) {
    echo "
    <script>
        Swal.fire({
            title: 'Updated Successful',
            text: 'Your Password has been updated successfully!',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '" . ROOT . "/admin/logout'; // Correctly concatenated
            }
        });
    </script>";
}

if (isset($pwd) && $pwd == 0) {
    echo "
    <script>
        Swal.fire({
            title: 'Updated Unsuccessful',
            text: 'Please try again!',
            icon: 'error',
            confirmButtonText: 'Return'
        });
    </script>";
}

if (isset($email) && $email == 1) {
    echo "
    <script>
        Swal.fire({
            title: 'Updated Successful',
            text: 'Your Email has been updated successfully!',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '" . ROOT . "/admin/logout'; // Correctly concatenated
            }
        });
    </script>";
}


if (isset($email) && $email == 0) {
    echo "
    <script>
        Swal.fire({
            title: 'Updated Unsuccessful',
            text: 'Please try again!',
            icon: 'error',
            confirmButtonText: 'Return'
        });
    </script>";
}
?>

</body>
</html>
