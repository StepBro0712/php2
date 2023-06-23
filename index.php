<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>apteka</title>
    <link href="css/style.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>
<div class="apteka mt-4">
    <?php
    if(($_COOKIE['user'] ?? '') === ''):
    ?>
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
                            <label><input type="text" class="form-price" name="price" id="price"
                                          placeholder="	Цена товара"></label><br>

                            <button class="btn btn-success" type="submit">Отправить</button>
                        </form>
                    </div>
                    <div class="col">
                        <h1>Создать заказ</h1>
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
                        $itemsResult = mysqli_query($connect, "SELECT * FROM `items`");
                        ?>
                        <table>
                            <thead>
                            <tr>
                                <th>Название</th>
                                <th>Международное название</th>
                                <th>Дата производства</th>
                                <th>Годен до</th>
                                <th>Цена</th>
                                <th>Количество</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while ($item = mysqli_fetch_assoc($itemsResult)) { ?>
                                <tr>
                                    <td><?= $item['name'] ?></td>
                                    <td><?= $item['international'] ?></td>
                                    <td><?= $item['creation_date'] ?></td>
                                    <td><?= $item['end'] ?></td>
                                    <td><?= $item['price'] ?></td>
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
                    <div class="col">
                        <p>Нажмите чтобы <a href="exit.php">выйти</a></p>
                    </div>
                </div>
                <br>
            </div>
        <?php endif;?>
    </div>

</div>
</body>
</html>
