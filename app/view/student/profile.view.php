<?php require_once("../app/view/inc/header.php"); ?>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/profile.css">

<div class="container">
    <?php require_once("../app/view/inc/sidebar.php"); ?>

    <div class="main">
        <?php require_once("../app/view/inc/topbar.php"); ?>

        <div class="profile-container">
            <h2>Student Profile</h2>
            <div class="profile-card">
                <?php
                $studentData = $this->fetchStudentProfile();
                if ($studentData) {
                    echo "<div class='profile-details'>";
                    echo "<img src='" . ROOT . "/assets/images/Sham.jpg' alt='Profile Picture'>";
                    echo "<p><strong>First Name:</strong> " . $studentData['first_name'] . "</p>";
                    echo "<p><strong>Last Name:</strong> " . $studentData['last_name'] . "</p>";
                    echo "<p><strong>Email:</strong> " . $studentData['email'] . "</p>";
                    echo "<p><strong>Index No:</strong> " . $studentData['index_no'] . "</p>";
                    echo "<p><strong>Registration No:</strong> " . $studentData['reg_no'] . "</p>";
                    // echo "<p><strong>Qualification:</strong> " . $studentData['qualification'] . "</p>";
                    if ($studentData['cv']) {
                        echo "<p><strong>CV:</strong> <a href='" . ROOT . "/uploads/" . $studentData['cv'] . "' target='_blank'>View CV</a></p>";
                    }
                    echo "</div>";
                    echo "<button class='edit-btn' onclick='openEditModal()'>Edit Profile</button>";
                } else {
                    echo "<p>Student profile not found.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h2>Edit Profile</h2>
        <form action="<?=ROOT?>/student/updateProfile" method="post" enctype="multipart/form-data">
            <label for="firstName">First Name</label>
            <input type="text" id="firstName" name="firstName" value="<?= $studentData['first_name'] ?>">
            <label for="lastName">Last Name</label>
            <input type="text" id="lastName" name="lastName" value="<?= $studentData['last_name'] ?>">
            <label for="cv">Upload CV</label>
            <input type="file" id="cv" name="cv">
            <!-- <label for="qualification">Qualification</label>
            <select name="qualification" id="qualification">
                <option value="" selected hidden>Select Position</option>
                <option value="BSc. in Information Systems">BSc. in Information Systems</option>
                <option value="BSc.(Hons) in Information Systems">BSc.(Hons) in Information Systems</option>
                <option value="BSc. in Computer Science">BSc. in Computer Science</option>
                <option value="BSc.(Hons) in Computer Science">BSc.(Hons) in Computer Science</option>
            </select>
            <br>
            <hr> -->
            <button type="submit" name="submit">Save Changes</button>
        </form>

    </div>
</div>

<script>
    function openEditModal() {
        document.getElementById("editModal").style.display = "block";
    }

    function closeEditModal() {
        document.getElementById("editModal").style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == document.getElementById("editModal")) {
            closeEditModal();
        }
    }

    // Handle form submission
    document.getElementById("editForm").addEventListener("submit", function(event) {
        event.preventDefault();
        var formData = new FormData(event.target);
        formData.append("userId", <?= $studentData['user_id'] ?>);
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "<?= ROOT ?>/student/updateProfile", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                console.log(xhr.responseText);
                // Handle successful response
                closeEditModal();
                // Optionally, you can refresh the page or update the UI with the new data
            }
        };
        xhr.send(formData);
    });
</script>

<?php require_once("../app/view/inc/footer.php"); ?>
