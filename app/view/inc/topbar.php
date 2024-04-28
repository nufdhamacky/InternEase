<?php
// Get the current URL
$currentURL = strtok($_SERVER['REQUEST_URI'], '?');

// Explode the URL by '/' to get an array of URL segments
$urlSegments = explode('/', $currentURL);

// Extract the last segment of the URL which might represent the current page
$page = end($urlSegments);

// Remove file extension (if present) from the page name
$page = pathinfo($page, PATHINFO_FILENAME);

// Convert underscores to spaces and capitalize the first letter of each word
$pageTitle = ucwords(str_replace("_", " ", $page));

// Set a default title for the home page
if ($pageTitle === '') {
    $pageTitle = 'Home';
}

$notifmodel = $this->model('Notification');
$notifications = $notifmodel->fetchNotifs($_SESSION['userId']);

$studentModel = $this->model('StudentModel');
$student = $studentModel->getStudentByUserId($_SESSION['userId']);
?>

<header class="top-bar">
    <button id="menu"><i class="fa-solid fa-xmark"></i></button>
    <div class="title"><?= $pageTitle ?></div>
    <div class="grid-container">
        <div class="grid-items">
            <div class="user-profile">
                <div class="username"><?= $student["first_name"]; ?></div>
                <a href="<?=ROOT?>/student/profile"><img class="avatar" src="<?=ROOT?>/assets/images/Sham.jpg" alt="User Avatar"></a>
            </div>
            <!-- notification-->
            <div class="notification">
                <span class="notify"><i class="fa fa-bell" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
</header>

<div class="notifications-container">
    <?php
    // Assuming $notifications is an array containing notification data
    if (isset($notifications) && is_array($notifications)) {
        foreach ($notifications as $notification) {
            echo '<div class="notification">';
            echo '<p class="message">' . $notification['message'] . '</p>';
            echo '<p class="created-at">' . $notification['created_at'] . '</p>';
            echo '</div>';
        }
    }
    ?>
</div>

<script>
    // Function to display notifications when the bell icon is clicked
    document.addEventListener("DOMContentLoaded", function () {
        var notificationIcon = document.querySelector('.notify');
        var notificationsContainer = document.querySelector('.notifications-container');

        // Toggle the visibility of the notifications container when the notification icon is clicked
        notificationIcon.addEventListener('click', () => {
            notificationsContainer.style.display = notificationsContainer.style.display === 'block' ? 'none' : 'block';
        });
    });

    // Function to fetch notifications from the server
    function displayNotifications() {
        // Make an AJAX request to fetch notifications from the server
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '<?= ROOT ?>/student/notification', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Parse the JSON response
                var notifications = JSON.parse(xhr.responseText);

                // Clear existing notifications
                var notificationsContainer = document.querySelector('.notifications-container');
                notificationsContainer.innerHTML = '';

                // Display new notifications
                notifications.forEach(function(notification) {
                    var notificationElement = document.createElement('div');
                    notificationElement.classList.add('notification');
                    notificationElement.innerHTML = '<p class="message">' + notification.message + '</p>' +
                        '<p class="created-at">' + notification.created_at + '</p>';
                    notificationsContainer.appendChild(notificationElement);
                });
            }
        };
        xhr.send();
    }

    // Call the function initially to display notifications on page load
    displayNotifications();

    // Optionally, you can refresh notifications at a specific interval
    setInterval(displayNotifications, 60000); 
</script>
