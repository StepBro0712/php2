<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>apteka</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel='stylesheet' type="text/css" href='css/style.css'>
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
                    <label><input type="text" class="form-control" name="search" id="search" placeholder="Имя/название"></label><br>

                    <label for="type">Тип поиска:</label>
                    <select class="form-control" name="type" id="type">
                        <option value="notes">Заметки</option>
                        <option value="tasks">Задачи</option>
                        <option value="events">События</option>
                    </select><br>

                    <button class="btn btn-success" type="submit">Отправить</button>
                </form>
            </div>
            <div class="container mt-4">
                <div class="row">
                    <div class="col">
                        <h1>Добавить заметку</h1>
                        <form action="send/send_notes.php" method="post">
                            <label><input type="text" class="form-control" name="title" id="title"
                                          placeholder="Название"></label><br>
                            <label><input type="text" class="form-control" name="description" id="description"
                                          placeholder="Введите описание"></label><br>
                            <label  for="date-input" class="form-label">Дата создания</label>
                            <input type="date" class="form-control" name="created_at" id="created_at">
                            <button class="btn btn-success" type="submit">Отправить</button>
                        </form>
                    </div>
                    <div class="col">
                        <h1>Добавить задачу</h1>
                        <form action="send/send_tasks.php" method="post">
                            <label><input type="text" class="form-control" name="title" id="title"
                                          placeholder="Название"></label><br>
                            <label><input type="text" class="form-control" name="description" id="description"
                                          placeholder="Введите описание"></label><br>
                            <label for="time-input" class="form-label">Время начала</label>
                            <input type="time" class="form-control" name="start_time" id="start_time">
                            <label for="time-input" class="form-label">Время конца</label>
                            <input type="time" class="form-control" name="end_time" id="end_time">
                            <label for="priority-select" class="form-label">Приоритет</label>
                            <select class="form-select" name="priority" id="priority">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                            <button class="btn btn-success" type="submit">Отправить</button>
                        </form>
                    </div>
                    <div class="col">
                        <h1>Добавить событие</h1>
                        <form action="send/send_events.php" method="post">
                            <label><input type="text" class="form-control" name="title" id="title"
                                          placeholder="Название"></label><br>
                            <label><input type="text" class="form-control" name="description" id="description"
                                          placeholder="Введите описание"></label><br>
                            <label><input type="text" class="form-control" name="location" id="location"
                                          placeholder="Место"></label><br>
                            <label  for="date-input" class="form-label">Дата события</label>
                            <input type="date" name="start_date" class="form-control" id="start_date">
                            <label for="time-input" class="form-label">Время начала</label>
                            <input type="time" class="form-control" name="start_time" id="start_time">
                            <label for="time-input" class="form-label">Время конца</label>
                            <input type="time" name="end_time" class="form-control" id="end_time">
                            <button class="btn btn-success" type="submit">Отправить</button>
                        </form>
                    </div>
                    <div class="col">
                        <p>Салют, <?=$_COOKIE['user']?></a></p>
                        <p>Привет <?=$_COOKIE['user']?>. Чтобы выйти нажмите <a href="exit.php">здесь<<</a></p>

                        <a href="/exit.php"><button  type="button" class="btn btn-secondary"> Выход </button></a>
                    </div>
                </div>
                <br>
            </div>
        <?php endif;?>
    </div>

</div>
</body>
</html>
