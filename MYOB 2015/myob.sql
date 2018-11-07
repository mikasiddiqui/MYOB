-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2015 at 03:52 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myob`
--

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE IF NOT EXISTS `income` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` decimal(65,0) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `name`, `value`, `date`) VALUES
(1, 'Landscaping', '50000', '2014-09-12'),
(2, 'Landscaping', '40000', '2015-01-07'),
(3, 'Landscaping', '60000', '2015-10-06'),
(4, 'Lawns and Maintenance', '10000', '2015-01-07'),
(5, 'Lawns and Maintenance', '20000', '2015-06-03'),
(6, 'Landscaping', '10000', '2014-02-10'),
(7, 'Landscaping', '3000', '2013-10-10'),
(8, 'Landscaping', '40000', '2014-01-01'),
(9, 'Landscaping', '30000', '2014-04-04'),
(11, 'Lawns and Maintenance', '30000', '2014-02-10'),
(12, 'Lawns and Maintenance', '23000', '2014-04-03');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_users`
--

CREATE TABLE IF NOT EXISTS `inventory_users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `inventory_users`
--

INSERT INTO `inventory_users` (`id`, `username`) VALUES
(1, 'mika');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_num` int(255) NOT NULL,
  `customer` varchar(1024) NOT NULL,
  `date_issued` date NOT NULL,
  `date_due` date NOT NULL,
  `total_amount` varchar(1024) NOT NULL,
  `amount_due` varchar(1024) NOT NULL,
  `status` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_num`, `customer`, `date_issued`, `date_due`, `total_amount`, `amount_due`, `status`) VALUES
(1, 1, 'Ziggy Partnership', '2015-01-08', '2015-02-05', '1498.34', '0.00', '1'),
(2, 2, 'Dr Fang Pottery', '2015-03-10', '2015-04-01', '568.68', '0.00', '1'),
(3, 3, 'P Macabi Pty Ltd', '2015-04-15', '2015-04-28', '754.65', '754.65', '3'),
(4, 4, 'Bexley & Zoe Merchants', '2015-09-08', '2015-09-24', '261.17', '261.17', '3'),
(5, 5, 'Blomfield LTD', '2015-09-15', '2015-10-10', '356.28', '356.28', '3'),
(6, 6, 'Stannard Enterprises', '2015-09-12', '2015-09-14', '69.00', '69.00', '3'),
(7, 7, 'First Place Ltd', '2015-10-14', '2015-10-20', '2000.00', '2000.00', '2'),
(8, 8, 'Cindy''s Bargains Ltd', '2015-05-10', '2015-06-02', '1312.34', '0.00', '1'),
(9, 9, 'Mayonnaise Ltd', '2015-10-02', '2015-10-10', '690.00', '0.00', '1'),
(10, 100, 'Test Enterprises', '2015-10-17', '2015-11-02', '456.00', '456.00', '2'),
(11, 11, 'Last Minute Enterprises', '2015-10-12', '2015-11-02', '69.00', '69.00', '2');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_users`
--

CREATE TABLE IF NOT EXISTS `invoice_users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `invoice_users`
--

INSERT INTO `invoice_users` (`id`, `username`) VALUES
(1, 'mika'),
(3, 'giovanni'),
(10, 'zinzan'),
(11, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `less_expenses`
--

CREATE TABLE IF NOT EXISTS `less_expenses` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(1024) NOT NULL,
  `value` varchar(1024) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `less_expenses`
--

INSERT INTO `less_expenses` (`id`, `name`, `value`, `date`) VALUES
(1, 'Accounting Fees', '120', '2015-07-17'),
(2, 'Accounting Fees', '150', '2015-09-09'),
(3, 'Advertising', '450', '2015-05-08'),
(4, 'Advertising', '346', '2015-09-10'),
(5, 'Bank Charges', '360', '2014-03-15'),
(6, 'Franchise Fees', '1000', '2014-03-01'),
(7, 'Franchise Fees', '1500', '2015-06-10'),
(8, 'Insurance', '1000', '2014-04-01'),
(9, 'Insurance', '1000', '2015-04-01'),
(10, 'Printing and Stationary', '431', '2015-03-04'),
(11, 'Hire of Equipment', '1500', '2015-03-03'),
(12, 'Repairs and Maintenance', '356', '2014-09-10');

-- --------------------------------------------------------

--
-- Table structure for table `profit_users`
--

CREATE TABLE IF NOT EXISTS `profit_users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `profit_users`
--

INSERT INTO `profit_users` (`id`, `username`) VALUES
(1, 'mika'),
(3, 'giovanni'),
(8, 'zinzan'),
(9, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `track_inventory`
--

CREATE TABLE IF NOT EXISTS `track_inventory` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `item_number` varchar(1024) NOT NULL,
  `name` varchar(1024) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `price` varchar(1024) NOT NULL,
  `quantity` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `track_inventory`
--

INSERT INTO `track_inventory` (`id`, `item_number`, `name`, `description`, `price`, `quantity`) VALUES
(1, '100', 'Spring Water', '500ml', '1.00', 48),
(2, '120', 'Cooler Large', '', '150.00', 2),
(3, '50', 'Chairs', '', '35', 25),
(4, '81', 'Flour', 'Whole Wheat 1 Kg', '4.99', 0),
(5, '88', 'Bananas', '1 Kg', '3.99', 5),
(6, '24', 'Standard Milk', '3 Litres', '2.99', 4),
(7, '99', 'Ice', '1 kg', '2.99', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(1024) NOT NULL,
  `first_name` varchar(1024) NOT NULL,
  `last_name` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `first_name`, `last_name`) VALUES
(1, 'mika', '27554fc4245eab22b877f2d3e78753cb', 'mikasiddiqui@myob.co.nz', 'Mika', 'Siddiqui'),
(2, 'giovanni', 'b0439fae31f8cbba6294af86234d5a28', 'giovannimayer@myob.co.nz', 'Giovanni', 'Mayer'),
(3, 'azaan', '0c465cebd957857d21f91945cc2127ee', 'azaanvirk@myob.co.nz', 'Azaan', 'Virk'),
(4, 'zinzan', '7dfc6d74628885f45b85e3d3ffbb947b', 'zinzanmurray@myob.co.nz', 'Zinzan', 'Murray'),
(5, 'admin', '27554fc4245eab22b877f2d3e78753cb', 'admin@myob.co.nz', 'Admin', 'Admin');

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `invoice_status_1` ON SCHEDULE EVERY 1 MINUTE STARTS '2015-10-14 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE invoices SET status = 1 WHERE CAST(amount_due AS SIGNED) = 0$$

CREATE DEFINER=`root`@`localhost` EVENT `invoice_status_2` ON SCHEDULE EVERY 1 MINUTE STARTS '2015-10-14 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE invoices SET status = 2 WHERE CURDATE() < date_due AND CAST(amount_due AS SIGNED) > 0$$

CREATE DEFINER=`root`@`localhost` EVENT `invoice_status_3` ON SCHEDULE EVERY 1 MINUTE STARTS '2015-10-14 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE invoices SET status = 3 WHERE CURDATE() > date_due AND CAST(amount_due AS SIGNED) > 0$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
