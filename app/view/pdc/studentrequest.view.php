<?php
include_once('../app/controller/pdc.php');
$pdcController = new Pdc();
if (isset($_GET["status-filter"]) && $_GET["status-filter"] != "all") {
    $studentRequests = $pdcController->filterStudentRequest($_GET["status-filter"], $_GET["sort"]);
} else {
    $studentRequests = $pdcController->getStudentRequest(isset($_GET["sort"]) ? $_GET["sort"] : "asc");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Request</title>
    <link rel="stylesheet" type="text/css" href="<?= ROOT ?>/css/pdc/studentreq.css">
</head>
<body>
<div class="container">
    

    <div class="report_item" style="width:fit-content;">
        <h2>Complaints</h2>


        <div class="filter-menu">
            <label for="complaint-id-search">Search by Complaint ID:</label>
            <input type="text" id="complaint-id-search">
            <button class="search-btn" id="search-button">Search</button>
        </div>
        <form action="" method="GET" class="filter-form">
            <div class="filter-menu">
                <label for="date-filter">Sort by Date:</label>
                <select id="date-filter" name="sort">
                    <option value="asc" <?php echo isset($_GET["sort"]) ? $_GET["sort"] == "asc" ? "selected" : "" : ""; ?>>
                        Oldest
                    </option>
                    <option value="desc" <?php echo isset($_GET["sort"]) ? $_GET["sort"] == "desc" ? "selected" : "" : ""; ?>>
                        Latest
                    </option>
                </select>

            </div>
            <div class="filter-menu">
                <label for="status-filter">Sort By Status:</label>
                <select name="status-filter" id="status-filter">
                    <option value="all">All</option>
                    <option value="resolved" <?php echo isset($_GET["status-filter"]) ? $_GET["status-filter"] == "resolved" ? "selected" : "" : ""; ?>>
                        resolved
                    </option>
                    <option value="unresolved" <?php echo isset($_GET["status-filter"]) ? $_GET["status-filter"] == "unresolved" ? "selected" : "" : ""; ?>>
                        unresolved
                    </option>
                </select>
                <button type="submit" class="btn">Filter</button>
            </div>
        </form>
        <table id="complaints-table">
            <thead>
            <tr>
                <td>Complaint ID</td>
                <td>Title</td>
                <td>Date</td>
                <td>Description</td>
                <td>Review-status</td>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($studentRequests as $request) { ?>
                <tr data-status="<?php echo $request->status; ?>">
                    <td><?php echo $request->id; ?></td>
                    <td><?php echo $request->title; ?></td>
                    <td><?php echo $request->date; ?></td>
                    <td>
                        <a href="complaintdes?id=<?php echo $request->id; ?>">view</a>
                    </td>
                    <td style="color: <?php echo $request->status == 0 ? "blue" : ($request->status == 1 ? "green" : "red"); ?>"><?php echo $request->status == 0 ? "Unresolved" : "Resolved"; ?></td>

                </tr>
            <?php } ?>
            </tbody>
        </table>

    </div>


</div>

</body>
<script>

    document.addEventListener('DOMContentLoaded', function () {
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
            rows.forEach(function (row) {
                var userType = row.getAttribute('data-user-type');
                var status = row.getAttribute('data-status');

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
            rows.sort(function (a, b) {
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


    document.addEventListener('DOMContentLoaded', function () {
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
            complaintRows.forEach(function (row) {
                var complaintId = row.cells[0].textContent.trim().toLowerCase();
                row.style.display = complaintId.includes(searchTerm) ? '' : 'none';
            });
        }
    });


</script>
</html>