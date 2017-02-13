-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2017 at 09:00 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biosource_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
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

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brand_id`, `brand_name`, `generic_code`, `dosage_code`, `category_code`, `brand_qtyperbox`, `brand_qtyperpiece`, `brand_priceperpiece`, `brand_priceperbox`, `brand_expiration`, `brand_holdingcost`, `brand_orderingcost`, `brand_totalqtyperbox`) VALUES
(1, 'Medicol', 1, 1, 1, 10, 10, 10, 10, '2017-01-24', 2000, 20000, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_code` int(11) NOT NULL,
  `category_name` text NOT NULL,
  `slog` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_code`, `category_name`, `slog`) VALUES
(1, 1, 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_checkout`
--

CREATE TABLE `tbl_checkout` (
  `checkout_id` int(11) NOT NULL,
  `checkout_qtypiece` int(11) NOT NULL,
  `checkout_qtybox` int(11) NOT NULL,
  `checkout_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `checkout_price` int(11) NOT NULL,
  `checkout_type` varchar(20) NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_checkout`
--

INSERT INTO `tbl_checkout` (`checkout_id`, `checkout_qtypiece`, `checkout_qtybox`, `checkout_date`, `checkout_price`, `checkout_type`, `item_id`, `user_id`) VALUES
(1, 0, 2, '2017-01-24 22:06:51', 20, 'tbl_product', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dosage`
--

CREATE TABLE `tbl_dosage` (
  `dosage_id` int(11) NOT NULL,
  `dosage_code` int(11) NOT NULL,
  `dosage_name` text NOT NULL,
  `slog` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dosage`
--

INSERT INTO `tbl_dosage` (`dosage_id`, `dosage_code`, `dosage_name`, `slog`) VALUES
(1, 1, '2mg', '2mg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_generic`
--

CREATE TABLE `tbl_generic` (
  `generic_id` int(11) NOT NULL,
  `generic_code` int(11) NOT NULL,
  `generic_name` text NOT NULL,
  `slog` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_generic`
--

INSERT INTO `tbl_generic` (`generic_id`, `generic_code`, `generic_name`, `slog`) VALUES
(1, 1, 'Biogesic', 'biogesic');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
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

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `generic_code`, `dosage_code`, `category_code`, `product_qtyperbox`, `product_qtyperpiece`, `product_priceperpiece`, `product_priceperbox`, `product_expiration`, `product_holdingcost`, `product_orderingcost`, `product_totalqtyperbox`) VALUES
(1, 'Solmux', 1, 1, 1, 98, 10, 10, 10, '2017-01-24', 100000, 100000, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `status_id` int(11) NOT NULL,
  `status_remarks` int(11) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `status_contact` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`status_id`, `status_remarks`, `user_id`, `status_contact`) VALUES
(1, 1, 1, '213444888'),
(2, 1, 4, '2134448555'),
(3, 1, 2, '213123135');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_contact` varchar(100) NOT NULL,
  `supplier_address` text NOT NULL,
  `supplier_status` int(11) NOT NULL DEFAULT '1',
  `supplier_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`supplier_id`, `supplier_name`, `supplier_contact`, `supplier_address`, `supplier_status`, `supplier_date`) VALUES
(1, 'nike', 'nike@gmail.com', 'california usa', 1, '2017-01-24 20:58:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

CREATE TABLE `tbl_transaction` (
  `trans_id` int(11) NOT NULL,
  `trans_price` varchar(100) NOT NULL,
  `trans_cashier` int(11) NOT NULL,
  `trans_citizen` varchar(100) NOT NULL,
  `trans_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_type`
--

CREATE TABLE `tbl_type` (
  `type_id` int(11) NOT NULL,
  `type_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_fname` text NOT NULL,
  `user_mname` text NOT NULL,
  `user_lname` text NOT NULL,
  `user_address` text NOT NULL,
  `user_username` varchar(225) NOT NULL,
  `user_password` varchar(225) NOT NULL,
  `type_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_fname`, `user_mname`, `user_lname`, `user_address`, `user_username`, `user_password`, `type_id`) VALUES
(1, 'Admin', 'A.', 'Admin', 'Admin address', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1),
(2, 'User', 'U.', 'User', 'User Address', 'user', '12dea96fec20593566ab75692c9949596833adc9', 2),
(3, 'Cashier', 'C.', 'Cashier', '123 sample address Manila, The Philippines', 'cashier', 'a5b42198e3fb950b5ab0d0067cbe077a41da1245', 1),
(4, 'John Cor', 'M.', 'Baylen', 'Malabon CIty', 'jc', 'f9ae8604de015e6fc12a1ebdbe72f262b981a2f6', 1);

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
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_checkout`
--
ALTER TABLE `tbl_checkout`
  MODIFY `checkout_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_dosage`
--
ALTER TABLE `tbl_dosage`
  MODIFY `dosage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_generic`
--
ALTER TABLE `tbl_generic`
  MODIFY `generic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_type`
--
ALTER TABLE `tbl_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
