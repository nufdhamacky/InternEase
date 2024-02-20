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
        <div class="notification">
                <div class="notibutton">
                <a href="<?php echo ROOT; ?>/admin/ad_report?data=<?php echo urlencode(json_encode($advertisments)); ?>&companies=<?php echo urlencode(json_encode($companies)); ?>" target="_blank">

                            <div>
                                <div>Download</div>
                                <div>advertisement</div>
                                <div>report</div>
                            </div>

                        </a>
                        <div class="iconBx">
                            <ion-icon name="document-text" size="large"></ion-icon>
                        </div>
                </div>

                <div class="notibutton">
                    <a href="<?php echo ROOT; ?>/admin/reg_report?data=<?php echo urlencode(json_encode($companies)); ?>" target="_blank">
                            <div>
                                <div>Download</div>
                                <div>Registration</div>
                                <div>report</div>
                            </div>
                        </a>
                        <div class="iconBx">
                            <ion-icon name="document-text" size="large"></ion-icon>
                        </div>
                </div>  

                <div class="notibutton">
                        <a href="">
                            <div>
                                <div>Most employed Position: </div>
                                <div>Software Enginner</div>
                                <div>Company with the highest recruit rate</div>
                                <div>99x</div>
                            </div>
                            <div class="iconBx">
                                <ion-icon  name="man-outline" size="large"></ion-icon>
                            </div>
                        </a>
                </div>  
                         
        </div>
    

    <div class="report">
            <div class='report_item'>
            <h2>Advertisment Summary</h2>

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
                <?php if ($advertisments && count($advertisments)> 0): ?>
                    <?php foreach ($advertisments as $ad): ?>

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
                        
                        <td><?php echo htmlspecialchars($ad['company_id']);?></td>
                        
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
                             
                            }
                        ?>
                        <td><?php echo htmlspecialchars($ad['position']); ?></td>
                        <td><?php echo htmlspecialchars($ad['no_of_intern']); ?></td>

                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>  
                </tbody>
            </table>
            </div>

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
            </div>
    </div>

</div>   
</body>
</html>
