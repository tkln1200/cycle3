-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 14, 2024 at 02:55 AM
-- Server version: 5.7.24
-- PHP Version: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS care_db;
CREATE DATABASE care_db;

USE care_db;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `activityId` int(10) NOT NULL,
  `sleepRating` int(2) NOT NULL,
  `sleepNotes` varchar(200) DEFAULT NULL,
  `foodRating` int(2) NOT NULL,
  `foodNotes` varchar(200) DEFAULT NULL,
  `waterRate` int(2) NOT NULL,
  `waterNotes` varchar(200) DEFAULT NULL,
  `exerciseRating` int(2) NOT NULL,
  `exerciseNotes` varchar(200) DEFAULT NULL,
  `createdDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`activityId`, `sleepRating`, `sleepNotes`, `foodRating`, `foodNotes`, `waterRate`, `waterNotes`, `exerciseRating`, `exerciseNotes`, `createdDate`) VALUES
(12, 9, NULL, 9, NULL, 10, NULL, 10, NULL, '2024-10-14');

-- --------------------------------------------------------

--
-- Table structure for table `affirmation`
--

CREATE TABLE `affirmation` (
  `affirmationId` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `isSelected` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `affirmation`
--

INSERT INTO `affirmation` (`affirmationId`, `description`, `isSelected`) VALUES
(5, 'I choose to see the good in every situation.', 0),
(6, 'I am in the right place at the right time, doing the right thing', 1),
(7, 'You are loved just for being who you are, just for existing', 0);

-- --------------------------------------------------------

--
-- Table structure for table `auditor`
--

CREATE TABLE `auditor` (
  `auditorId` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auditor`
--

INSERT INTO `auditor` (`auditorId`, `email`, `fname`, `lname`, `password`) VALUES
(1, 'amanda.a@care.com', 'Amanda', 'Auditor', '$2y$10$0J3v6hSyhwntLcco4USuguxNYRCJsD.gxxroLNHDgIPIlFefChu.O');

-- --------------------------------------------------------

--
-- Table structure for table `goal`
--

