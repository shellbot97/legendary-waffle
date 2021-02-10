CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(500) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `remarks` varchar(50) NULL
);