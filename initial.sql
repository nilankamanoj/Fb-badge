create database overlay;

use database overlay;

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `uname` varchar(40) CHARACTER SET latin1 NOT NULL,
  `u_id` int(12) NOT NULL,
  `name` varchar(40) CHARACTER SET latin1 NOT NULL,
   `description` varchar(500) CHARACTER SET latin1 NOT NULL,
    `fileurl` varchar(40) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;