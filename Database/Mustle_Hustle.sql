-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Oct 14, 2021 at 03:21 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Mustle_Hustle`
--

-- --------------------------------------------------------

--

-- Table structure for table `login`
--

-- Create the table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role ENUM('user', 'admin') NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert an admin user with a hashed password
INSERT INTO users (role, username, password)
VALUES ('admin', 'Admin123', 'Admin@123'); -- Replace with actual hashed password



-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(10) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `fname`, `email`,`password`) VALUES
(1, 'admin','admintms@gmail.com', 'Adm12345');


-- --------------------------------------------------------



--
-- Table structure for table `ContactUs`
--

CREATE TABLE `ContactUs` (
  `id` int(10) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pno` BIGINT(20) NOT NULL,
  `query` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ContactUs`
--

INSERT INTO `ContactUs` (`id`, `firstname`, `email`, `pno`, `query`) VALUES
(1, 'Ganesh',  'ganeshravinaik2001@gmail.com',  2147483647, 'What are the safety guidelines for using gym equipment like the treadmill or elliptical machine?'),
(2, 'kiran',  'kirannaik1@gmail.com',  845868956, 'What are the benefits of hiring a personal trainer at the gym?');

-- --------------------------------------------------------

-- 
-- Table structure for table `payment`
-- 
CREATE TABLE payment_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    duration VARCHAR(10) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    city VARCHAR(100) NOT NULL,
    zip VARCHAR(10) NOT NULL,
    cardholder_name VARCHAR(255) NOT NULL,
    card_number VARCHAR(19) NOT NULL,
    expiry_month CHAR(2) NOT NULL,
    expiry_year CHAR(2) NOT NULL,
    cvv CHAR(4) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

--
-- Dumping data for table `booking`
--


-- INSERT INTO `payment` (`id`, `full_name`, `email`, `address`, `city`, `state`, `zip_code`, `membership`, `credit_debit_card_number`, `exp_month`, `exp_year`, `cvv`) VALUES
-- (1, 'Ganesh', 'ganeshravinaik2001@gmail.com', 'warje', 'pune', 'maharashtra', 411058, '10,000', 43628493762, 09, 2025, 638);


--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `feedback` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `feedback`) VALUES
(1, 'joy', 'joy123@gmail.com', 'good website'),
(2, 'amar', 'amar56@gmail.com', 'nice website');



-- Table structure for table `member`
--

CREATE TABLE `member` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `dor` date NOT NULL,
  `plan` varchar(20) NOT NULL,
  `contact` int(10) NOT NULL,
  `address` varchar(40) NOT NULL,
  `services` varchar(20) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------


--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `designation` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `contact` int(10) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `equipment` (
  `equip_id` int(11) NOT NULL,
  `fullname` varchar(20) NOT NULL,
  `description` varchar(20) NOT NULL,
  `dop` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `vendor` varchar(20) NOT NULL,
  `contact` int(10) NOT NULL,
  `address` varchar(50) NOT NULL,
  `cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




--
-- Indexes for dumped tables
--








--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`user_id`);



-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`user_id`);


--
-- Indexes for table `staff`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`equip_id`);

--
-- AUTO_INCREMENT for dumped tables
--


--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;


--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;


--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;


--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `equipment`
  MODIFY `equip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;



