<?php require_once("../app/views/inc/header.php"); ?>

<div class="container">
        <?php require_once("../app/views/inc/sidebar.php"); ?>
    
        <div class="main">
            <?php require_once("../app/views/inc/topbar.php"); ?>

            <div class="content">
                <div class="profile-box">
                    <div class="profile-header">
                        <div class="profile">
                            <img class="profile-picture" src="<?=ROOT?>/assets/shamah.png" alt="Profile Picture">
                            <div class="profile-name">Shamah</div>
                        </div>
                        <button class="edit-button">Edit</button>
                        <i class="settings-icon fas fa-cog"></i>
                    </div>
                    <div class="profile-content">
                        <div class="input1">
                            <textarea class="text-area" placeholder="Course"></textarea>
                        <textarea class="text-area" placeholder="Contact"></textarea>
                        <textarea class="text-area" placeholder="School"></textarea>
                        </div>
                        <div class="text1-area">
                            <label for="cv-upload" class="cv-label">Upload CV:</label>
                            <input type="file" id="cv-upload" class="cv-input">
                            <label for="cv-upload" class="cv-button" >Choose File</label>
                        </div>
                        <textarea class="text-area" placeholder="Interested Areas"></textarea>
                        <textarea class="text-area" placeholder="Experience"></textarea>
                        <textarea class="text-area" placeholder="Extra Curricular"></textarea>
                        <textarea class="text-area" placeholder="Qualifications"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once("../app/views/inc/footer.php"); ?>