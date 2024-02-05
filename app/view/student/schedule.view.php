<?php require_once("../app/views/inc/header.php"); ?>

<div class="container">
        <?php require_once("../app/views/inc/sidebar.php"); ?>

        <!-- main -->

        <div class="main">
            <?php require_once("../app/views/inc/topbar.php"); ?>
            <?php
// Sample schedule data (replace with your actual data)
$scheduleData = [
    [
        'company_name' => 'Company A',
        'topic' => 'Topic 1',
        'date' => '2023-11-10',
        'venue' => 'Venue A',
        'time' => '10:00 AM',
    ],
    [
        'company_name' => 'Company B',
        'topic' => 'Topic 2',
        'date' => '2023-11-12',
        'venue' => 'Venue B',
        'time' => '2:30 PM',
    ],
];

// Generate the table structure using PHP
echo '<div class="schedule-container">
        <table id="scheduleTable" class="scheduleTable">
            <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Topic</th>
                    <th>Date</th>
                    <th>Venue</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody id="scheduleData" class="scheduleData">';

foreach ($scheduleData as $entry) {
    echo '<tr>';
    echo '<td>' . $entry['company_name'] . '</td>';
    echo '<td>' . $entry['topic'] . '</td>';
    echo '<td>' . $entry['date'] . '</td>';
    echo '<td>' . $entry['venue'] . '</td>';
    echo '<td>' . $entry['time'] . '</td>';
    echo '</tr>';
}

echo '</tbody>
        </table>
    </div>';
?>
  
                  

    

    </div>
</div>

<?php require_once("../app/views/inc/footer.php"); ?>