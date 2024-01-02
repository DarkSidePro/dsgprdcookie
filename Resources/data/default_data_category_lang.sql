-- --------------------------------------------------------
-- Host:                         localhost
-- Wersja serwera:               11.2.2-MariaDB-1:11.2.2+maria~ubu2204 - mariadb.org binary distribution
-- Serwer OS:                    debian-linux-gnu
-- HeidiSQL Wersja:              12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Zrzucanie danych dla tabeli prestashop.ps_ds_gprd_cookie_category_lang: ~3 rows (około)
INSERT INTO `PREFIX_ds_gprd_cookie_category_lang` (`id`, `id_lang`, `text_value`, `category_id`, `category_name`) VALUES
	(2, 1, 'Te pliki cookie są niezbędne do prawidłowego funkcjonowania witryny i nie można ich wyłączyć.', 1, 'Niezbędne'),
	(3, 1, 'Te pliki cookie zbierają informacje o sposobie korzystania z naszej witryny. Wszystkie dane są anonimowe i nie mogą być wykorzystane do identyfikacji użytkownika.', 2, 'Wydajność i analityka'),
	(4, 1, 'Te pliki cookie są wykorzystywane w celu lepszego dopasowania komunikatów reklamowych do użytkownika i jego zainteresowań. Celem jest wyświetlanie reklam, które są odpowiednie i angażujące dla poszczególnych użytkowników, a tym samym bardziej wartościowe dla wydawców i zewnętrznych reklamodawców.', 3, 'Targetowanie i reklama');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
