<?php

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    /** database config **/
    define('DBNAME', 'internEaseTest');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');

    define('ROOT', 'http://localhost/internease/public');

}

define('APP_NAME', "My Webiste");
define('APP_DESC', "Best website on the planet");

/** true means show errors **/
define('DEBUG', true);
