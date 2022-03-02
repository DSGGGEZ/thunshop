-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2022 at 04:41 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thunshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch_store`
--

CREATE TABLE `branch_store` (
  `idbranch_store` int(11) NOT NULL,
  `storename` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `branch_store`
--

INSERT INTO `branch_store` (`idbranch_store`, `storename`, `address`, `city`) VALUES
(1, 'Home', 'ทำเนียบรัฐบาล', 'Phitsanolok'),
(2, 'Naresuan University', '223/157', 'Phitsanolok');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `idcustomer` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`idcustomer`, `name`, `address`, `city`) VALUES
(1, 'Chonlasit Umpawan', 'ทำเนียบรัฐบาล', 'Phitsanolok'),
(2, 'Panuphan Injan', '111/11', 'Phitsanolok'),
(3, 'Porramet Makyoo', '223/157', 'Phitsanolok');

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

CREATE TABLE `customer_order` (
  `idcustomer_order` int(11) NOT NULL,
  `idpromotion` int(11) DEFAULT NULL,
  `idproduct` int(11) NOT NULL,
  `idbranch_store` int(11) NOT NULL,
  `idcustomer` int(11) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`idcustomer_order`, `idpromotion`, `idproduct`, `idbranch_store`, `idcustomer`, `date`) VALUES
(1, 0, 1, 1, 1, '2022-03-02');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `idproduct` int(11) NOT NULL,
  `brand` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `producttype` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `spec` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`idproduct`, `brand`, `producttype`, `spec`, `price`) VALUES
(1, 'Gigabype', 'GPU', 'RTX 3090Ti', 40000),
(2, 'G-Skill', 'RAM', '8GB DDR4 3200', 1299);

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `idpromotion` int(11) NOT NULL,
  `promocode` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch_store`
--
ALTER TABLE `branch_store`
  ADD PRIMARY KEY (`idbranch_store`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`idcustomer`);

--
-- Indexes for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`idcustomer_order`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`idproduct`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`idpromotion`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch_store`
--
ALTER TABLE `branch_store`
  MODIFY `idbranch_store` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `idcustomer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `idcustomer_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `idproduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `idpromotion` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
