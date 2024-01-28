const inputFile = document.getElementById('input-file');

const profilePicture = document.querySelector('.profile-pic img');

inputFile.addEventListener('change', function() {
    // Check if any file is selected
    if (this.files && this.files[0]) {
        // Create a FileReader object
        const reader = new FileReader();

        // Set up the FileReader onload event
        reader.onload = function(e) {
            // Set the src attribute of the profile picture to the uploaded image data
            profilePicture.src = e.target.result;
        };

        // Read the uploaded file as a data URL
        reader.readAsDataURL(this.files[0]);
    }
});
