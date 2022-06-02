-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 02 2022 г., 04:21
-- Версия сервера: 5.5.48
-- Версия PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Quiz_DB`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Q1`
--

CREATE TABLE IF NOT EXISTS `Q1` (
  `id` int(11) NOT NULL,
  `qid` int(10) NOT NULL,
  `question` varchar(50) NOT NULL,
  `answer` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `img` varchar(70) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Q1`
--

INSERT INTO `Q1` (`id`, `qid`, `question`, `answer`, `status`, `img`) VALUES
(1, 1, 'What''s Your number', '321', 0, ''),
(2, 1, '', '321321', 0, ''),
(3, 1, '', '321312', 0, ''),
(4, 1, '', '321312', 0, ''),
(5, 1, '', '321312', 0, ''),
(6, 2, 'Andr chert', '32131s', 0, ''),
(7, 2, '', '321312', 0, ''),
(8, 2, '', '321312', 0, ''),
(9, 3, 'beebebe', 'dsadasdas', 0, ''),
(10, 3, '', 'net', 0, ''),
(11, 3, '', 'da', 0, ''),
(12, 4, 'IMG TEST', '32312321', 1, 'public/images/Whisky1.jpg'),
(13, 4, '', 'dsadasdasdas', 1, 'public/images/Whisky1.jpg'),
(14, 4, '', 'dsadasdasdas', 1, 'public/images/HolaQuiz-Category5f86fd669085d.jpg'),
(15, 4, '', 'dsadasdasdas', 1, 'public/images/Whisky1.jpg'),
(16, 4, '', 'dsadasdasdas', 1, 'public/images/Whisky1.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `Quizes`
--

CREATE TABLE IF NOT EXISTS `Quizes` (
  `id` int(45) NOT NULL,
  `name` varchar(55) NOT NULL COMMENT 'h1 text',
  `img` varchar(100) NOT NULL COMMENT 'img link',
  `questions` int(20) NOT NULL COMMENT 'num of questions',
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Quizes`
--

INSERT INTO `Quizes` (`id`, `name`, `img`, `questions`, `status`) VALUES
(1, 'How Well Do Your Friends Know You?', 'public/images/HolaQuiz-Category5f86fd669085d.jpg', 10, 1),
(5, 'Vensanchik privet peredaet', 'public/images/HolaQuiz-Category5f86fd669085d.jpg', 5, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `countryID` smallint(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `countryID`) VALUES
(1, 'dasdasd', 2),
(2, 'kjhbjkhb', 4),
(3, 'dsa', 6),
(4, 'vas', 2),
(5, 'dsadas', 8),
(6, 'vensan', 8),
(7, 'Vens', 8),
(8, 'Vensan', 8);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Q1`
--
ALTER TABLE `Q1`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Quizes`
--
ALTER TABLE `Quizes`
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
-- AUTO_INCREMENT для таблицы `Q1`
--
ALTER TABLE `Q1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `Quizes`
--
ALTER TABLE `Quizes`
  MODIFY `id` int(45) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
