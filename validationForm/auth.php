<?php
$login = trim($_POST['login']);
$pass = trim($_POST['pass']);

$pass = md5($pass."asdfas2rf2423");

$mysql = new mysqli('localhost', 'root', '', 'aptekadb');

if($mysql->connect_error){
    die("Ошибка: " . $mysql->connect_error);
}

$stmt = $mysql->prepare("SELECT * FROM users WHERE login = ? AND pass = ?");
$stmt->bind_param("ss", $login, $pass);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if(empty($user)){
    echo "Пользователь не найден";
    exit();
}

setcookie('user', $user['name'], time() + 3600, "/");

$mysql->close();

if ($user['admin'] == '1') {
    // Устанавливаем переменную сессии $_SESSION['admin'] в true для администратора
    session_start();
    $_SESSION['admin'] = true;
    header('Location: /Pr2');
} else {
    header('Location: /Pr2/user.php');
}
?>