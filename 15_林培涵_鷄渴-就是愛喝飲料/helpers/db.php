<?php
define('DATABASE_NAME', 'gk');
define('DATABASE_USER', 'root');
define('DATABASE_PASS', '');
define('DATABASE_HOST', '127.0.0.1');
include_once('class.DBPDO.php');

$DB = new DBPDO();
?>