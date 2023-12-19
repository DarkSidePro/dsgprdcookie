CREATE TABLE `PREFIX_ds_gprd_cookie_gui_configuration_value` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`field_value` VARCHAR(255) NOT NULL,
	`enabled` BIT(1) NOT NULL,
	`configuration` INT(11) NOT NULL,
	PRIMARY KEY (`id`) USING BTREE
	INDEX (id), 
	INDEX (configuration), 
	INDEX (enabled)
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;
