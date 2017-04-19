<?php
session_start();
require_once 'functions.php';
$user = getUser($_SESSION["user"]["login"]);

if ($user['password']!==$_SESSION["user"]["password"] || empty($_SESSION["user"]["password"]))
{
     header ("HTTP/1.0 403 Access denied");
     echo "Access denied", $user['password']; "</br> "; exit();
}


header('Content-Type: text/html; charset=utf-8');
$dir ='Tests/';
$list=scandir($dir);
$z=count(scandir('Tests/'))-1;
$x=2;
do {
     ?>
<form action="list.php" method="POST">
<div>
   
    <label><input name="delete" type="radio" value="<?php echo $list[$x]; ?>"></label>
</div>


<?php
    echo $list[$x],"  ", "</br>";
    
}   while ($x++<$z);
?>
<button type="submit">Удалить</button>

