-- Zrzut struktury tabela pomarex13_erp_dev.ds_gprd_cookie_category_lang
CREATE TABLE IF NOT EXISTS `PREFIX_ds_gprd_cookie_category_lang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_lang` int(11) NOT NULL,
  `text_value` varchar(500) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_lang` (`id_lang`),
  KEY `category_id` (`category_id`),
  KEY `category_name` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;