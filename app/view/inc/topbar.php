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
?>

<header class="top-bar">
    <button id="menu"><i class="fa-solid fa-xmark"></i></button>
    <div class="title"><?= $pageTitle ?></div>
    <div class="grid-container">
        <div class="grid-items">
            <div class="user-profile">
                <div class="username">Shamah</div>
                <a href="profile.html"><img class="avatar" src="<?=ROOT?>/assets/images/Sham.jpg" alt="User Avatar"></a>
            </div>
            <!-- notification-->
            <div class="notification">
                <span class="notify"><i class="fa fa-bell" aria-hidden="true"></i></span>
            </div>
            <a href="logout" class="logout">
                <span class="notify"><i class="fa fa-sign-out" aria-hidden="true"></i></span>
            </a>
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
    
    // Function to display notifications dynamically
    
</script>