<?php
$mysqli = new mysqli('localhost', 'root', '', 'aptekadb');
$search = ($_POST['search']);
$search = $mysqli->real_escape_string($search);
$search_like = $search . '%';



if($mysqli->connect_error){
    die("Ошибка: " . $mysqli->connect_error);
}

$result = $mysqli->query("SELECT `name`, `instructions`, `price` FROM items WHERE `name` LIKE '$search_like' ");

while ($row = $result->fetch_assoc()) {
    ?>

    <p>
        Имя: <?= $row['name']; ?><br>
        Номер: <?= $row['instructions']; ?><br>
        Цена: <?= $row['price']; ?><br>
        <br>
        <button class="btn btn-secondary" onclick="goBack()">Назад</button>

        <script>
            function goBack() {
                window.history.back();
            }
        </script>
    </p>
    <?php
}

$mysqli->close();

?>