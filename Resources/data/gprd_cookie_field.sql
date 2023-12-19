CREATE TABLE `PREFIX_ds_gprd_cookie_field` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`field_name` INT(11) UNSIGNED NOT NULL,
	PRIMARY KEY (`id`) USING BTREE
	INDEX (id), 
  	INDEX (field_name)
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;
