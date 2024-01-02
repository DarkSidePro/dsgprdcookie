CREATE TABLE IF NOT EXISTS `PREFIX_ds_gprd_cookie_lang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_lang` int(11) NOT NULL,
  `text_value` VARCHAR(2000) NULL DEFAULT NULL COLLATE 'utf8mb3_unicode_ci',
  `cookie_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_lang` (`id_lang`),
  KEY `text_value` (`text_value`),
  KEY `cookie_id` (`cookie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;