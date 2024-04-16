<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage pdc</title>
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/admin/com.css?v=<?php echo time(); ?>">
</head>
<body>

    <div class="container">
        <?php include_once('../app/view/layout/Admin_sidemenu.php')  ?>
            <div class="content">        

                        <div class="report_item">
                            <h2>Active PDC Users</h2>
                            <table>
                                <thead>
                                    <tr>
                                        <td>User Name</td>
                                        <td colspan="2"><center>User</center></td>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php if ($pdc_users && count($pdc_users)> 0): ?>
                                    <?php foreach ($pdc_users as $users): ?>

                                        <tr>
                                        <td><?php echo isset($users['email']) ? htmlspecialchars($users['email']) : ''; ?></td>
                                        <td><?php echo isset($users['first_name']) ? htmlspecialchars($users['first_name']) : ''; ?></td>
                                        <td><?php echo isset($users['last_name']) ? htmlspecialchars($users['last_name']) : ''; ?></td>
                                        </tr>

                                    <?php endforeach; ?>
                                <?php endif; ?>   
                                </table>
                        </div>


                <div class="toggle-bar" onclick="toggleContent('insert')" id='toggleI'>Add a PDC User <ion-icon  id="insertI" name="caret-down-outline" size="small"></ion-icon></div>  
                
                <div class="toggle" id="insertToggle">
                    <form class="insert-form" id="insertform" method="post" action="managepdc">

                        <div class="formgroup">
                        <label for="pdc_fname">First name:</label>
                        <input class="input-text" type="text" name="pdc_fname" id="pdc_fname">
                        </div>

                        <div class="formgroup">
                        <label for="pdc_lname">Last name:</label>
                        <input class="input-text" type="text" name="pdc_lname" id="pdc_lname">
                        </div>

                        <div class="formgroup">
                        <label for="pdc_email">Email:</label>
                        <input class="input-text" type="text" name="pdc_email" id="pdc_email">
                        </div>

                        <div class="formgroup">
                        <label for="pdc_pwd">password:</label>
                        <input class="input-text" type="password" name="pdc_pwd" id="pdc_pwd">
                        </div>  
                        
                        <div class="formgroup">
                        <label for="pdc_rpwd">Confirm-password:</label>
                        <input class="input-text" type="password" name="pdc_rpwd" id="pdc_rpwd">
                        </div>   
                        <p >
                            <?php       
                              if (isset($data['errors']) && is_array($data['errors'])) {
                                foreach ($data['errors'] as $errorKey => $errorMessages) {
                                    if (is_array($errorMessages)) {
                                        // Loop through each error message if it's an array
                                        foreach ($errorMessages as $errorMessage) {
                                            echo htmlspecialchars($errorMessage) . '<br>';
                                        }
                                    } else {
                                        // It's a string, so just echo it out
                                        echo htmlspecialchars($errorMessages) . '<br>';
                                    }
                                }
                            }
                            
                            ?>      
                        </p>
                        <center><input type="submit"  class="btn" value="Submit" name="insertpdc"></center>
                    </form>
                </div>

                <!--                       
                    <form class="update-form"  method="post">

                        <div class="formgroup">
                            <label for="col">Column:</label>
                                <select name="col" id="col" onchange="togglePasswordFields()">
                                    <option value="first_name">First name</option>
                                    <option value="last_name">Last name</option>
                                    <option value="email">Email</option>
                                    <option value="password">Password</option>
                                </select>

                            <div  id="updatevalue">
                                <label for="updatevalue">Value</label>
                                <input class="input-text" type="text" name="updatevalue" id="updatevalue">
                            </div>

                            <div id="confirmPassword" style="display: none;">
                                    <label for="confirmPassword">Confirm Password:</label>
                                    <input class="input-text" type="password" name="confirmPassword">
                            </div>
                        </div>  

                        <div class="formgroup">
                            <label for="pdcid">PDC ID:</label>
                            <input class="input-text" type="text" name="pdcid" id="pdcid">
                            <input type="submit" class="btn" value="Update" name="updatepdc">
                        </div>
                    </form>
                                    -->
            </div>

    </div>  


<script>

    function toggleContent(type) {
            var toggleId = type + "Toggle";
            var iconId = type + "I";
            var content = document.getElementById(toggleId);
            var icon = document.getElementById(iconId);

            if (content.style.display === "none" || content.style.display === "") {
                content.style.display = "block";
                fadeInElement(toggleId);
                icon.setAttribute("name", "caret-up-outline");
                scrollToBottom();
            } else {
                content.style.display = "none";
                icon.setAttribute("name", "caret-down-outline");
                scrollToTop();
            }
    }

    function scrollToBottom() {
        var halfPageHeight = document.body.scrollHeight / 2;
        window.scrollTo(0, halfPageHeight);
    }

    function scrollToTop() {
            var halfPageHeight = document.body.scrollHeight;
            window.scrollTo(0, halfPageHeight);
    }

    $(document).ready(function() {
        <?php if (isset($data['errors'])) { ?>
            toggleContent('insert');
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



if(isset($add) && $add == 0){
    echo "
    
    <script>
        
            Swal.fire({
                title: 'PDC user insertion failed!',
                text: 'Please try again!',
                icon: 'error',
                confirmButtonText: 'return'
            });
      
    </script>";
}

if(isset($add) && $add == 1) {
    echo "
    
    <script>
        
            Swal.fire({
                title: 'PDC user Added Sucessful',
                icon: 'success',
                confirmButtonText: 'OK'
            });
      
    </script>";
} 

?>
</body>
</html>
