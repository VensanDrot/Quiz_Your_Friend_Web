-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 16 2022 г., 18:36
-- Версия сервера: 5.5.48
-- Версия PHP: 7.0.4

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
-- Структура таблицы `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`id`, `login`, `password`, `status`) VALUES
(1, 'admin', '25d55ad283aa400af464c76d713c07ad', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Q1`
--

INSERT INTO `Q1` (`id`, `qid`, `question`, `answer`, `status`, `img`) VALUES
(1, 1, 'How old are u', '19', 0, ''),
(2, 1, '', '321321', 0, ''),
(3, 1, '', '321312', 0, ''),
(4, 1, '', '321312', 0, ''),
(5, 1, '', '321312', 0, ''),
(6, 2, 'Andr chert', '32131s', 0, ''),
(7, 2, '', '321312', 0, ''),
(8, 2, '', 'Vens1kCheck', 0, ''),
(9, 3, 'beebebe', 'dsadasdas', 0, ''),
(10, 3, '', 'net', 0, ''),
(11, 3, '', 'da', 0, ''),
(12, 4, 'IMG TEST', 'vaav', 1, 'public/images/photo_2022-02-05_15-05-26.jpg'),
(13, 4, '', 'dsadasdasdas', 1, 'public/images/Whisky1.jpg'),
(14, 4, '', 'dsadasdasdas', 1, 'public/images/Whisky1.jpg'),
(15, 4, '', 'dsadasdasdas', 1, 'public/images/Whisky1.jpg'),
(16, 4, '', 'dsadasdasdas', 1, 'public/images/Whisky1.jpg'),
(17, 1, '', '321312', 0, ''),
(18, 1, '', 'dsdss', 0, ''),
(19, 1, '', 'veveve', 0, ''),
(20, 2, '', 'nene', 0, ''),
(21, 2, '', 'nene', 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `Quizes`
--

CREATE TABLE IF NOT EXISTS `Quizes` (
  `id` int(100) NOT NULL,
  `QName` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT 'h1 text',
  `img` varchar(250) NOT NULL COMMENT 'img link',
  `questions` int(20) NOT NULL COMMENT 'num of questions',
  `status` tinyint(1) NOT NULL,
  `type` int(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Quizes`
--

INSERT INTO `Quizes` (`id`, `QName`, `name`, `img`, `questions`, `status`, `type`) VALUES
(1, 'QuizOne', 'How Well Do Your Friends Know You?', 'public/images/HolaQuiz-Category5f86fd669085d.jpg', 10, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `results`
--

CREATE TABLE IF NOT EXISTS `results` (
  `id` int(200) NOT NULL,
  `userid` int(200) NOT NULL,
  `Qid` varchar(200) NOT NULL,
  `fid` int(200) NOT NULL,
  `result` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Url`
--

CREATE TABLE IF NOT EXISTS `Url` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `short` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `countryID` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

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
-- Индексы таблицы `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Url`
--
ALTER TABLE `Url`
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
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `Q1`
--
ALTER TABLE `Q1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT для таблицы `Quizes`
--
ALTER TABLE `Quizes`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `results`
--
ALTER TABLE `results`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `Url`
--
ALTER TABLE `Url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
