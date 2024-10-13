CREATE TABLE `staff` (
  `staffId` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`staffId`)
);