CREATE TABLE IF NOT EXISTS `PREFIX_ds_gprd_cookie_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `default_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `readonly` tinyint(1) NOT NULL,
  `type` ENUM('necessary','analytics','ads','') NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `cookie_in_category_id` (`cookie_in_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
