CREATE TABLE `publishers` (
  `publisher_id` int NOT NULL AUTO_INCREMENT,
  `publisher_name` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `media_id` int NOT NULL,
  `is_active` int NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remarks` varchar(50) NOT NULL,
  PRIMARY KEY (`publisher_id`),
  KEY `media_id` (`media_id`),
  CONSTRAINT `publishers_ibfk_1` FOREIGN KEY (`media_id`) REFERENCES `media` (`media_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;