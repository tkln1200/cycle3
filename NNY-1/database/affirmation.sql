CREATE TABLE `affirmation` (
  `affirmationId` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) NOT NULL,
  `isSelected` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`affirmationId`)
);