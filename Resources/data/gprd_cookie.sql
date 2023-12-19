CREATE TABLE `PREFIX_ds_gprd_cookie` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`id_shop` INT(11) UNSIGNED NOT NULL,
	`cookie_service` VARCHAR(255) NOT NULL,
	`cookie_name` VARCHAR(255) NOT NULL,
	'cookie_category' INT(11) UNSIGNED NOT NULL,
	`date_add` DATETIME NOT NULL,
	`date_upd` DATETIME NOT NULL,
	PRIMARY KEY (`id`) USING BTREE
	INDEX (id), 
  	INDEX (cookie_category)
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;
