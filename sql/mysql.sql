#
# Structure table for `countdown_categories` 
#

CREATE TABLE `countdown_categories` (
  `category_id` INT(11)     NOT NULL  AUTO_INCREMENT,
  `category_title` varchar(256) NOT NULL,
  `category_weight` int(11) NOT NULL  DEFAULT 0,
  PRIMARY KEY (`category_id`)
) 
  ENGINE=MyISAM ;

#
# Structure table for `countdown_events` 5
#

CREATE TABLE `countdown_events` (
  `event_id`          INT(11)     NOT NULL  AUTO_INCREMENT,
  `event_name`        VARCHAR(256) NOT NULL,
  `event_description` MEDIUMTEXT  NOT NULL,
  `event_enddatetime` TIMESTAMP   NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `event_uid`         INT(11)     NOT NULL  DEFAULT 0,
  `event_categoryid`  INT(11)     NOT NULL  DEFAULT 0,
  `event_logo`        VARCHAR(256) NOT NULL,
  `date_created`      INT(11) UNSIGNED NOT NULL DEFAULT 0,
  `date_updated`      INT(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`event_id`)
)
  ENGINE = MyISAM;
