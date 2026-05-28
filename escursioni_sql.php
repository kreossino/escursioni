CREATE TABLE `e107_escursioni` (
  `ex_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ex_title` varchar(255) NOT NULL DEFAULT '',
  `ex_sef` varchar(255) NOT NULL DEFAULT '',
  `ex_text` text NOT NULL,
  `ex_image1` varchar(255) NOT NULL DEFAULT '',
  `ex_image2` varchar(255) NOT NULL DEFAULT '',
  `ex_image3` varchar(255) NOT NULL DEFAULT '',
  `ex_image4` varchar(255) NOT NULL DEFAULT '',
  `ex_file` varchar(255) NOT NULL DEFAULT '',
  `ex_type` varchar(255) NOT NULL DEFAULT '',
  `ex_duration` varchar(255) NOT NULL DEFAULT '',
  `ex_difficulty` varchar(255) NOT NULL DEFAULT '',
  `escursioni_name` varchar(255) NOT NULL DEFAULT '',
  `escursioni_folder` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`ex_id`),
  FULLTEXT (`escursioni_name`),
  FULLTEXT (`escursioni_folder`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

CREATE TABLE `e107_escursioni_selezioni` (
  `sel_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sel_slug` varchar(190) NOT NULL DEFAULT '',
  `sel_title` varchar(255) NOT NULL DEFAULT '',
  `sel_ids` text NOT NULL,
  `sel_datestamp` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`sel_id`),
  UNIQUE KEY `sel_slug` (`sel_slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
