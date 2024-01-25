<?php 

// all files created in the core should added to the autoload.php file

require("config.php");
require("database.php");
require("controller.php");
require("model.php");
require("app.php");
require("mailer.php");


spl_autoload_register(function($class){

    require "../app/models/".$class.".php";

} );

?> 