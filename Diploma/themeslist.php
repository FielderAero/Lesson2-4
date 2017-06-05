<html>
  <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Список тем</title>
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

<?php
session_start();

if (empty($_SESSION['user']))
{
     header ("HTTP/1.0 403 Access denied");
     echo "Нет доступа пожалуйста войдите как администратор"; "</br> ";
     ?><p><a href="main.php">На главную</a></p> 
     <?php
}
else {

echo "Вы вошли как, ", $_SESSION['user'];?>  
<p><a href="logout.php">Выход</a></p> <p><a href="entered.php">Назад</a></p>

<?php

$pdo = new PDO("mysql:host=localhost; dbname=u22733_netology; charset=UTF8;", "u22733_netology", "qwerty12345");
$pdo->exec("SET NAMES UTF8");
$pdo2 = new PDO("mysql:host=localhost; dbname=u22733_vergilon; charset=UTF8;", "u22733_vergilon", "qwerty12345");
$pdo2->exec("SET NAMES UTF8");
$themes="SHOW TABLES";
        

$newtheme="CREATE TABLE `{$_POST['newtheme']}` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `question` text NOT NULL,
    `answer` text NOT NULL,
    `user` text NOT NULL,
    `status`text NOT NULL,
    `published` INT NOT NULL DEFAULT '0',
    `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
$check="SHOW TABLES WHERE Tables_in_u22733_netology='".$_POST['newtheme']."'";
foreach ($pdo->query($check) as $row) {
        if (isset($row['Tables_in_u22733_netology'])) {$help=1; echo "Данная тема уже существует", "</br>";};};//Ввел вспомогательную переменную $help, чтобы имена админов не повторялись

if (isset($_POST['Create'])&&((empty($_POST['newtheme'])))) {
echo "Название темы не может быть пустым";
};

if (isset($_POST['Create'])&&((!empty($_POST['newtheme']))&&($help!=1))) {
    $pdo->query($newtheme);
};

$delete="DROP TABLE `{$_POST['deletetheme']}`";
$delete2="DELETE FROM `noanswers` WHERE theme='".$_POST['deletetheme']."'";
if (isset($_POST['delete'])) {
    $pdo->query($delete);
    $pdo2->query($delete2);
};



?>


<table>
        <tr>
            <td>Список тем </td>
            <td>Просмотреть вопросы</td>
            <td>Количество вопросов</td>
            <td>Вопросов без ответов</td>
            <td>Опубликованных вопросов</td>
            <td>Удалить тему</td>
        </tr>  
<?php foreach ($pdo->query($themes) as $row) {?>
<tr>
    <td><?php echo $row['Tables_in_u22733_netology']; ?></td>
    <td>
        <form action='theme.php' method='post'>
    <input type="hidden" value="<?php echo $row['Tables_in_u22733_netology'];?>" name="theme"/>   
    <input type="submit" value="Вопросы" name="description"/>
    </form>
    </td>
    <td>
        <?php
        $questioncount=$pdo->prepare("SELECT * FROM `{$row['Tables_in_u22733_netology']}` WHERE question!=''");
        $questioncount->execute();
        echo $questioncount->rowCount();
        ?>
    </td>
    <td>
        <?php
        $answercount=$pdo->prepare("SELECT * FROM `{$row['Tables_in_u22733_netology']}` WHERE answer=''");
        $answercount->execute();
        echo $answercount->rowCount();
        ?>
    </td>
    <td>
        <?php
        $publiccount=$pdo->prepare("SELECT * FROM `{$row['Tables_in_u22733_netology']}` WHERE published='1'");
        $publiccount->execute();
        echo $publiccount->rowCount();
        ?>
    </td>
    
    <td>
         <form action="themeslist.php" method="post">
         <input type="hidden" value="<?php echo $row['Tables_in_u22733_netology'];?>" name="deletetheme"/>  
        <input type="submit" value="Удалить" name="delete">
         </form>
    </td>
</tr>
<?php } ?>
</table>


<form action=themeslist.php method="POST">
        <input type="text" name="newtheme" placeholder="Название темы" value="" />
        <input type="submit" name="Create" value="Добавить" />
</form>
</body>
<?php
}
?>
</html>