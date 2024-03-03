<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <title>report</title>
     <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/admin/com.css?v=<?php echo time(); ?>">

    </head>
<body>

<div class="container">
        <?php include_once('../app/view/layout/Admin_sidemenu.php') ?>

    <div class="notification" >
        
        <div class="notibutton">
                    <div>Students selected for 1st Round</div>
                    <div><?php  $s =78; echo htmlspecialchars($s); ?>
                    <ion-icon  name="briefcase" size="medium"></ion-icon>
                    </div>
            </div>

            <div class="notibutton">
                    <div>Total Students </div>
                    <div><?php echo htmlspecialchars($total); ?>
                    <ion-icon  name="people-circle-outline" size="medium"></ion-icon>
                    </div>
            </div>

            <div class="notibutton">
                        <div>Black Listed Companies</div>
                        <div><?php echo htmlspecialchars($count); ?>
                        <ion-icon  name="ban-outline" size="medium"></ion-icon>
                        </div>

                </div>  


    </div>

    <div class="report">
            <div class='report_item'>
                <h2>Active advertisements</h2>

                <table>
                    <thead>
                        <tr>
                            <td>Company name</td>
                            <td>job position</td>
                            <td>no.of interns</td>
                        </tr>
                    </thead>
                    <tbody>
                    <tbody>
                    <?php if ($advertisments && count($advertisments) > 0): ?>
                    <?php foreach ($advertisments as $ad): ?>
                        <?php if ($ad['status'] == 1): ?> 
                            <?php
                            foreach ($companies as $company) {
                                $companyName = 'N/A';
                                if ($company['user_id'] == $ad['company_id']) {
                                    $ad['company_id'] = $company['company_name'];
                                    break;
                                }
                            }
                            ?>   
                            <tr>
                                <td><?php echo htmlspecialchars($ad['company_id']); ?></td>
                                <?php
                                switch ($ad['position']) {
                                    case 'qa':
                                        $ad['position'] = 'Quality Assurance';
                                        break;
                                    case 'ba':
                                        $ad['position'] = 'Business Analyst';
                                        break;
                                    default:
                                        $ad['position'] = 'N/a';
                                        break;
                                }
                                ?>
                                <td><?php echo htmlspecialchars($ad['position']); ?></td>
                                <td><?php echo htmlspecialchars($ad['no_of_intern']); ?></td>
                            </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>  
                    </tbody>
                </table>
            <div class="noticolumn">
                <div class="notibutton">
                    <a href="<?php echo ROOT; ?>/admin/ad_report?data=<?php echo urlencode(json_encode($advertisments)); ?>&companies=<?php echo urlencode(json_encode($companies)); ?>" target="_blank">
                            <div class="iconBx">
                                <ion-icon name="document-text" size="large"></ion-icon>
                                <div>Download advertisement Data</div>
                            </div>
                        </a>
                </div>
            </div>
            
        </div>
    </div>

    <div class="report">
        <div class='report_item'>      
            <h2>Company List</h2>

                <table>
                    <thead>
                        <tr>
                            <td>Company</td>
                            <td>Contact Name</td>
                            <td>Contact</td>
                            <td>email</td>
                        </tr>
                    </thead>

                    <tbody>
                    <?php if ($companies && count($companies)> 0): ?>
                        <?php foreach ($companies as $company): ?>

                            <tr>
                                <td><?php echo htmlspecialchars($company['company_name']);?></td>
                                <td><?php echo htmlspecialchars($company['contact_person']); ?></td>
                                <td><?php echo htmlspecialchars($company['contact_no']); ?></td>
                                <td><?php echo htmlspecialchars($company['Email']); ?></td>
                            </tr>

                        <?php endforeach; ?>
                    <?php endif; ?>   
                    </table>
                <div class="noticolumn">  
                    <div class="notibutton">
                        <a href="<?php echo ROOT; ?>/admin/reg_report?data=<?php echo urlencode(json_encode($companies)); ?>" target="_blank">
                            <div class="iconBx">
                                <ion-icon name="document-text" size="large"></ion-icon>
                                <div>Download company list</div>
                            </div>
                </div>  
            </div>
            </div>
        </div>
       
    <div  id="chart_bar" style="height: calc(<?php echo count($companies); ?> * 10vw);" ></div>  
    </div>


</div>
       
</body>

<script>
    

    google.charts.load('current', { packages: ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);

    function generateRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        // Set the first two digits to '00' for green and red channels to generate blue hues
        color += '00';
        // Generate random values for the blue channel
        for (var i = 0; i < 4; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    function drawChart() {
        var companies = <?php echo json_encode($companylist); ?>;
        var years = <?php echo json_encode($years); ?>;
        var internsByYear = <?php echo json_encode($internsByYear); ?>;

        console.log('Companies:', companies);
        console.log('Years:', years);
        console.log('Interns by Year:', internsByYear);

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Company');
        years.forEach(function(year) {
            data.addColumn('number', year.toString());
        });

        // Add data rows
        for (var i = 0; i < companies.length; i++) {
            var company = companies[i];
            var row = [company];
            years.forEach(function(year) {
                var count = internsByYear[company][year] ? internsByYear[company][year] : 0;
                row.push(count);
            });
            data.addRow(row);
        }

        var options = {
            title: 'Intern Recruitment Comparison',
            chartArea: { width: '60%' },
            hAxis: { title: 'Number of Interns' },
            vAxis: { title: 'Company' },
            colors: Array.from({ length: years.length }, generateRandomColor) // Generate random colors
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_bar'));
        chart.draw(data, options);
    }
</script>


</html>
