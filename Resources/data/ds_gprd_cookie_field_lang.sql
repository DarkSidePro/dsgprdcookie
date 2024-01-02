CREATE TABLE IF NOT EXISTS `PREFIX_ds_gprd_cookie_field_lang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_lang` int(11) NOT NULL,
  `text_value` varchar(4096) DEFAULT NULL,
  `field_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_lang` (`id_lang`),
  KEY `FKds_gprd_co51441` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;