<?php require_once("../app/view/inc/header.php"); ?>

<div class="container">
        <?php require_once("../app/view/inc/sidebar.php"); ?>
    
        <div class="main">
            <?php require_once("../app/view/inc/topbar.php"); ?>

            <div class="grid-container-adtop">
                <div class="grid-container-round1">Round 1</div>
                <div class="grid-container-round2">Round 2</div>
            </div>

            <div class="ad-cards">
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
                    <span class="close" onclick="closeAdDetails()">&times;</span>
                    <h2>Company Name</h2>
                    <p><strong>Job Position:</strong> Job Position Title</p>
                    <p><strong>Mode of Work:</strong> Full-time/Part-time/Remote</p>
                    <p><strong>Internship Period:</strong> Start Date - End Date</p>
                    <p><strong>Requirements:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                    <button onclick="applyToJob()">Apply</button>
                </div>
            </div>            
        </div>
    </div>

    <script>
        // Function to display ad details window
        function displayAdDetails() {
            document.getElementById('adDetailsWindow').style.display = 'block';
        }

        // Function to close ad details window
        function closeAdDetails() {
            document.getElementById('adDetailsWindow').style.display = 'none';
        }

        // Function to handle applying to the job
        function applyToJob() {
            // Logic to handle job application goes here
            alert('You have applied to this job!');
        }

    </script>

<?php require_once("../app/view/inc/footer.php"); ?>