CREATE TABLE `PREFIX_ds_gprd_cookie_lang` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`id_lang` INT(11) UNSIGNED NOT NULL,
	`text_value` VARCHAR(255) NOT NULL,
	`cookie` INT(11) NOT NULL,
	PRIMARY KEY (`id`) USING BTREE
	INDEX (id), 
  	INDEX (id_lang),
	INDEX (text_value),
	INDEX(cookie)
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;
