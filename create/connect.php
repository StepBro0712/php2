<?php

// параметры подключения к базе данных
$host = "localhost"; // адрес сервера базы данных
$user = "root"; // имя пользователя базы данных
$password = ""; // пароль пользователя базы данных
$db_name = "aptekadb"; // название базы данных

// подключение к базе данных
$connect = mysqli_connect($host, $user, $password, $db_name);

// проверка успешности подключения
if (!$connect) {
    die("Ошибка подключения к базе данных: " . mysqli_connect_error());
}

?>