<html>
  <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Вопросы в выбранной теме</title>
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
 
<p><a href="main.php">Назад</a></p>

<?php

if (isset($_POST['themequestion'])) {
    $_POST['theme']=$_POST['themequestion'];
};

if (!isset($_POST['theme'])) {echo "Не выбрана тема";
    
}
else {
echo "Вопросы по теме ", $_POST['theme'];



$pdo = new PDO("mysql:host=localhost; dbname=u22733_netology; charset=UTF8;", "u22733_netology", "qwerty12345");
$pdo->exec("SET NAMES UTF8");
        
$theme="SELECT id,question,answer,user,date_added FROM `{$_POST['theme']}` WHERE published=1";
$add="INSERT INTO `{$_POST['themequestion']}`(`question`, `user`) VALUES ('".$_POST['text']."','".$_POST['user']."')";

if ((isset($_POST['ask']))&&isset($_POST['themequestion'])&&!empty($_POST['text'])&&!empty($_POST['user'])) {
    $pdo->query($add);
};




?>


<table>
        <tr>
            <td>Вопрос </td>
            <td>Ответ</td>
            <td>Автор</td>
            <td>Дата вопроса</td>
        </tr>  
<?php foreach ($pdo->query($theme) as $row) {?>
<tr>
    <td><?php echo $row['question']; ?></td>
    <td><?php echo $row['answer']; ?></td>
    <td><?php echo $row['user']; ?></td>
    <td><?php echo $row['date_added']; ?></td>
</tr>
<?php } ?>
</table>


<form action="answersforusers.php" method="post">
         <input type="hidden" value="<?php echo $_POST['theme'];?>" name="themequestion"/>  
         <input type="text" name="user" placeholder="Имя пользователя" value="" />
         <input type="text" name="text" placeholder="Введите вопрос" value="" />
        <input type="submit" value="Задать вопрос" name="ask"></p>
</form>
<?php 
if ((isset($_POST['ask']))&&isset($_POST['themequestion'])&&(empty($_POST['text'])||empty($_POST['user']))) {
    echo "Имя пользователя или вопрос не могут быть пустыми";
};
if ((isset($_POST['ask']))&&isset($_POST['themequestion'])&&!empty($_POST['text'])&&!empty($_POST['user'])) {
    echo "Ваш вопрос появится как только администратор опубликует его";
};
}
?>

</body>
</html>