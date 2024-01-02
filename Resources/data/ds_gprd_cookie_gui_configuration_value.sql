CREATE TABLE IF NOT EXISTS `PREFIX_ds_gprd_cookie_gui_configuration_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_value` varchar(255) NOT NULL,
  `configuration_id` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `configuration_id` (`configuration_id`),
  KEY `enabled` (`enabled`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;