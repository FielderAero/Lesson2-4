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
<p><a href="themeslist.php">Назад к списку тем</a></p>

<?php

$pdo = new PDO("mysql:host=localhost; dbname=u22733_netology; charset=UTF8;", "u22733_netology", "qwerty12345");
$pdo->exec("SET NAMES UTF8");
$pdo2 = new PDO("mysql:host=localhost; dbname=u22733_vergilon; charset=UTF8;", "u22733_vergilon", "qwerty12345");//Для того, чтобы когда удаляю вопрос через эту страницу, он не оставался следом на странице answerswithnoquestions.php
$pdo2->exec("SET NAMES UTF8");
$theme="SELECT id,question,answer,user,status,published,date_added FROM `{$_POST['theme']}`";
$status1="UPDATE `{$_POST['theme']}` SET `status`='Ожидает ответа' WHERE answer=''";
$status2="UPDATE `{$_POST['theme']}` SET `status`='Дан ответ' WHERE answer<>''";


$delete="DELETE FROM `{$_POST['deletefromtheme']}` WHERE(id='".$_POST['deleteid']."')";
$delete2="DELETE FROM `noanswers` WHERE(question='".$_POST['deletequestion2']."')";
echo $_POST['deletequestion2'];
    if(isset($_POST['deletequestion'])) {
        $pdo->query($delete);
        $pdo2->query($delete2);
    };

        
if (isset($_POST['publishedquestion'])) { 
    $publish="UPDATE `{$_POST['publishedfromtheme']}` SET `published`='1' WHERE `id`='".$_POST['publishedid']."'";
    $pdo->query($publish);
};

if (isset($_POST['unpublishedquestion'])) { 
    $unpublish="UPDATE `{$_POST['unpublishedfromtheme']}` SET `published`='0' WHERE `id`='".$_POST['publishedid']."'";
    $pdo->query($unpublish);
};

$edituser="UPDATE `{$_POST['theme']}` SET `user`='".$_POST['edituser']."' WHERE `id`='".$_POST['userid']."'";
$edituser2="UPDATE `noanswers` SET `user`='".$_POST['edituser']."' WHERE `user`='".$_POST['useredit2']."'";

if (isset($_POST['changeuser'])&&empty($_POST['edituser'])) {echo "Имя пользователя не может быть пустым";};

if (isset($_POST['changeuser'])&&!empty($_POST['edituser'])) {
    $pdo->query($edituser);
    $pdo2->query($edituser2);
};

$editanswer="UPDATE `{$_POST['theme']}` SET `answer`='".$_POST['editanswer']."' WHERE `id`='".$_POST['answerid']."'";
$editanswer2="UPDATE `noanswers` SET `answer`='".$_POST['editanswer']."' WHERE `answer`='".$_POST['answeredit2']."'";
if (isset($_POST['changeanswer'])&&empty($_POST['editanswer'])) {echo "Ответ не может быть пустым";};

if (isset($_POST['changeanswer'])&&!empty($_POST['editanswer'])) {
    $pdo->query($editanswer);
    $pdo2->query($editanswer2);
};

$editquestion="UPDATE `{$_POST['theme']}` SET `question`='".$_POST['editquestion']."' WHERE `id`='".$_POST['questionid']."'";
if (isset($_POST['changequestion'])&&empty($_POST['editquestion'])) {echo "Вопрос не может быть пустым";};

if (isset($_POST['changequestion'])&&!empty($_POST['editquestion'])) {
    $pdo->query($editquestion);
};

$themes="SHOW TABLES";

$changetheme="INSERT INTO `{$_POST['choosetheme']}` SELECT * FROM `{$_POST['theme']}` WHERE id='".$_POST['changetheme']."'";
$deletefromtheme="DELETE FROM `{$_POST['theme']}` WHERE id='".$_POST['changetheme']."'";


if (isset($_POST['newtheme'])&&$_POST['choosetheme']!=$_POST['theme']) {
    $pdo->query($changetheme);
    $pdo->query($deletefromtheme);
}


$pdo->query($status1);
$pdo->query($status2);
?>




