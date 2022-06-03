-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 03 2022 г., 20:44
-- Версия сервера: 8.0.24
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `lesson`
--

CREATE TABLE `lesson` (
  `LessonId` int NOT NULL,
  `LessonName` varchar(255) NOT NULL,
  `Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `lesson`
--

INSERT INTO `lesson` (`LessonId`, `LessonName`, `Description`) VALUES
(1, 'Введение в алгоритмизацию', 'В этом уроке вы получите базовые теоретические знания об алгоритмах и алгоритмизации и пройдете свой первый тест по данной теме'),
(2, 'Блок-схемы', 'Все об условных обозначениях и значениях элементов блок-схем'),
(3, 'Константы, переменные и ячейки памяти', 'Что представляют собой константы, как объявить переменную и зачем нужны ячейки памяти'),
(4, 'Массивы', 'Все, что нужно знать о массивах: от того, как их объявить, до алгоритмов их сортировки'),
(5, 'Линейные алгоритмы', ''),
(6, 'Разветвляющиеся алгоритмы', ''),
(7, 'Циклические алгоритмы', 'Примеры циклических алгоритмов');

-- --------------------------------------------------------

--
-- Структура таблицы `options`
--

CREATE TABLE `options` (
  `Id` int NOT NULL,
  `TestId` int NOT NULL,
  `Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `IsTrue` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `options`
--

INSERT INTO `options` (`Id`, `TestId`, `Description`, `IsTrue`) VALUES
(1, 1, 'Это важная составляющая любой программы', 0),
(2, 1, 'Это инструкция для автомата о том, в какой последовательности нужно выполнить действия', 1),
(3, 1, 'Это последовательность действий, которая впоследствии поможет создать программу', 0),
(4, 1, 'Это последовательность действий, представленная в виде блок-схемы', 0),
(5, 2, 'Что может быть только один верный результат', 0),
(6, 2, 'Что результат будет получен в любом случае', 0),
(7, 2, 'Что результат может быть как получен, так и не получен', 0),
(8, 2, 'Что через конечное число шагов будет получен результат', 1),
(9, 7, '<img src=\"images/start.png\">', 0),
(10, 7, '<img src=\"images/parallelogr.png\">', 1),
(11, 7, '<img src=\"images/circle2.png\">', 0),
(12, 7, '<img src=\"images/romb.png\">', 0),
(13, 8, 'Ответ 1', 1),
(14, 8, 'Ответ 2', 0),
(15, 8, 'Ответ 3', 0),
(16, 8, 'Ответ 4', 0),
(17, 9, 'Ответ 1', 0),
(18, 9, 'Ответ 2', 0),
(19, 9, 'Ответ 3', 0),
(20, 9, 'Ответ 4', 1),
(21, 10, 'Ответ 1', 0),
(22, 10, 'Ответ 2', 1),
(23, 10, 'Ответ 3', 0),
(24, 10, 'Ответ 4', 0),
(25, 11, 'Ответ 1', 0),
(26, 11, 'Ответ 2', 0),
(27, 11, 'Ответ 3', 1),
(28, 11, 'Ответ 4', 0),
(29, 12, 'Ответ 1', 1),
(30, 12, 'Ответ 2', 0),
(31, 12, 'Ответ 3', 0),
(32, 12, 'Ответ 4', 0),
(33, 13, 'Ответ 1', 0),
(34, 13, 'Ответ 2', 1),
(35, 13, 'Ответ 3', 0),
(36, 13, 'Ответ 4', 0),
(37, 14, 'Ответ 1', 0),
(38, 14, 'Ответ 2', 0),
(39, 14, 'Ответ 3', 1),
(40, 14, 'Ответ 4', 0),
(41, 15, 'Ответ 1', 0),
(42, 15, 'Ответ 2', 0),
(43, 15, 'Ответ 3', 0),
(44, 15, 'Ответ 4', 1),
(45, 16, 'Ответ 1', 1),
(46, 16, 'Ответ 2', 0),
(47, 20, 'Вариант 1', 0),
(48, 20, 'Вариант 2', 1),
(49, 20, 'Вариант 3', 0),
(50, 21, 'Вариант 1', 0),
(51, 21, 'Вариант 2', 0),
(52, 21, 'Вариант 3', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `session`
--

CREATE TABLE `session` (
  `SessionId` int NOT NULL,
  `StartTime` datetime NOT NULL,
  `FinishTime` datetime DEFAULT NULL,
  `Status` varchar(255) NOT NULL,
  `LessonId` int NOT NULL,
  `UserId` int NOT NULL,
  `Points` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `session`
--

INSERT INTO `session` (`SessionId`, `StartTime`, `FinishTime`, `Status`, `LessonId`, `UserId`, `Points`) VALUES
(1, '2022-05-22 14:32:20', '2022-05-22 18:40:28', 'Finished', 1, 4, 2),
(2, '2022-05-22 18:37:21', '2022-05-22 18:43:57', 'Finished', 1, 4, 1),
(3, '2022-05-22 18:44:47', '2022-05-22 18:45:10', 'Finished', 1, 4, 1),
(4, '2022-05-22 18:45:29', '2022-05-22 18:45:51', 'Finished', 1, 4, 0),
(10, '2022-05-22 21:35:39', '2022-05-22 21:35:59', 'Finished', 1, 4, 2),
(11, '2022-05-22 21:45:00', '2022-05-22 21:45:20', 'Finished', 1, 4, 1),
(12, '2022-05-23 10:13:42', '2022-05-23 10:14:01', 'Finished', 1, 4, 2),
(13, '2022-05-23 11:25:55', '2022-05-23 11:26:15', 'Finished', 1, 4, 1),
(14, '2022-05-23 11:29:38', '2022-05-23 11:30:02', 'Finished', 1, 5, 1),
(16, '2022-05-23 16:05:58', '2022-05-23 16:06:17', 'Finished', 1, 4, 2),
(17, '2022-05-24 09:05:44', '2022-05-24 09:06:04', 'Finished', 1, 9, 1),
(20, '2022-05-24 21:56:51', '2022-05-24 21:59:54', 'Finished', 1, 4, 1),
(22, '2022-05-25 18:02:38', '2022-05-25 18:02:59', 'Finished', 1, 12, 0),
(23, '2022-05-25 18:03:07', '2022-05-25 18:03:29', 'Finished', 1, 12, 1),
(24, '2022-05-25 18:46:42', '2022-05-25 18:47:05', 'Finished', 1, 6, 1),
(25, '2022-05-25 18:47:15', '2022-05-25 18:47:34', 'Finished', 1, 6, 2),
(26, '2022-05-25 18:56:20', '2022-05-25 19:01:51', 'Finished', 1, 10, 2),
(44, '2022-05-25 21:30:59', '2022-05-25 22:00:49', 'Finished', 1, 4, 2),
(47, '2022-05-26 07:31:45', '2022-05-26 07:47:27', 'Finished', 2, 4, 1),
(49, '2022-05-26 07:57:05', '2022-05-26 07:58:41', 'Finished', 2, 10, 3),
(50, '2022-05-26 07:59:19', '2022-05-26 07:59:37', 'Finished', 1, 13, 1),
(51, '2022-05-26 07:59:47', '2022-05-26 08:01:09', 'Finished', 2, 13, 6),
(52, '2022-05-26 08:07:57', '2022-05-26 08:08:19', 'Finished', 1, 9, 1),
(53, '2022-05-26 08:08:32', '2022-05-26 08:09:56', 'Finished', 2, 9, 8),
(54, '2022-05-26 08:12:18', '2022-05-26 08:12:38', 'Finished', 1, 12, 2),
(55, '2022-05-26 08:32:20', '2022-05-26 08:41:02', 'Finished', 2, 4, 8),
(59, '2022-05-30 16:45:56', '2022-05-30 16:46:45', 'Finished', 1, 4, 2),
(60, '2022-05-30 16:59:47', '2022-05-30 17:00:06', 'Finished', 1, 4, 1),
(64, '2022-05-30 17:11:57', '2022-05-30 17:13:42', 'Terminated', 2, 4, 0),
(65, '2022-05-30 17:15:09', '2022-05-30 17:15:19', 'Terminated', 1, 4, 0),
(66, '2022-05-30 17:17:41', '2022-05-30 17:17:54', 'Terminated', 1, 5, 0),
(67, '2022-05-30 17:20:35', '2022-05-30 17:23:18', 'Terminated', 1, 4, 0),
(70, '2022-06-01 14:07:23', '2022-06-01 14:07:55', 'Finished', 7, 4, 2),
(74, '2022-06-01 14:17:02', '2022-06-01 14:17:43', 'Finished', 1, 4, 2),
(75, '2022-06-01 14:17:55', '2022-06-01 14:18:13', 'Finished', 7, 4, 2),
(76, '2022-06-01 14:23:13', '2022-06-01 14:23:50', 'Finished', 1, 4, 2),
(77, '2022-06-01 14:25:19', '2022-06-01 14:25:46', 'Finished', 1, 4, 2),
(78, '2022-06-01 17:29:05', '2022-06-01 17:29:45', 'Terminated', 1, 4, 0),
(79, '2022-06-01 17:29:52', '2022-06-01 17:30:13', 'Finished', 1, 4, 2),
(80, '2022-06-01 17:30:22', '2022-06-01 17:30:49', 'Terminated', 2, 4, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `test`
--

CREATE TABLE `test` (
  `Id` int NOT NULL,
  `LessonId` int NOT NULL,
  `Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `AnswerDesc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `OrderNumber` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `test`
--

INSERT INTO `test` (`Id`, `LessonId`, `Description`, `AnswerDesc`, `OrderNumber`) VALUES
(1, 1, 'Выберите верное определение понятия \"алгоритм\":', 'Алгоритм – это инструкция для автомата о том, в какой последовательности нужно выполнить действия при переработке исходного материала в требуемый результат', 1),
(2, 1, 'Что означает свойство алгоритма \"результативность\"?', 'Алгоритмическая инструкция лишь тогда может быть названа алгоритмом, когда при любом сочетании исходных данных она гарантирует, что через конечное число шагов будет обязательно получен результат', 2),
(7, 2, 'Каким из этих элементов обозначается ввод или вывод данных?', 'Операции ввода и вывода данных обозначаются параллелограммом\n                        <br>\n                        <img src=\"images/data.jpg\">', 1),
(8, 2, 'Описание 2', 'Ответ 2', 2),
(9, 2, 'Описание 3', 'Ответ 3', 3),
(10, 2, 'Описание 4', 'Ответ 4', 4),
(11, 2, 'Описание 5', 'Ответ 5', 5),
(12, 2, 'Описание 6', 'Ответ 6', 6),
(13, 2, 'Описание 7', 'Ответ 7', 7),
(14, 2, 'Описание 8', 'Ответ 8', 8),
(15, 2, 'Описание 9', 'Ответ 9', 9),
(16, 2, 'Описание 10', 'Ответ 10', 10),
(20, 7, 'Вопрос 1', 'Доп информация', 1),
(21, 7, 'Вопрос 2', 'Доп информация', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `theory`
--

CREATE TABLE `theory` (
  `id` int NOT NULL,
  `LessonId` int NOT NULL,
  `Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `OrderNumber` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `theory`
--

INSERT INTO `theory` (`id`, `LessonId`, `Description`, `OrderNumber`) VALUES
(1, 1, '<b>Алгоритм</b> – это инструкция для автомата о том, в какой последовательности нужно выполнить действия при переработке исходного материала в требуемый результат.\r\n            <br><br>\r\n            Наряду с понятием алгоритма используют термин <b>алгоритмизация</b>, под которой понимают совокупность приемов и способов составления алгоритмов для решения алгоритмических задач.\r\n            <br><br>\r\n            Часто алгоритм используется не как инструкция для автомата, а как схема алгоритмического решения задачи. Это позволяет оценить эффективность предлагаемого способа решения, его результативность, исправить возможные ошибки, сравнить его еще до применения на компьютере с другими алгоритмами решения этой же задачи. Наконец, алгоритм является основой для составления программы, которую пишет программист на каком-либо языке программирования с тем, чтобы реализовать процесс обработки данных на компьютере.', 1),
(2, 1, 'Неотъемлемым свойством алгоритма является его <i>результативность</i>, то есть алгоритмическая инструкция лишь тогда может быть названа алгоритмом, когда при любом сочетании исходных данных она гарантирует, что через конечное число шагов будет обязательно получен результат.\r\n            <br><br>\r\n            На практике получили известность два способа изображения алгоритмов:\r\n            <br>\r\n            - <b>в виде пошагового словесного описания;</b>\r\n            <br>\r\n            - <b>в виде блок-схем.</b>\r\n            <br><br>\r\n            Первый из этих способов получил значительно меньшее распространение из-за его многословности и отсутствия наглядности.\r\n            <br>\r\n            Второй, напротив, оказался очень удобным средством изображения алгоритмов и получил широкое распространение в научной и учебной литературе.', 2),
(9, 2, '<b>Блок-схема</b>  – это совокупность блоков, предписывающих выполнение определенных операций, и связей между этими блоками.\r\n            Внутри блоков указывается информация об операциях, подлежащих выполнению.\r\n            <br><br>\r\n            В этом уроке вы узнаете о наиболее часто используемых блоках, элементах связей между ними и том, что они означают.\r\n            <br><br>\r\n            Блоки и элементы связей называют <i>символами</i> блок-схем.', 1),
(10, 2, '<div style=\"position: relative; font-size: 1.7ex; display: flex; flex-direction: row\">\n<img src=\"images/terminator.jpg\" style=\"border-radius: 20px\">\n<div style=\"position: relative; left: 15px; top:25px\">\n<b>- Терминатор начала и конца работы функции</b>\n</div>\n</div>\n<div style=\"position: relative; font-size: 1.7ex; top: 30px\">\nТерминатором начинается и заканчивается любая функция.\n<br><br>\nТип возвращаемого значения и аргументов функции обычно указывается в комментариях к блоку терминатора.\n</div>\n<div style=\"position: relative; font-size: 1.7ex; display: flex; flex-direction: row; top:50px\">\n<img src=\"images/data.jpg\" style=\"border-radius: 20px\">\n<div style=\"position: relative; left: 15px; top:25px\">\n<b>- Операции ввода и вывода данных</b>\n</div>\n</div>\n<div style=\"position: relative; font-size: 1.7ex; top: 80px\">\nВ ГОСТ определено множество символов ввода/вывода, например вывод на магнитные ленты, дисплеи и т.п.\n<br><br>\nЕсли источник данных не принципиален, обычно используется символ параллелограмма. Подробности ввода/вывода могут быть указаны в комментариях.\n</div>', 2),
(11, 2, '<div style=\"position: relative; font-size: 1.7ex; display: flex; flex-direction: row\">\r\n                <img src=\"images/process.jpg\" style=\"border-radius: 20px\">\r\n                <div style=\"position: relative; left: 15px; top:25px\">\r\n                    <b>- Выполнение операций над данными </b>\r\n                </div>\r\n            </div>\r\n            <div style=\"position: relative; font-size: 1.7ex; top: 30px\">\r\n                В блоке операций обычно размещают одно или несколько (ГОСТ не запрещает) операций присваивания, не требующих вызова внешних функций.\r\n            </div>\r\n            <div style=\"position: relative; font-size: 1.7ex; display: flex; flex-direction: row; top:50px\">\r\n                <img src=\"images/solution.jpg\" style=\"border-radius: 20px\">\r\n                <div style=\"position: relative; left: 15px; top:25px\">\r\n                    <b>- Блок, иллюстрирующий ветвление алгоритма</b>\r\n                </div>\r\n            </div>\r\n            <div style=\"position: relative; font-size: 1.7ex; top: 80px\">\r\n                Блок в виде ромба имеет один вход и несколько подписанных выходов.\r\n                <br><br>\r\n                В случае, если блок имеет 2 выхода (соответствует оператору ветвления), на них подписывается результат сравнения — «да/нет».\r\n                Если из блока выходит большее число линий (оператор выбора), внутри него записывается имя переменной, а на выходящих дугах — значения этой переменной.\r\n            </div>', 3),
(12, 2, '<div style=\"position: relative; font-size: 1.7ex; display: flex; flex-direction: row\">\r\n                <img src=\"images/procedure.jpg\" style=\"border-radius: 20px\">\r\n                <div style=\"position: relative; left: 15px; top:25px\">\r\n                    <b>- Вызов внешней процедуры </b>\r\n                </div>\r\n            </div>\r\n            <div style=\"position: relative; font-size: 1.7ex; top: 30px\">\r\n                Вызов внешних процедур и функций помещается в прямоугольник с дополнительными вертикальными линиями.\r\n            </div>\r\n            <div style=\"position: relative; font-size: 1.7ex; display: flex; flex-direction: row; top:50px\">\r\n                <img src=\"images/loop.jpg\" style=\"border-radius: 20px\">\r\n                <div style=\"position: relative; left: 15px; top:55px\">\r\n                    <b>- Начало и конец цикла</b>\r\n                </div>\r\n            </div>\r\n            <div style=\"position: relative; font-size: 1.7ex; top: 80px\">\r\n                Символы начала и конца цикла содержат имя и условие. Условие может отсутствовать в одном из символов пары.\r\n                <br>\r\n                Расположение условия, определяет тип оператора, соответствующего символам на языке высокого уровня — оператор с предусловием (while) или постусловием (do … while).\r\n            </div>', 4),
(13, 2, '<div style=\"position: relative; font-size: 1.7ex; display: flex; flex-direction: row\">\r\n                <img src=\"images/preprocess.jpg\" style=\"border-radius: 20px\">\r\n                <div style=\"position: relative; left: 15px; top:25px\">\r\n                    <b>- Подготовка данных </b>\r\n                </div>\r\n            </div>\r\n            <div style=\"position: relative; font-size: 1.7ex; top: 30px\">\r\n                Символ «подготовка данных» в произвольной форме (в ГОСТ нет ни пояснений, ни примеров), задает входные значения.\r\n                <br>\r\n                <br>\r\n                Используется обычно для задания циклов со счетчиком.\r\n            </div>\r\n            <div style=\"position: relative; font-size: 1.7ex; display: flex; flex-direction: row; top:50px\">\r\n                <img src=\"images/connector.jpg\" style=\"border-radius: 20px\">\r\n                <div style=\"position: relative; left: 15px; top:25px\">\r\n                    <b>- Соединитель</b>\r\n                </div>\r\n            </div>\r\n            <div style=\"position: relative; font-size: 1.7ex; top: 80px\">\r\n                В случае, если блок-схема не умещается на лист, используется символ соединителя, отражающий переход потока управления между листами.\r\n                <br>\r\n                <br>\r\n                Символ может использоваться и на одном листе, если по каким-либо причинам тянуть линию не удобно.\r\n            </div>', 5),
(14, 2, 'При соединении блоков следует использовать вертикальные и горизонтальные линии потоков.\n<br>\n<br>\nГоризонтальные потоки, имеющие направление справа налево, и вертикальные потоки, имеющие направление снизу вверх, должны быть обязательно помечены стрелками. Прочие потоки могут быть помечены или оставлены непомеченными.\n<br>\n<br>\nЖелательно чтобы линии потоков были параллельны линиям внешней рамки или границам листа.\n<br>\n<br>\nРекомендуется расстояние между параллельными линиями потоков устанавливать кратным 5 мм.\n<br>\n<br>\nГоризонтальный и вертикальный размеры блока рекомендуется назначать кратно 5-ти мм.', 6),
(15, 2, 'Для размещения блоков рекомендуется поле листа разбивать на горизонтальные и вертикальные (для разветвлявшихся схем) зоны.\r\n<br>\r\n<br>\r\nДля удобства описания блок-схемы каждый ее блок следует пронумеровать. Удобно использовать сквозную нумерации блоков. Номер блока располагают в разрыве в левой верхней части рамки блока или над ним.\r\n<br>\r\n<br>\r\nПо характеру связей между блоками различают алгоритмы линейной, разветвляющейся и циклической структуры.', 7),
(16, 7, 'Часто при решении задач приходится повторять выполнение операций по одним и тем же зависимостям при различных значениях входящих в них переменных и производить многократный проход по одним и тем же участкам алгоритма. Такие участки называются циклами. Алгоритмы, содержащие циклы, называется циклическими. Использование циклов существенно сокращает объем алгоритма.\r\n\r\nРазличают циклы с наперед известным и наперед неизвестным количеством проходов.', 1),
(17, 7, 'Пример 1. Рассмотрим пример алгоритма с циклом, имеющим наперед неизвестное количество проходов. Для этого решим следующую задачу. Указать наименьшее количество членов ряда натуральных чисел 1, 2, 3, ..., сумма которых больше числа К.\r\n\r\nБлок-схема алгоритма решения этой задачи приведена на рис. 5. Она состоит из восьми блоков.\r\nПосле начала работы в блоке 2 вводится значение числа К. Далее в блоке 3 переменная i получает значение 1, т. е. значение, с которого начнется отсчет натуральных чисел. Переменная S, предназначенная для накопления сумма этих чисел, перед началом суммирования получает значение 0. После этого управление передается блоку 5.\r\n\r\nВ нем при выполнении команды S = S + i производится сложение содержимого ячеек S и i, а результат записывается в ячейку S. Поскольку до операции сложения было S = 0, i = 1, то после операции будет S = 1. При записи нового значения старое содержимое ячейки S (нуль) стирается, а на его место записывается число 1.', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `full_name` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `login` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `avatar` text CHARACTER SET utf8 COLLATE utf8_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `password`, `avatar`) VALUES
(4, 'Быстрова Анастасия Максимовна', 'admin', 'a_nastya_b@mail.ru', '21232f297a57a5a743894a0e4a801fc3', 'uploads/1654083136default-image.jpg'),
(5, 'Чистякова Татьяна Евгеньевна', 'tanya', 'tanya@local.ru', 'd37eaa547940fdd713097006308bf6c9', 'uploads/1653482078fc2846b7eea496544b0b4d7cfd470026.jpg'),
(6, 'Певчева Виктория Владимировна', 'vika', 'vika@local.ru', 'c341b1783290bc3b03a82b50485332f1', 'uploads/1653482156freitas-16b-900x901.jpg'),
(7, 'Антонов Павел Анатольевич', 'pavel', 'pavel@mail.ru', 'ef1652b79c940145b600de7a2fe0288e', 'uploads/16534819741612773995_31-p-temno-goluboi-fon-minimalizm-oboi-na-aifon-43.jpg'),
(8, 'Матюшкина Анастасия Романовна', 'nastya', 'nastya@mail.ru', 'f7126b1ce9faf63a53673ccb3de5f653', 'uploads/1653481937High_resolution_wallpaper_background_ID_77700440776.jpg'),
(9, 'Морозова Светлана Игоревна', 'sveta', 'sveta@mail.ru', 'ada1fd2a836c65b6220d0fa0eda3258d', 'uploads/16534820171618505519_31-phonoteka_org-p-foni-dlya-prezentatsii-minimalistichnie-31.jpg'),
(10, 'Чувинова София Сергеевна', 'sonya', 'sonya@mail.ru', '4346e11916fbde332f90dc7d9914b098', 'uploads/16534819951558089460_minim-foto-23.jpg'),
(12, 'Шашкова Дарья Дмитриевна', 'dasha', 'dasha@mail.ru', '4bea249142664d11a289ffdf30225a91', 'uploads/16534818591625635274_8-kartinkin-com-p-estetichnie-foni-minimalizm-krasivie-foni-9.jpg'),
(13, 'Артюшина Анастасия Александровна', 'art_nastya', 'art_nastya@mail.ru', 'f7126b1ce9faf63a53673ccb3de5f653', 'uploads/16534818361619737757_33-phonoteka_org-p-fon-rabochego-stola-minimalizm-motivatsiya-34.jpg'),
(14, 'Банакова Марина Сергеевна', 'marina', 'marina@mail.ru', 'ce5225d01c39d2567bc229501d9e610d', 'uploads/1653481915BitterSweetSymphony_JeanetteHagglund-1.jpg'),
(15, 'Полторабатько Тамара Николаевна', 'tamara', 'tamara@mail.ru', '6f61924695bee393771882cc1e0e3096', 'uploads/1653482047168-1688100_neon-material-design.jpg'),
(16, 'Романов Роман Романович', 'roman', 'roman@mail.ru', 'b179a9ec0777eae19382c14319872e1b', 'uploads/165409407612953835862659.57064a2b15262.jpg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`LessonId`);

--
-- Индексы таблицы `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `TestId` (`TestId`);

--
-- Индексы таблицы `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`SessionId`),
  ADD KEY `LessonId` (`LessonId`),
  ADD KEY `UserId` (`UserId`);

--
-- Индексы таблицы `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `LessonId` (`LessonId`);

--
-- Индексы таблицы `theory`
--
ALTER TABLE `theory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `LessonId` (`LessonId`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `lesson`
--
ALTER TABLE `lesson`
  MODIFY `LessonId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `options`
--
ALTER TABLE `options`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT для таблицы `session`
--
ALTER TABLE `session`
  MODIFY `SessionId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT для таблицы `test`
--
ALTER TABLE `test`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `theory`
--
ALTER TABLE `theory`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_ibfk_2` FOREIGN KEY (`TestId`) REFERENCES `test` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`LessonId`) REFERENCES `lesson` (`LessonId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `session_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `test_ibfk_1` FOREIGN KEY (`LessonId`) REFERENCES `lesson` (`LessonId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `theory`
--
ALTER TABLE `theory`
  ADD CONSTRAINT `theory_ibfk_1` FOREIGN KEY (`LessonId`) REFERENCES `lesson` (`LessonId`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
