-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 03 2019 г., 23:43
-- Версия сервера: 5.7.20-log
-- Версия PHP: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gallery`
--

-- --------------------------------------------------------

--
-- Структура таблицы `basket`
--

CREATE TABLE `basket` (
  `id_basket` int(11) NOT NULL,
  `id_session` text NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id_feedback` int(11) NOT NULL,
  `name` text NOT NULL,
  `text_fb` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`id_feedback`, `name`, `text_fb`, `date`) VALUES
(1, 'Вася', 'Отзыв 1', '2018-07-08 21:18:00'),
(2, 'Иван', 'Отзыв 2', '2018-07-08 21:18:35'),
(3, 'Алексей', 'Отзыв 3', '2018-09-12 08:32:32');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id_image` int(11) NOT NULL,
  `path_img` text NOT NULL,
  `count_preview` int(11) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id_image`, `path_img`, `count_preview`, `description`, `price`) VALUES
(1, '01.jpg', 11, 'Описание товара 1', '50000.00'),
(2, '02.jpg', 14, 'Описание товара 2', '75000.00'),
(3, '03.jpg', 4, 'Описание товара 3', '199000.90'),
(4, '04.jpg', 15, 'Описание товара 4', '999.99'),
(5, '05.jpg', 18, 'Описание товара 5', '1000.01'),
(6, '06.jpg', 5, 'Описание товара 6', '1000000.00'),
(7, '07.jpg', 10, 'Описание товара 7', '150000.00'),
(8, '08.jpg', 6, 'Описание товара 8', '10000000.00'),
(9, '09.jpg', 11, 'Описание товара 9', '35000.00'),
(10, '10.jpg', 11, 'Описание товара 10', '99999.99'),
(11, '11.jpg', 12, 'Описание товара 11', '350500.00'),
(12, '12.jpg', 5, 'Описание товара 12', '7800.00'),
(13, '13.jpg', 6, 'Описание товара 13', '4000000.00'),
(14, '14.jpg', 2, 'Описание товара 14', '140900.00'),
(15, '15.jpg', 11, 'Описание товара 15', '55700.00');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_session` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` text NOT NULL,
  `count` int(11) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id_order`, `id_session`, `id_user`, `status`, `count`, `amount`, `date`) VALUES
(8, 'j943hr9jiqgjoaarie0v9jadt6', 2, 'В обработке', 3, '77000.02', '2018-09-12 16:02:01'),
(9, 'j943hr9jiqgjoaarie0v9jadt6', 2, 'В обработке', 1, '7800.00', '2018-09-12 16:03:27'),
(10, 'j943hr9jiqgjoaarie0v9jadt6', 3, 'В обработке', 1, '55700.00', '2018-09-12 16:08:31'),
(11, 'j943hr9jiqgjoaarie0v9jadt6', 3, 'В обработке', 2, '8000000.00', '2018-09-12 16:10:25'),
(12, 'j943hr9jiqgjoaarie0v9jadt6', 3, 'В обработке', 4, '290699.98', '2018-09-12 22:27:23'),
(13, '72bf4tvn413r3oopr3t500im04', 4, 'В обработке', 2, '1350500.00', '2018-09-17 19:40:19'),
(14, '72bf4tvn413r3oopr3t500im04', 2, 'В обработке', 1, '999.99', '2018-09-17 20:50:18'),
(48, '9revsj62lvlk5mhoq81u33in34', 5, 'Принят в работу', 1, '35000.00', '2019-01-03 22:46:05'),
(49, 's3satk9crjp0g740ptonp8d7o2', 5, 'В обработке', 1, '10000000.00', '2019-01-03 23:08:23');

-- --------------------------------------------------------

--
-- Структура таблицы `products_in_order`
--

CREATE TABLE `products_in_order` (
  `id_products_in_order` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products_in_order`
--

INSERT INTO `products_in_order` (`id_products_in_order`, `id_order`, `id_product`, `quantity`) VALUES
(11, 8, 5, 2),
(12, 8, 2, 1),
(13, 9, 12, 1),
(14, 10, 15, 1),
(15, 11, 13, 2),
(16, 12, 10, 2),
(17, 12, 15, 1),
(18, 12, 9, 1),
(19, 13, 6, 1),
(20, 13, 11, 1),
(21, 14, 4, 1),
(55, 48, 9, 1),
(56, 49, 8, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `login` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `login`, `password`, `email`) VALUES
(1, 'admin', '123', ''),
(2, 'user1', 'pass1', 'email1'),
(3, 'user2', 'pass2', 'email2'),
(4, 'user3', 'pass3', 'email3'),
(5, 'user4', 'pass4', 'email4');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id_basket`),
  ADD KEY `basket_fk_images` (`id_product`);

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id_feedback`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id_image`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `orders_fk_users` (`id_user`);

--
-- Индексы таблицы `products_in_order`
--
ALTER TABLE `products_in_order`
  ADD PRIMARY KEY (`id_products_in_order`),
  ADD KEY `products_in_order_fk_images` (`id_product`),
  ADD KEY `products_in_order_fk_orders` (`id_order`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `id_basket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id_feedback` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT для таблицы `products_in_order`
--
ALTER TABLE `products_in_order`
  MODIFY `id_products_in_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_fk_images` FOREIGN KEY (`id_product`) REFERENCES `images` (`id_image`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_fk_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Ограничения внешнего ключа таблицы `products_in_order`
--
ALTER TABLE `products_in_order`
  ADD CONSTRAINT `products_in_order_fk_images` FOREIGN KEY (`id_product`) REFERENCES `images` (`id_image`),
  ADD CONSTRAINT `products_in_order_fk_orders` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
