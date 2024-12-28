-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2024 at 02:12 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rental_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `city` varchar(200) NOT NULL,
  `street` varchar(300) NOT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `otp_expiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `fname`, `lname`, `password`, `city`, `street`, `otp`, `otp_expiration`) VALUES
(1, 'admin@gmail.com', 'John', 'Doe', 'admin', 'CityAdmin', 'StreetAdmin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `plate_id` int(10) NOT NULL,
  `model` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `year` int(4) NOT NULL,
  `image` varchar(600) NOT NULL,
  `description` varchar(300) NOT NULL,
  `price_per_hour` float(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`plate_id`, `model`, `color`, `brand`, `year`, `image`, `description`, `price_per_hour`) VALUES
(1, 'ModelS', 'Black', 'Tesla', 2022, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQq8Z_TF0FpMR1T7o_T6c8J4a-UN5x8Jx3Lrw&usqp=CAU', 'Electric car', 120.00),
(2, 'SUV', 'Black', 'BMW', 2022, 'https://media.gemini.media/img/Original/2018/3/14/2018_3_14_13_38_15_942.jpg', 'Exclusive car', 105.00),
(3, 'Accent', 'Silver', 'Hyundai', 2005, 'https://www.elbalad.news/UploadCache/libfiles/951/8/600x338o/179.jpg', 'rent and you wont regret', 120.00),
(4, 'Maxima', 'Silver', 'Nissan', 2015, 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/02/Nissan_Maxima_SV_%28A36%29_%E2%80%93_Frontansicht%2C_1._Oktober_2016%2C_New_York.jpg/1920px-Nissan_Maxima_SV_%28A36%29_%E2%80%93_Frontansicht%2C_1._Oktober_2016%2C_New_York.jpg', 'rent and you wont regret it', 7.00),
(5, 'Sunny', 'White', 'Nissan', 2022, 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/07/Nissan_Sunny_1998.JPG/390px-Nissan_Sunny_1998.JPG', 'rent and you wont regret it', 8.00),
(6, 'Corolla Sprinter', 'White', 'Tyota', 2020, 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/cb/2022_Toyota_GR86_Premium_in_Halo%2C_Front_Right%2C_04-10-2022_%282%29.jpg/390px-2022_Toyota_GR86_Premium_in_Halo%2C_Front_Right%2C_04-10-2022_%282%29.jpg', 'rent and you wont regret it', 12.00),
(7, 'Accent', 'Grey', 'Hyundai', 2019, 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/57/2012_Hyundai_Accent_GLS_sedan_--_12-14-2011.jpg/1280px-2012_Hyundai_Accent_GLS_sedan_--_12-14-2011.jpg', 'rent and you wont regret it', 10.00),
(8, 'Nasr', 'Burgundy', 'Shahin', 1999, 'https://upload.wikimedia.org/wikipedia/commons/d/d6/Shahin1.jpg', 'Come and rent, there is nothing cheaper than this', 5.00),
(9, 'Nasr', 'Burgundy', 'Shahin', 1999, 'https://content.almalnews.com/wp-content/uploads/2020/05/%D8%A3%D8%B3%D8%B9%D8%A7%D8%B1-%D9%87%D9%8A%D9%88%D9%86%D8%AF%D8%A7%D9%8A-%D9%81%D9%8A%D8%B1%D9%86%D8%A7.jpg', 'Really wanna rent this?', 6.00),
(10, 'cayenne s', 'Black', 'porsche', 202, 'https://www.elbalad.news/UploadCache/libfiles/331/4/600x338o/62.jpg', 'Exclusive car', 145.00);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cssn` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `cpass` varchar(255) NOT NULL,
  `bdate` date NOT NULL,
  `total_rent` int(4) NOT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `otp_expiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cssn`, `email`, `fname`, `lname`, `cpass`, `bdate`, `total_rent`, `otp`, `otp_expiration`) VALUES
('2204122', 'TakePassToLogIn@gmail.com', 'password', 'format->', 'aaAA11!!', '2004-05-10', 0, NULL, NULL),
('2205019', 'rana@gmail.com', 'Rana', 'Ashraf', '$2y$10$KWzg2cKdbnmtzI4J8L7I2.U3r8TEejGMFMoE/RKB5Rs6mb2KUQqqu', '2004-10-20', 0, NULL, NULL),
('2205040', 'mark@gmail.com', 'Mark', 'Magdy', '$2y$10$ZTm57LoPPA6YMIfVRtOapu9KvArmIpLPFfUDy4Kg7jB2zP.9c4w1u', '2004-10-20', 0, '292003', '2024-12-28 02:11:38'),
('2205122', 'arsany@gmail.com', 'Arsany', 'Osama', '$2y$10$wUMjnY9.3TnHfDVKId8Xr.jblqVi9HB.vT6qWso86Qe5gctIwCjRG', '2004-10-20', 1, '134341', '2024-12-28 02:14:11'),
('2205136', 'ahmed@gmail.com', 'Ahmed', 'Bekhit', '$2y$10$r3I5/q3D1e3EXEhzlKE1XOmYQvF5VWKNkKDkTxaPehJgtfVIlsdCa', '2004-10-20', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `address_id` int(10) NOT NULL,
  `cssn` varchar(30) DEFAULT NULL,
  `country` varchar(30) NOT NULL,
  `city` varchar(200) NOT NULL,
  `street` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`address_id`, `cssn`, `country`, `city`, `street`) VALUES
