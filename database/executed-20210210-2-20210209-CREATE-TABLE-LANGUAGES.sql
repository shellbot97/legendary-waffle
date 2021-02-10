CREATE TABLE `languages` (
  `language_id` int NOT NULL AUTO_INCREMENT,
  `language_name` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `language_abbreviation` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `is_active` int NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;