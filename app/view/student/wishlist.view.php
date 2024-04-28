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
    var adData = <?php echo json_encode($ads); ?>;
    var adDetailsWindow = document.getElementById('adDetailsWindow');
    var adContent = document.querySelector('.ad-details .ad-content');

    var ad = adData[index];
    console.log(ad);

    // Make an asynchronous request to check if the student has already applied
    fetch(`hasApplied?adId=${ad.ad_id}`)
        .then(response => response.json())
        .then(data => {
            var hasApplied = data.hasApplied; // Assuming the response contains a boolean indicating whether the student has applied

            console.log(hasApplied);

            // Update UI accordingly
            var applyButtonHtml = hasApplied ? "Applied" : "Apply";
            var applyButtonOnClick = hasApplied ? "" : `onclick="applyToJob(${ad.ad_id}, ${userId})"`;
            var applyButtonBackground = hasApplied ? "violet" : "";

            var applyButton = `
                <button id="apply" style="background: ${applyButtonBackground}" ${applyButtonOnClick}>
                    ${applyButtonHtml}
                </button>
            `;

            var wishlistButtonHtml = '<button id="removeFromWishlist" onclick="removeFromWishlist(' + ad.ad_id + ')">Remove from Wishlist</button>';

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
                ${wishlistButtonHtml}
            `;

            adDetailsWindow.style.display = 'block';
        })
        .catch(error => {
            console.error('Error checking application status:', error);
        });
}


    function deleteFromWishlist(adId) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'deleteFromWishlistController.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle response here if needed
            console.log(xhr.responseText);
        }
    };
    xhr.send('adId=' + adId);
}

</script>
<?php require_once("../app/view/inc/footer.php"); ?>