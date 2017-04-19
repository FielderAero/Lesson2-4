<!DOCTYPE HTML>

<html>
<head>
</head>
<body>
 <?php
header('Content-Type: text/html; charset=utf-8');
$dir ='Tests/';
$list=scandir($dir);
$z=count(scandir('Tests/'))-1;
$x=2;

echo $_POST[name], "</br>";
$final = $_POST['yourname3'];

$file = file_get_contents("Tests/{$_POST[name]}"); 
$fileDecode = json_decode($file, true); 
$result = $fileDecode['calculate']['result']; "</br>";
   
echo "Правильный ответ ", $result, "</br>", $final, "  ";

if ($_POST[answer]==$result) {
echo "Ваш ответ правильный ", "Ваша оценка 5";}
else {echo "Ваш ответ неправильный ", "Ваша оценка 2"; header('Location: fail.php');}

?>
<form action="boom.php" METHOD="POST">
    <label><input name="sertif" type="hidden" value="Congratulations  "></label>
    <label><input name="name1" type="hidden" value=<?php echo $final?>></label>
    <label><?php echo "</br>", "</br>", $label;?></label>
    <button type="submit">Get your Certificate</button>
</form>

 



</body>
</html>
