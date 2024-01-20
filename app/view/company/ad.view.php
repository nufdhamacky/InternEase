    <?php 

//     if(isset($_SESSION['ad_addition'])){
//         echo "<script>alert('".$_SESSION['ad_addition']."')</script>";
//         unset($_SESSION['ad_addition']);
//     }

//    $company_id = $_SESSION['id'];
//    $sql = "SELECT * FROM `company_ad` WHERE `company_id` = $company_id";
//    $results = mysqli_query($conn, $sql) or die(mysqli_error($conn));

//     //  Delete record
//    if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     if (isset($_POST['record_id'])) {
//         // Sanitize and get the record ID
//         $record_id = filter_var($_POST['record_id'], FILTER_SANITIZE_NUMBER_INT);

//         // Perform the record deletion using the $record_id
//         // Replace 'your_database_table' with your actual table name
//         $sql = "DELETE FROM company_ad WHERE ad_id = $record_id";
//         $result = mysqli_query($conn, $sql);

//         if ($result) {
//             // Record successfully deleted
//             $_SESSION['ad_addition'] = "Record successfully deleted";
//             header('location:'.SITEURL.'ad.php'); // Redirect to a success page
//             exit();
//         } else {
//             // Handle the error, e.g., display an error message
//         }
//     }
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Advertisements</title>
    <link rel="stylesheet" type="text/css" href="<?=ROOT?>/css/company/companyAd.css">
</head>
<body>
    
    <div class="container">
    <?php require_once('../app/view/layout/companyMenubar.php') ?>
    
        <div class ="main">
            <div class = "topbar">
                <div class = "toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class = "user">
                    <span><?php //echo $_SESSION['company_name']; ?></span>
                    <ion-icon class="profile-icon" name="person-circle-outline"></ion-icon>
                </div>

            </div>

            <div class="details">
                <div class="heading-advertisement">
                    <h2>Advertisements</h2>
                    <a href="addAd.php">
                        <button class="add-advertisement">+ Add</button>
                    </a>
                </div>
                
                <div class="filter-details">
                    <div class = "secondbar">
                        <div class = "search">
                            <ion-icon name="search-outline"></ion-icon>
                            <input type = "text" placeholder = "Search Student" class = "box1">
                        </div>

                        <div class = "allstudents">
                            <select>
                                <option value = "all">All</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="ad-table">
                    <div class="table-heading">
                        <div class="position-class">Poisition</div>
                        <div class="requirement-class">Requirements</div>
                        <div class="intake-class">No of intakes</div>
                        <div class="mode-class">Working mode</div>
                    </div>
                    <div class="table-all-data">
                    <?php
                        // if(mysqli_num_rows($results) != 0){
                        //     while($row = mysqli_fetch_assoc($results)){
                          
                    ?>
                                <div class="each-data">
                                    <div class="position-class">
                                        <?php 
                                            // if($row['position']=="se"){
                                            //     echo "Software Engineer";
                                            // }else if($row['position']=="ba"){
                                            //     echo "Business Analyst";
                                            // }else if($row['position']=="qa"){
                                            //     echo "Quality Assurance";
                                            // }
                                        ?>
                                    </div>
                                    <div class="requirement-class"><?php echo $row['requirements'] ?></div>
                                    <div class="intake-class"><?php echo $row['no_of_intern'] ?></div>
                                    <div class="mode-class"><?php echo $row['working_mode'] ?></div>
                                    <div>
                                        <a href="adView.php?id=<?php echo $row['ad_id']; ?>">
                                            <button class="data-view-btn" type="submit">View</button></div>
                                        </a>
                                    <div>
                                        <form method="post">
                                            <input type="hidden" name="record_id" value="<?php echo $row['ad_id']; ?>">
                                                <button class="data-delete-btn" type="submit">Delete</button>
                                        </form>
                                    </div>
                                </div>
                    <?php 
                            // }
                        // } else {
                    ?>  
                                <div class="each-data">
                                    <div class="position-class">No bokings available</div>
                                </div>

                    <?php
                        // }    
                    ?>
                    </div>
                </div>
    
            </div>
        </div>
                   
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>