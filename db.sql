-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2018 at 12:00 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db1`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `dispRevenue` ()  select * from revenue

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `agent_name` varchar(50) NOT NULL,
  `agent_id` varchar(50) NOT NULL,
  `agent_loc` varchar(50) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `prod_id` varchar(50) NOT NULL,
  `recv_add` varchar(50) NOT NULL,
  `order_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`agent_name`, `agent_id`, `agent_loc`, `order_id`, `prod_id`, `recv_add`, `order_status`) VALUES
('D-kart', 'dk-01', 'Chennai', 'Ar-02', 'Titan-01', 'Mangalore', 'Processing'),
('D-kart', 'dk-02', 'Chennai', 'Raj-01', 'Apple-01', 'Chennai', 'Delivered'),
('E-kart', 'ek-01', 'Bangalore', 'Cha-01', 'Huawai-01', 'Bangalore', 'Confirmed'),
('E-kart', 'ek-02', 'Mangalore', 'Am-01', 'Alexa-01', 'Bangalore', 'Processing'),
('E-kart', 'ek-04', 'Mangalore', 'Ra-01', 'Yonex-01', 'Mangalore', 'Delivered'),
('Go-kart', 'gok-01', 'Mangalore', 'gru-01', 'nike-01', 'Mangalore', 'Shipped');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `recv_name` varchar(50) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `prod_id` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`recv_name`, `order_id`, `prod_id`, `action`, `time`) VALUES
('', '', 'Alexa-01', 'Updated', '2018-11-08 06:02:29'),
('Bangalore', 'Am-01', 'Alexa-01', 'Inserted', '2018-11-08 06:12:56'),
('bangalore', 'an-01', 'Apple-01', 'Updated', '2018-12-04 14:32:33'),
('Mangalore', 'Ar-01', 'Titan-01', 'Deleted', '2018-11-08 06:06:53'),
('Mangalore', 'Ar-02', 'Titan-01', 'Inserted', '2018-11-08 06:11:12'),
('Mangalore', 'gru-01', 'nike-01', 'Updated', '2018-11-12 16:40:04'),
('Mangalore', 'jk-01', 'Alexa-01', 'Inserted', '2018-11-08 05:55:16'),
('Mangalore', 'jk-02', 'Alexa-01', 'Updated', '2018-11-08 05:58:43'),
('bangalore', 'ka-01', 'Apple-01', 'Inserted', '2018-12-04 14:03:34'),
('Bangalore', 'Kar-01', 'PC-01', 'Deleted', '2018-11-09 06:40:31'),
('Mumbai', 'Su-01', 'JBL-01', 'Deleted', '2018-11-09 07:46:50'),
('Bengalore', 'ysh-01', 'cam-01', 'Deleted', '2018-11-09 07:46:51'),
('bangalore', 'ka-02', 'nex-01', 'Inserted', '2018-12-04 14:30:34');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `recv_name` varchar(50) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `recv_add` varchar(50) NOT NULL,
  `prod_id` varchar(50) NOT NULL,
  `order_date` date NOT NULL,
  `mop` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`recv_name`, `order_id`, `recv_add`, `prod_id`, `order_date`, `mop`) VALUES
