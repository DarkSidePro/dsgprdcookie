CREATE TABLE `ps_ds_gprd_cookie` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`id_shop` INT(10) NOT NULL,
	`cookie_service` VARCHAR(255) NOT NULL COLLATE 'utf8mb3_unicode_ci',
	`cookie_name` VARCHAR(255) NOT NULL COLLATE 'utf8mb3_unicode_ci',
	`enabled` INT(11) NOT NULL,
	`script` TEXT NOT NULL COLLATE 'utf8mb3_unicode_ci',
	`extra_script` TEXT NULL DEFAULT NULL COLLATE 'utf8mb3_unicode_ci',
	`position` ENUM('header','footer') NOT NULL DEFAULT 'footer' COLLATE 'utf8mb3_unicode_ci',
	PRIMARY KEY (`id`) USING BTREE,
	INDEX `id` (`id`) USING BTREE
)
COLLATE='utf8mb3_unicode_ci'
ENGINE=InnoDB
;
