CREATE TABLE `goal` (
  `goalId` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `category` varchar(45) NOT NULL,
  `dueDate` date NOT NULL,
  `isCompleted` tinyint(1) NOT NULL,
  `completedDate` date DEFAULT NULL,
  PRIMARY KEY (`goalId`)
);