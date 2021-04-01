-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 01, 2021 at 08:19 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bootz`
--

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `code`, `name`) VALUES
(1, 'SWE', 'Sweden'),
(2, 'ESP', 'Spain');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `first_name`, `last_name`, `email`, `created_at`) VALUES
(1, 'Milad', 'Esmaeilzadeh', 'milad.e@bootz.com', '2021-03-19 00:18:00'),
(2, 'mahyar', 'Esmaeilzadeh', 'mmahie@bootz.com', '2021-03-19 00:18:00'),
(3, 'fahimeh', 'ghorbani', 'f.ghorbani@bootz.com', '2021-03-19 00:18:00'),
(4, 'reza', 'nejati', 'rn.nejati@gmail.com', '2021-04-01 22:18:00'),
(5, 'adrial', 'monika', 'adrial@bootz.com', '2021-03-26 00:18:00'),
(6, 'sadasd', 'sadsad', 'sada@ad.com', '2021-03-18 00:00:00'),
(7, 'sadasd', 'cvxcv', 'milaxcveh@gmail.com', '2021-03-18 00:00:00'),
(27, 'pedram', 'arziani', 'p.arz@aaas.com', '2021-03-20 00:00:00'),
(26, 'david', 'amoniss', 'amoniss@ss.com', '2021-03-29 00:00:00'),
(25, 'vahid', 'nazari', 'zz@asdf.com', '2021-03-23 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `device` varchar(100) NOT NULL,
  `buy_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `country_id`, `customer_id`, `device`, `buy_date`) VALUES
(1, 1, 1, 'PC', '2021-03-31 15:27:25'),
(2, 1, 1, 'MOB', '2021-03-26 11:16:00'),
(3, 2, 27, 'MOB', '2021-03-21 11:16:00'),
(4, 2, 26, 'MOB', '2021-03-20 11:16:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

DROP TABLE IF EXISTS `order_item`;
CREATE TABLE IF NOT EXISTS `order_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `product_id`, `qty`) VALUES
(1, 1, 1, 2),
(2, 1, 2, 1),
(3, 2, 2, 4),
(4, 3, 2, 5),
(5, 4, 1, 3),
(6, 4, 2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `EAN` varchar(50) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `EAN`, `price`) VALUES
(1, 'Nike shoes', '2159780585783', 49),
(2, 'T-shirt', '9762888751641', 23);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
