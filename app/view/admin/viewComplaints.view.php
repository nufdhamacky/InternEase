<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints</title>
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/admin/com.css?v=<?php echo time(); ?>">
    <?php
    function compareComplaints($a, $b) {
        if ($a['status'] == $b['status']) {
            return 0;
        }
        return ($a['status'] < $b['status']) ? -1 : 1;
    }

    usort($complaintsArray, 'compareComplaints');
    ?>
</head>
<body>

<div class="container">
    <?php include_once('../app/view/layout/Admin_sidemenu.php') ?>
    <div class="report_item" style="width:fit-content;">
        <h2>Complaints</h2>

        <!-- Filter Menu -->
        <div class="filter-menu">
            <label for="date-filter">Sort by Date:</label>
            <select id="date-filter">
                <option value="oldest">Oldest</option>
                <option value="latest">Latest</option>
            </select>

            <label for="user-type-filter">Filter by User Type:</label>
            <select id="user-type-filter">
                <option value="all">All Users</option>
                <option value="student">Student</option>
                <option value="company">Company</option>
            </select>

            <label for="status-filter">Filter by Status:</label>
            <select id="status-filter">
                <option value="all">All</option>
                <option value="resolved">Resolved</option>
                <option value="unresolved">Un-resolved</option>
            </select>
        </div>          

        <div class="filter-menu">
        <label for="complaint-id-search">Search by Complaint ID:</label>
            <input type="text" id="complaint-id-search">
            <button class="search-btn" id="search-button">Search</button>
        </div>

        <table id="complaints-table">
            <thead>
                <tr>
                    <td>Complaint ID</td>
                    <td>Title</td>
                    <td>User</td>
                    <td>Date</td>
                    <td>Description</td>
                    <td>Review-status</td>
                </tr>
            </thead>
            <tbody>
                <?php if ($complaintsArray && count($complaintsArray) > 0): ?>
                    <?php foreach ($complaintsArray as $complaint): ?>
                        <tr data-user-type="<?php echo htmlspecialchars($complaint['user_type']); ?>">
                            <td><?php echo htmlspecialchars($complaint['complaint_id']); ?></td>
                            <td><?php echo htmlspecialchars($complaint['title']); ?></td>
                            <?php 
                                if($complaint['student_id'] == NULL){
                                    $id= $complaint['company_id'];
                                } else {
                                    $id=$complaint['student_id'];
                                }
                            ?>
                            <td><?php echo htmlspecialchars($complaint['user_type']); ?></td>
                            <td><?php echo htmlspecialchars($complaint['date']); ?></td>
                            <td><a href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/admin/description/<?php echo $complaint['complaint_id']; ?>" target="_blank"><button class="btn">View</button></a></td>
                            <td>
                                <?php if ($complaint['status'] == 0): ?>
                                    <span style="color:red;font-weight: bold;">Un-resolved</span>
                                <?php else: ?>
                                    <span style="color:light blue;font-weight: bold;">Resolved</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>   
            </tbody>
        </table>
    </div>
</div>
    
</body>
<script>

document.addEventListener('DOMContentLoaded', function() {
    // Get the filter dropdowns
    var dateFilter = document.getElementById('date-filter');
    var userTypeFilter = document.getElementById('user-type-filter');
    var statusFilter = document.getElementById('status-filter'); // Get the status filter dropdown
    var complaintsTable = document.getElementById('complaints-table');
    
    // Add event listener to sort and filter complaints on change
    dateFilter.addEventListener('change', sortAndFilterComplaints);
    userTypeFilter.addEventListener('change', sortAndFilterComplaints);
    statusFilter.addEventListener('change', sortAndFilterComplaints); // Listen for changes on the new status filter

    function sortAndFilterComplaints() {
        var sortOrder = dateFilter.value;
        var selectedUserType = userTypeFilter.value;
        var selectedStatus = statusFilter.value; // Get the selected status

        // Get the rows of the table
        var rows = Array.from(complaintsTable.querySelectorAll('tbody tr'));

        // Filter rows based on user type and status
        rows.forEach(function(row) {
            var userType = row.getAttribute('data-user-type');
            var status = row.cells[5].textContent.trim(); // No need to convert to lower case
            
            // Determine if the row should be displayed
            var display = true;
            if (selectedUserType !== 'all' && userType !== selectedUserType) {
                display = false;
            }
            // Update the status check to match the hyphenated 'Un-resolved' text
            if (selectedStatus !== 'all') {
                if (selectedStatus === 'resolved' && status !== 'Resolved') {
                    display = false;
                } else if (selectedStatus === 'unresolved' && status !== 'Un-resolved') {
                    display = false;
                }
            }
            row.style.display = display ? '' : 'none';
        });


        // Sort rows based on date
        rows.sort(function(a, b) {
            var dateA = new Date(a.cells[3].textContent);
            var dateB = new Date(b.cells[3].textContent);

            return sortOrder === 'oldest' ? dateA - dateB : dateB - dateA;
        });

        // Append rows back to the table in the new order
        var tbody = complaintsTable.querySelector('tbody');
        tbody.innerHTML = ''; // Clear existing rows
        rows.forEach(row => tbody.appendChild(row));
    }
});


document.addEventListener('DOMContentLoaded', function() {
        // Get the filter dropdowns
        var searchButton = document.getElementById('search-button');
        var searchInput = document.getElementById('complaint-id-search');

        // Add event listeners to handle filtering
        searchButton.addEventListener('click', searchComplaints);


        // Function to search complaints by complaint ID
        function searchComplaints() {
            var searchTerm = searchInput.value.trim().toLowerCase();

            // Get all complaint rows
            var complaintRows = document.querySelectorAll('#complaints-table tbody tr');

            // Loop through each row and search for the complaint ID
            complaintRows.forEach(function(row) {
                var complaintId = row.cells[0].textContent.trim().toLowerCase();
                row.style.display = complaintId.includes(searchTerm) ? '' : 'none';
            });
        }
});


</script>

</html>
