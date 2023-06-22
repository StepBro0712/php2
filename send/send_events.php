<?php
//--------------------------------------------
$title = $_POST['title'];
$description = $_POST['description'];
$location = $_POST['location'];
$start_date = $_POST['start_date'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
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
$location = $mysqli->real_escape_string($location);
$start_date = $mysqli->real_escape_string($start_date);
$start_time = $mysqli->real_escape_string($start_time);
$end_time = $mysqli->real_escape_string($end_time);

$sql = "INSERT INTO events (`title`, `description`, `start_date`, `start_time`, `end_time`, `location`)
VALUES ('$title', '$description', '$start_date', '$start_time', '$end_time', '$location')";

if ($mysqli->query($sql) === true) {
echo "Данные успешно добавлены в таблицу.";
} else {
echo "Ошибка: " . $mysqli->error;
}

$mysqli->close();

header('Location: /');
?>