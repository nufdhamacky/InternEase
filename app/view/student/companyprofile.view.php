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
                        <?php echo $company['company_name']; ?>
                    </div>
                    <div class="com-description">
                        <?php echo $company['description']; ?>
                    </div>
                    <div class="website">
                        <a href="<?php echo $company['website']; ?>"><?php echo $company['website']; ?></a>
                    </div>
                    <div class="contact-person">
                        Contact Person: <span class="person"><?php echo $company['contact_person']; ?></span>
                    </div>
                    <div class="contact-number">
                        Contact Number: <span class="num"><?php echo $company['contact_number']; ?></span>
                    </div>
                    <div class="address">
                        Address: <span class="addr"><?php echo $company['address']; ?></span>
                    </div>
                </div>
            </div>
        
    </div>
</div>


<?php require_once("../app/view/inc/footer.php"); ?>