CREATE TABLE `activity` (
  `activityId` int(10) NOT NULL AUTO_INCREMENT,
  `sleepRating` int(2) NOT NULL,
  `sleepNotes` varchar(200) DEFAULT NULL,
  `foodRating` int(2) NOT NULL,
  `foodNotes` varchar(200) DEFAULT NULL,
  `waterRate` int(2) NOT NULL,
  `waterNotes` varchar(200) DEFAULT NULL,
  `exerciseRating` int(2) NOT NULL,
  `exerciseNotes` varchar(200) DEFAULT NULL,
  `createdDate` date NOT NULL,
  PRIMARY KEY (`activityId`)
);