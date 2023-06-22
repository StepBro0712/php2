<?php

$login = trim($_POST['login']);
$name = trim($_POST['name']);
$pass = trim($_POST['pass']);

if(mb_strlen($login) < 5 || mb_strlen($login) > 12) {
    echo "Недопустимая длина логина";
    exit();
} else if(mb_strlen($name) < 3 || mb_strlen($name) > 12) {
    echo "Недопустимая длина логина";
    exit();
} else if(mb_strlen($pass) < 2 || mb_strlen($pass) > 12) {
    echo "Недопустимая длина пароля";
    exit();
}

$pass = md5($pass."asdfas2rf2423");

$mysql = new mysqli('localhost', 'root', '', 'aptekadb');

if($mysql->connect_error){
    die("Ошибка: " . $mysql->connect_error);
}

$mysql->query("iNSERT INTO `users` (`login`, `pass`, `name`)
    VALUES('$login', '$pass', '$name')");

$mysql->close();

header('Location: /');

?>


