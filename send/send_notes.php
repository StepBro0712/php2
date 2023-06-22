<?php
//--------------------------------------------
$title = $_POST['title'];
$description = $_POST['description'];
$created_at = $_POST['created_at'] ?? '';
//--------------------------------------------

//--------------------------------------------


if (empty($title) || empty($description) || empty($created_at)) {
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

$sql = "INSERT INTO notes (`title`, `description`, `created_at`)
        VALUES ('$title','$description','$created_at')";

if ($mysqli->query($sql) === true) {
    echo "Данные успешно добавлены в таблицу.";
} else {
    echo "Ошибка: " . $mysqli->error;
}

$mysqli->close();

header('Location: /');
?>