<?php
//--------------------------------------------
$name = $_POST['name'];
$international = $_POST['international'] ?? '';
$creation_date = $_POST['creation_date'];
$end = $_POST['end'];
$bull = $_POST['bull'];
$rf = $_POST['rf'];
$producer = $_POST['producer'];
$instructions = $_POST['instructions'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$dace = $_POST['dace'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];


//--------------------------------------------

//--------------------------------------------


if (empty($name) || empty($international) || empty($creation_date) || empty($end) ||
    empty($bull) || empty($rf) || empty($producer) || empty($instructions) ||
    empty($address) |empty($quantity) || empty($phone) || empty($dace) || empty($price)) {
    echo "Пожалуйста, заполните все обязательные поля при добавлении предмета. <button onclick='history.back()'>Назад</button>";
    exit();
}

else if (mb_strlen($name) < 5) {
    echo "Недопустимое название";
    exit();
}

else if (mb_strlen($international) < 2 || mb_strlen($international) > 100) {
    echo "Недопустимое международное название лекарства";
    exit();
}

else if (mb_strlen($creation_date) < 2 || mb_strlen($creation_date) > 100) {
    echo "Недопустимая дата производства";
    exit();
}

else if (mb_strlen($end) < 2 || mb_strlen($end) > 100) {
    echo "Недопустимый срок годности";
    exit();
}

else if (mb_strlen($bull) < 2 || mb_strlen($bull) > 100) {
    echo "Недопустимая длина описания";
    exit();
}

else if (mb_strlen($rf) < 2 || mb_strlen($rf) > 100) {
    echo "Недопустимый регистрационный номер Минздрава РФ";
    exit();
}

else if (mb_strlen($producer) < 2 || mb_strlen($producer) > 100) {
    echo "Недопустимые данные о производителе";
    exit();
}


else if (mb_strlen($instructions) < 2 || mb_strlen($instructions) > 100) {
    echo "Недопустимая инструкция к лекарству";
    exit();
}

else if (mb_strlen($address) < 2 || mb_strlen($address) > 100) {
    echo "Недопустимый вид упаковки";
    exit();
}

else if (mb_strlen($phone) < 2 || mb_strlen($phone) > 100) {
    echo "Недопустимый телефон поставщика";
    exit();
}

else if (mb_strlen($dace) < 2 || mb_strlen($dace) > 100) {
    echo "Недопустимая дата поступления на склад";
    exit();
}

if (mb_strlen($price) < 2 || mb_strlen($price) > 100) {
    echo "Недопустимая цена товара";
    exit();
}
if (mb_strlen($quantity) < 2 || mb_strlen($quantity) > 100) {
    echo "Недопустимое колличество";
    exit();
}



$mysqli = new mysqli('localhost', 'root', '', 'aptekadb');

if ($mysqli->connect_error) {
    die("Ошибка: " . $mysqli->connect_error);
}

$name= $mysqli->real_escape_string($name);
$international= $mysqli->real_escape_string($international);
$creation_date= $mysqli->real_escape_string($creation_date);
$end= $mysqli->real_escape_string($end);
$bull= $mysqli->real_escape_string($bull);
$rf= $mysqli->real_escape_string($rf);
$producer= $mysqli->real_escape_string($producer);
$instructions= $mysqli->real_escape_string($instructions);
$address= $mysqli->real_escape_string($address);
$phone= $mysqli->real_escape_string($phone);
$dace= $mysqli->real_escape_string($dace);
$price= $mysqli->real_escape_string($price);
$quantity= $mysqli->real_escape_string($quantity);

$sql = "INSERT INTO items (`name`, `international`, `creation_date`, `end`, `bull`, `rf`, `producer`, `instructions`, `address`,
                  `phone`, `dace`,`quantity`, `price`)
        VALUES ('$name', '$international', '$creation_date', '$end', '$bull', '$rf', '$producer', '$instructions', '$address',
                  '$phone', '$dace','$quantity', '$price')";

if ($mysqli->query($sql) === true) {
    echo "Данные успешно добавлены в базу данных.";
} else {
    echo "Ошибка: " . $mysqli->error;
}

$mysqli->close();

header('Location: /');
?>