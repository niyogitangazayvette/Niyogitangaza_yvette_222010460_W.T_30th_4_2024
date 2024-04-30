-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2024 at 08:53 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yvette-niyogitangaza-ohsms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobileNumber` varchar(20) NOT NULL,
  `securityQuestion` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `role` varchar(30) NOT NULL DEFAULT 'admin',
  `date_done` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `mobileNumber`, `securityQuestion`, `answer`, `username`, `password`, `address`, `city`, `state`, `country`, `role`, `date_done`, `status`) VALUES
(1, 'Turikumwenimana Daniel', 'danieltn889@gmail.com', '+250785085214', 'What city were you born in?', 'kgl', 'danieltn889@gmail.com', '12345', 'kgl', 'kgl', 'kgl', 'Rwanda', 'administrator', '2024-04-09', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `house`
--

CREATE TABLE `house` (
  `id` int(11) NOT NULL,
  `upiNumber` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `location` varchar(100) NOT NULL,
  `sellerId` int(11) DEFAULT NULL,
  `pic` text DEFAULT NULL,
  `date_done` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `house`
--

INSERT INTO `house` (`id`, `upiNumber`, `description`, `price`, `location`, `sellerId`, `pic`, `date_done`, `status`) VALUES
(4, '10004-3443-45643-1232', 'My house is located in a quiet, residential neighborhood that is surrounded by trees and greenery. The house is a two-story colonial-style home that is painted a warm shade of beige. The front of the house features a welcoming porch with rocking chairs and potted plants. The backyard is spacious and features a well-manicured lawn and a cozy patio with a BBQ grill.', '1000000.00', 'Musanze', 4, 'img/6616589f2bfc5_1712740511.jpeg', '2024-04-10', 'Available'),
(5, '10004-3443-45643-1236', 'As you step inside the house, you are greeted by a spacious foyer that leads to the living room. The living room features high ceilings and large windows that let in plenty of natural light. The decor is elegant and features a combination of modern and vintage pieces. The dining room is located next to the living room and features a large wooden table and comfortable chairs.', '1000000.00', 'Musanze', 4, 'img/661658d3a32c0_1712740563.jpg', '2024-04-10', 'Sold'),
(6, '10004-3443-45643-1238', 'countertops are made of granite and there is plenty of storage space for all of my cooking tools and utensils. The kitchen also has a small breakfast nook that overlooks the backyard.\r\n\r\nThe bedrooms in the house are located on the second floor. The master bedroom is spacious and features a king-sized bed, a walk-in closet, and an en-suite bathroom. The other two bedrooms are also generously sized and feature comfortable beds and plenty of storage space.', '1000000.00', 'Musanze', 4, 'img/66165a4c72448_1712740940.jpeg', '2024-04-10', 'Available'),
(7, '10004-3443-45643-1239', 'countertops are made of granite and there is plenty of storage space for all of my cooking tools and utensils. The kitchen also has a small breakfast nook that overlooks the backyard.\r\n\r\nThe bedrooms in the house are located on the second floor. The master bedroom is spacious and features a king-sized bed, a walk-in closet, and an en-suite bathroom. The other two bedrooms are also generously sized and feature comfortable beds and plenty of storage space.', '1000000.00', 'Musanze', 4, 'img/66165a6006129_1712740960.webp', '2024-04-10', 'Sold'),
(8, '10004-3443-45643-1245', 'countertops are made of granite and there is plenty of storage space for all of my cooking tools and utensils. The kitchen also has a small breakfast nook that overlooks the backyard.\r\n\r\nThe bedrooms in the house are located on the second floor. The master bedroom is spacious and features a king-sized bed, a walk-in closet, and an en-suite bathroom. The other two bedrooms are also generously sized and feature comfortable beds and plenty of storage space.', '1000000.00', 'Musanze', 4, 'img/66165a7d54cb2_1712740989.webp', '2024-04-10', 'Available'),
(9, '10004-3443-45643-1212', 'countertops are made of granite and there is plenty of storage space for all of my cooking tools and utensils. The kitchen also has a small breakfast nook that overlooks the backyard.\r\n\r\nThe bedrooms in the house are located on the second floor. The master bedroom is spacious and features a king-sized bed, a walk-in closet, and an en-suite bathroom. The other two bedrooms are also generously sized and feature comfortable beds and plenty of storage space.', '1000000.00', 'Musanze', 4, 'img/66165c57cca19_1712741463.jpg', '2024-04-10', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `houseId` int(11) DEFAULT NULL,
  `buyerId` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date_done` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `houseId`, `buyerId`, `amount`, `date_done`, `status`) VALUES
