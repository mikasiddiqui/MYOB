-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 19, 2016 at 07:53 AM
-- Server version: 10.1.11-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `completed`
--

CREATE TABLE `completed` (
  `id` int(11) NOT NULL,
  `priority` int(255) NOT NULL,
  `task` varchar(50000) NOT NULL,
  `deadline` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `commented` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `completed`
--

INSERT INTO `completed` (`id`, `priority`, `task`, `deadline`, `commented`) VALUES
(1, 1, 'Complete accounting project', '2016-05-19 07:50:56', 1),
(2, 2, 'Compile Research', '2016-05-19 07:51:31', 1),
(3, 1, 'Finish big tech project', '2016-05-19 07:51:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `corpus`
--

CREATE TABLE `corpus` (
  `id` int(11) NOT NULL,
  `sentence` varchar(60000) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `corpus`
--

INSERT INTO `corpus` (`id`, `sentence`, `title`, `date`) VALUES
(3, 'Internet has created an all new virtual world that is very helpful in providing every information by click of a button and also very user friendly. Internet, as a source of information, is a boon for people. It provides anything and everything without having to go out and explore. By saying this, I completely disagree with the author and feel that the advantages outweigh the drawbacks.', 'Tech', '2016-05-18 16:02:52'),
(4, 'As the society grows more and more health conscious, stronger voices to ban smoking in all public areas begin to emerge. Banning public has been used as a mean for government to discourage smoking and also to improve city image. It is almost impossible to achieve consensus on this issue as it creates great inconvenience for the smokers. However, I believe smoking should be banned in public places and my reasons are as follow.', 'Smoking', '2016-05-18 16:22:40'),
(5, 'its the best thing to cure bordem. if only i could get to level 5 so there wouldnt be limits on answers.', 'Yahoo', '2016-05-18 16:38:30'),
(6, 'MYOB is a good company in the way that it helps employees develop their skills, although it treats it\'s customers poorly and makes no attempt to help the wider community.', 'Tech', '2016-05-19 03:15:29'),
(7, 'This is cool.', 'MYOB', '2016-05-19 05:07:44'),
(8, 'This is decent, not bad.', 'MYOB', '2016-05-19 05:08:24'),
(9, 'This is weird.', 'MYOB', '2016-05-19 05:08:55'),
(10, 'This is really cool, i like this.', 'Tech', '2016-05-19 05:09:24'),
(11, 'This is really bad, i like this.', 'Tech', '2016-05-19 05:09:52'),
(12, 'I dont enjoy this at all.', 'Tech', '2016-05-19 05:10:25'),
(13, 'Smoking is not cool at all.', 'Smoking', '2016-05-19 05:12:21'),
(14, 'Smoking sucks.', 'Smoking', '2016-05-19 05:12:47'),
(15, 'MYOB is a cool company', 'MYOB', '2016-05-19 09:04:14'),
(17, 'I found it rather enjoyable.', 'Tech', '2016-05-19 08:10:56');

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `id` int(11) NOT NULL,
  `value` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`id`, `value`) VALUES
(9, 1),
(10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sentiment_table`
--

CREATE TABLE `sentiment_table` (
  `id` int(11) NOT NULL,
  `sentence_id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sentiment` varchar(10) NOT NULL,
  `confidence` float(20,19) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sentiment_table`
--

INSERT INTO `sentiment_table` (`id`, `sentence_id`, `title`, `sentiment`, `confidence`) VALUES
(5, 3, 'Tech', 'pos', 0.5714285969734192000),
(6, 4, 'Smoking', 'neg', 0.6999999880790710000),
(7, 5, 'Tech', 'neg', 0.5714285969734192000),
(8, 9, 'Testing', 'pos', 0.6000000238418579000),
(9, 10, 'Test', 'pos', 0.5000000000000000000),
(10, 12, 'Test', 'pos', 0.6999999880790710000),
(11, 6, 'Tech', 'neg', 1.0000000000000000000),
(12, 7, 'MYOB', 'pos', 1.0000000000000000000),
(13, 8, 'MYOB', 'pos', 1.0000000000000000000),
(14, 9, 'MYOB', 'pos', 0.8571428656578064000),
(15, 10, 'Tech', 'neg', 0.7142857313156128000),
(16, 11, 'Tech', 'neg', 1.0000000000000000000),
(17, 12, 'Tech', 'neg', 0.7142857313156128000),
(18, 13, 'Smoking', 'pos', 1.0000000000000000000),
(19, 14, 'Smoking', 'neg', 0.7142857313156128000),
(20, 15, 'MYOB', 'pos', 0.7142857313156128000),
(21, 17, 'Tech', 'pos', 1.0000000000000000000);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `task` varchar(50000) NOT NULL,
  `name` varchar(255) NOT NULL,
  `deadline` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `percentage` int(10) NOT NULL,
  `status` int(255) NOT NULL,
  `priority` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task`, `name`, `deadline`, `percentage`, `status`, `priority`) VALUES
(1, 'Finish the MYOB report', 'Mika Siddiqui', '2016-05-18 21:47:02', 0, 0, 1),
(2, 'Proofread Documents ', 'Giovanni Mayer', '2016-05-19 07:38:41', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sentiment` float(19,18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `sentiment`) VALUES
(1, 'Mika Siddiqui', 'mikasiddiqui@gmail.com', 0.600000023841857900),
(2, 'Giovanni Mayer', 'giovannimayer@gmail.com', 0.699999988079071000),
(3, 'Umesh Wimalawardana', 'umeshwimalawardana@gmail.com', 0.800000011920929000),
(4, 'Random Person', 'randomperson@gmail.com', 0.400000005960464500),
(5, 'Azaan Virk', 'azaanvirk@gmail.com', 0.200000002980232240);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `completed`
--
ALTER TABLE `completed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `corpus`
--
ALTER TABLE `corpus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sentiment_table`
--
ALTER TABLE `sentiment_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `completed`
--
ALTER TABLE `completed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `corpus`
--
ALTER TABLE `corpus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `sentiment_table`
--
ALTER TABLE `sentiment_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
