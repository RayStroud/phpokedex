CREATE TABLE IF NOT EXISTS `ability` (
  `ability_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`ability_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=191 ;

CREATE TABLE IF NOT EXISTS `pokemon` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `img_name` varchar(100) DEFAULT NULL,
  `pokedex_no` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `type1` varchar(8) NOT NULL,
  `type2` varchar(8) DEFAULT NULL,
  `info` text NOT NULL,
  `height` decimal(5,1) NOT NULL,
  `weight` decimal(5,1) NOT NULL,
  `ability1` int(11) NOT NULL,
  `ability2` int(11) DEFAULT NULL,
  `abilityH` int(11) DEFAULT NULL,
  `hp` int(11) NOT NULL,
  `atk` int(11) NOT NULL,
  `def` int(11) NOT NULL,
  `sp_atk` int(11) NOT NULL,
  `sp_def` int(11) NOT NULL,
  `spd` int(11) NOT NULL,
  `bst` int(11) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=782 ;