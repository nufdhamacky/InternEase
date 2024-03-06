<?php require_once("../app/view/inc/header.php"); ?>

<div class="container">
        <?php require_once("../app/view/inc/sidebar.php"); ?>
    
        <div class="main">
            <?php require_once("../app/view/inc/topbar.php"); ?>

            <div class="rounds">
                <div class="round">
                    <div class="round-marker"></div>
                    <div class="round-text">Round 01</div>
                </div>
                <div>
                    <svg width="20" height="78" viewBox="0 0 20 78" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18.5175 37.0295L18.0663 37.2447L18.5175 37.0295ZM18.5266 40.4543L18.9791 40.6671L18.5266 40.4543ZM0.881955 1.21525L18.0663 37.2447L18.9688 36.8142L1.78455 0.784753L0.881955 1.21525ZM18.0742 40.2414L0.880821 76.7871L1.78568 77.2128L18.9791 40.6671L18.0742 40.2414ZM18.0663 37.2447C18.518 38.1919 18.5209 39.2918 18.0742 40.2414L18.9791 40.6671C19.5534 39.4462 19.5497 38.0321 18.9688 36.8142L18.0663 37.2447Z" fill="#DEE2E6"></path></svg>
                </div>
                <div class="round">
                    <div class="round-marker"></div>
                    <div class="round-text">Round 02</div>
                </div>
            </div>

            <div class="ad-cards">
            
                <?php
                if (isset($data['data']) && is_array($data['data'])) {
                    foreach ($data['data'] as $index => $ad) {
                        echo '<div class="ad-card" onclick="displayAdDetails(' . $index . ')">';
                        echo '<img src="' . ROOT . $ad['image_url'] . '" alt="Advertisement ' . ($index + 1) . '">';
                        echo '<h3>' . $ad['company_name'] . '</h3>';
                        echo '<p>' . $ad['description'] . '</p>';
                        echo '</div>';
                    }
                }
                ?>
                <div class="ad-card" onclick="displayAdDetails(1)">
                    <img src="<?=ROOT?>/assets/images/wso2.png" alt="Advertisement 1">
                    <h3>WSO2</h3>
                    <p>Description of the advertisement 1</p>
                </div>
                <div class="ad-card" onclick="displayAdDetails(2)">
                    <img src="<?=ROOT?>/assets/images/codegen.png" alt="Advertisement 2">
                    <h3>Codegen</h3>
                    <p>Description of the advertisement 2</p>
                </div>
                <div class="ad-card" onclick="displayAdDetails(2)">
                    <img src="<?=ROOT?>/assets/images/sysco.png" alt="Advertisement 2">
                    <h3>SyscoLabs</h3>
                    <p>Description of the advertisement 2</p>
                </div>
                <div class="ad-card" onclick="displayAdDetails(2)">
                    <img src="<?=ROOT?>/assets/images/ifs.png" alt="Advertisement 2">
                    <h3>IFS</h3>
                    <p>Description of the advertisement 2</p>
                </div>
                <div class="ad-card" onclick="displayAdDetails(2)">
                    <img src="<?=ROOT?>/assets/images/virtusa.png" alt="Advertisement 2">
                    <h3>Virtusa</h3>
                    <p>Description of the advertisement 2</p>
                </div>
                <div class="ad-card" onclick="displayAdDetails(2)">
                    <img src="<?=ROOT?>/assets/images/sh.png" alt="Advertisement 2">
                    <h3>Synergen Health</h3>
                    <p>Description of the advertisement 2</p>
                </div>
                <div class="ad-card" onclick="displayAdDetails(2)">
                    <img src="<?=ROOT?>/assets/images/sysco.png" alt="Advertisement 2">
                    <h3>SyscoLabs</h3>
                    <p>Description of the advertisement 2</p>
                </div>
                <div class="ad-card" onclick="displayAdDetails(2)">
                    <img src="<?=ROOT?>/assets/images/ifs.png" alt="Advertisement 2">
                    <h3>IFS</h3>
                    <p>Description of the advertisement 2</p>
                </div>
                <div class="ad-card" onclick="displayAdDetails(2)">
                    <img src="<?=ROOT?>/assets/images/virtusa.png" alt="Advertisement 2">
                    <h3>Virtusa</h3>
                    <p>Description of the advertisement 2</p>
                </div>
                <div class="ad-card" onclick="displayAdDetails(2)">
                    <img src="<?=ROOT?>/assets/images/sh.png" alt="Advertisement 2">
                    <h3>Synergen Health</h3>
                    <p>Description of the advertisement 2</p>
                </div>
            </div>
            <div class="ad-details" id="adDetailsWindow">
                <div class="ad-content">
                    <!-- js handling -->
                </div>
            </div>            
        </div>
    </div>

    <script>
    

        function displayAdDetails(index) {
            var adData = <?php echo json_encode($data['data']); ?>;

            var adDetailsWindow = document.getElementById('adDetailsWindow');
            var adContent = document.querySelector('.ad-details .ad-content');

            // Assuming your data structure includes additional details like 'position', 'modeOfWork', 'internshipPeriod', 'requirements'
            var ad = adData[index];

            adContent.innerHTML = `
                <span class="close" onclick="closeAdDetails()">&times;</span>
                <h2>${ad.company_name}</h2>
                <p><strong>Job Position:</strong> ${ad.position}</p>
                <p><strong>Mode of Work:</strong> ${ad.modeOfWork}</p>
                <p></strong>Location:</strong> ${ad.location}</p>
                <p style="color:red;"><strong>Application Deadline:</strong> ${ad.deadline}</p>
                <p><strong>Requirements:</strong> ${ad.requirements}</p>
                <button onclick="applyToJob()">Apply</button>
                <button id="wishlist" onclick="wishlistJob()"><i class="fa-regular fa-heart"></i></button>
            `;

            adDetailsWindow.style.display = 'block';
        }

        function closeAdDetails() {
            document.getElementById('adDetailsWindow').style.display = 'none';
        }

        // Function to handle applying to the job
        function applyToJob() {
            // Logic to handle job application goes here

            alert('You have applied to this job!');
        }

        function wishlistJob(){

            document.getElementById('wishlist').innerHTML = `<i style="fill: red;" class="fa-solid fa-heart"></i>`;
            alert('Job Wishlisted');
        }


    </script>

<?php require_once("../app/view/inc/footer.php"); ?>