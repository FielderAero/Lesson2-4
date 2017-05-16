<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require 'vendor/autoload.php';
if(file_exists('vendor/yandex/geo/source/Yandex/Geo/Api.php')) {echo "exists", "</br>";};


$api=new vendor\yandex\geo\source\Yandex\Geo\Api();

?>


