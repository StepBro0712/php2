
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
                    <h1>Создать заказ </h1>
                    <form action="create/order.php" method="post">
                        <label><input type="text" class="form-name" name="name" id="name"
                                      placeholder="Название товара"></label><br>
                        <label><input type="text" class="form-price" name="price" id="price"
                                      placeholder="Цена товара"></label><br>
                        <label><input type="text" class="form-goods_invoice" name="goods_invoice" id="goods_invoice"
                                      placeholder="Номер приходной накладной ведомости"></label><br>
                        <label><input type="text" class="form-company" name="company" id="company"
                                      placeholder="Название покупателя"></label><br>
                        <button class="btn btn-success" type="submit">Отправить</button>
                    </form>
                </div>
                <div class="col">
                    <h1>Список товаров</h1>
                    <?php
                    require_once 'create/connect.php';
                    $itemsResult = mysqli_query($connect, "SELECT * FROM `orders`");
                    ?>
                    <table>
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Цена</th>
                            <th>Номер приходной ведомости</th>
                            <th>Название покупателя</th>
                            <th>Количество</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($item = mysqli_fetch_assoc($itemsResult)) { ?>
                            <tr>
                                <td><?= $item['name'] ?></td>
                                <td><?= $item['price'] ?></td>
                                <td><?= $item['goods_invoice'] ?></td>
                                <td><?= $item['company'] ?></td>
                                <td><?= $item['quantity'] ?></td>
                                <td>
                                    <form action="delete/item.php" method="post">
                                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>