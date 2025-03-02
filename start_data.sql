SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `height` double UNSIGNED DEFAULT NULL,
  `kg` double UNSIGNED DEFAULT NULL,
  `years` int UNSIGNED DEFAULT NULL,
  `active_range` double UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `name`, `gender`, `height`, `kg`, `years`, `active_range`) VALUES
(1, 'niki@niki.bg', 'nikipass', 'Niki', 'мъж', '183', '85', '20', '1.55');
COMMIT;
