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


























<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>apteka</title>
    <link href="css/style.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>
<div class="apteka mt-4">
    <?php if(($_COOKIE['user'] ?? '') === ''): ?>
    <div class="row">
        <div class="col">
            <h1>Регистрация</h1>
            <form class="registration" action="validationForm/check.php" method="post">
                <label><input type="text" class="form-control" name="name" id="name"
                              placeholder="Введите имя"></label>
                <br>
                <label><input type="text" class="form-control" name="login" id="login"
                              placeholder="Введите логин"></label>
                <br>

                <label><input type="password" class="form-control" name="pass" id="pass"
                              placeholder="Введите пароль"></label>
                <br>
                <button class="btn btn-success" type="submit">Зарегистрироваться</button>
            </form>
        </div>
        <div class="col">
            <h1>Авторизация</h1>
            <form class="auth" action="validationForm/auth.php" method="post">
                <label><input type="text" class="form-control" name="login" id="login"
                              placeholder="Введите логин"></label><br>
                <label><input type="password" class="form-control" name="pass" id="pass"
                              placeholder="Введите пароль"></label><br>

                <button class="btn btn-success" type="submit">Войти</button>
            </form>
        </div>
        <?php else:?>
            <div class="search">
                <h1>Поиск</h1>
                <form action="search/search.php" method="post">
                    <label><input type="text" class="form-control" name="search" id="search" placeholder="Название"></label><br>
                    <button class="btn btn-success" type="submit">Отправить</button>
                </form>
            </div>
            <div class="container mt-4">
                <div class="row">
                    <div class="col">
                        <h1>Добавить товар</h1>
                        <form action="create/goods.php" method="post">
                            <label><input type="text" class="form-name" name="name" id="name"
                                          placeholder="	Название товара"></label><br>
                            <label><input type="text" class="form-international" name="international" id="international"
                                          placeholder="Международное название лекарства"></label><br>
                            <br><p>Дата производства</p>
                            <label><input type="date" class="form-begin" name="creation_date" id="creation_date"></label><br>
                            <br><p>Годен до</p>
                            <label><input type="date" class="form-end" name="end" id="end"></label><br>
                            <label><input type="checkbox" class="form-bull" name="bull" id="bull"
                                          placeholder="Одобрено Минздравом РФ"></label><br>
                            <label><input type="text" class="form-rf" name="rf" id="rf"
                                          placeholder="Регистрационный номер Минздрава РФ"></label><br>
                            <label><input type="text" class="form-producer" name="producer" id="producer"
                                          placeholder="Данные о производителе"></label><br>
                            <label><input type="textarea" class="form-instructions" name="instructions" id="instructions"
                                          placeholder="Инструкция к лекарству"></label><br>
                            <label><input type="text" class="form-address" name="address" id="address"
                                          placeholder="Адрес поставщика"></label><br>
                            <label><input type="text" class="form-phone" name="phone" id="phone"
                                          placeholder="Телефон поставщика"></label><br>
                            <br><p>	Дата поступления на склад</p>
                            <label><input type="date" class="form-dace" name="dace" id="dace"></label><br>
                            <label><input type="number" class="form-control" name="price" id="price" placeholder="Цена"></label><br>
                            <label><input type="number" class="form-control" name="quantity" id="quantity"
                                          placeholder="Введите количество"></label><br>
                            <button class="btn btn-success" type="submit">Добавить товар</button>
                        </form>
                    </div>
                    <div class="col">
                        <h1>Список товаров</h1>
                        <?php
                        require_once 'create/connect.php';
                        $items = mysqli_query($connect, "SELECT * FROM `items`");
                        ?>
                        <table>
                            <thead>
                            <tr>
                                <th>Название</th>
                                <th>Международное название</th>
                                <th>Дата производства</th>
                                <th>Годен до</th>
                                <th>Одобрено Минздравом РФ</th>
                                <th>Регистрационный номер Минздрава РФ</th>
                                <th>Дата поступления на склад</th>
                                <th>Цена</th>
                                <th>Количество</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while ($items = mysqli_fetch_assoc($items)) { ?>
                                <tr>
                                    <td><?= $items['name'] ?></td>
                                    <td><?= $items['international'] ?></td>
                                    <td><?= $items['creation_date'] ?></td>
                                    <td><?= $items['end'] ?></td>
                                    <td><?= $items['bull'] ?></td>
                                    <td><?= $items['rf'] ?></td>
                                    <td><?= $items['dace'] ?></td>
                                    <td><?= $items['price'] ?></td>
                                    <td><?= $items['quantity'] ?></td>
                                    <td><a href="create/delete.php?id=<?= $item['id'] ?>">Удалить</a></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="container mt-4">
                <div class="row">
                    <div class="col">
                        <h1>Оформление заказа</h1>
                        <form action="create/order.php" method="post">
                            <label><input type="text" class="form-control" name="name" id="name"
                                          placeholder="Введите название товара"></label><br>
                            <label><input type="number" class="form-control" name="price" id="price"
                                          placeholder="Цена"></label><br>
                            <label><input type="number" class="form-control" name="quantity" id="quantity"
                                          placeholder="Количество"></label><br>

                            <button class="btn btn-success" type="submit">Оформить заказ</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="container mt-4">
                <div class="row">
                    <div class="col">
                        <h1>Выход</h1>
                        <form action="validationForm/exit.php">
                            <button class="btn btn-danger" type="submit">Выйти из аккаунта</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif;?>
    </div>
    <script src="js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>

