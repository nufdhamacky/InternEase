<?php require_once("../app/view/inc/header.php"); ?>


<div class="container">
    <?php require_once("../app/view/inc/sidebar.php"); ?>
    <div class="main">
            <?php require_once("../app/view/inc/topbar.php"); ?>
            <div class="com-container">
                <div class="logo">
                    <img src="<?=ROOT?>/assets/images/<?=company['user_profile']?>" alt="Company Logo">
                </div>
                <div class="company-info">
                    <div class="com-name">
                        <?php echo $data['company_name']; ?>
                    </div>
                    <div class="com-description">
                        <?php echo $data['description']; ?>
                    </div>
                    <div class="website">
                        <a href="<?php echo $data['website']; ?>"><?php echo $data['website']; ?></a>
                    </div>
                    <div class="contact-person">
                        Contact Person: <span class="person"><?php echo $data['contact_person']; ?></span>
                    </div>
                    <div class="contact-number">
                        Contact Number: <span class="num"><?php echo $data['contact_number']; ?></span>
                    </div>
                    <div class="address">
                        Address: <span class="addr"><?php echo $data['address']; ?></span>
                    </div>
                </div>
            </div>
        
    </div>
</div>


<?php require_once("../app/view/inc/footer.php"); ?>