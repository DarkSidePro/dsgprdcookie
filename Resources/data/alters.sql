ALTER TABLE PREFIX_ds_gprd_cookie_configuration_values ADD CONSTRAINT FKds_gprd_co653573 FOREIGN KEY (configuration) REFERENCES PREFIX_ds_gprd_cookie_configuration (id);
ALTER TABLE PREFIX_ds_gprd_cookie_lang ADD CONSTRAINT FKds_gprd_co960709 FOREIGN KEY (cookie) REFERENCES PREFIX_ds_gprd_cookie (id);
ALTER TABLE PREFIX_ds_gprd_cookie_category_lang ADD CONSTRAINT FKds_gprd_co870681 FOREIGN KEY (category) REFERENCES PREFIX_ds_gprd_cookie_category (id);
ALTER TABLE PREFIX_ds_gprd_cookie_field_lang ADD CONSTRAINT FKds_gprd_co51441 FOREIGN KEY (field) REFERENCES PREFIX_ds_gprd_cookie_field (id);
ALTER TABLE PREFIX_ds_gprd_cookie_category ADD CONSTRAINT FKds_gprd_co654092 FOREIGN KEY (id) REFERENCES PREFIX_ds_gprd_cookie (id);