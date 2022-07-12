CREATE DATABASE demo;
use demo;
CREATE TABLE IF NOT EXISTS `category` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35;

INSERT INTO `category` (`cid`, `name`, `parent`) VALUES
(1, 'Hardware', 0),
(2, 'Software', 0),
(3, 'Movies', 0),
(4, 'Clothes', 0),
(5, 'Printers', 1),
(6, 'Monitors', 1),
(7, 'Inkjet printers', 5),
(8, 'Laserjet Printers', 5),
(9, 'LCD monitors', 6),
(10, 'TFT monitors', 6),
(11, 'Antivirus', 2),
(12, 'Action movies', 3),
(13, 'Comedy Movies', 3),
(14, 'Romantic movie', 3),
(15, 'Thriller Movies', 3),
(16, 'Mens', 4),
(17, 'Womens', 4),
(18, 'Shirts', 16),
(19, 'T-shirts', 16),
(20, 'Shirts', 16),
(21, 'Jeans', 16),
(22, 'Accessories', 16),
(23, 'Tees', 17),
(24, 'Skirts', 17),
(25, 'Leggins', 17),
(26, 'Jeans', 17),
(27, 'Accessories', 17),
(28, 'Watches', 22),
(29, 'Tie', 22),
(30, 'cufflinks', 22),
(31, 'Earrings', 27),
(32, 'Bracelets', 27),
(33, 'Necklaces', 27),
(34, 'Pendants', 27);