<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Main</title>
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
        <form action="entered.php" method="POST">
            <label for="login">Логин</label>
            <input type="text" name="login" id="login">
            <label for="password">Пароль</label>
            <input type="password" name="password" id="password">
            <input type="submit" value="Войти как администратор" name="enter"/>
        </form>
        
<?php 
echo "Выберите тему, чтобы задать вопрос или посмотреть ответы";

$pdo = new PDO("mysql:host=localhost; dbname=u22733_netology; charset=UTF8;", "u22733_netology", "qwerty12345");
$pdo->exec("SET NAMES UTF8");
$themes="SHOW TABLES";

?>


<table>
        <tr>
            <td>Список тем </td>
            <td>Просмотреть вопросы</td>
        </tr>  
<?php foreach ($pdo->query($themes) as $row) {?>
<tr>
    <td><?php echo $row['Tables_in_u22733_netology']; ?></td>
    <td>
        <form action='answersforusers.php' method='post'>
    <input type="hidden" value="<?php echo $row['Tables_in_u22733_netology'];?>" name="theme"/>   
    <input type="submit" value="Вопросы" name="description"/>
    </form>
    </td>
</tr>
<?php } ?>
</table>


</body>
</html>