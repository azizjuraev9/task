-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 12 2018 г., 04:18
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
-- База данных: `task_yii`
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
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gifts`
--

INSERT INTO `gifts` (`id`, `name`, `image`, `amount`, `status`) VALUES
(1, 'Samsung Galaxsy S9', '/uploads/1539180573_5bbe081d9d17c.png', 28, 1),
(4, 'Xiaomi mi5', '/uploads/1539190463_5bbe2ebfd826d.png', 32, 1),
(5, 'Huawei P9', '/uploads/1539190495_5bbe2edf799dc.png', 35, 1),
(6, 'Acer Predator_PT715', '/uploads/1539190527_5bbe2eff75f79.png', 10, 1),
(7, 'ASUS G51J 3D', '/uploads/1539190558_5bbe2f1e3af13.png', 9, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1539262703),
('m130524_201442_init', 1539262705),
('m181011_125911_gifts', 1539263525),
('m181011_125931_params', 1539263526),
('m181011_125946_user_gifts', 1539263595);

-- --------------------------------------------------------

--
-- Структура таблицы `params`
--

CREATE TABLE `params` (
  `id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `params`
--

INSERT INTO `params` (`id`, `key`, `value`, `desc`) VALUES
(1, 'available_money', '54710', 'Available Money'),
(2, 'min_units', '2', 'Min units to win'),
(3, 'min_money', '25', 'Min money to win'),
(4, 'max_money', '200', 'Max money to win'),
(5, 'max_units', '25', 'Max units to win'),
(6, 'rotate_cost', '30', 'Rotate cost'),
(7, 'conversion_ratio', '0.3', '1 Euro = X Units');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `units` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `units`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'aziz', 'GbUcH5fl_bWbsWPH3uKjZ3qHLMy5tBVZ', '$2y$13$jYbEChzYVrHQstKkziOQyOkTcJEOZn.hcXnwfDpiPsx/taOVVPpdW', NULL, 1001, 'azizjuraev@gmail.com', 10, 1539263802, 1539304225);

-- --------------------------------------------------------

--
-- Структура таблицы `user_gifts`
--

CREATE TABLE `user_gifts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gift_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `money` int(11) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_gifts`
--

INSERT INTO `user_gifts` (`id`, `user_id`, `gift_id`, `status`, `money`, `time`) VALUES
(1, 1, 7, 2, NULL, '2018-10-11 21:06:39'),
(2, 1, 4, 1, NULL, '2018-10-11 21:37:55'),
(3, 1, NULL, 2, 105, '2018-10-11 21:38:06'),
(4, 1, NULL, 2, 26, '2018-10-11 21:38:47'),
(5, 1, NULL, 2, 45, '2018-10-11 22:07:25'),
(6, 1, NULL, 2, 98, '2018-10-12 00:27:38'),
(7, 1, NULL, 2, 145, '2018-10-12 00:31:29'),
(8, 1, NULL, 2, 145, '2018-10-12 00:31:47'),
(9, 1, NULL, 2, 145, '2018-10-12 00:32:20'),
(10, 1, NULL, 2, 145, '2018-10-12 00:33:31'),
(11, 1, NULL, 2, 145, '2018-10-12 00:34:35'),
(12, 1, NULL, 2, 145, '2018-10-12 00:34:46');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `gifts`
--
ALTER TABLE `gifts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `params`
--
ALTER TABLE `params`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`key`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`),
  ADD UNIQUE KEY `units` (`units`);

--
-- Индексы таблицы `user_gifts`
--
ALTER TABLE `user_gifts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-user_gifts-user_id` (`user_id`),
  ADD KEY `idx-user_gifts-gift_id` (`gift_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `user_gifts`
--
ALTER TABLE `user_gifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `user_gifts`
--
ALTER TABLE `user_gifts`
  ADD CONSTRAINT `fk-user_gifts-gift_id` FOREIGN KEY (`gift_id`) REFERENCES `gifts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-user_gifts-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
