<?php session_start(); ?>
<div class="navigation">
    <img src = "../views/admin/images/InternEaseLogo.png" alt="">
    <ul>
    <li>
        <li>
            <a href="managepdc.php">
                <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
                <span class="title">Manage PDC</span>
            </a>
        </li>
        <li>
            <a href="admin_dashboard.php">
                <span class="icon"><ion-icon name="bag-remove-outline"></ion-icon></span>
                <span class="title">Reports</span>
            </a>
        </li>
        <li>
            <a href="viewComplaints.php">
                <span class="icon"><ion-icon name="calendar-clear-outline"></ion-icon></span>
                <span class="title">Complaints</span>
            </a>
        </li>
        <li>
            <a href="profile.php">
                <span class="icon"><ion-icon name="swap-horizontal-outline"></ion-icon></span>
                <span class="title">Profile</span>
            </a>
        </li>
        <li>
            <a href="../PDC/signout.php">
                <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                <span class="title">Sign Out </span>
            </a>
        </li>
    </ul>
</div>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>