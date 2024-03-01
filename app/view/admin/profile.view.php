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
            <div class="toggle-bar" onclick="toggleContent('edit')" id="toggleE">Edit Email Address</div>  
                <div class="toggle" id="editToggle">

                    <form class="update-form" method="POST" action='profile'>
                        <div class="formgroup">
                            <label>Please Enter your New Email Below</label>
                            <input type="hidden" name="col" value="user_name">
                            <div id="updatevalue">
                                <label for="updatevalue">Enter Email</label>
                                <input class="input-text" type="text" name="updatevalue" id="updatevalue">
                            </div>

                            <div id="confirmPassword" style="display: none;">
                                <label for="confirmPassword">Retype Password:</label>
                                <input class="input-text" type="password" name="confirmPassword">
                            </div>
                        </div>

                        <div class="formgroup">
                            <input type="submit" class="btn" value="Update" name="updateadmin">
                        </div>
                    </form>

                </div>
     

            <div class="toggle-bar" onclick="toggleContent('reset')" id="toggleR">Reset Password</div>  
            <div class="toggle" id="resetToggle">

            <form class="update-form" method="POST" action='profile'>
                <div class="formgroup">
                <label>Please Enter your Password Below</label>
                <input type="hidden" name="col" value="password">
                <!--<select name="col" id="col" onchange="togglePasswordFields()">
                    <option value="user_name" selected>Email</option>
                    <option value="password">password</option>
                </select>
-->

                <div id="updatevalue">
                    <label for="updatevalue">Enter Password</label>
                    <input class="input-text" type="text" name="updatevalue" id="updatevalue">
                </div>

                <div id="confirmPassword">
                    <label for="confirmPassword">Retype Password:</label>
                    <input class="input-text" type="password" name="confirmPassword">
                </div>
                </div>

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
        if (content.style.display === "none" || content.style.display === "" ) {
            content.style.display = "block";
            if(type=='reset'){
                var bar = document.getElementById('toggleE')
                bar.style.display = "none";
            }else{
                var bar = document.getElementById('toggleR')
                bar.style.display = "none";
             }    
        } else {
            content.style.display = "none";
            if(type=='reset'){
                var bar = document.getElementById('toggleE')
                bar.style.display = "block";
            }else{
                var bar = document.getElementById('toggleR')
                bar.style.display = "block";
             }    
        }

      
      
    }

 /*   
    function togglePasswordFields() {
        var col = document.getElementById("col");
        var updatevalueLabel = document.querySelector('label[for="updatevalue"]');
        var confirmPasswordField = document.getElementById("confirmPassword");
        var value = document.getElementById("update");
        if (col.value === "password") {
            updatevalueLabel.textContent = 'Enter Password';
            confirmPasswordField.style.display = "block";
        } else {
            confirmPasswordField.style.display = "none";
            updatevalueLabel.textContent = 'Enter Email';
        }
    }


    $(document).ready(function () {
        $("form").submit(function (event) {
            var formData = {
            col: $("#col").val(),
            updatevalue: $("#updatevalue").val(),
            password: $("#confirmPassword").val(),
            };

            $.ajax({
            type: "POST",
            url: "process.php",
            data: formData,
            dataType: "json",
            encode: true,
            }).done(function (data) {
            console.log(data);
            });

            event.preventDefault();
        });
    
});*/
</script>
</body>
</html>
