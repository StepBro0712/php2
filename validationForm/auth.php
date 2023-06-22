<?php
$login = trim($_POST['login']);
$pass = trim($_POST['pass']);

$pass = md5($pass."asdfas2rf2423");

$mysql = new mysqli('localhost', 'root', '', 'aptekadb');

if($mysql->connect_error){
die("Ошибка: " . $mysql->connect_error);
}

$result = $mysql->query("SELECT * FROM users WHERE login = '$login' AND pass = '$pass'");
$user = $result->fetch_assoc();
if(empty($user)){
echo "Пользователь не найден";
exit();
}

setcookie('user', $user['name'], time() + 3600, "/");

$mysql->close();

header('Location: /');
?>


