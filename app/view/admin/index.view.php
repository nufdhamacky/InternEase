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
                        <div>First Round Selections</div>
                        <div>Total Applications - <?php   echo htmlspecialchars($first_round_data['applied']);?> </div>
                        <div>IS recruited - <?php   echo htmlspecialchars($first_round_data['total_1st_is']);?> </div>
                        <div>CS recruited - <?php   echo htmlspecialchars($first_round_data['total_1st_cs']);?> </div> 
                        <div><ion-icon  name="briefcase" size="medium"></ion-icon></div>

                </div>

                
                <div class="notibutton">
                        <div>Second Round Selections</div>
                        <div>Total Applications - <?php   echo htmlspecialchars($second_round_data['applied_2nd']);?> </div>
                        <div>IS recruited - <?php   echo htmlspecialchars($second_round_data['total_2nd_is']);?> </div>
                        <div>CS recruited - <?php   echo htmlspecialchars($second_round_data['total_2nd_cs']);?> </div>
                        <div><ion-icon  name="briefcase" size="medium"></ion-icon></div>
                </div>

                <div class="notibutton">
                        <div>Total Students:<?php echo htmlspecialchars($students['IS']+$students['CS']); ?></div>
                        <div></div>
                        <div></div>
                        <div>IS: <?php echo htmlspecialchars($students['IS']); ?> </div><div> CS: <?php echo htmlspecialchars($students['CS']); ?></div>
                        <div></div>
                        <div></div>
                </div>

                <div class="notibutton tooltip">
                    <div>Black Listed Companies</div>
                    
                    <div><?php echo htmlspecialchars($BL['count']); ?>
                    <?php if(!empty($BL['blacklistedCompanies'])):?>
                    <ion-icon  name="ban-outline" size="medium"></ion-icon>                          
                        <span class="tooltiptext">
                        <?php
                        if(!empty($BL['blacklistedCompanies'] && isset($BL['blacklistedCompanies']) )){
                            foreach ($BL['blacklistedCompanies'] as $bcompany) {
                                echo htmlspecialchars($bcompany);
                                echo "<br>";
                            }
                        }
                        ?> 
                        <?php endif ?>
                            </span>
                    </div>
                    <div>Complaints Received</div>
                    <div><?php echo htmlspecialchars($com_count); ?></div>
                    <div></div>


            </div>  

                       
        </div>
        <div class="search-container">
                
                <form action="<?=ROOT?>/admin/search_company" method="POST">
                    <div class="formgroup">
                    <input class="input-text" type="text" placeholder="<?php if(isset($_SESSION['search_company'])){echo $_SESSION['search_company'];}
                    else{ echo "search company";} ?>" name="company">
                    <input class="btn" type="submit" value="Search" name="search_company" ><br>
                    </div>
                </form>
            

                <?php if(isset($_SESSION['search_company'])){  ?>
                    
                    <form action="<?=ROOT?>/admin/removefilter" method="post">
                    <?php if($empty==1){?>
                        <p>No companies found!</p>
                    <?php }?>
                       <input class="btn" type="submit" value="Reset Filter" name="removefilter" ><br>
                    </form>
                <?php } ?>
        </div>

        <div class="chart_container">
            
            <div id='chartdiv' style="display:block;">
                <div class="chart"  id="chart_bar2" style="height: calc(<?php if(!isset($_SESSION['search_company'])){echo count($companies);}else{echo 4;} ?> * 8vw);width: calc(<?php echo count($companies); ?> * 13vw);" ></div>  
                <div class="chart" id="chart_bar" style="height: calc(<?php echo count($companies); ?> *8vw);width: calc(<?php echo count($companies); ?> * 13vw);" ></div>  
            </div>
            
        </div>
    </div>
    


</div>
       
</body>

<script>
    

    google.charts.load('current', { packages: ['corechart'] });
    google.charts.setOnLoadCallback(drawChart_interns);
    google.charts.setOnLoadCallback(drawChart_positions);


    var charts = document.getElementById('chartdiv');
    var empty = <?php echo json_encode($empty); ?>;
    console.log('empty:',empty);
    if(empty == 1){
        charts.style.display = 'none';
        charts.style.opacity = 0;
    }


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
            chartArea: { width: '50%' },
            hAxis: { title: 'Number of Interns' },
            vAxis: { title: 'Company' },
            errorHandling: 'none',
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
        chartArea: { width: '80%' },
        hAxis: { title: 'Number of Interns', minValue: 0 }, // Horizontal axis is now the value axis
        vAxis: { title: 'Company' }, // Vertical axis is now the category axis
        tooltip: { isHtml: true },
        bar: { groupWidth: '75%' },
        isStacked: true,
    };

    // Change to BarChart
    var chart = new google.visualization.BarChart(document.getElementById('chart_bar2'));
    chart.draw(data, options);
}






    


</script>


</html>
