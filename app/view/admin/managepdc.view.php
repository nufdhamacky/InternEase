<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage pdc</title>
     <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/admin/com.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" type="text/css" href="../../public/css/admin/com.css?v=<?php echo time(); ?>">
</head>
<body>

    <div class="container">
        <?php include_once('../app/view/layout/Admin_sidemenu.php') ?>
            <div class="content">        

                <div class='report'>      
                    <h2>Active PDC Users</h2>
                        <div class="report_item">
                            <table>
                                <thead>
                                    <tr>
                                        <td>User</td>
                                        <td colspan="2"><center>User Name</center></td>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php if ($pdc_users && count($pdc_users)> 0): ?>
                                    <?php foreach ($pdc_users as $users): ?>

                                        <tr>
                                            <td><?php echo htmlspecialchars($users['email']);?></td>
                                            <td><?php echo htmlspecialchars($users['first_name']); ?></td>
                                            <td><?php echo htmlspecialchars($users['last_name']); ?></td>
                                        </tr>

                                    <?php endforeach; ?>
                                <?php endif; ?>   
                                </table>
                        </div>
                </div>

                <div class="toggle-bar" onclick="toggleContent()">Add a PDC User</div>  
                
                <div class="toggle" id="toggle">
                    <form class="insert-form" method="post" action="managepdc">

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
</body>

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

        function toggleContent() {
            var content = document.getElementById("toggle");
            if (content.style.display === "none") {
                content.style.display = "block";
            } else {
                content.style.display = "none";
            }
        }

    </script>
</html>