(1, 1, 1, '12300000.00', '2024-04-09', 'Approved'),
(2, 2, 4, '20000000.00', '2024-04-09', 'Cancelled'),
(3, 2, 4, '20000000.00', '2024-04-09', 'Cancelled'),
(6, 1, 6, '1000000.00', '2024-04-10', 'Appending'),
(7, 6, 6, '1000000.00', '2024-04-10', 'Cancelled'),
(8, 7, 6, '1000000.00', '2024-04-10', 'Cancelled'),
(9, 7, 6, '1000000.00', '2024-04-10', 'Cancelled'),
(10, 4, 6, '1000000.00', '2024-04-10', 'Cancelled'),
(11, 9, 6, '1000000.00', '2024-04-10', 'Cancelled'),
(12, 5, 4, '1000000.00', '2024-04-10', 'Approved'),
(13, 7, 4, '1000000.00', '2024-04-10', 'Approved'),
(14, 9, 6, '1000000.00', '2024-04-10', 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobileNumber` varchar(20) NOT NULL,
  `securityQuestion` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `role` varchar(30) NOT NULL DEFAULT 'buyer',
  `date_done` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `mobileNumber`, `securityQuestion`, `answer`, `password`, `address`, `city`, `state`, `country`, `role`, `date_done`, `status`) VALUES
(1, 'Turikumwenimana Daniel', 'danieltn889@gmail.com', '+250785085214', 'What city were you born in?', 'kgl', '827ccb0eea8a706c4c34a16891f84e7b', 'kgl', 'kgl', 'kgl', 'Rwanda', 'administrator', '2024-04-09', 'Active'),
(4, 'Tumukunde Blender', 'danieltn889@gmail.com', '+250785085214', 'What city were you born in?', 'kgl', '827ccb0eea8a706c4c34a16891f84e7b', 'kgl', 'kgl', 'kgl', 'Rwanda', 'seller', '2024-04-09', 'Active'),
(6, 'Manizabayo John', 'danieltn889@gmail.com', '+250785085214', 'What city were you born in?', 'kgl', '827ccb0eea8a706c4c34a16891f84e7b', 'kgl', 'kgl', 'kgl', 'Rwanda', 'buyer', '2024-04-10', 'Active'),
(7, 'Manizabayo John', 'danieltn8894@gmail.com', '+250785085214', 'What city were you born in?', 'kgl', '827ccb0eea8a706c4c34a16891f84e7b', 'kgl', 'kgl', 'kgl', 'Rwanda', 'buyer', '2024-04-11', 'Active'),
(8, 'Manizabayo John', 'danieltn88964@gmail.com', '+250785085214', 'What city were you born in?', 'kgl', '827ccb0eea8a706c4c34a16891f84e7b', 'kgl', 'kgl', 'kgl', 'Rwanda', 'buyer', '2024-04-11', 'Active'),
(9, 'Turikumwenimana Daniel', 'danieltn8898@gmail.com', '+250785085214', 'What is your mother\'s maiden name?', 'musanze', '827ccb0eea8a706c4c34a16891f84e7b', 'kgl', 'kgl', 'kigali', 'Rwanda', 'buyer', '2024-04-18', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `house`
--
ALTER TABLE `house`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `house`
--
ALTER TABLE `house`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
