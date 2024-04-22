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
        <?php include_once('../app/view/layout/Admin_sidemenu.php') ;$s =3;?>

    <div class="notification" >
        
            <div class="notibutton">
                    <div> 1st Round Selections (total applied:<?php   echo htmlspecialchars($first_round_data['applied']);?>) </div>
                    <div>IS : <?php   echo htmlspecialchars($first_round_data['total_1st_is']);?> , CS : <?php   echo htmlspecialchars($first_round_data['total_1st_cs']);?>  
                    <ion-icon  name="briefcase" size="medium"></ion-icon></div>
            </div>

            
            <div class="notibutton">
                    <div> 2nd Round Selections (total applied:<?php   echo htmlspecialchars($second_round_data['applied_2nd']);?>) </div>
                    <div>IS : <?php   echo htmlspecialchars($second_round_data['total_2nd_is']);?> , CS : <?php   echo htmlspecialchars($second_round_data['total_2nd_cs']);?>  
                    <ion-icon  name="briefcase" size="medium"></ion-icon></div>
            </div>

            <div class="notibutton">
                    <div>Total Students:<?php echo htmlspecialchars($students['IS']+$students['CS']); ?></div>
                    <div>IS: <?php echo htmlspecialchars($students['IS']); ?> CS: <?php echo htmlspecialchars($students['CS']); ?></div>
            </div>

            <div class="notibutton tooltip">
                        <div>Black Listed Companies</div>
                        <div><?php echo htmlspecialchars($BL['count']); ?>
                        <ion-icon  name="ban-outline" size="medium"></ion-icon>                          
                            <span class="tooltiptext">
                            <?php
                            foreach ($BL['blacklistedCompanies'] as $bcompany) {
                                echo htmlspecialchars($bcompany);
                                echo "<br>";
                            }
                            ?> 
                             </span>
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
                        </a>
                </div>  
            </div>
            </div>
        </div>
       
        <div  id="chart_bar" style="height: calc(<?php echo count($companies); ?> * 10vw);" ></div>  
        <div  id="chart_bar2" style="height: calc(<?php echo count($companies); ?> * 10vw);" ></div>  
    </div>
    


</div>
       
</body>

<script>
    

    google.charts.load('current', { packages: ['corechart'] });
    google.charts.setOnLoadCallback(drawChart_interns);
    google.charts.setOnLoadCallback(drawChart_positions);

 


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

    function drawChart_interns() {
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

    function drawChart_positions() {
    var companiesP = <?php echo json_encode($companiesP); ?>;
    var yearsP = <?php echo json_encode($yearsP); ?>;
    var positions = <?php echo json_encode($Positions); ?>;
    var internsByYearP = <?php echo json_encode($Pyear); ?>;

    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Company');

    // Dynamically add columns only for position-year combinations that exist in the data
    var positionYearCombos = new Set();
    companiesP.forEach(function(company) {
        yearsP.forEach(function(year) {
            positions.forEach(function(position) {
                if (internsByYearP[company] && internsByYearP[company][year] && internsByYearP[company][year][position]) {
                    var combo = position + ',' + year;
                    positionYearCombos.add(combo);
                }
            });
        });
    });

    // Add columns for valid position-year combinations
    positionYearCombos.forEach(function(combo) {
        data.addColumn('number', combo);
        data.addColumn({type: 'string', role: 'tooltip', 'p': {'html': true}});
    });

    console.log(positionYearCombos);

    // Create rows for each company
    companiesP.forEach(function(company) {
        var row = [company];
        positionYearCombos.forEach(function(combo) {
            var [position, year] = combo.split(','); // Assuming combo is like 'HR 2022'
            var count = (internsByYearP[company] && internsByYearP[company][year] && internsByYearP[company][year][position])
                ? internsByYearP[company][year][position] : 0;
            var tooltip = '<div style="padding:5px;"><strong>' + position + '</strong><br/>' +
                        'Year: ' + year + '<br/>' +
                        'Company: ' + company + '<br/>' +
                        'Interns: ' + count + '</div>';
            row.push(count, tooltip);
        });
        data.addRow(row);
    });

    var options = {
        title: 'Number of Interns per Position by Company and Year',
        chartArea: { width: '60%' },
        hAxis: { title: 'Company' },
        vAxis: { title: 'Number of Interns' },
        tooltip: { isHtml: true },
        bar: { groupWidth: '75%' },
        isStacked: true,
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('chart_bar2'));
    chart.draw(data, options);
}





    


</script>


</html>