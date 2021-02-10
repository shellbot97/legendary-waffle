CREATE TABLE `sessions` (
  `session_id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `session_token` varchar(1000) NOT NULL,
  `data` text NULL,
  `is_active` int(1) NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `remarks` varchar(50) NULL,
  FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`),
  FOREIGN KEY (`updated_by`) REFERENCES `users` (`user_id`)
);