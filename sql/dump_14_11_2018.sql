-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Ноя 14 2018 г., 06:34
-- Версия сервера: 8.0.13
-- Версия PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `hmdoll`
--

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'идентификатор',
  `name` varchar(255) NOT NULL COMMENT 'наименование изделия',
  `description` text NOT NULL COMMENT 'описание',
  `dimensions` varchar(20) NOT NULL COMMENT 'размеры',
  `status` int(11) NOT NULL COMMENT 'статус готовности (спр)',
  `type` int(11) NOT NULL COMMENT 'тип изделия (спр)',
  `material` int(11) NOT NULL COMMENT 'материал изделия (спр)',
  `price` int(11) NOT NULL COMMENT 'Цена',
  `ready` tinyint(1) NOT NULL COMMENT 'Готовность к выкладке на витину'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица изделий (куколок)';

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `dimensions`, `status`, `type`, `material`, `price`, `ready`) VALUES
(1, 'Муня', 'Мягкая и трогательная обнимашка', '30 см', 1, 1, 1, 2600, 1),
(2, 'Дуня', 'Мягкая и трогательная обнимашка', '25 см', 1, 1, 1, 2600, 1),
(3, 'Овца', 'Коллекционная кукла - хороший подарок ', '32 см', 2, 3, 1, 6200, 1),
(4, 'Конь в пальто', 'Название говорит само за себя', '28 см', 2, 3, 1, 8600, 1),
(5, 'Хрюша', 'Символ Нового года - хороший подарок', '15 см', 1, 2, 1, 600, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `materials`
--

CREATE TABLE `materials` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'индекс',
  `name` varchar(255) NOT NULL COMMENT 'наименование'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `materials`
--

INSERT INTO `materials` (`id`, `name`) VALUES
(1, 'текстиль'),
(2, 'кожа'),
(3, 'папье-маше');

-- --------------------------------------------------------

--
-- Структура таблицы `mmenu`
--

CREATE TABLE `mmenu` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `href` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mmenu`
--

INSERT INTO `mmenu` (`id`, `title`, `href`) VALUES
(1, 'Главная', 'http://hmdoll.ru'),
(2, 'Оплата и доставка', 'http://hmdoll.ru'),
(3, 'О нас', 'http://hmdoll.ru');

-- --------------------------------------------------------

--
-- Структура таблицы `statuses`
--

CREATE TABLE `statuses` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'индекс',
  `name` varchar(255) NOT NULL COMMENT 'наименование'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'готова'),
(2, 'под заказ'),
(3, 'для образца');

-- --------------------------------------------------------

--
-- Структура таблицы `sw_images`
--

CREATE TABLE `sw_images` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'идентификатор',
  `item` int(10) UNSIGNED NOT NULL COMMENT 'внешний ключ (товары)',
  `num` int(1) UNSIGNED NOT NULL COMMENT 'порядковый номер на витрине',
  `file` varchar(255) NOT NULL COMMENT 'файл изображения'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sw_images`
--

INSERT INTO `sw_images` (`id`, `item`, `num`, `file`) VALUES
(1, 1, 1, 'mun01.jpg'),
(2, 1, 2, 'mun02.jpg'),
(3, 1, 3, 'mun03.jpg'),
(4, 1, 4, 'mun04.jpg'),
(5, 2, 1, 'dun01.jpg'),
(6, 2, 2, 'dun02.jpg'),
(7, 2, 3, 'dun03.jpg'),
(8, 2, 4, 'dun04.jpg'),
(9, 3, 1, 'shp01.jpg'),
(10, 3, 2, 'shp02.jpg'),
(11, 3, 3, 'shp03.jpg'),
(12, 3, 4, 'shp04.jpg'),
(13, 3, 5, 'shp05.jpg'),
(14, 4, 1, 'hrs01.jpg'),
(15, 4, 2, 'hrs02.jpg'),
(16, 4, 3, 'hrs03.jpg'),
(17, 4, 4, 'hrs04.jpg'),
(18, 5, 1, 'pig01.jpg'),
(19, 5, 2, 'pig02.jpeg'),
(20, 5, 3, 'pig03.jpeg'),
(21, 5, 4, 'pig04.jpeg');

-- --------------------------------------------------------

--
-- Структура таблицы `types`
--

CREATE TABLE `types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `types`
--

INSERT INTO `types` (`id`, `name`) VALUES
(1, 'игрушка'),
(2, 'зверушка'),
(3, 'коллекционная');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mmenu`
--
ALTER TABLE `mmenu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sw_images`
--
ALTER TABLE `sw_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item` (`item`);

--
-- Индексы таблицы `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'идентификатор', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'индекс', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `mmenu`
--
ALTER TABLE `mmenu`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'индекс', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `sw_images`
--
ALTER TABLE `sw_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'идентификатор', AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `types`
--
ALTER TABLE `types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
