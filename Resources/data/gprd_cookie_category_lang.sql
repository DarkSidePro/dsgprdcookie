CREATE TABLE `PREFIX_ds_gprd_cookie_category_lang` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`id_lang` INT(11) NOT NULL,
	`text_value` VARCHAR(2048),
	`category` VARCHAR(255) NOT NULL,
	`date_add` DATETIME NOT NULL,
	`date_upd` DATETIME NOT NULL,
	PRIMARY KEY (`id`) USING BTREE
	INDEX (id), 
	INDEX (id_lang), 
	INDEX (category), 
	INDEX (category_name)
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;
