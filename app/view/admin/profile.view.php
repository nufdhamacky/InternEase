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
            <form class="update-form" method="POST" action='profile'>
                <div class="formgroup">
                    <label for="col">Attribute:</label>
                    <select name="col" id="col" onchange="togglePasswordFields()">
                        <option value="user_name">Email</option>
                        <option value="password">Password</option>
                    </select>

                    <div id="updatevalue">
                        <label for="updatevalue">Value:</label>
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
    </div>
</div>
   



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    function togglePasswordFields() {
        var col = document.getElementById("col");
        var updatevalue = document.getElementById("updatevalue");
        var confirmPasswordField = document.getElementById("confirmPassword");

        if (col.value === "password") {
            confirmPasswordField.style.display = "block";
        } else {
            confirmPasswordField.style.display = "none";
        }
    }
/*
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
