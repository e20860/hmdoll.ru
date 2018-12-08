-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Ноя 30 2018 г., 11:34
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
-- Структура таблицы `articules`
--

CREATE TABLE `articules` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `articules`
--

INSERT INTO `articules` (`id`, `name`) VALUES
(1, 'Обнимашка'),
(2, 'Небедная овечка'),
(3, 'Конь в пальто'),
(4, 'Поросёнок');

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
  `ready` tinyint(1) NOT NULL COMMENT 'Готовность к выкладке на витину',
  `articul` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица изделий (куколок)';

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `dimensions`, `status`, `type`, `material`, `price`, `ready`, `articul`) VALUES
(1, 'Муня', 'Мягкая и трогательная обнимашка', '30 см', 1, 1, 1, 2600, 1, 1),
(2, 'Дуня', 'Мягкая и трогательная обнимашка', '25 см', 1, 1, 1, 2600, 1, 1),
(3, 'Долли', 'Коллекционная кукла - хороший подарок ', '32 см', 2, 1, 1, 6200, 1, 2),
(4, 'Евстафий', 'Название говорит само за себя', '28 см', 2, 1, 1, 8600, 1, 3),
(5, 'Хрюша', 'Символ Нового года - хороший подарок', '15 см', 1, 1, 1, 600, 1, 4);

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
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `parent` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mmenu`
--

INSERT INTO `mmenu` (`id`, `name`, `link`, `parent`) VALUES
(1, 'Главная', 'main/index', 0),
(2, 'Куклы', 'main/dolls', 0),
(3, 'Выкройки', 'main/patterns', 0),
(4, 'Заготовки', 'main/sets', 0),
(5, 'Оплата и доставка', 'howtopay', 0),
(6, 'О нас', 'about', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `num` varchar(10) NOT NULL,
  `item` int(10) UNSIGNED NOT NULL,
  `quantity` tinyint(4) NOT NULL,
  `amount` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(10) NOT NULL,
  `customer` varchar(50) NOT NULL,
  `cust_details` text NOT NULL,
  `paid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(25) NOT NULL,
  `header` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `name`, `header`, `description`, `content`) VALUES
(1, 'dolls', 'Куклы ручной работы', 'Здесь Вы можете найти замечательную куклу изготовленную для Вас. Все куклы производятся по оригинальным лекалам вручную. Мы вкладываем в каждую частичку своей души. Может какая-нибудь согреет Вас?', ''),
(2, 'patterns', 'Выкройки', 'Качественные выкройки по оригинальным лекалам помагут Вам создать своих неповторимых кукол', ''),
(3, 'sets', 'Наборы для изготовления кукол', 'С помощью наших наборов вы сможете легко создать свою неповторимую куклу', '');

-- --------------------------------------------------------

--
-- Структура таблицы `smenu`
--

CREATE TABLE `smenu` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `parent` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `smenu`
--

INSERT INTO `smenu` (`id`, `name`, `link`, `parent`) VALUES
(1, 'В магазин', 'main/index', 0),
(2, 'Товары', 'main/dolls', 0),
(3, 'Справочники', '#', 0),
(4, 'Страницы', '#', 0),
(5, 'Статистика', 'howtopay', 0),
(11, 'Куклы', '#', 2),
(12, 'Выкройки', '#', 2),
(13, 'Заготовки', '#', 2),
(14, 'Общие', '#', 3),
(15, 'Меню', '#', 3),
(16, 'Первая', '#', 4),
(17, 'Оплата и доставка', '#', 4),
(18, 'О нас', '#', 4);

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
-- Структура таблицы `sw_video`
--

CREATE TABLE `sw_video` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'идентификатор',
  `item` int(10) UNSIGNED NOT NULL COMMENT 'внешний ключ (товары)',
  `file` varchar(255) NOT NULL COMMENT 'файл изображения'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sw_video`
--

INSERT INTO `sw_video` (`id`, `item`, `file`) VALUES
(1, 1, 'horse1.mp4'),
(5, 2, 'horse1.mp4'),
(9, 3, 'video1.mp4'),
(14, 4, 'norse.mp4'),
(18, 5, 'pigs.mp4');

-- --------------------------------------------------------

--
-- Структура таблицы `types`
--

CREATE TABLE `types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `menu` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `types`
--

INSERT INTO `types` (`id`, `name`, `menu`) VALUES
(1, 'кукла', 'dolls'),
(2, 'выкройка', 'patterns'),
(3, 'набор', 'sets');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(25) NOT NULL,
  `email` varchar(80) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `articules`
--
ALTER TABLE `articules`
  ADD PRIMARY KEY (`id`);

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
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `smenu`
--
ALTER TABLE `smenu`
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
-- Индексы таблицы `sw_video`
--
ALTER TABLE `sw_video`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item` (`item`);

--
-- Индексы таблицы `types`
--
ALTER TABLE `types`
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
-- AUTO_INCREMENT для таблицы `articules`
--
ALTER TABLE `articules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `smenu`
--
ALTER TABLE `smenu`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
-- AUTO_INCREMENT для таблицы `sw_video`
--
ALTER TABLE `sw_video`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'идентификатор', AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `types`
--
ALTER TABLE `types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
