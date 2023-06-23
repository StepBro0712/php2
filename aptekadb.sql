-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 23 2023 г., 18:34
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `aptekadb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `international` varchar(100) NOT NULL,
  `creation_date` date NOT NULL,
  `end` date NOT NULL,
  `bull` tinyint(1) NOT NULL,
  `rf` varchar(100) NOT NULL,
  `producer` varchar(50) NOT NULL,
  `instructions` varchar(250) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `dace` date NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `quantity` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`id`, `name`, `international`, `creation_date`, `end`, `bull`, `rf`, `producer`, `instructions`, `phone`, `address`, `dace`, `price`, `quantity`) VALUES
(1, 'fewfewf', 'gregerg', '2023-06-23', '2023-07-01', 0, '34324324', 'fwfervevdcsdcsdc', 'cfewverfrevrv', '33123213213', 'ewdwecewcewce', '2003-12-12', 150000, '12'),
(2, 'Гиоксизон', 'Гиоксизон', '2023-06-23', '2023-07-08', 0, '123456', 'Гиоксизон.орг', 'Наружное применение', '+7 923 530 70 53', 'Томск', '2023-06-24', 150, '12'),
(3, 'Гиоксизонdd', 'вцddddd', '2012-02-12', '2025-03-04', 0, '12321312321', 'gregtrb trbetrbverb', 'terbtrfbtrfbtrbtrb', '324324324', 'btrbetfbrtbtrb', '2023-04-12', 12441234, '12'),
(4, 'Парацетамол', 'Парацетамол', '2023-06-23', '2023-07-09', 0, '34324324', 'Парацетамолю.орг', 'Внутренее применение', '+7 923 530 70 53', 'Томск', '2023-06-24', 150, '12');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `goods_invoice` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `company` varchar(120) NOT NULL,
  `quantity` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`user_id`, `name`, `price`, `goods_invoice`, `id`, `company`, `quantity`) VALUES
(1, 'Гиоксизон', 150, 124325, 5, 'TTIT', '1'),
(1, 'Гиоксизон', 150, 3423412, 6, 'TTIT', '1'),
(0, 'Гиоксизон', 120, 34333434, 7, 'TTIT', '1'),
(0, 'Гиоксизон', 150, 342341223, 8, 'TTIT', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `login` varchar(255) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `user_name`, `admin`, `login`, `pass`, `name`) VALUES
(1, 1, 1, 'admin', 'aef00d217db0774bb218be1c6e903f1e', 'admin'),
(2, 2, 0, 'loxlox', '368af43f2cd3b8fe8482263b6a209b7f', 'Гиоксизон');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
