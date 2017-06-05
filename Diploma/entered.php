<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin page</title>
</head>
<body>
        <?php 
        session_start();
        
        if (isset($_POST['enter'])) {
        $pdo = new PDO("mysql:host=localhost; dbname=u22733_vergilon; charset=UTF8;", "u22733_vergilon", "qwerty12345");
        $pdo->exec("SET NAMES UTF8");   
        $check="SELECT `id` FROM `adminslist` WHERE(admin='".$_POST['login']."'AND password='".$_POST['password']."')";
        foreach ($pdo->query($check) as $row) {
        if ($row['id']=$_POST['login']) {echo "Добро пожаловать ",   $_POST['login'];
        $_SESSION['user']=$_POST['login']; $_SESSION['password']=$_POST['password']; $reg=1;
        
        ?><p><a href="adminslist.php">Список администраторов</a></p>
        <p><a href="themeslist.php">Список тем</a></p>
        <p><a href="questionswithnoanswers.php">Вопросы без ответа</a></p>
        <p><a href="logout.php">Выход</a></p>
        <?php
        }}//$reg-вспомогательная переменная
        
        if ($reg!=1) {
        echo "Неверный логин или пароль ";
        ?><p><a href="main.php">Вернуться</a></p><?php

        };
        
        }
        else if ((!isset($_POST['enter']))&&(!isset($_SESSION['user'])))
        { 
            echo "Пожалуйста войдите как администратор";
          ?><p><a href="main.php">Главная страница</a></p><?php  
        }
            else 
            {
                 $pdo = new PDO("mysql:host=localhost; dbname=u22733_vergilon; charset=UTF8;", "u22733_vergilon", "qwerty12345");
                $pdo->exec("SET NAMES UTF8");   
                 $check="SELECT `id` FROM `adminslist` WHERE(admin='".$_SESSION['user']."'AND password='".$_SESSION['password']."')";
                foreach ($pdo->query($check) as $row) {
                if ($row['id']=$_SESSION['user']) {echo "Добро пожаловать ",   $_SESSION['user'];
                $reg=1;
        
                ?><p><a href="adminslist.php">Список администраторов</a></p>
                 <p><a href="themeslist.php">Список тем</a></p>
                 <p><a href="questionswithnoanswers.php">Вопросы без ответа</a></p>
                <p><a href="logout.php">Выход</a></p>
                <?php
                }}//$reg-вспомогательная переменная
        
                if ($reg!=1) {
                echo "Неверный логин или пароль ";
                ?><p><a href="main.php">Вернуться</a></p><?php

            };
            }
        
        
        ?>
</body>
</html>