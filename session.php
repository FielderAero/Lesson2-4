<?php
require_once 'functions.php';
if (!isLogged()) {
    redirect('basic.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h2>Добро пожаловать, <?php echo $_SESSION["user"]["name"] ?></h2>
    <a href="logout.php">Выйти</a>
</body>
<form action="list.php" method="POST">
<div>
    <p>To the test list</p>
    <button type="submit">Test list</button>
</div>
</html>