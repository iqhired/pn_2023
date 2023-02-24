update `cam_users` set email = 'ayesha@hematechservices.com' , pin=1111;
UPDATE cam_station_pos_rel set email_to= 'ayesha@hematechservices.com';
ALTER TABLE `form_frequency_data` ADD `form_type` VARCHAR(255) NULL DEFAULT NULL AFTER `form_user_data_id`, ADD `station_event_id` INT(10) NULL DEFAULT NULL AFTER `form_type`, ADD `email_status` CHAR(1) NULL DEFAULT NULL AFTER `station_event_id`;
ALTER TABLE `good_bad_pieces_details` ADD `part_defect_zone` VARCHAR(50) NOT NULL AFTER `bad_pieces`;
ALTER TABLE `good_bad_pieces` ADD `part_defect_zone` VARCHAR(50) NOT NULL AFTER `bad_pieces`;
ALTER TABLE `form_frequency_data` ADD `event_type_id` INT(10) NULL DEFAULT NULL AFTER `station_event_id`;
ALTER TABLE `pm_part_number` ADD `defect_part_images` LONGTEXT NULL DEFAULT NULL AFTER `is_deleted`;
ALTER TABLE `pm_part_number` ADD `part_defect_zone` VARCHAR(255) NOT NULL AFTER `defect_part_images`;
ALTER TABLE `pm_part_number` CHANGE `part_defect_zone` `part_defect_zone` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;
ALTER TABLE `form_frequency_data` ADD `line_up_time` VARCHAR(255) NULL DEFAULT NULL AFTER `station_event_id`;
ALTER TABLE `form_frequency_data` ADD `up_time` VARCHAR(255) NULL DEFAULT NULL AFTER `line_up_time`;
ALTER TABLE `good_bad_pieces` CHANGE `part_defect_zone` `part_defect_zone` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;
ALTER TABLE `good_bad_pieces_details` CHANGE `part_defect_zone` `part_defect_zone` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;
ALTER TABLE `form_frequency_data` ADD `users` VARCHAR(255) NULL DEFAULT NULL AFTER `event_type_id`;
ALTER TABLE `sg_station_event_log` ADD `line_id` INT(10) NOT NULL AFTER `station_event_id`;
ALTER TABLE `sg_station_event_log` ADD `end_time` VARCHAR(255) NOT NULL AFTER `created_on`, ADD `tt` VARCHAR(255) NOT NULL AFTER `end_time`;
ALTER TABLE `cam_line` ADD `shift_st` CHAR(2) NULL DEFAULT '7' AFTER `is_deleted`;

ALTER TABLE `sg_station_event_log` ADD `line_id` INT(10) NULL AFTER `event_seq`;
ALTER TABLE `sg_station_event_log` ADD `end_time` VARCHAR(255) NULL AFTER `is_incomplete`;
ALTER TABLE `sg_station_event_log` ADD `tt` VARCHAR(255) NULL AFTER `end_time`;
update sg_station_event_log as slog inner join sg_station_event as sg on slog.station_event_id = sg.station_event_id set slog.line_id=sg.line_id where slog.station_event_id = sg.station_event_id;

ALTER TABLE `form_type` ADD `email_req` CHAR(1) NOT NULL DEFAULT '0' AFTER `form_rejection_loop`;
ALTER TABLE `form_frequency_data` CHANGE `email_status` `email_status` CHAR(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0';
ALTER TABLE `form_frequency_data` CHANGE `email_status` `lab_email` CHAR(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0';
ALTER TABLE `form_frequency_data` ADD `op_mail` CHAR(1) NOT NULL DEFAULT '0' AFTER `lab_email`, ADD `psheet_mail` CHAR(1) NOT NULL DEFAULT '0' AFTER `op_mail`;