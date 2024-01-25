<?php
include "../init.php";
include "admin.php";

$new = new admin;
$new->model('AdminModel');
$new->profile();
?>