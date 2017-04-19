<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Тест</title>
</head>
<?php
session_start();
$filename="Tests/{$_POST[number]}";
if (!file_exists("Tests/{$_POST[number]}")){
    header ("HTTP/1.0 404 Not found");
    echo "Not found", "</br> ";
exit;}
    else
    echo $_POST[number];
$file = file_get_contents("Tests/{$_POST[number]}");
$fileDecode = json_decode($file, true); 


$label = $fileDecode['calculate']['label'];
$type = $fileDecode['calculate']['input']['type'];
$result = $fileDecode['calculate']['result'];

echo '<br>';
echo '<br>';
echo '<br>';

$name=$_POST[number];

if (!$_POST['yourname2']) {$b=$_SESSION["user"]["login"];} else {$b=$_POST['yourname2'];}  //Имя, либо админа либо гостя

?>
<p></p>
<form action="result.php" METHOD="POST">
    <label><?php echo "Hello ",$b, "</br>";?></label>
    <label><input name="name" type="hidden" value=<?php echo $name; ?>></label>
    <label><input name="yourname3" type="hidden" value=<?php echo $b; ?>></label>
    <label><?php echo "</br>", "</br>", $label;?></label>
    Count <input name=answer type="<?php echo $type?>">
    <button type="submit">Answer</button>
</form>
