<html>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>yandexgeo</title>
</head>
<body>
<style>
    table { 
        border-spacing: 0;
        border-collapse: collapse;
    }

    table td, table th {
        border: 1px solid #ccc;
        padding: 5px;
    }
    
    table th {
        background: #eee;
    }
</style>

<form action=index2.php method="POST">
        <input type="text" name="address" placeholder="Введите адрес" value="" />
        <input type="submit" name="search" value="Искать" />
</form>

<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require '/var/www/u22733/data/vendor/autoload.php';

$api=new \Yandex\Geo\Api();

// Можно искать по точке

// Или можно икать по адресу
if(isset($_POST['address'])) {
$api->setQuery($_POST['address']);
};

// Настройка фильтров
$api
    ->setLimit(100) // кол-во результатов
    ->setLang(\Yandex\Geo\Api::LANG_US) // локаль ответа
    ->load();

$response = $api->getResponse();
$response->getFoundCount(); // кол-во найденных адресов
$response->getQuery(); // исходный запрос
$response->getLatitude(); // широта для исходного запроса
$response->getLongitude(); // долгота для исходного запроса

// Список найденных точек
    $collection = $response->getList();
    if(isset($_POST['address'])) {?>
    <table>
        <tr>
            <td>Адрес </td>
            <td>Координаты </td>
    </tr>
    <?php
    foreach ($collection as $item) {
    $item->getAddress();  // вернет адрес
    $item->getLatitude();  // широта
    $item->getLongitude();  // долгота
    $item->getData(); // необработанные данные
    ?>
    <tr>
        <td><?php echo $item->getAddress(); ?></td>
        <td><?php echo "Широта ", $item->getLatitude(), " Долгота ", $item->getLongitude(); ?></td>
    </tr>
    <?php
    }
    }




?>

</body>
</html>


