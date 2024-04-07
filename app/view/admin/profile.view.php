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
     

            <div class="toggle-bar" onclick="toggleContent('reset')" id="toggleR">Reset Password <ion-icon id="resetI" name="caret-down-outline"  size="small"></ion-icon></div>  
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
        
        if (content.style.display == "none" || content.style.display == "" ) {
            content.style.display = "block";
            toggleicon(toggleId,type+"I");  
            if(type=='reset'){
               
                var bar = document.getElementById('toggleE')
                bar.style.display = "none";
            }else{
 
                var bar = document.getElementById('toggleR')
                bar.style.display = "none";
             }               
        } else {
            content.style.display = "none";
            toggleicon(toggleId,type+"I");  
            if(type=='reset'){
                var bar = document.getElementById('toggleE')
                bar.style.display = "block";
            }else{
          
                var bar = document.getElementById('toggleR')
                bar.style.display = "block";
             }    
        }

}

    function toggleicon(toggle,icon) {
        var icon = document.getElementById(icon);
        var content = document.getElementById(toggle);
        if (content.style.display == "none") {
            icon.setAttribute("name", "caret-down-outline");
        } else {
            icon.setAttribute("name", "caret-up-outline");
        }
    }

</script>
<?php 

    if(isset($pwd) && $pwd == 1) {
        echo "
        
        <script>
            
                Swal.fire({
                    title: 'Updated Sucessful',
                    text: 'Your Password has been updated sucessfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
          
        </script>";
    }
    
    if(isset($pwd) && $pwd == 0){
        echo "
        
        <script>
            
                Swal.fire({
                    title: 'Updated Unsucessful',
                    text: 'Please try again!',
                    icon: 'error',
                    confirmButtonText: 'return'
                });
          
        </script>";
    }

    if(isset($email) && $email == 1) {
        echo "
        
        <script>
            
                Swal.fire({
                    title: 'Updated Sucessful',
                    text: 'Your Email has been updated sucessfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
          
        </script>";
    } 
    
    if(isset($email) && $email == 0){
        echo "
        
        <script>
            
                Swal.fire({
                    title: 'Updated Unsucessful',
                    text: 'Please try again!',
                    icon: 'error',
                    confirmButtonText: 'return'
                });
          
        </script>";
    }
?>

</body>
</html>
