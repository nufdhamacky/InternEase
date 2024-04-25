<?php
include_once('../app/controller/pdc.php');
$pdcController = new Pdc();
$id = $_GET["id"];
$studentRequest = $pdcController->getStudentRequestById($id);

?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Details</title>
    <link rel="stylesheet" type="text/css" href="<?= ROOT ?>/css/pdc/details.css">

</head>
<body>

<div class="container">

    <div class="details">
        <div class="description">
            <div class="rightpart">

                <form class="box" action="<?= ROOT ?>/pdc/updateStudent" method="post">
                    <h2>Student Complaints</h2>

                    <p class="label1">Complaint ID: <?php echo $studentRequest->id; ?> </p>
                    <p class="label1">First Name: <?php echo $studentRequest->student->firstName; ?> </p>
                    <p class="label1">Last Name: <?php echo $studentRequest->student->lastName; ?> </p>
                    <p class="label1">Reg.No: <?php echo $studentRequest->student->regNo; ?> </p>
                    <p class="label1">Subject: <?php echo $studentRequest->title; ?> </p>
                    <p class="label1">Message: <?php echo $studentRequest->description; ?> </p>
                </form>
            </div>
            <div>
                <form method="post" action="<?= ROOT ?>/pdc/replyComplaint" class="box">
                    <input type="number" hidden value="<?php echo $id; ?>" name="id">
                    <h2>Reply</h2>
                    <textarea name="reply" id="reply"
                              cols="30" <?php echo $studentRequest->reply != null ? "readonly" : ""; ?>
                              rows="10"> <?php echo $studentRequest->reply; ?> </textarea>
                    <button type="submit" <?php echo $studentRequest->reply != null ? "hidden" : ""; ?>>Reply</button>
                </form>
            </div>


</body>
</html>
