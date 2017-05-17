<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require '/var/www/u22733/data/vendor/autoload.php';
if(file_exists('/var/www/u22733/data/vendor/yandex/geo/source/Yandex/Geo/Api.php')) {echo "exists", "</br>";};

$api=new \Yandex\Geo\Api();

// Можно искать по точке
$api->setPoint(30.5166187, 50.4452705);

// Или можно икать по адресу
$api->setQuery('Тверская 6');

// Настройка фильтров
$api
    ->setLimit(1) // кол-во результатов
    ->setLang(\Yandex\Geo\Api::LANG_US) // локаль ответа
    ->load();

$response = $api->getResponse();
$response->getFoundCount(); // кол-во найденных адресов
$response->getQuery(); // исходный запрос
$response->getLatitude(); // широта для исходного запроса
$response->getLongitude(); // долгота для исходного запроса

// Список найденных точек
    $collection = $response->getList();
    foreach ($collection as $item) {
    $item->getAddress(); // вернет адрес
    $item->getLatitude(); // широта
    $item->getLongitude(); // долгота
    $item->getData(); // необработанные данные
}



?>