('Aman', 'Am-01', 'Bangalore', 'Alexa-01', '2018-10-11', 'Cash On Delivery'),
('ana', 'an-01', 'bangalore', 'Apple-01', '0000-00-00', 'cash'),
('Arun', 'Ar-02', 'Mangalore', 'Titan-01', '2018-10-20', 'Online'),
('Channa', 'Cha-01', 'Bangalore', 'Huawai-01', '2018-10-22', 'Online'),
('Guru', 'gru-01', 'Mangalore', 'nike-01', '2018-10-17', 'Cash On Delivery'),
('Rahul', 'Ra-01', 'Mangalore', 'Yonex-01', '2018-09-09', 'Online'),
('Rajesh', 'Raj-01', 'Chennai', 'Apple-01', '2018-10-19', 'Online'),
('Rajesh', 'Raj-01', 'Chennai', 'Apple-01', '2018-10-19', 'Online'),
('Rajesh', 'ka-02', 'Chennai', 'Apple-01', '2018-10-19', 'Online');
UPDATE orders
SET order_date='2018-10-12'
WHERE order_date='0000-00-00';

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `deletettrigger` AFTER DELETE ON `orders` FOR EACH ROW INSERT INTO logs VALUES(old.recv_add, old.order_id, old.prod_id, 'Deleted', now())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `inserttrigger` AFTER INSERT ON `orders` FOR EACH ROW INSERT INTO logs VALUES(new.recv_add, new.order_id, new.prod_id, 'Inserted', now())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updatetrigger` AFTER UPDATE ON `orders` FOR EACH ROW INSERT INTO logs VALUES(new.recv_add, new.order_id, new.prod_id, 'Updated', now())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prod_id` varchar(50) NOT NULL,
  `prod_name` varchar(50) NOT NULL,
  `prod_price` int(20) NOT NULL,
  `prod_rating` int(11) NOT NULL,
  `prod_avl` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_id`, `prod_name`, `prod_price`, `prod_rating`, `prod_avl`) VALUES
('Alexa-01', 'Amazon Alexa', 15000, 9, 'yes'),
('Apple-01', 'IphoneX', 45000, 9, 'yes'),
('cam-01', 'Nikon Camera', 25000, 9, 'yes'),
('Huawai-01', 'Huawai Router', 3000, 7, 'no'),
('JBL-01', 'JBL Headphones', 5000, 8, 'yes'),
('nike-01', 'nike shoe', 5000, 8, 'no'),
('PC-01', 'Apple PC', 100000, 10, 'yes'),
('Titan-01', 'Titan Watch', 15000, 10, 'no'),
('Yonex-01', 'Yonex Racket', 6000, 9, 'No'),
('nex-01', 'Racket', 6000, 10, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `revenue`
--

CREATE TABLE `revenue` (
  `total_orders` int(20) NOT NULL,
  `order_delv` int(20) NOT NULL,
  `order_pend` int(20) NOT NULL,
  `amount_recv` int(200) NOT NULL,
  `amount_pend` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `revenue`
--

INSERT INTO `revenue` (`total_orders`, `order_delv`, `order_pend`, `amount_recv`, `amount_pend`) VALUES
(6, 2, 4, 20000, 69000);

-- --------------------------------------------------------

--
-- Stand-in structure for view `sort`
-- (See below for the actual view)
--
CREATE TABLE `sort` (
`recv_name` varchar(50)
,`order_id` varchar(50)
,`recv_add` varchar(50)
,`prod_id` varchar(50)
,`order_date` date
,`mop` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `order_id` varchar(50) NOT NULL,
  `due_date` date NOT NULL,
  `prod_id` varchar(50) NOT NULL,
  `order_date` date NOT NULL,
  `agent_id` varchar(50) NOT NULL,
  `order_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`order_id`, `due_date`, `prod_id`, `order_date`, `agent_id`, `order_status`) VALUES
('Ra-01', '2018-09-15', 'Yonex-01', '2018-09-09', 'ek-04', 'Delivered'),
('Raj-01', '2018-10-25', 'Apple-01', '2018-10-19', 'dk-02', 'Delivered'),
('Cha-01', '2018-10-28', 'Huawai-01', '2018-10-22', 'ek-01', 'Confirmed'),
('gru-01', '2018-11-01', 'nike-01', '2018-10-17', 'gok-01', 'Shipped'),
('Ar-02', '2018-11-02', 'Titan-01', '2018-10-20', 'dk-01', 'Processing'),
('Am-01', '2018-11-03', 'Alexa-01', '2018-10-11', 'ek-01', 'Processing');

-- --------------------------------------------------------

--
-- Structure for view `sort`
--
DROP TABLE IF EXISTS `sort`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sort`  AS  select `orders`.`recv_name` AS `recv_name`,`orders`.`order_id` AS `order_id`,`orders`.`recv_add` AS `recv_add`,`orders`.`prod_id` AS `prod_id`,`orders`.`order_date` AS `order_date`,`orders`.`mop` AS `mop` from `orders` where ((`orders`.`mop` = 'online') or (`orders`.`recv_add` = 'Mangaluru')) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD UNIQUE KEY `agent_id_2` (`agent_id`),
  ADD KEY `prod_id` (`prod_id`),
  ADD KEY `orders` (`order_id`,`recv_add`) USING BTREE,
  ADD KEY `agent_id` (`agent_id`),
  ADD KEY `order_status` (`order_status`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`,`recv_add`) USING BTREE,
  ADD KEY `prod_id` (`prod_id`),
  ADD KEY `order_date` (`order_date`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prod_id`,`prod_name`) USING BTREE;

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD UNIQUE KEY `due_date` (`due_date`),
  ADD KEY `prod_id` (`prod_id`) USING BTREE,
  ADD KEY `order_id` (`order_id`) USING BTREE,
  ADD KEY `agent_id` (`agent_id`),
  ADD KEY `order_date` (`order_date`),
  ADD KEY `order_status` (`order_status`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agents`
--
ALTER TABLE `agents`
  ADD CONSTRAINT `agents_ibfk_1` FOREIGN KEY (`order_id`,`recv_add`) REFERENCES `orders` (`order_id`, `recv_add`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `agents_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `product` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `product` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `status_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `product` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `status_ibfk_3` FOREIGN KEY (`order_status`) REFERENCES `agents` (`order_status`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `status_ibfk_4` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`agent_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `status_ibfk_5` FOREIGN KEY (`order_date`) REFERENCES `orders` (`order_date`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `status_ibfk_6` FOREIGN KEY (`order_status`) REFERENCES `agents` (`order_status`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
