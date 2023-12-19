CREATE TABLE `PREFIX_ds_gprd_cookie_category` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`default_enabled` BIT NOT NULL,
	`readonly` BIT NOT NULL,
	`date_add` DATETIME NOT NULL,
	`date_upd` DATETIME NOT NULL,
	PRIMARY KEY (`id`) USING BTREE
	INDEX (id), 
  	INDEX (cookie_category)
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;
