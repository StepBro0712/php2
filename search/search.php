<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel='stylesheet' type="text/css" href='css/style.css'>
</head>
<body>
<div class="container mt-4">
    <?php
    if (!isset($_COOKIE['user'])) {
        header('Location: /');
        exit();
    }
    ?>

    <div class="row">
        <div class="col">
            <?php
            $search = $_POST['search'];
            $type = $_POST['type']; // Дополнительный параметр для определения типа поиска

            $mysqli = new mysqli('localhost', 'root', '', 'aptekadb');

            if ($mysqli->connect_error) {
                die("Ошибка: " . $mysqli->connect_error);
            }

            $search = $mysqli->real_escape_string($search);
            $search_like = $search . '%';

            // Выполнение разных запросов в зависимости от типа поиска
            if ($type === 'notes') {
                $result = $mysqli->query("SELECT `title`, `description`, `created_at` FROM notes WHERE `title` LIKE '$search_like'");
                $title_label = 'Заголовок';
                $description = 'Содержание';
                $created_at = 'Создана';

            } elseif ($type === 'tasks') {
                $result = $mysqli->query("SELECT `title`, `description`, `start_time`, `end_time`, `priority` FROM tasks WHERE `title` LIKE '$search_like'");
                $title_label = 'Задача';
                $description = 'Описание';
                $start_time = 'Время начала';
                $end_time = 'Время окончания';
                $priority = 'Приоритет';
            } elseif ($type === 'events') {
                $result = $mysqli->query("SELECT `title`, `description`, `location`, `start_date`, `start_time`, `end_time` FROM events WHERE `title` LIKE '$search_like'");
                $title_label = 'Название';
                $description = 'Описание';
            } else {
                echo "Некорректный тип поиска.";
                $mysqli->close();
                exit();
            }

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <p>
                        <?= $title_label; ?>: <?= $row['title']; ?><br>
                        <?= $description; ?>: <?= $row['description']; ?><br>

                        <!-- Дополнительные поля для задач и событий -->
                        <?php if ($type === 'tasks') { ?>
                            Дата начала: <?= $row['start_time']; ?><br>
                            Дата окончания: <?= $row['end_time']; ?><br>
                            Приоритет: <?= $row['priority']; ?><br>
                        <?php } elseif ($type === 'events') { ?>
                            Место: <?= $row['location']; ?><br>
                            Дата: <?= $row['start_date']; ?><br>
                            Время начала: <?= $row['start_time']; ?><br>
                            Время окончания: <?= $row['end_time']; ?><br>
                        <?php } ?>
                    </p>
                    <?php
                }
            } else {
                echo "Ничего не найдено.";
            }

            $mysqli->close();
            ?>

            <br>
            <button class="btn btn-secondary" onclick="goBack()">Назад</button>

            <script>
                function goBack() {
                    window.history.back();
                }
            </script>
        </div>
    </div>

</div>
</body>
</html>