CREATE TABLE `goal` (
  `goalId` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `category` varchar(45) NOT NULL,
  `dueDate` date NOT NULL,
  `isCompleted` tinyint(1) DEFAULT NULL,
  `completedDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `goal`
--

INSERT INTO `goal` (`goalId`, `title`, `category`, `dueDate`, `isCompleted`, `completedDate`) VALUES
(17, 'I will not drink any alcohol', 'eatingGoal', '2024-10-16', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(50) DEFAULT NULL,
  `space` int(11) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `sTime` time DEFAULT NULL,
  `eTime` time DEFAULT NULL,
  `therapist_id` int(11) DEFAULT NULL,
  `occupied_space` int(11) DEFAULT NULL,
  `group_progress` int(11) DEFAULT NULL,
  `participants` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `space`, `location`, `date`, `sTime`, `eTime`, `therapist_id`, `occupied_space`, `group_progress`, `participants`) VALUES
(2, 'GAD Group Consulting', 3, 'Room 1', '2024-10-15', '14:20:00', '15:20:00', 5, 2, 0, '57,58');

-- --------------------------------------------------------

--
-- Table structure for table `group_patients`
--

CREATE TABLE `group_patients` (
  `id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `group_patients`
--

INSERT INTO `group_patients` (`id`, `group_id`, `patient_id`) VALUES
(3, 2, 57),
(4, 2, 58);

-- --------------------------------------------------------

--
-- Table structure for table `journal`
--

CREATE TABLE `journal` (
  `id` int(11) NOT NULL,
  `patientId` int(11) DEFAULT NULL,
  `therapistId` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `dateCreated` date DEFAULT NULL,
  `timeCreated` time DEFAULT NULL,
  `details` text,
  `moodLevel` int(11) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `journal`
--

INSERT INTO `journal` (`id`, `patientId`, `therapistId`, `title`, `dateCreated`, `timeCreated`, `details`, `moodLevel`, `file`) VALUES
(109, 58, 5, 'Productive day at work', '2024-09-30', '18:41:00', 'I can hardly believe it—I actually did it. After six grueling months of constant stress, sleepless nights, and endless self-doubt, I finished the project. It was like climbing a mountain, and today, I finally reached the top. The client has been such a nightmare, always demanding more, never satisfied, and making me question every decision I made. But today, when I handed in that final report, and they actually smiled—really smiled—I felt a wave of relief and pride that I haven’t felt in a long time. <br> It’s like all the anxiety I’ve been carrying around suddenly lifted, even if just for a moment. I’ve been so hard on myself, convinced I wasn’t good enough, that I’d somehow mess this up, but I didn’t. I pushed through, despite all the times I wanted to give up, and now I can see that it was worth it. I’m excited, not just because it’s over, but because I proved to myself that I can handle this. I’m stronger than I thought. I still feel the anxiety lurking in the background, but today, it doesn’t seem as powerful. Today, I feel like I won, and that’s a feeling I want to hold onto for as long as I can.', 10, NULL),
(110, 57, 5, 'Why me?', '2024-10-14', '02:38:00', 'I don\'t know why I even bother anymore. Everything feels so heavy, like I\'m carrying the weight of the world on my shoulders. Every day is the same—wake up, fight through the endless thoughts, pretend I\'m okay, and then collapse back into bed, only to repeat the cycle. My heart races for no reason, my thoughts spiral out of control, and I can never seem to find a moment of peace. It\'s exhausting. I try to be strong, to keep going, but what\'s the point? I\'m just so tired of constantly worrying about everything—about things that don\'t even matter in the grand scheme of things. But I can\'t stop. It\'s like I\'m trapped in my own mind, suffocating under the pressure of my own thoughts. Everyone else seems to have it together, so why can\'t I? Why does everything feel like such a struggle? I hate that I can\'t control this, that it feels like I\'ll never be free of it. I just want to escape, to find some relief, but I don\'t even know what that would look like. How do I keep going when it all feels so pointless?', 1, NULL),
(111, 57, 5, 'Does my dog know how to talk?', '2024-10-12', '21:39:00', 'Loneliness has become a constant companion, wrapping itself around me in ways I never imagined. Some days, the emptiness feels overwhelming, like there\'s no one in the world who truly understands. I see people with their friends, their families, and wonder why I can\'t feel that connection. It\'s like I\'m on the outside looking in, always yearning for something I can\'t quite reach. But then there\'s Max, my sweet, loyal dog. He\'s the one being who seems to get me without needing any words. When the anxiety becomes too much, and I feel like I\'m drowning in my own thoughts, Max is there, quietly lying next to me, offering a kind of comfort no human ever has. His soft fur under my hand, the way he looks at me with those big, trusting eyes—it\'s like he\'s saying, \\\"I\'m here, you\'re not alone.\\\" I don\'t know what I\'d do without him. He’s my anchor in this storm, reminding me that even in the depths of my loneliness, I’m not truly alone. I’m so grateful for him, for the unconditional love he gives me, for the way he’s always by my side, even when the world feels like it’s falling apart.', 5, 'dog.jpg'),
(112, 59, 5, 'Falling in love or is it just alcohol?', '2024-10-14', '02:42:00', 'I don\'t usually let myself go like this, but tonight, after a few too many drinks, everything I’ve been holding back is bubbling to the surface. It’s strange how alcohol seems to peel away the layers I’ve carefully built around myself, exposing this raw, aching need for connection. I can’t help but think about how lonely I am, how much I crave the touch, the warmth of another person. I’ve always been so scared to let anyone in, terrified they’ll see the mess I am inside, but right now, all I want is someone to hold me, to tell me it’s going to be okay. It’s like there’s a hole inside me, and no matter how much I try to fill it with distractions or pretend it’s not there, it never goes away. I want to be loved, to be seen, to be someone’s person, but I’m so afraid. I don’t know how to let go of this fear, this anxiety that keeps me trapped in my own mind. The alcohol makes it easier to imagine what it would be like, to dream of a world where I’m not so alone, but I know when I wake up, I’ll be back in my cage, longing for something I’m too scared to reach for.\"', 4, 'last_night_party.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `therapist_id` int(11) NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `patient_id`, `therapist_id`, `notes`) VALUES
(2, 57, 5, 'The patient needs to rest');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `therapistId` int(11) DEFAULT NULL,
  `title` varchar(10) DEFAULT NULL,
  `fName` varchar(50) DEFAULT NULL,
  `lName` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `contactNo` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `streetAddress` varchar(255) DEFAULT NULL,
  `postCode` varchar(10) DEFAULT NULL,
  `height` decimal(5,2) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `diagnosis` text,
  `status` varchar(20) DEFAULT NULL,
  `profile` longblob,
  `password` varchar(255) DEFAULT NULL,
  `groupId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `therapistId`, `title`, `fName`, `lName`, `dob`, `gender`, `contactNo`, `email`, `streetAddress`, `postCode`, `height`, `weight`, `startDate`, `endDate`, `diagnosis`, `status`, `profile`, `password`, `groupId`) VALUES
(57, 5, 'Ms', 'Zoe', 'Glasson', '1998-02-18', 'Female', '0412345678', 'zoe.glasson@gmail.com', '122 Main Rd', '5000', '156.00', '60.00', '2024-01-23', '0000-00-00', 'GAD', 'Active', NULL, '$2y$10$lcSqlgqaZSI.u5qTtxfKyOgK86v1jpFriXyUPl3QLzah0rMs5tqhC', 1),
(58, 5, 'Ms', 'Phoebe', 'Sigley', '1993-10-20', 'Female', '0453789273', 'phoebe.sigley@gmail.com', '45 Thirza Rd', '5044', '168.00', '53.00', '2024-10-09', '0000-00-00', 'GAD', 'Active', NULL, '$2y$10$IadS2cBol4t8qLrVhNBdt.rjKNlM6C9gCYsBwE7Js/eRd/nMsoBYi', NULL),
(59, 5, 'Mr', 'Jack', 'Baker', '2001-06-06', 'Male', '0452289227', 'jack.baker@gmail.com', '144 South Rd', '5063', '189.00', '67.00', '2024-10-01', '0000-00-00', 'Depression', 'Active', NULL, '$2y$10$lvQybSnvXcZy/AblrNpenOJj/AnCK9LL8iRs59pGtKyJG.JpMAQti', NULL),
(60, 5, 'Ms', 'Amy', 'Mitchell', '1998-04-18', 'Female', '0412345678', 'amy.mitchell@gmail.com', '122 Main Rd', '5000', '156.00', '60.00', '2024-01-23', '0000-00-00', 'GAD', 'Active', NULL, '$2y$10$WM/R7gwuyzew4VHXMx1Bwe7ELP4UBMu6JBZa52g6ajAWwNceRNiaW', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffId` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffId`, `email`, `fname`, `lname`, `password`) VALUES
(4, 'johny.j@care.com', 'Johnny', 'Jullian', '$2y$10$8cesOneDlTfbATW/47h9c.24i7bHvRcZ0gjDjksgmVRcjGCyvY4re');

-- --------------------------------------------------------

--
-- Table structure for table `therapist`
--

CREATE TABLE `therapist` (
  `id` int(11) NOT NULL,
  `title` varchar(10) DEFAULT NULL,
  `fName` varchar(50) DEFAULT NULL,
  `lName` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contactNo` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `profile` longblob,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `therapist`
--

INSERT INTO `therapist` (`id`, `title`, `fName`, `lName`, `email`, `contactNo`, `address`, `profile`, `password`) VALUES
(5, NULL, 'Lauren', 'Li', 'lauren.li@care.com', NULL, NULL, NULL, '$2y$10$p5MdPXV4RifP9WnaMcUDSOdxBJRaWWXpirIl8AhorKUhCvS2NcHOS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`activityId`);

--
-- Indexes for table `affirmation`
--
ALTER TABLE `affirmation`
  ADD PRIMARY KEY (`affirmationId`);

--
-- Indexes for table `auditor`
--
ALTER TABLE `auditor`
  ADD PRIMARY KEY (`auditorId`);

--
-- Indexes for table `goal`
--
ALTER TABLE `goal`
  ADD PRIMARY KEY (`goalId`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_patients`
--
ALTER TABLE `group_patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patientId` (`patientId`),
  ADD KEY `therapistId` (`therapistId`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `therapistId` (`therapistId`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffId`);

--
-- Indexes for table `therapist`
--
ALTER TABLE `therapist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `activityId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `affirmation`
--
ALTER TABLE `affirmation`
  MODIFY `affirmationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `auditor`
--
ALTER TABLE `auditor`
  MODIFY `auditorId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `goal`
--
ALTER TABLE `goal`
  MODIFY `goalId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `group_patients`
--
ALTER TABLE `group_patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `journal`
--
ALTER TABLE `journal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `therapist`
--
ALTER TABLE `therapist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `journal`
--
ALTER TABLE `journal`
  ADD CONSTRAINT `journal_ibfk_1` FOREIGN KEY (`patientId`) REFERENCES `patient` (`id`),
  ADD CONSTRAINT `journal_ibfk_2` FOREIGN KEY (`therapistId`) REFERENCES `therapist` (`id`);

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`therapistId`) REFERENCES `therapist` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
