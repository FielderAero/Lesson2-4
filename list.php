<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Список</title>
</head>
<?php
session_start();
$delete=$_POST['delete'];
unlink("Tests/$delete");

?>

<?php
header('Content-Type: text/html; charset=utf-8');
$dir ='Tests/';
$list=scandir($dir);
$z=count(scandir('Tests/'))-1;
$x=2;
if ($_POST['yourname']!=$_SESSION["user"]["login"]) {$a=$_POST['yourname'];} else { $a=$_SESSION["user"]["login"];}
do {
    ?>
<form action="test.php" method="POST">
<div>
    <label><input name="yourname2" type="hidden" value="<?php echo $a; ?>"></label>
    <label><input name="number" type="radio" value="<?php echo $list[$x]; ?>"></label>
</div>


<?php
    echo $list[$x],"  ", "</br>";
     

    
}   while ($x++<$z);

?> 

<button type="submit">Пройти</button>  
 
    






<?php
require_once 'functions.php';
if (empty($_SESSION["user"]["login"]) && empty($_SESSION["user"]["password"]) && empty($_POST['yourname'])) {
header ('WWW-Authenticate: Basic realm="boom"');
header('Location: start.php');
}


$user = getUser($_SESSION["user"]["login"]);

if (((strcmp($_POST['yourname'], $_SESSION["user"]["login"])===0)||empty($_POST['yourname'])) && ($user['password']==$_SESSION["user"]["password"]))
    {
        echo "</br>", "You can download new tests", "</br>", '<a href="admin.php">admin.php</a>', "</br>";
echo "</br>", "Also, as administrator, you can delete Tests ", '<a href="unlink.php">unlink.php</a>', "</br>";    }
       ?>
           

 