(2, '2205122', 'Egypt', 'Alexandria', 'Mosquitos Bridge');

-- --------------------------------------------------------

--
-- Table structure for table `rent`
--

CREATE TABLE `rent` (
  `rent_id` int(10) NOT NULL,
  `cssn` varchar(30) DEFAULT NULL,
  `plate_id` int(10) DEFAULT NULL,
  `total_hours` int(5) NOT NULL,
  `start_date` date NOT NULL,
  `return_date` date NOT NULL,
  `total_price` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rent`
--

INSERT INTO `rent` (`rent_id`, `cssn`, `plate_id`, `total_hours`, `start_date`, `return_date`, `total_price`) VALUES
(2, '2205122', 3, 96, '2024-12-28', '2025-01-01', 11520.00);

-- --------------------------------------------------------

--
-- Table structure for table `rent_address`
--

CREATE TABLE `rent_address` (
  `rent_id` int(10) DEFAULT NULL,
  `address_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rent_address`
--

INSERT INTO `rent_address` (`rent_id`, `address_id`) VALUES
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `rent_contact`
--

CREATE TABLE `rent_contact` (
  `rent_id` int(10) NOT NULL,
  `phone_number1` varchar(12) NOT NULL,
  `phone_number2` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rent_contact`
--

INSERT INTO `rent_contact` (`rent_id`, `phone_number1`, `phone_number2`) VALUES
(2, '01212006002', '01212006503');

-- --------------------------------------------------------

--
-- Table structure for table `reserved_cars`
--

CREATE TABLE `reserved_cars` (
  `plate_id` int(10) DEFAULT NULL,
  `start_time` date NOT NULL,
  `return_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reserved_cars`
--

INSERT INTO `reserved_cars` (`plate_id`, `start_time`, `return_date`) VALUES
(3, '2024-12-28', '2025-01-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`plate_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cssn`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `fk_customer_address_cssn` (`cssn`);

--
-- Indexes for table `rent`
--
ALTER TABLE `rent`
  ADD PRIMARY KEY (`rent_id`),
  ADD KEY `fk_rent_cssn` (`cssn`),
  ADD KEY `fk_rent_plate_id` (`plate_id`);

--
-- Indexes for table `rent_address`
--
ALTER TABLE `rent_address`
  ADD KEY `fk_rent_address_rent_id` (`rent_id`),
  ADD KEY `fk_rent_address_address_id` (`address_id`);

--
-- Indexes for table `rent_contact`
--
ALTER TABLE `rent_contact`
  ADD PRIMARY KEY (`rent_id`);

--
-- Indexes for table `reserved_cars`
--
ALTER TABLE `reserved_cars`
  ADD KEY `fk_reserved_cars_plate_id` (`plate_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `address_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rent`
--
ALTER TABLE `rent`
  MODIFY `rent_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `fk_customer_address_cssn` FOREIGN KEY (`cssn`) REFERENCES `customer` (`cssn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rent`
--
ALTER TABLE `rent`
  ADD CONSTRAINT `fk_rent_cssn` FOREIGN KEY (`cssn`) REFERENCES `customer` (`cssn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rent_plate_id` FOREIGN KEY (`plate_id`) REFERENCES `car` (`plate_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rent_address`
--
ALTER TABLE `rent_address`
  ADD CONSTRAINT `fk_rent_address_address_id` FOREIGN KEY (`address_id`) REFERENCES `customer_address` (`address_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rent_address_rent_id` FOREIGN KEY (`rent_id`) REFERENCES `rent` (`rent_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rent_contact`
--
ALTER TABLE `rent_contact`
  ADD CONSTRAINT `fk_rent_contact_rent_id` FOREIGN KEY (`rent_id`) REFERENCES `rent` (`rent_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reserved_cars`
--
ALTER TABLE `reserved_cars`
  ADD CONSTRAINT `fk_reserved_cars_plate_id` FOREIGN KEY (`plate_id`) REFERENCES `car` (`plate_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
