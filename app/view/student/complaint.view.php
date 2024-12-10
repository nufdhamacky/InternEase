<?php require_once("../app/view/inc/header.php"); ?>
<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Optional: Display startup errors
ini_set('display_startup_errors', 1);
?>


<div class="container">
    <?php require_once("../app/view/inc/sidebar.php"); ?>

    <div class="main">
    <?php require_once("../app/view/inc/topbar.php"); ?>

    
    <div class="complaint-container">
        <h2>Internship Complaint Form</h2>
        <?php if (isset($error_message)): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <?php if (isset($success_message)): ?>
            <p class="success-message"><?php echo $success_message; ?></p>
        <?php endif; ?>
        <form method="post" action="<?=ROOT?>/student/registercomplaint" id="complaint-form">
            <div class="form-group">
                <label for="student_name">Student Name:</label>
                <input type="text" id="student_name" name="student_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="student_email">Student Email:</label>
                <input type="email" id="student_email" name="student_email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="complaint">Complaint:</label>
                <textarea id="complaint" name="description" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Complaint</button>
        </form>
    </div>
</div>
</div>
<?php require_once("../app/view/inc/footer.php"); ?>
<script src="<?=ROOT?>/public/js/complaint.js"></script>

<?php require_once("../app/view/inc/footer.php"); ?>