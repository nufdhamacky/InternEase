<?php require_once("../app/view/inc/header.php"); ?>

<div class="container">
        <?php require_once("../app/view/inc/sidebar.php"); ?>
    
        <div class="main">
            <?php require_once("../app/view/inc/topbar.php"); ?>

            <div class="ad-cards">
            
                <?php
                if (isset($ads) && count($ads) > 0) {
                    foreach ($ads as $index => $ad) {
                        echo '<div class="ad-card" onclick="displayAdDetails(' . $index . ')">';
                        echo '<img src="' . ROOT . '/assets/images/' . $ad['user_profile'] . '" alt="Advertisement ' . ($index + 1) . '">';
                        echo '<h3>' . $ad['company_name'] . '</h3>';
                        echo '<h5>' . $ad['position'] . '</h5>';
                        echo '<p>' . $ad['requirements'] . '</p>';
                        echo '</div>';
                    }
                }
                ?>
                
            </div>
            <div class="ad-details" id="adDetailsWindow">
                <div class="ad-content">
                    <!-- js handling -->
                </div>
            </div> 

        </div>
</div>

<<script>
    function displayAdDetails(index) {
        var adData = <?php echo json_encode($ads); ?>
        var adDetailsWindow = document.getElementById('adDetailsWindow');
        var adContent = document.querySelector('.ad-details .ad-content');

        var ad = adData[index];
        console.log(ad);
    }
</script>

<?php require_once("../app/view/inc/footer.php"); ?>