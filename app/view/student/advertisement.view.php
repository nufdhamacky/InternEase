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
                
            </div>
            <div class="ad-details" id="adDetailsWindow">
                <div class="ad-content">
                    <!-- js handling -->
                </div>
            </div>            
        </div>
    </div>


    <div id="preferencesModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Job Role Preferences</h2>
            <form id="preferencesForm">
                <?php
                    // Assume $jobRoles is an array of available IT internship roles
                    $jobRoles = ["Web Developer", "Data Analyst", "Software Engineer", "Network Administrator", "UI/UX Designer", "DevOps Engineer", "Cybersecurity Analyst"];
                    
                    for ($i = 1; $i <= 7; $i++) {
                        echo "<label for='preference$i'>Preference $i:</label>";
                        echo "<select name='preference$i' id='preference$i'>";
                        
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
           
            var adData = <?php echo json_encode($data['data']); ?>;

            var adDetailsWindow = document.getElementById('adDetailsWindow');
            var adContent = document.querySelector('.ad-details .ad-content');

            // Assuming your data structure includes additional details like 'position', 'modeOfWork', 'internshipPeriod', 'requirements'
            var ad = adData[index];
            console.log(ad);

            adContent.innerHTML = `
                <span class="close" onclick="closeAdDetails()">&times;</span>
                <h2>${ad.company_name}</h2>
                <p><strong>Job Position:</strong> ${ad.position}</p>
                <p><strong>Mode of Work:</strong> ${ad.modeOfWork}</p>
                <p></strong>Location:</strong> ${ad.location}</p>
                <p style="color:red;"><strong>Application Deadline:</strong> ${ad.deadline}</p>
                <p><strong>Requirements:</strong> ${ad.requirements}</p>
                <button onclick="applyToJob(${ad.id}, ${userId})">Apply</button>
                <button id="wishlist" onclick="wishlistJob(${ad.id}, ${userId})"><i class="fa-regular fa-heart"></i></button>
            `;

            adDetailsWindow.style.display = 'block';
        }

        function closeAdDetails() {
            document.getElementById('adDetailsWindow').style.display = 'none';
        }

        // Function to handle applying to the job
        function applyToJob(adId, userId) {

            console.log('Ad ID:', adId);
            console.log('User ID:', userId);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '<?=ROOT?>/student/apply', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        // Handle success
                        document.getElementById('wishlist').innerHTML = `<i style="fill: red;" class="fa-solid fa-heart"></i>`;
                        alert('Job Wishlisted');
                    } else {
                        // Handle error
                        console.error('Error wishlisting the job:', xhr.status, xhr.statusText);
                    }
                }
            };
            xhr.send('adId=' + adId + '&userId=' + userId);
            

            alert('You have applied to this job!');
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

        function wishlistJob(adId, userId) {
            console.log('Wishlist button clicked');
            console.log(adId);
            console.log(userId);

            // Create a form element
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = '<?=ROOT?>/student/wishlist'; // Change the action to your wishlist.php script

            // Create hidden input fields for adId and userId
            var adIdInput = document.createElement('input');
            adIdInput.type = 'hidden';
            adIdInput.name = 'adId';
            adIdInput.value = adId;

            var userIdInput = document.createElement('input');
            userIdInput.type = 'hidden';
            userIdInput.name = 'userId';
            userIdInput.value = userId;

            // Append the input fields to the form
            form.appendChild(adIdInput);
            form.appendChild(userIdInput);

            // Append the form to the document body and submit it
            document.body.appendChild(form);
            form.submit();

            // Remove the form from the document body
            document.body.removeChild(form);
        }



    </script>

<?php require_once("../app/view/inc/footer.php"); ?>