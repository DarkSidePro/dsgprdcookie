CREATE TABLE `PREFIX_ds_gprd_cookie_in_category` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`cookie_id` INT(11) NOT NULL,
	`category_id` INT(11) NOT NULL,
	PRIMARY KEY (`id`) USING BTREE,
	INDEX `cookie_id` (`cookie_id`) USING BTREE,
	INDEX `category_id` (`category_id`) USING BTREE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;
