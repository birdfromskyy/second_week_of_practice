-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 04 2024 г., 09:46
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `pattern`
--

-- --------------------------------------------------------

--
-- Структура таблицы `interaction`
--

CREATE TABLE `interaction` (
  `id_student` int(11) NOT NULL,
  `id_practic` int(11) DEFAULT NULL,
  `vid_dogovora` varchar(100) DEFAULT NULL,
  `payment` varchar(100) DEFAULT NULL,
  `spravlyalsya` varchar(100) DEFAULT NULL,
  `kachestva` varchar(250) DEFAULT NULL,
  `amount_vipolneniya` varchar(100) DEFAULT NULL,
  `zamechaniya` varchar(250) DEFAULT NULL,
  `ocenka` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `interaction`
--

INSERT INTO `interaction` (`id_student`, `id_practic`, `vid_dogovora`, `payment`, `spravlyalsya`, `kachestva`, `amount_vipolneniya`, `zamechaniya`, `ocenka`) VALUES
(13, 10, NULL, 'нет', 'плохо', 'низкая ответственность, непунктуальность, неполное выполнение заданий', 'неуспешно', 'не проявлял активности, требуется значительное улучшение', 'неудовлетворительно'),
(12, 10, NULL, 'нет', 'плохо', 'низкая ответственность, непунктуальность, неполное выполнение заданий', 'неуспешно', 'не проявлял активности, требуется значительное улучшение', 'неудовлетворительно'),
(11, 10, NULL, 'нет', 'хорошо', 'ответственность, пунктуальность', 'большинство заданий', 'отсутствуют', 'хорошо'),
(10, 10, NULL, 'нет', 'хорошо', 'ответственность, пунктуальность', 'большинство заданий', 'отсутствуют', 'хорошо'),
(15, 10, NULL, 'нет', 'оперативно', 'высокая ответственность, пунктуальность, тщательность в выполнении заданий', 'полностью', 'отсутствуют', 'отлично'),
(2, 10, NULL, 'нет', 'оперативно', 'высокая ответственность, пунктуальность, тщательность в выполнении заданий', 'полностью', 'отсутствуют', 'отлично');

-- --------------------------------------------------------

--
-- Структура таблицы `practics`
--

CREATE TABLE `practics` (
  `id` int(11) NOT NULL,
  `vid` varchar(30) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `place_practic` varchar(100) DEFAULT NULL,
  `address_organization` varchar(100) DEFAULT NULL,
  `fio_director_of_company` varchar(100) DEFAULT NULL,
  `post_director_of_company` varchar(50) DEFAULT NULL,
  `fio_director_of_ugrasu` varchar(100) DEFAULT NULL,
  `post_director_of_ugrasu` varchar(100) DEFAULT NULL,
  `fio_director_of_organization` varchar(100) DEFAULT NULL,
  `post_director_of_organization` varchar(100) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `number_of_prikaz` varchar(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `practics`
--

INSERT INTO `practics` (`id`, `vid`, `type`, `name`, `place_practic`, `address_organization`, `fio_director_of_company`, `post_director_of_company`, `fio_director_of_ugrasu`, `post_director_of_ugrasu`, `fio_director_of_organization`, `post_director_of_organization`, `from_date`, `to_date`, `number_of_prikaz`, `date`) VALUES
(10, 'учебная', 'производственная', 'Югорский Государственный Университет', 'ФГБОУ ВО Югорский Государственный Университет', 'г.Ханты-Мансийск, ул. Чехова, 16', 'Змеев Денис Олегович', 'доцент', 'Змеев Денис Олегович', 'доцент', 'Иванов Иван Иванович', 'доцент', '2024-04-22', '2024-05-18', '2-222', '2024-03-06'),
(11, 'учебная', 'Ознакомительная', 'Вторая', 'ЮГУ', 'ЮГУ', 'Змеев', 'доцент', 'Змеев', 'доцент', 'Змеев', 'доцент', '2024-01-01', '2024-01-02', '322', '2024-01-01');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `type_account` varchar(100) NOT NULL DEFAULT 'user',
  `email` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `course` int(11) DEFAULT NULL,
  `groupp` varchar(5) DEFAULT NULL,
  `surname` varchar(20) DEFAULT NULL,
  `name` varchar(20) NOT NULL,
  `patronymic` varchar(20) DEFAULT NULL,
  `institute` varchar(100) DEFAULT NULL,
  `direction` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `type_account`, `email`, `pass`, `course`, `groupp`, `surname`, `name`, `patronymic`, `institute`, `direction`) VALUES
(1, 'admin', 'gena@gmail.com', '5737c6ec2e0716f3d8a7a5c4e0de0d9a', 2, '1521б', 'Ножников', 'Геннадий', 'Александрович', 'ИШЦТ', 'Программная инженерия'),
(2, 'user', 'gennady@gmail.com', '5737c6ec2e0716f3d8a7a5c4e0de0d9a', 2, '1521б', 'Ножников', 'Геннадий', 'Александрович', 'Инженерная Школа Цифровых Технологий', 'Программная инженерия'),
(10, 'user', '57600576@ugrasu.ru', '5737c6ec2e0716f3d8a7a5c4e0de0d9a', NULL, '1521б', 'Братченко', 'Александр', 'Васильевич', NULL, NULL),
(11, 'user', '22249035@ugrasu.ru', '5737c6ec2e0716f3d8a7a5c4e0de0d9a', NULL, '1521б', 'Гусейнов', 'Айхан', 'Эльчин Оглы', NULL, NULL),
(12, 'user', '98339207@ugrasu.ru', '5737c6ec2e0716f3d8a7a5c4e0de0d9a', NULL, '1521б', 'Плотников', 'Михаил', 'Александрович', NULL, NULL),
(13, 'user', '50275863@ugrasu.ru', '5737c6ec2e0716f3d8a7a5c4e0de0d9a', 2, '1521б', 'Васильев', 'Вася', 'Васёк', 'Инженерная Школа Информационных Технологий', 'Программная инженерия'),
(15, 'user', '66761625@ugrasu.ru', '5737c6ec2e0716f3d8a7a5c4e0de0d9a', 2, '1521б', 'Попова', 'Владислава', 'Олеговна', 'Инженерная Школа Информационных Технологий', 'Программная инженерия');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `practics`
--
ALTER TABLE `practics`
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
-- AUTO_INCREMENT для таблицы `practics`
--
ALTER TABLE `practics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