<table>
        <tr>
            <td>Вопрос </td>
            <td>Ответ</td>
            <td>Автор</td>
            <td>Статус</td>
            <td>Опубликован/скрыт</td>
            <td>Опубликовать</td>
            <td>Дата вопроса</td>
            <td>Удалить вопрос</td>
            <td>Переместить вопрос в тему</td>
        </tr>  
<?php foreach ($pdo->query($theme) as $row) {?>
<tr>
    <td><?php echo $row['question']; ?>
            <form action="theme.php" method="post">
            <input type="hidden" value="<?php echo $row['id'];?>" name="questionid"/> 
            <input type="hidden" value="<?php echo $_POST['theme'];?>" name="theme"/>
            <input type="hidden" value="<?php echo $row['answer'];?>" name="answeredit2"/>
            <input type="text" name="editquestion" placeholder="<?php echo $row['question'];?>" value="" />
            <input type="submit" value="Изменить вопрос" name="changequestion"></p>
            </form>
    </td>
    <td><?php echo $row['answer']; ?>
            <form action="theme.php" method="post">
            <input type="hidden" value="<?php echo $row['id'];?>" name="answerid"/> 
            <input type="hidden" value="<?php echo $_POST['theme'];?>" name="theme"/>
            <input type="text" name="editanswer" placeholder="<?php echo $row['answer'];?>" value="" />
            <input type="submit" value="Изменить ответ" name="changeanswer"></p>
            </form>
    </td>
    <td><?php echo $row['user']; ?>
    
            <form action="theme.php" method="post">
            <input type="hidden" value="<?php echo $row['id'];?>" name="userid"/> 
            <input type="hidden" value="<?php echo $_POST['theme'];?>" name="theme"/>
            <input type="hidden" value="<?php echo $row['user'];?>" name="useredit2"/>
            <input type="text" name="edituser" placeholder="<?php echo $row['user'];?>" value="" />
            <input type="submit" value="Редактировать автора" name="changeuser"></p>
            </form>
            
    </td>
    <td><?php echo $row['status']; ?> </td>
    <td>
        <?php if ($row['published']==0) {echo "Скрыт";};
        if ($row['published']==1) {echo "Опубликован";}; ?>
    </td>
    <td>
         <form action="theme.php" method="post">
         <input type="hidden" value="<?php echo $row['id'];?>" name="publishedid"/> 
         <input type="hidden" value="<?php echo $_POST['theme'];?>" name="theme"/>
         <?php if ($row['published']==0) { ?>
             <input type="hidden" value="<?php echo $_POST['theme'];?>" name="publishedfromtheme"/>
             <input type="submit" value="Опубликовать" name="publishedquestion"></p>
             <?php
         }; ?>
        <?php if ($row['published']==1) { ?>
             <input type="hidden" value="<?php echo $_POST['theme'];?>" name="unpublishedfromtheme"/>
             <input type="submit" value="Скрыть" name="unpublishedquestion"></p>
             <?php
         }; ?>
    
    
        
         </form>
    </td>
    <td><?php echo $row['date_added']; ?></td>
     <td>
         <form action="theme.php" method="post">
            <input type="hidden" value="<?php echo $_POST['theme'];?>" name="theme"/>
         <input type="hidden" value="<?php echo $row['id'];?>" name="deleteid"/> 
         <input type="hidden" value="<?php echo $row['question'];?>" name="deletequestion2"/>
         <input type="hidden" value="<?php echo $_POST['theme'];?>" name="deletefromtheme"/>
        
        <input type="submit" value="Удалить" name="deletequestion"></p>
         </form>
    </td>
    <td>
         <form action="theme.php" method="post">
             <input type="hidden" value="<?php echo $_POST['theme'];?>" name="theme"/>
                <input type="hidden" value="<?php echo $row['id'];?>" name="changetheme"/>  
             <p></p><select name="choosetheme">
                <?php foreach ($pdo->query($themes) as $row) {?>
                <option><?php echo $row['Tables_in_u22733_netology']?></option>
            <?php }?>
            </select></p>
            <p><input type="submit" value="Перенести в тему" name="newtheme"></p>
         </form>
    </td>
</tr>
<?php } ?>
</table>

</body>
<?php
}
?>
</html>