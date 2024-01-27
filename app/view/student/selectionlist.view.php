<?php require_once("../app/view/inc/header.php"); ?>

<div class="container">
        <?php require_once("../app/view/inc/sidebar.php"); ?>

        <!-- main -->

        <div class="main">
            <?php require_once("../app/view/inc/topbar.php"); ?>
            
        <!-- Sample form trial-->
        <div class="form">
            <form action="<?=ROOT?>/student/selectionlist" method="get">
            Name: <input type="text" name="name"><br>
            E-mail: <input type="text" name="email"><br>
            <input type="submit">
            </form>
        </div>
        

<?php require_once("../app/view/inc/footer.php"); ?>