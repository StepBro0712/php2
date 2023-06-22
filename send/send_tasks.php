<?php
//--------------------------------------------
$title = $_POST['title'];
$description = $_POST['description'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$priority = $_POST['priority'];
//--------------------------------------------

//--------------------------------------------

if (empty($title) || empty($description) || empty($start_time) || empty($end_time) || empty($priority)) {
    echo "Пожалуйста, заполните все обязательные поля при добавлении заметки. <button onclick='history.back()'>Назад</button>";
    exit();
}

if (mb_strlen($title) < 5) {
    echo "Недопустимое имя/название";
    exit();
}

if (mb_strlen($description) < 2 || mb_strlen($description) > 100) {
    echo "Недопустимая длина описания";
    exit();
}

$mysqli = new mysqli('localhost', 'root', '', 'aptekadb');

if ($mysqli->connect_error) {
    die("Ошибка: " . $mysqli->connect_error);
}

$title = $mysqli->real_escape_string($title);
$description = $mysqli->real_escape_string($description);
$start_time = $mysqli->real_escape_string($start_time);
$end_time = $mysqli->real_escape_string($end_time);
$priority = $mysqli->real_escape_string($priority);

$sql = "INSERT INTO tasks (`title`, `description`, `start_time`, `end_time`, `priority`)
        VALUES ('$title', '$description', '$start_time', '$end_time', '$priority')";

if ($mysqli->query($sql) === true) {
    echo "Данные успешно добавлены в таблицу.";
} else {
    echo "Ошибка: " . $mysqli->error;
}

$mysqli->close();

header('Location: /');
?>