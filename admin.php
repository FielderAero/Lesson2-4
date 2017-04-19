<?php 
session_start();
require_once 'functions.php';
$user = getUser($_SESSION["user"]["login"]);

if ($user['password']!==$_SESSION["user"]["password"] || empty($_SESSION["user"]["password"]))
{
     header ("HTTP/1.0 403 Access denied");
     echo "Access denied", $user['password']; "</br> ";
}
else {
?>

<form enctype="multipart/form-data" action="21.php" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="30000">
Download file: <input name="userfile" type="file">
<input type="submit" value="Send File">
</form>
<?php }?>
