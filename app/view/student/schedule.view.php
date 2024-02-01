<?php require_once("../app/view/inc/header.php"); ?>


<div class="container">
    <?php require_once("../app/view/inc/sidebar.php"); ?>

    <!-- main -->

    <div class="main">
        <?php require_once("../app/view/inc/topbar.php"); ?>
        <div class="content">
            <div class="calendar">
                <?php
                    // Get the current month and year
                    $month = date('n');
                    $year = date('Y');

                    // Get the first day of the month
                    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

                    // Get the number of days in the month
                    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

                    // Get the day of the week for the first day of the month
                    $dayOfWeek = date('w', $firstDayOfMonth);

                    // Display the calendar table
                    echo '<table>';
                    echo '<tr><th colspan="7">' . date('F Y', $firstDayOfMonth) . '</th></tr>';
                    echo '<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>';
                    echo '<tr>';

                    // Add empty cells for days before the first day of the month
                    for ($i = 0; $i < $dayOfWeek; $i++) {
                        echo '<td></td>';
                    }

                    // Add days of the month
                    for ($day = 1; $day <= $daysInMonth; $day++) {
                        echo '<td>' . $day . '</td>';

                        // Start a new row after each Saturday
                        if (($day + $dayOfWeek) % 7 == 0) {
                            echo '</tr><tr>';
                        }
                    }

                    // Add empty cells for remaining days in the last row
                    $remainingDays = 7 - (($daysInMonth + $dayOfWeek) % 7);
                    for ($i = 0; $i < $remainingDays; $i++) {
                        echo '<td></td>';
                    }

                    echo '</tr>';
                    echo '</table>';
                ?>
            </div>
        </div>
    </div>
</div>

<?php require_once("../app/view/inc/footer.php"); ?>