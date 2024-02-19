
<div class="navigation">
    <img src = "<?=ROOT?>/assets/images/logo.png" alt="">
    <ul>
    <li>
        <li> 
            <a href="<?=ROOT?>/admin/managepdc">
                <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
                <span class="title">Manage PDC</span>
            </a>
        </li>
        <li>
            <a href="<?=ROOT?>/admin/report">
                <span class="icon"><ion-icon name="bag-remove-outline"></ion-icon></span>
                <span class="title">Reports</span>
            </a>
        </li>
        <li>
            <a href="<?=ROOT?>/admin/Complaints">
                <span class="icon"><ion-icon name="calendar-clear-outline"></ion-icon></span>
                <span class="title">Complaints</span>
            </a>
        </li>
        <li>
            <a href="<?=ROOT?>/admin/profile">
                <span class="icon"><ion-icon name="swap-horizontal-outline"></ion-icon></span>
                <span class="title">Profile</span>
            </a>
        </li>
        <li>
            <a href="<?=ROOT?>/admin/logout">
                <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                <span class="title">Sign Out </span>
            </a>
        </li>
    </ul>
</div>

<div class ="main">
            <div class = "topbar">
                <div class = "toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class = "user">
                    <ion-icon name="notifications-circle-outline"></ion-icon>
                    <span><?php echo isset($_SESSION['userName']) ? $_SESSION['userName'] : 'Guest'; ?></span>
                    <ion-icon name="person-circle-outline"></ion-icon>
                    
                </div>

            </div>
            
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>