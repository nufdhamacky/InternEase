<?php require_once("../app/views/inc/header.php"); ?>

<div class="container">
        <?php require_once("../app/views/inc/sidebar.php"); ?>
    
        <div class="main">
            <?php require_once("../app/views/inc/topbar.php"); ?>
            <div class="complaint-container">
                <div class="complaint-form">
                    <h2>Enter Your Complaint</h2>
                    <form id="complaintForm">
                        <textarea id="complaintText" placeholder="Type your complaint"></textarea>
                        <button type="button" onclick="submitComplaint()">Submit</button>
                    </form>
                </div>
            
                <div class="previous-complaints">
                    <h2>Previous Complaints</h2>
                    <div class="complaint-list" id="complaintList">
                        <!-- Complaints will be dynamically populated here -->
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <script>
        // Function to submit a complaint
        function submitComplaint() {
            var complaintText = document.getElementById('complaintText').value;
            if (complaintText.trim() !== '') {
                // Create a new complaint item
                var complaintList = document.getElementById('complaintList');
                var complaintItem = document.createElement('div');
                complaintItem.className = 'complaint-item';
                complaintItem.innerText = complaintText;
                complaintList.appendChild(complaintItem);

                // Clear the textarea after submitting
                document.getElementById('complaintText').value = '';
            } else {
                alert('Please enter a complaint before submitting.');
            }
        }

    </script>
    
<?php require_once("../app/views/inc/footer.php"); ?>