<?php require_once("../app/views/inc/header.php"); ?>

    <div class="container">
        <?php require_once("../app/views/inc/sidebar.php"); ?>

        <!-- main -->

        <div class="main">
            <?php require_once("../app/views/inc/topbar.php"); ?>
            <div class="content">
                <div class="heading" style="padding-top: 40px;">My Profile</div>
                <div class="profile-container">
                    <div class="display-info">
                    <div class="form-container">
        <form>
            <ul class="info-list">
                <li>
                    <label for="name">Your Name:</label>
                    <input type="text" name="name" id="name">
                </li>
                <li>
                    <label for="regno">Registration No:</label>
                    <input type="text" name="regno" id="regno">
                </li>
                <li>
                    <label for="email">Your Email:</label>
                    <input type="text" name="email" id="email">
                </li>
                <li>
                    <label for="status">Application Status:</label>
                    <input type="text" name="status" id="status">
                </li>
            </ul>
        </form>
    </div>

                    </div>
                    <button class="edit-button" onclick="editInfo()">Edit</button>
                </div>
                
            
            <div class="info-box comp">
                <div class="textbottom" style="flex-grow: 3;">Companies Applied</div>
                <div class="number" style="flex-grow: 1;">05</div>     
                <button class="button button-info" style="flex-grow: 1;" onclick="redirectPage('/companies.html')">View All</button>
            </div>
            <div class="info-box intv">
                <div class="textbottom" style="flex-grow: 3;">Interviews Scheduled</div>
                <div class="number" style="flex-grow: 1;">03</div> 
                <button class="button button-info" style="flex-grow: 1;" onclick="redirectPage('interview.html')">View All</button>
            </div>
            </div>

            <!-- charts -->
            <div class="metrics">
                <canvas id="engagementChart" class="customChart"></canvas>
                <canvas id="adsRespondedChart" class="customChart"></canvas>
                <canvas id="adTypesChart" class="customChart"></canvas>
            </div>
            <!-- end of charts -->
        </div>

        <!-- main -->
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data for engagement over time
        const engagementData = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Engagement',
                data: [50, 75, 60, 80, 55, 90],
                fill: false,
                borderColor: '#007bff',
                tension: 0.4
            }]
        };

        // Data for ads responded to
        const adsRespondedData = {
            labels: ['Ads 1', 'Ads 2', 'Ads 3', 'Ads 4', 'Ads 5'],
            datasets: [{
                label: 'Ads Responded To',
                data: [20, 35, 25, 40, 30],
                backgroundColor: '#007bff'
            }]
        };

// Creating line chart for engagement
const engagementChart = new Chart(document.getElementById('engagementChart').getContext('2d'), {
    type: 'line',
    data: engagementData,
    options: {
        responsive: false,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: 'top'
            },
            title: {
                display: true,
                text: 'Engagement Over Time',
                padding: 20
            }
        }
    }
});

// Creating bar chart for ads responded to
const adsRespondedChart = new Chart(document.getElementById('adsRespondedChart').getContext('2d'), {
    type: 'bar',
    data: adsRespondedData,
    options: {
        responsive: false,
        maintainAspectRatio: false,
        indexAxis: 'y',
        plugins: {
            legend: {
                display: true,
                position: 'top'
            },
            title: {
                display: true,
                text: 'Ads Responded To',
                padding: 20
            }
        }
    }
});
// Data for ad types distribution
const adTypesData = {
    labels: ['Type A', 'Type B', 'Type C', 'Type D'],
    datasets: [{
        data: [25, 30, 15, 10], // Sample data
        backgroundColor: ['#007bff', '#28a745', '#ff5722', '#ffc107'],
    }]
};

// Creating a doughnut chart for ad types distribution
const adTypesChart = new Chart(document.getElementById('adTypesChart').getContext('2d'), {
    type: 'doughnut',
    data: adTypesData,
    options: {
        responsive: false,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: 'bottom',
            },
            title: {
                display: true,
                text: 'Ad Types Distribution',
                padding: 20,
            },
        },
    },
});

    </script>

<?php require_once("../app/views/inc/footer.php"); ?>