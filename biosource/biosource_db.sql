-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2016 at 11:50 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `biosource_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE IF NOT EXISTS `tbl_brand` (
`brand_id` int(11) NOT NULL,
  `brand_name` text NOT NULL,
  `generic_code` int(11) NOT NULL,
  `dosage_code` int(11) NOT NULL,
  `category_code` int(11) NOT NULL,
  `brand_qtyperbox` int(11) NOT NULL,
  `brand_qtyperpiece` int(11) NOT NULL,
  `brand_priceperpiece` int(11) NOT NULL,
  `brand_priceperbox` int(11) NOT NULL,
  `brand_expiration` date NOT NULL,
  `brand_holdingcost` int(11) NOT NULL,
  `brand_orderingcost` int(11) NOT NULL,
  `brand_totalqtyperbox` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
`category_id` int(11) NOT NULL,
  `category_code` int(11) NOT NULL,
  `category_name` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_code`, `category_name`) VALUES
(1, 201, 'amphetamine'),
(2, 202, 'anabolic steroid'),
(3, 203, 'anaesthetic'),
(4, 204, 'analgesic'),
(5, 205, 'anesthetic'),
(6, 206, 'antacid'),
(7, 207, 'antibiotic'),
(8, 208, 'anticoagulant'),
(9, 209, 'antidepressant'),
(10, 210, 'antidote'),
(11, 211, 'antihistamine'),
(12, 212, 'anti-inflammatory'),
(13, 213, 'antimalarial'),
(14, 214, 'antiretroviral'),
(15, 215, 'barbitruate'),
(16, 216, 'beta-blocker'),
(17, 217, 'booster'),
(18, 218, 'caplet'),
(19, 219, 'capsule'),
(20, 220, 'contraceptive'),
(21, 221, 'cough drop'),
(22, 222, 'cough mixture'),
(23, 223, 'cough syrup'),
(24, 224, 'depressant'),
(25, 225, 'draft');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_checkout`
--

CREATE TABLE IF NOT EXISTS `tbl_checkout` (
`checkout_id` int(11) NOT NULL,
  `checkout_qtypiece` int(11) NOT NULL,
  `checkout_qtybox` int(11) NOT NULL,
  `checkout_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `checkout_price` int(11) NOT NULL,
  `checkout_type` varchar(20) NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dosage`
--

CREATE TABLE IF NOT EXISTS `tbl_dosage` (
`dosage_id` int(11) NOT NULL,
  `dosage_code` int(11) NOT NULL,
  `dosage_name` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dosage`
--

INSERT INTO `tbl_dosage` (`dosage_id`, `dosage_code`, `dosage_name`) VALUES
(1, 601, '2mg'),
(2, 602, '4mg'),
(3, 603, '25mg'),
(4, 604, '50mg'),
(5, 605, '120mg'),
(6, 606, '250mg'),
(7, 607, '500mg'),
(8, 608, '750mg'),
(9, 609, '1000mg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_generic`
--

CREATE TABLE IF NOT EXISTS `tbl_generic` (
`generic_id` int(11) NOT NULL,
  `generic_code` int(11) NOT NULL,
  `generic_name` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_generic`
--

INSERT INTO `tbl_generic` (`generic_id`, `generic_code`, `generic_name`) VALUES
(1, 301, 'ibuprofen'),
(2, 302, 'axert'),
(3, 303, 'Amevive'),
(4, 304, 'Fosamax'),
(5, 305, 'UroXatral'),
(6, 306, 'Alloprin'),
(7, 307, 'Insulin'),
(8, 308, 'Tramadol'),
(9, 309, 'Acetaminophen'),
(10, 310, 'Hydrocodone & Acetaminophen'),
(11, 311, 'Paracetamol');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
`product_id` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `generic_code` int(11) NOT NULL,
  `dosage_code` int(11) NOT NULL,
  `category_code` int(11) NOT NULL,
  `product_qtyperbox` int(11) NOT NULL,
  `product_qtyperpiece` int(11) NOT NULL,
  `product_priceperpiece` int(11) NOT NULL,
  `product_priceperbox` int(11) NOT NULL,
  `product_expiration` date NOT NULL,
  `product_holdingcost` int(11) NOT NULL,
  `product_orderingcost` int(11) NOT NULL,
  `product_totalqtyperbox` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE IF NOT EXISTS `tbl_status` (
`status_id` int(11) NOT NULL,
  `status_remarks` int(11) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `status_contact` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE IF NOT EXISTS `tbl_supplier` (
`supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_contact` varchar(100) NOT NULL,
  `supplier_address` text NOT NULL,
  `supplier_status` int(11) NOT NULL DEFAULT '1',
  `supplier_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

CREATE TABLE IF NOT EXISTS `tbl_transaction` (
`trans_id` int(11) NOT NULL,
  `trans_price` varchar(100) NOT NULL,
  `trans_cashier` text NOT NULL,
  `trans_citizen` varchar(100) NOT NULL,
  `trans_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_type`
--

CREATE TABLE IF NOT EXISTS `tbl_type` (
`type_id` int(11) NOT NULL,
  `type_name` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_type`
--

INSERT INTO `tbl_type` (`type_id`, `type_name`) VALUES
(1, 'Admin'),
(2, 'Cashier');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
`user_id` int(11) NOT NULL,
  `user_fname` text NOT NULL,
  `user_mname` text NOT NULL,
  `user_lname` text NOT NULL,
  `user_address` text NOT NULL,
  `user_username` varchar(225) NOT NULL,
  `user_password` varchar(225) NOT NULL,
  `type_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_fname`, `user_mname`, `user_lname`, `user_address`, `user_username`, `user_password`, `type_id`) VALUES
(1, 'Admin', 'A.', 'Admin', 'Admin address', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1),
(2, 'User', 'U.', 'User', 'User Address', 'user', '12dea96fec20593566ab75692c9949596833adc9', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
 ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
 ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_checkout`
--
ALTER TABLE `tbl_checkout`
 ADD PRIMARY KEY (`checkout_id`);

--
-- Indexes for table `tbl_dosage`
--
ALTER TABLE `tbl_dosage`
 ADD PRIMARY KEY (`dosage_id`);

--
-- Indexes for table `tbl_generic`
--
ALTER TABLE `tbl_generic`
 ADD PRIMARY KEY (`generic_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
 ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
 ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
 ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
 ADD PRIMARY KEY (`trans_id`);

--
-- Indexes for table `tbl_type`
--
ALTER TABLE `tbl_type`
 ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `tbl_checkout`
--
ALTER TABLE `tbl_checkout`
MODIFY `checkout_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_dosage`
--
ALTER TABLE `tbl_dosage`
MODIFY `dosage_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_generic`
--
ALTER TABLE `tbl_generic`
MODIFY `generic_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_type`
--
ALTER TABLE `tbl_type`
MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
