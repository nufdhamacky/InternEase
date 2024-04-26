<?php require_once("../app/view/inc/header.php"); ?>

<div class="container">
        <?php require_once("../app/view/inc/sidebar.php"); ?>
    
        <div class="main">
            <?php require_once("../app/view/inc/topbar.php"); ?>

            <div class="rounds">
                <div class="round" id="firstround">
                    <div class="round-marker"></div>
                    <div class="round-text">Round 01</div>
                </div>
                <div>
                    <svg width="20" height="78" viewBox="0 0 20 78" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18.5175 37.0295L18.0663 37.2447L18.5175 37.0295ZM18.5266 40.4543L18.9791 40.6671L18.5266 40.4543ZM0.881955 1.21525L18.0663 37.2447L18.9688 36.8142L1.78455 0.784753L0.881955 1.21525ZM18.0742 40.2414L0.880821 76.7871L1.78568 77.2128L18.9791 40.6671L18.0742 40.2414ZM18.0663 37.2447C18.518 38.1919 18.5209 39.2918 18.0742 40.2414L18.9791 40.6671C19.5534 39.4462 19.5497 38.0321 18.9688 36.8142L18.0663 37.2447Z" fill="#DEE2E6"></path></svg>
                </div>
                <div class="round" id="secondround">
                    <div class="round-marker"></div>
                    <div class="round-text">Round 02</div>
                </div>
            </div>

            <div class="filterSection">
                <button><a href="applied" class="btn">View Applications</a></button>
                <button><a href="wishlisted" class="btn">View Your Wishlist</a></button>
            </div>

            <div class="ad-cards">
            
                <?php
                if (isset($ads) && count($ads) > 0) {
                    foreach ($ads as $index => $ad) {
                        echo '<div class="ad-card" onclick="displayAdDetails(' . $index . ')">';
                        echo '<img src="' . ROOT . '/assets/images/' . $ad['user_profile'] . '" alt="Advertisement ' . ($index + 1) . '">';
                        echo '<h3>' . $ad['company_name'] . '</h3>';
                        echo '<h5>' . $ad['position'] . '</h5>';
                        echo '<p>' . $ad['requirements'] . '</p>';
                        // echo '<p>' . $ad['ad_id'] . '</p>';
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

<!-- Second Round -->
    <div id="preferencesModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Job Role Preferences</h2>
            <form id="preferencesForm">
                <?php
                // Assume $jobRoles is an array of available IT internship roles
                $jobRoles = ["Web Developer", "Data Analyst", "Software Engineer", "Network Administrator", "UI/UX Designer", "DevOps Engineer", "Cybersecurity Analyst"];

                for ($i = 1; $i <= 3; $i++) {
                    echo "<label for='preference$i'>Preference $i:</label>";
                    echo "<select name='preference$i' class='preference' onchange='updateOptions(this)'>";
                    // echo "<option value=''>None</option>"; // Add None option as the default

                    // Add options for each job role
                    foreach ($jobRoles as $role) {
                        echo "<option value='$role'>$role</option>";
                    }

                    echo "</select><br>";
                }
                ?>
                <input type="submit" value="Save Preferences">
            </form>
        </div>
    </div>

<?php
// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Assign userId to a JavaScript variable
echo "<script>var userId = " . json_encode($_SESSION['userId']) . ";</script>";


?>

    <script>
        console.log('Script loaded successfully');

        document.addEventListener("DOMContentLoaded", function () {
        // Open the modal when the button is clicked
        document.getElementById("secondround").addEventListener("click", function () {
            document.getElementById("preferencesModal").style.display = "block";
        });

        // Close the modal when the close button or outside the modal is clicked
        document.querySelectorAll(".close, .modal").forEach(function (element) {
            element.addEventListener("click", function () {
                document.getElementById("preferencesModal").style.display = "none";
            });
        });

        // Prevent modal from closing when the form is clicked
        document.getElementById("preferencesForm").addEventListener("click", function (e) {
                e.stopPropagation();
            });
        });
    

        function displayAdDetails(index) {
            var adData = <?php echo json_encode($ads); ?>;
            var adDetailsWindow = document.getElementById('adDetailsWindow');
            var adContent = document.querySelector('.ad-details .ad-content');

            var ad = adData[index];
            console.log(ad);

            // Check if the student has already applied for the job
            var hasApplied = ad.applied; // Assuming ad.applied is a boolean value indicating whether the student has applied

            // Update UI accordingly
            var applyButtonHtml = hasApplied ? "Applied" : "Apply";
            var applyButtonOnClick = hasApplied ? "" : `onclick="applyToJob(${ad.ad_id}, ${userId})"`;
            var applyButtonBackground = hasApplied ? "violet" : "";

            var applyButton = `
                <button id="apply" style="background: ${applyButtonBackground}" ${applyButtonOnClick}>
                    ${applyButtonHtml}
                </button>
            `;

            var wishlistButton = hasApplied ? "" : `<button id="wishlist" onclick="wishlistJob(${ad.ad_id}, ${userId})"><i class="fa-regular fa-heart"></i></button>`;

            adContent.innerHTML = `
                <span class="close" onclick="closeAdDetails()">&times;</span>
                <h2>${ad.company_name}</h2>
                <p><strong>Job Position:</strong> ${ad.position}</p>
                <p><strong>Mode of Work:</strong> ${ad.working_mode}</p>
                <p><strong>Vacancies:</strong> ${ad.no_of_intern}</p>
                <p><strong>Internship period begins:</strong> ${ad.from_date}</p>
                <p><strong>Internship period ends:</strong> ${ad.to_date}</p>
                <p><strong>Qualifications:</strong> ${ad.qualification}</p>
                <p><strong>Expected Applications Count:</strong> ${ad.no_of_cvs_required}</p>
                <p><strong>Requirements:</strong> ${ad.requirements}</p>
                ${applyButton}
                ${wishlistButton}
            `;

            adDetailsWindow.style.display = 'block';
        }

        function closeAdDetails() {
            document.getElementById('adDetailsWindow').style.display = 'none';
        }


        // function wishlistJob(adId, userId) {
        //     // AJAX request for wishlisting the job
        //     console.log('Wishlist button clicked');


        //     console.log('Ad ID:', adId);
        //     console.log('User ID:', userId);

        //     var xhr = new XMLHttpRequest();
        //     xhr.open('POST', 'http://localhost/internease/public/student/wishlist', true);
        //     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        //     xhr.onreadystatechange = function () {
        //         if (xhr.readyState === 4) {
        //             if (xhr.status === 200) {
        //                 // Handle success
        //                 document.getElementById('wishlist').innerHTML = `<i style="fill: red;" class="fa-solid fa-heart"></i>`;
        //                 alert('Job Wishlisted');
        //             } else {
        //                 // Handle error
        //                 console.error('Error wishlisting the job:', xhr.status, xhr.statusText);
        //             }
        //         }
        //     };
        //     xhr.send('adId=' + adId + '&userId=' + userId);
        // }

        function applyToJob(adId, userId) {
            console.log('Apply button clicked');
            console.log('Ad ID:', adId);
            console.log('User ID:', userId);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '<?= ROOT ?>/student/apply', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        // Handle success
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            // Update the UI to reflect the apply status
                            var applyButton = document.getElementById('apply');
                            applyButton.style.background = 'violet';
                            applyButton.innerHTML = `Applied`;
                            alert('Applied to Job');
                        } else {
                            alert('Error: ' + response.message);
                        }
                    } else {
                        // Handle error
                        console.error('Error wishlisting the job:', xhr.status, xhr.statusText);
                    }
                }
            };
            xhr.send('adId=' + adId + '&userId=' + userId);
        }

        function wishlistJob(adId, userId) {
            console.log('Wishlist button clicked');
            console.log('Ad ID:', adId);
            console.log('User ID:', userId);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '<?= ROOT ?>/student/wishlist', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        // Handle success
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            // Update the UI to reflect the wishlist status
                            var wishlistButton = document.getElementById('wishlist');
                            wishlistButton.innerHTML = `<i style="fill: red;" class="fa-solid fa-heart"></i>`;
                            alert('Job Wishlisted');
                        } else {
                            alert('Error: ' + response.message);
                        }
                    } else {
                        // Handle error
                        console.error('Error wishlisting the job:', xhr.status, xhr.statusText);
                    }
                }
            };
            xhr.send('adId=' + adId + '&userId=' + userId);
        }


        function updateOptions(select) {
            var preferenceSelects = document.getElementsByClassName('preference');
            var selectedOptions = [];

            // Collect all selected options
            for (var i = 0; i < preferenceSelects.length; i++) {
                if (preferenceSelects[i].value !== '') {
                    selectedOptions.push(preferenceSelects[i].value);
                }
            }

            // Iterate through all select boxes
            for (var i = 0; i < preferenceSelects.length; i++) {
                var options = preferenceSelects[i].getElementsByTagName('option');
                // Reset all options to enabled
                for (var j = 0; j < options.length; j++) {
                    options[j].disabled = false;
                }
                // Disable selected options in other select boxes
                if (preferenceSelects[i] !== select) {
                    for (var j = 0; j < options.length; j++) {
                        if (selectedOptions.includes(options[j].value)) {
                            options[j].disabled = true;
                        }
                    }
                }
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
    const roundDates = <?php echo json_encode($roundData); ?>;
    const currentDate = new Date(); // Current date

    if (!Array.isArray(roundDates) || roundDates.length === 0) {
        console.error('No round dates found or invalid data format.');
        return;
    }

    let isActive = false;

    const roundIdMapping = {
        "firstround": 1,
        "secondround": 2
        // Add more mappings if needed
    };

    

    roundDates.forEach(function(round) {
        const roundStartDate = new Date(round.start_date);
        const roundEndDate = new Date(round.end_date);
        const roundElementId = Object.keys(roundIdMapping).find(key => roundIdMapping[key] === round.id);

        if (!roundElementId) {
            console.error('Invalid round ID:', round.id);
            return;
        }

        console.log(round.id);
    console.log(roundIdMapping[key]);   

        const roundElement = document.getElementById(roundElementId);

        if (currentDate >= roundStartDate && currentDate <= roundEndDate) {
            roundElement.classList.add('active');
            isActive = true;
        } else {
            roundElement.classList.remove('active');
        }

        console.log(roundStartDate); // Log start date for debugging
    });

    // Uncomment this section if you want to set a default active round
    // if (!isActive) {
    //     const firstRoundElementId = Object.keys(roundIdMapping)[0];
    //     const firstRoundElement = document.getElementById(firstRoundElementId);
    //     firstRoundElement.classList.add('active');
    // }
});






    </script>

<?php require_once("../app/view/inc/footer.php"); ?>