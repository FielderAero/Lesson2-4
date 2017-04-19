<?php
session_start();
function getUsers()
{
    $filePath = 'users.json';
    if (!file_exists($filePath)) {
        echo "no exist";
    }
    $fileData = file_get_contents($filePath);
    $data = json_decode($fileData, true);
    if (!$data) {
        echo "no data";
    }
    return $data;
}
function getUser($login)
{
    $users = getUsers();
    foreach ($users as $user) {
        if (strcmp($user['login'], $login) === 0) {
            return $user;
        }
    }
    return null;
}
function login($login, $password)
{
    $user = getUser($login);
    if ($user && $user['password'] == $password) {
        $_SESSION['user'] = $user;
        return true;
    }
    return false;
}
function isPost()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}
function getParamPost($name)
{
    return filter_input(INPUT_POST, $name);
}
function isLogged()
{
    return !empty($_SESSION['user']);
}
function getLoggedUser()
{
    return !empty($_SESSION['user']) ? $_SESSION['user'] : null;
}
function redirect($location)
{
    header("Location: $location");
    die;
}
function logout()
{
    session_destroy();
}
function hasAccess($role)
{
    return false;
}


