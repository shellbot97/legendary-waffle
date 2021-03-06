CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `media_id` int NOT NULL,
  `url` varchar(1000) NOT NULL,
  `headline` varchar(255) NOT NULL,
  `published_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `language_id` int NOT NULL,
  `location_id` int NOT NULL,
  `auther_id` int NOT NULL,
  `publisher_id` int NOT NULL,
  `section_id` int NOT NULL,
  `content` blob NOT NULL,
  `keywords` text NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) NULL,
  FOREIGN KEY (`media_id`) REFERENCES `media` (`media_id`),
  FOREIGN KEY (`language_id`) REFERENCES `languages` (`language_id`),
  FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`),
  FOREIGN KEY (`auther_id`) REFERENCES `authers` (`auther_id`),
  FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`publisher_id`),
  FOREIGN KEY (`section_id`) REFERENCES `sections` (`section_id`)
);