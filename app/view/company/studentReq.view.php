<?php
$ads = $data['ads'];
$students = $data['students'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Requests</title>
    <link rel="stylesheet" type="text/css" href="<?= ROOT ?>/css/company/companyStudentReq.css">
</head>
<body>

<div class="container">
    <?php require_once('../app/view/layout/companyMenubar.php'); ?>
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
            <div class="user">
                <span><?= $_SESSION['companyName'] ?></span>
                <ion-icon class="profile-icon" name="person-circle-outline"></ion-icon>
            </div>
        </div>

        <div class="secondbar">
            <form action="" method="GET" class="allstudents">
                <div>
                    <select name="ad_id" id="ads">
                        <option value="all" <?= (!isset($_GET['ad_id']) || $_GET['ad_id'] === 'all') ? 'selected' : ''; ?>>
                            All
                        </option>
                        <?php foreach ($ads as $ad): ?>
                            <option value="<?= htmlspecialchars($ad['ad_id']) ?>"
                                <?= (isset($_GET['ad_id']) && $_GET['ad_id'] === $ad['ad_id']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($ad['position']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn">
                        <ion-icon name="search-outline"></ion-icon>
                    </button>
                </div>
            </form>
        </div>

        <div id="seTable" class="details">
            <div class="studentdetails">
                <div class="cardHeader">
                    <h2>Student Applications</h2>
                </div>

                <table>
                    <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Registration No.</th>
                        <th>Position</th>
                        <th>CV</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php if ($students): ?>
                        <?php foreach ($students as $student): ?>
                            <tr>
                                <td><?= htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) ?></td>
                                <td><?= htmlspecialchars($student['reg_no']) ?></td>
                                <td><?= htmlspecialchars($student['position']) ?></td>
                                <td>
                                    <a href="<?= htmlspecialchars($student['cv']) ?>" download class="download-cv-btn">Download
                                        CV</a>
                                </td>
                                <td>
                                    <select class="status-select"
                                            data-student-id="<?= htmlspecialchars($student['id']) ?>">
                                        <option value="pending" <?= ($student['status'] == 0) ? 'selected' : '' ?>>
                                            Pending
                                        </option>
                                        <option value="shortlist" <?= ($student['status'] == 1) ? 'selected' : '' ?>>
                                            Shortlist
                                        </option>
                                        <option value="reject" <?= ($student['status'] == 2) ? 'selected' : '' ?>>
                                            Reject
                                        </option>
                                    </select>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="5">No student applications found.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<script>
    document.querySelectorAll('.status-select').forEach(select => {
        select.addEventListener('change', (event) => {
            const studentId = event.target.getAttribute('data-student-id');
            const selectedValue = event.target.value;

            if (selectedValue) {
                // Define the URL to which you're sending the request (this might be a controller endpoint)
                const url = '/InternEase/public/company/updateStatus'; // Adjust this URL to your endpoint

                // Send the AJAX request using the fetch API
                fetch(url, {
                    method: 'POST', // Use POST method for modifying data
                    headers: {
                        'Content-Type': 'application/json', // JSON content type
                        'X-Requested-With': 'XMLHttpRequest', // Indicate it's an AJAX request
                    },
                    body: JSON.stringify({
                        applied_id: studentId,
                        status: selectedValue, // Map the action to the correct status code
                    }),
                })
                    .then(response => {
                        if (response.ok) {
                            console.log('Status updated successfully.');
                        } else {
                            console.error('Error updating status.');
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
            }
        });
    });
</script>

</body>
</html>
