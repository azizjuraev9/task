-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 11 2018 г., 13:39
-- Версия сервера: 10.1.34-MariaDB
-- Версия PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `task`
--

-- --------------------------------------------------------

--
-- Структура таблицы `gifts`
--

CREATE TABLE `gifts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gifts`
--

INSERT INTO `gifts` (`id`, `name`, `image`, `amount`, `status`) VALUES
(1, 'Samsung Galaxsy S9', 'uploads/1539180573_5bbe081d9d17c.png', 29, 1),
(4, 'Xiaomi mi5', 'uploads/1539190463_5bbe2ebfd826d.png', 34, 1),
(5, 'Huawei P9', 'uploads/1539190495_5bbe2edf799dc.png', 35, 1),
(6, 'Acer Predator_PT715', 'uploads/1539190527_5bbe2eff75f79.png', 10, 1),
(7, 'ASUS G51J 3D', 'uploads/1539190558_5bbe2f1e3af13.png', 10, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `params`
--

CREATE TABLE `params` (
  `id` int(11) NOT NULL,
  `key` varchar(20) NOT NULL,
  `value` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `params`
--

INSERT INTO `params` (`id`, `key`, `value`, `desc`) VALUES
(6, 'min_units', '2', 'Min units to win'),
(3, 'available_money', '44840', 'Available Money'),
(4, 'min_money', '25', 'Min money to win'),
(5, 'max_money', '200', 'Max money to win'),
(7, 'max_units', '25', 'Max units to win'),
(8, 'rotate_cost', '30', 'Rotate cost'),
(9, 'conversion_ratio', '0.3', '1 Euro = X Units');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(70) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `units` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `lastname`, `units`, `status`, `role`) VALUES
(1, 'aziz', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'azizjuraev9@gmail.com', 'Aziz', 'Juraev', 654, 1, 'admin'),
(3, 'ibrohim', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'ibrohim@gmail.com', 'Ibrohim', 'Bratan', 0, 1, 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `user_gift`
--

CREATE TABLE `user_gift` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gift_id` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT '1',
  `money` int(11) DEFAULT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_gift`
--

INSERT INTO `user_gift` (`id`, `user_id`, `gift_id`, `status`, `money`, `time`) VALUES
(1, 1, 4, 2, NULL, '2018-10-11 05:54:17'),
(2, 1, 1, 1, NULL, '2018-10-11 05:54:17'),
(3, 1, 0, 2, 106, '2018-10-11 05:54:17'),
(4, 1, 0, 2, 36, '2018-10-11 10:04:05');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `gifts`
--
ALTER TABLE `gifts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `params`
--
ALTER TABLE `params`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`key`),
  ADD UNIQUE KEY `key_2` (`key`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Индексы таблицы `user_gift`
--
ALTER TABLE `user_gift`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`gift_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `gifts`
--
ALTER TABLE `gifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `params`
--
ALTER TABLE `params`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `user_gift`
--
ALTER TABLE `user_gift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
