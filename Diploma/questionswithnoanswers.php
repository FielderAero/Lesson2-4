<html>
  <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Вопросы без ответа</title>
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

$delete="DELETE FROM `{$_POST['deletefromtheme']}` WHERE question='".$_POST['deletefromquestion']."' AND user='".$_POST['deletefromuser']."'";
$delete2="DELETE FROM `noanswers` WHERE question='".$_POST['deletefromquestion']."' AND user='".$_POST['deletefromuser']."'";
if (isset($_POST['deletequestion'])) {
    $pdo->query($delete);
    $pdo2->query($delete2);
};
 
$editquestion="UPDATE `{$_POST['updatefromtheme']}` SET `question`='".$_POST['editquestion']."' WHERE `question`='".$_POST['updatefromquestion']."' AND user='".$_POST['updatefromuser']."'";
$editquestion2="UPDATE `noanswers` SET `question`='".$_POST['editquestion']."' WHERE `question`='".$_POST['updatefromquestion']."' AND user='".$_POST['updatefromuser']."'";
if (isset($_POST['changequestion'])) {
    echo $_POST['updatefromquestion'];
    $pdo->query($editquestion);
    $pdo2->query($editquestion2);
};

$editanswer="UPDATE `{$_POST['answertheme']}` SET `answer`='".$_POST['editanswer']."' WHERE `question`='".$_POST['answertoquestion']."' AND user='".$_POST['answertouser']."'";
$editanswer2="UPDATE `noanswers` SET `answer`='".$_POST['editanswer']."' WHERE `question`='".$_POST['answertoquestion']."' AND user='".$_POST['answertouser']."'";
if (isset($_POST['changeanswer'])) {
   $pdo->query($editanswer);
    $pdo2->query($editanswer2);
};

$deletewithanswers="DELETE FROM `noanswers` WHERE answer!=''";
$pdo2->query($deletewithanswers);


?>


<table>
        <tr>
            <td>Тема</td>
            <td>Вопрос </td>
            <td>Ответ</td>
            <td>Автор</td>
            <td>Дата вопроса</td>
            <td>Удалить вопрос</td>
        </tr>  
<?php foreach ($pdo->query($themes) as $row) {
       $question="SELECT id,question,answer,user,status,published,date_added FROM `{$row['Tables_in_u22733_netology']}` WHERE answer=''";
       $addtheme=$row['Tables_in_u22733_netology'];
        foreach ($pdo->query($question) as $row) {
            $norepeats="DELETE FROM `noanswers` WHERE(question='".$row['question']."' AND user='".$row['user']."' AND date_added='".$row['date_added']."')";
            $noanswer="INSERT INTO `noanswers`(question,answer,user,date_added,theme) VALUES('".$row['question']."','".$row['answer']."','".$row['user']."','".$row['date_added']."','".$addtheme."')";
            $pdo2->query($norepeats);
            $pdo2->query($noanswer);
        }
}    
        $tablewithquestions="SELECT question,answer,user,date_added,theme FROM `noanswers` ORDER BY date_added ASC";
        foreach ($pdo2->query($tablewithquestions) as $row) {
?>

<tr> 
    <td><?php echo $row['theme']; ?></td>
    <td><?php echo $row['question']; ?>
         <form action="questionswithnoanswers.php" method="post">
            <input type="hidden" value="<?php echo $row['theme'];?>" name="updatefromtheme"/> 
            <input type="hidden" value="<?php echo $row['question'];?>" name="updatefromquestion"/>
            <input type="hidden" value="<?php echo $row['user'];?>" name="updatefromuser"/>
            <input type="text" name="editquestion" placeholder="<?php echo $row['question'];?>" value="" />
            <input type="submit" value="Изменить вопрос" name="changequestion"></p>
            </form>
    </td>
    <td><?php echo $row['answer']; ?>
            <form action="questionswithnoanswers.php" method="post">
            <input type="hidden" value="<?php echo $row['theme'];?>" name="answertheme"/> 
            <input type="hidden" value="<?php echo $row['question'];?>" name="answertoquestion"/>
            <input type="hidden" value="<?php echo $row['user'];?>" name="answertouser"/>
            <input type="text" name="editanswer" value="" />
            <input type="submit" value="Ответить" name="changeanswer"></p>
            </form>
    </td>
    <td><?php echo $row['user']; ?></td>
    <td><?php echo $row['date_added']; ?></td>
      <td>
         <form action="questionswithnoanswers.php" method="post">
            <input type="hidden" value="<?php echo $row['theme'];?>" name="deletefromtheme"/>
         <input type="hidden" value="<?php echo $row['question'];?>" name="deletefromquestion"/> 
         <input type="hidden" value="<?php echo $row['user'];?>" name="deletefromuser"/>
        
        <input type="submit" value="Удалить" name="deletequestion"></p>
         </form>
    </td>
    
</tr>
<?php } ?>
</table>
<?php  } ?>

</body>
</html>