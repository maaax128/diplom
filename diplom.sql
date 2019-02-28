-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.6.41-log - MySQL Community Server (GPL)
-- Операционная система:         Win32
-- HeidiSQL Версия:              10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица diplom.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы diplom.admins: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT IGNORE INTO `admins` (`id`, `login`, `password`) VALUES
	(1, 'admin', 'admin'),
	(2, 'qwert', 'мсчмчсмсч'),
	(6, 'Дэн Кеннеди', '1234'),
	(11, 'ура', 'работает'),
	(14, 'ммммм', 'мммм'),
	(15, 'Вадик', '1234');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;

-- Дамп структуры для таблица diplom.answer
CREATE TABLE IF NOT EXISTS `answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answer` varchar(255) NOT NULL,
  `id_category` int(255) NOT NULL,
  `id_questions` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы diplom.answer: ~8 rows (приблизительно)
/*!40000 ALTER TABLE `answer` DISABLE KEYS */;
INSERT IGNORE INTO `answer` (`id`, `answer`, `id_category`, `id_questions`) VALUES
	(1, 'в автосервисе', 1, 1),
	(3, 'в магазине', 1, 9),
	(4, 'Вадя, сам разбирайся', 4, 3),
	(5, 'Конечно же', 60, 30),
	(8, 'Знают все, кроме Вади', 60, 4),
	(9, 'Вад', 4, 8),
	(10, '145', 5, 31),
	(11, 'много', 4, 10);
/*!40000 ALTER TABLE `answer` ENABLE KEYS */;

-- Дамп структуры для таблица diplom.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы diplom.category: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT IGNORE INTO `category` (`id`, `category`) VALUES
	(4, 'Бизнес'),
	(5, 'Разное'),
	(60, 'Авто');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Дамп структуры для таблица diplom.questions
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `id_category` int(255) NOT NULL,
  `answered` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `create_date` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы diplom.questions: ~9 rows (приблизительно)
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT IGNORE INTO `questions` (`id`, `question`, `id_category`, `answered`, `userName`, `email`, `create_date`, `status`) VALUES
	(3, 'Нужно установить программу 1С к кому можно обратиться? А Вадя знает????', 4, 1, 'test1', '', '2019-02-20', 2),
	(4, 'Кто знает прогамму модификаций коалического ве?', 60, 1, 'test', '', '2019-01-10', 1),
	(6, 'Сколько зарабатывает президент?', 4, 0, 'test', '', '2019-02-09', 0),
	(10, 'сколько тебе лет?', 4, 1, 'Максим', 'maaax128@list.ru', '2019-02-08', 1),
	(30, 'Вадя, где ты был?', 60, 1, 'Вадикадик', 'maaax128@list.ru', '2019-02-09', 1),
	(31, 'ваааааааааааааааааааааааа1', 5, 1, 'Нетология', 'maaax128@list.ru', '2018-10-10', 1),
	(32, 'да да да', 4, 0, 'але', 'maaax@list.ru', '2019-01-10', 0),
	(33, 'апиапипа', 5, 0, '12', 'паиаип', '2019-01-01', 0),
	(35, 'епепепепепепепе', 4, 0, 'але', 'кккккккк', '2019-02-10', 0);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
