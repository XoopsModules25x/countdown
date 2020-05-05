#
# Structure table for `countdown_events` 5
#

CREATE TABLE `countdown_events` (
  `id`          INT(11)     NOT NULL  AUTO_INCREMENT,
  `uid`         INT(11)     NOT NULL  DEFAULT 0,
  `name`        VARCHAR(255) NOT NULL,
  `description` MEDIUMTEXT  NOT NULL,
  `enddatetime` TIMESTAMP   NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)
  ENGINE = MyISAM;
