<?php
require_once 'functions.php';
session_start();
if (isLogged()) {
    redirect('session.php');
}

if (isPost()) {
    if(login(getParamPost('login'), getParamPost('password'))) {
    redirect('session.php');
    } else {
        if (!empty($_SESSION["user"]["login"])||!empty($_SESSION["user"]["passoword"])) { echo "wrong login/password";}
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Session Auth</title>
</head>
<body>
    <ul>
    <?php foreach ($errors as $error): ?>
        <li><?= $error ?></li>
    <?php endforeach; ?>
    </ul>
    <?php if (!isLogged()): ?>
        <form method="POST">
            <label for="login">Логин</label>
            <input type="text" value="<?= (string)getParamPost('login') ?>" name="login" id="login">
            <label for="password">Пароль</label>
            <input type="password" value="<?= (string)getParamPost('password') ?>" name="password" id="password">
            <button type="submit">Войти</button>
        </form>
    <?php endif; ?>
</body>
</html>