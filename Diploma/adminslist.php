<html>
  <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Список админов</title>
</head>
<body>
<?php 
session_start();
if (empty($_SESSION['user']))
{
     header ("HTTP/1.0 403 Access denied");
     echo "Нет доступа пожалуйста войдите как администратор"; "</br> ";
     ?><p><a href="main.php">На главную</a></p><?php
}
else {

 echo "Вы вошли как, ", $_SESSION['user'];?>  
<p><a href="logout.php">Выход</a></p> <p><a href="entered.php">Назад</a></p>
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

<body>


    
<?php

$pdo = new PDO("mysql:host=localhost; dbname=u22733_vergilon; charset=UTF8;", "u22733_vergilon", "qwerty12345");
$pdo->exec("SET NAMES UTF8");
$sql="SELECT id,admin,password FROM `adminslist`";
$delete="DELETE FROM `adminslist` WHERE(id='".$_POST['deleteid']."')";
    if(isset($_POST['deleteadmin'])) {
        $pdo->query($delete);
    };
$update="UPDATE `adminslist` SET `password`='".$_POST['changepassword']."' WHERE(id='".$_POST['passwordedit']."')";
    if(isset($_POST['editpassword'])) {
        $pdo->query($update);
    };

$newadmin="INSERT INTO `adminslist`(admin, password) VALUES ('".$_POST['newadmin']."', '".$_POST['newpassword']."')";
?>
 <form action="adminslist.php" method="POST">
            <label for="newadmin">Новый администратор</label>
            <input type="text" name="newadmin" id="newadmin">
            <label for="newpassword">Пароль</label>
            <input type="password" name="newpassword" id="newpassword">
            <input type="submit" value="Создать" name="Create"/>
    </form>
<?php
$check="SELECT `id` FROM `adminslist` WHERE(admin='".$_POST['newadmin']."')";
foreach ($pdo->query($check) as $row) {
        if (isset($row['id'])) {$help=1; echo "Имя пользователя занято, выберете другое", "</br>";};};//Ввел вспомогательную переменную $help, чтобы имена админов не повторялись
if (isset($_POST['Create'])&&((empty($_POST['newadmin']))||(empty($_POST['newpassword'])))) {
    echo "При создании нового администратора вы должны ввести и имя администратора и пароль";
};

if (isset($_POST['Create'])&&((!empty($_POST['newadmin']))&&(!empty($_POST['newpassword'])))&&($help!=1)) {
    $pdo->query($newadmin);
};
?>
<table>
        <tr>
            <td>Администратор </td>
            <td>Пароль </td>
            <td>Изменить пароль</td>
            <td>Удалить администратора</td>
        </tr>

<?php foreach ($pdo->query($sql) as $row) {?>
<tr>
    <td><?php echo $row['admin']?></td>
    <td><?php echo $row['password']?></td>
     <td>
        <form action="adminslist.php" method="post">
         <input type="hidden" value=<?php echo $row['id']?> name="passwordedit"/>  
         <input type="text" name="changepassword" placeholder="Новый пароль" value="" />
        <input type="submit" value="Изменить пароль" name="editpassword"></p>
         </form>
    </td>
    <td>
         <form action="adminslist.php" method="post">
         <input type="hidden" value=<?php echo $row['id']?> name="deleteid"/>  
        <input type="submit" value="Удалить" name="deleteadmin"></p>
         </form>
    </td>

</tr>
<?php } 
?>
</table>
<?php
}        
?>
</body>

</html>