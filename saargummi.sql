update `cam_users` set email = 'ayesha@hematechservices.com' , pin=1111;
UPDATE cam_station_pos_rel set email_to= 'ayesha@hematechservices.com';
ALTER TABLE `form_frequency_data` ADD `form_type` VARCHAR(255) NULL DEFAULT NULL AFTER `form_user_data_id`, ADD `station_event_id` INT(10) NULL DEFAULT NULL AFTER `form_type`, ADD `email_status` CHAR(1) NULL DEFAULT NULL AFTER `station_event_id`;
ALTER TABLE `good_bad_pieces_details` ADD `part_defect_zone` VARCHAR(50) NOT NULL AFTER `bad_pieces`;ALTER TABLE `good_bad_pieces` ADD `part_defect_zone` VARCHAR(50) NOT NULL AFTER `bad_pieces`;
ALTER TABLE `form_frequency_data` ADD `event_type_id` INT(10) NULL DEFAULT NULL AFTER `station_event_id`;
ALTER TABLE `pm_part_number` ADD `defect_part_images` LONGTEXT NULL DEFAULT NULL AFTER `is_deleted`;
ALTER TABLE `pm_part_number` ADD `part_defect_zone` VARCHAR(255) NOT NULL AFTER `defect_part_images`;
ALTER TABLE `pm_part_number` CHANGE `part_defect_zone` `part_defect_zone` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;
ALTER TABLE `form_frequency_data` ADD `line_up_time` VARCHAR(255) NULL DEFAULT NULL AFTER `station_event_id`;
ALTER TABLE `form_frequency_data` ADD `up_time` VARCHAR(255) NULL DEFAULT NULL AFTER `line_up_time`;
