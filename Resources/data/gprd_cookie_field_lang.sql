CREATE TABLE `PREFIX_ds_gprd_cookie_field_lang` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`id_lang` INT(11) UNSIGNED NOT NULL,
	`text_value` VARCHAR(4096),
	`field` INT(11) UNSIGNED NOT NULL,
	PRIMARY KEY (`id`) USING BTREE
	INDEX (id), 
  	INDEX (field_name)
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;
