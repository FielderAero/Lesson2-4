<?php
$uploaddir = 'Tests/';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir .
    $_FILES['userfile']['name'])) {
    print "Success.";
    header('Location: list.php');
} else {
    print "Ошибка";
}
?>
