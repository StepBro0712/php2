<?php
$name = $_POST['name'];
$price = $_POST['price'];
$goods_invoice = $_POST['goods_invoice'];
$company = $_POST['company'];

if (empty($name) || empty($price) || empty($goods_invoice) || empty($company)) {
    echo "Пожалуйста, заполните все обязательные поля при создании заказа. <button onclick='history.back()'>Назад</button>";
    exit();
} elseif (mb_strlen($name) < 5) {
    echo "Недопустимое название";
    exit();
} elseif (mb_strlen($price) < 2 || mb_strlen($price) > 100) {
    echo "Недопустимая цена товара";
    exit();
} elseif (mb_strlen($goods_invoice) < 2 || mb_strlen($goods_invoice) > 100) {
    echo "Недопустимый номер заказа";
    exit();
} elseif (mb_strlen($company) < 2 || mb_strlen($company) > 100) {
    echo "Недопустимое название компании";
    exit();
}

$mysqli = new mysqli('localhost', 'root', '', 'aptekadb');

if ($mysqli->connect_error) {
    die("Ошибка: " . $mysqli->connect_error);
}

// Используем подготовленный запрос с параметрами, чтобы избежать SQL-инъекций
$sql = "SELECT COUNT(*) as count FROM orders WHERE `goods_invoice` = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $goods_invoice);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['count'] > 0) {
    echo "Заказ с таким номером уже существует.";
    exit();
}

// Если заказ с таким номером не существует, добавляем запись в базу данных
$name = $mysqli->real_escape_string($name);
$price = $mysqli->real_escape_string($price);
$goods_invoice = $mysqli->real_escape_string($goods_invoice);
$company = $mysqli->real_escape_string($company);

$sql = "INSERT INTO orders (`name`, `price`, `goods_invoice`, `company`)
        VALUES ('$name', '$price', '$goods_invoice', '$company')";

if ($mysqli->query($sql) === true) {
    echo "Отправлен.";
} else {
    echo "Ошибка: " . $mysqli->error;
}

$mysqli->close();

header('Location: /');
?>

<?php
require_once '../create/connect.php';

$name = $_POST['name'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];

// получаем информацию о товаре из базы данных
$good = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `goods` WHERE `name`='$name' AND `price`='$price'"));

// проверяем, есть ли товар в наличии
if ($good['quantity'] >= $quantity) {
    // вычитаем количество товара из базы данных
    mysqli_query($connect, "UPDATE `goodsSET `quantity`=`quantity`-'$quantity' WHERE `name`='$name' AND `price`='$price'");

    // добавляем информацию о заказе в базу данных
    mysqli_query($connect, "INSERT INTO `orders` (`good_id`, `user_id`, `quantity`) VALUES ('".$good['id']."', '".$_COOKIE['user']."', '$quantity')");

    // выводим информацию о заказе на странице
    echo "<h1>Заказ оформлен</h1>";
    echo "<p>Товар: ".$good['name']."</p>";
    echo "<p>Цена: ".$good['price']."</p>";
    echo "<p>Количество: ".$quantity."</p>";
} else {
    // выводим сообщение об ошибке, если товара недостаточно
    echo "<h1>Ошибка оформления заказа</h1>";
    echo "<p>Товара недостаточно</p>";
}
?>

<?php
require_once '../create/connect.php';

$order = mysqli_fetch_assoc(mysqli_query($connect, "SELECT `orders`.`quantity`, `goods`.`name`, `goods`.`price` FROM `orders` JOIN `goods` ON `orders`.`good_id`=`goods`.`id` WHERE `orders`.`id`='".$_GET['id']."'"));

echo "<h1>Информация о заказе</h1>";
echo "<p>Товар: ".$order['name']."</p>";
echo "<p>Цена: ".$order['price']."</p>";
echo "<p>Количество: ".$order['quantity']."</p>";
?>




