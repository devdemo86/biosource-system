-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2017 at 09:20 AM
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
  `brand_totalqtyperbox` int(11) NOT NULL,
  `brand_supplier` varchar(100) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `has_barcode` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brand_id`, `brand_name`, `generic_code`, `dosage_code`, `category_code`, `brand_qtyperbox`, `brand_qtyperpiece`, `brand_priceperpiece`, `brand_priceperbox`, `brand_expiration`, `brand_holdingcost`, `brand_orderingcost`, `brand_totalqtyperbox`, `brand_supplier`, `variant_id`, `has_barcode`) VALUES
(1, 'RiteMed', 1, 1, 1, 2, 5, 5, 50, '2020-02-19', 10000, 10000, 100, 'mercury@gmail.com', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
`category_id` int(11) NOT NULL,
  `category_code` int(11) NOT NULL,
  `category_name` text NOT NULL,
  `slog` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_code`, `category_name`, `slog`) VALUES
(1, 1, 'Anti-Biotic', 'anti-biotic');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_checkout`
--

CREATE TABLE IF NOT EXISTS `tbl_checkout` (
`checkout_id` int(11) NOT NULL,
  `checkout_qtypiece` int(11) NOT NULL,
  `checkout_qtybox` int(11) NOT NULL,
  `checkout_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  `dosage_name` text NOT NULL,
  `slog` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dosage`
--

INSERT INTO `tbl_dosage` (`dosage_id`, `dosage_code`, `dosage_name`, `slog`) VALUES
(1, 1, '500mg', '500mg'),
(2, 1, '200mg', '200mg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_generic`
--

CREATE TABLE IF NOT EXISTS `tbl_generic` (
`generic_id` int(11) NOT NULL,
  `generic_code` int(11) NOT NULL,
  `generic_name` text NOT NULL,
  `slog` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_generic`
--

INSERT INTO `tbl_generic` (`generic_id`, `generic_code`, `generic_name`, `slog`) VALUES
(1, 1, 'Amoxicillin', 'amoxicillin'),
(2, 1, 'Paracetamol', 'paracetamol');

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
  `product_totalqtyperbox` int(11) NOT NULL,
  `product_supplier` varchar(100) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `has_barcode` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `generic_code`, `dosage_code`, `category_code`, `product_qtyperbox`, `product_qtyperpiece`, `product_priceperpiece`, `product_priceperbox`, `product_expiration`, `product_holdingcost`, `product_orderingcost`, `product_totalqtyperbox`, `product_supplier`, `variant_id`, `has_barcode`) VALUES
(1, 'Pharex B', 1, 1, 1, 30, 1, 27, 270, '2020-02-19', 5000, 5000, 10, 'mercury@gmail.com', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE IF NOT EXISTS `tbl_status` (
`status_id` int(11) NOT NULL,
  `status_remarks` int(11) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `status_contact` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`status_id`, `status_remarks`, `user_id`, `status_contact`) VALUES
(1, 1, 1, '123456789'),
(2, 1, 2, '123456789');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`supplier_id`, `supplier_name`, `supplier_contact`, `supplier_address`, `supplier_status`, `supplier_date`) VALUES
(1, 'mercury drug store', 'mercury@gmail.com', '1045 m. naval st, city of navotas, 1485 metro manila', 1, '2017-02-13 16:02:31'),
(2, 'gelo', 'gelo@gmail.com', 'test', 1, '2017-02-21 19:44:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

CREATE TABLE IF NOT EXISTS `tbl_transaction` (
`trans_id` int(11) NOT NULL,
  `trans_price` varchar(100) NOT NULL,
  `trans_cashier` int(11) NOT NULL,
  `trans_citizen` varchar(100) NOT NULL,
  `trans_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` varchar(100) NOT NULL,
  `trans_qtypiece` int(11) NOT NULL,
  `trans_qtybox` int(11) NOT NULL,
  `trans_type` varchar(20) NOT NULL,
  `item_id` int(11) NOT NULL,
  `is_finish` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`trans_id`, `trans_price`, `trans_cashier`, `trans_citizen`, `trans_date`, `amount`, `trans_qtypiece`, `trans_qtybox`, `trans_type`, `item_id`, `is_finish`) VALUES
(1, '500', 2, '', '2017-02-22 14:57:26', '135', 5, 0, 'tbl_product', 1, 1),
(2, '200', 2, '', '2017-02-22 18:33:54', '135', 5, 0, 'tbl_product', 1, 1),
(3, '100', 2, '', '2017-02-22 18:50:59', '100', 0, 2, 'tbl_brand', 1, 1),
(4, '270', 2, '', '2017-02-22 19:16:37', '270', 10, 0, 'tbl_product', 1, 1),
(5, '60', 2, '', '2017-02-24 13:54:12', '54', 2, 0, 'tbl_product', 1, 1),
(6, '50', 2, '123123123123123', '2017-02-24 14:01:35', '40', 0, 1, 'tbl_brand', 1, 1),
(7, '60', 2, '', '2017-02-24 14:52:52', '54', 2, 0, 'tbl_product', 1, 1);

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
(1, 'Gelo', '', 'lopez', 'Malabon City', 'gelo', '74913f5cd5f61ec0bcfdb775414c2fb3d161b620', 1),
(2, 'Cashier', 'Cashier', 'Cashier', 'Cecilia Chapman 711-2880 Nulla St. Mankato Mississippi 96522', 'cashier', 'd9a60dee793334ec2c9dee3fc5a77bab710fa143', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_variant`
--

CREATE TABLE IF NOT EXISTS `tbl_variant` (
`variant_id` int(11) NOT NULL,
  `variant_name` text NOT NULL,
  `slog` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_variant`
--

INSERT INTO `tbl_variant` (`variant_id`, `variant_name`, `slog`) VALUES
(3, 'Capsule', 'capsule'),
(4, 'Tablet', 'tablet'),
(5, 'Syrup', 'syrup'),
(6, 'Pills', 'pills');

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
 ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `user_username` (`user_username`);

--
-- Indexes for table `tbl_variant`
--
ALTER TABLE `tbl_variant`
 ADD PRIMARY KEY (`variant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_checkout`
--
ALTER TABLE `tbl_checkout`
MODIFY `checkout_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_dosage`
--
ALTER TABLE `tbl_dosage`
MODIFY `dosage_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_generic`
--
ALTER TABLE `tbl_generic`
MODIFY `generic_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
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
--
-- AUTO_INCREMENT for table `tbl_variant`
--
ALTER TABLE `tbl_variant`
MODIFY `variant_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
