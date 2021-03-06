CREATE TABLE IF NOT EXISTS `kwc_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `teaser` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `visible` tinyint(4) NOT NULL,
  `is_top` tinyint(4) NOT NULL,
  `read_required` tinyint(4) NOT NULL,
  `vi_nr` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `author_id` int(11) NOT NULL,
  `expire_top_read_required` date DEFAULT NULL,
  `views` int(11) NOT NULL,
  `mail_priority` int(11) NOT NULL,
  `only_intern` tinyint(4) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `is_top` (`is_top`),
  KEY `visible` (`visible`),
  KEY `deleted` (`deleted`),
  KEY `only_intern` (`only_intern`),
  KEY `date` (`date`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
