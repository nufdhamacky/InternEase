<?php require_once("../app/view/inc/header.php"); ?>

<div class="container">
        <?php require_once("../app/view/inc/sidebar.php"); ?>
    
        <div class="main">
            <?php require_once("../app/view/inc/topbar.php"); ?>

            <div class="ad-cards">
            
                <?php
                if (isset($data['ads']) && is_array($data['ads'])) {
                    foreach ($data['ads'] as $index => $ad) {
                        echo '<div class="ad-card" onclick="displayAdDetails(' . $index . ')">';
                        echo '<img src="' . ROOT . $ad['image_url'] . '" alt="Advertisement ' . ($index + 1) . '">';
                        echo '<h3>' . $ad['company_name'] . '</h3>';
                        echo '<p>' . $ad['description'] . '</p>';
                        echo '</div>';
                    }
                }
                ?>
                
            </div>
             

        </div>
</div>

<?php require_once("../app/view/inc/footer.php"); ?>