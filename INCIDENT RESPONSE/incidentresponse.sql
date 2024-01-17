-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 14, 2021 at 04:46 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `incidentresponse`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `incident_id` int(11) NOT NULL,
  `comment_id` varchar(20) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `time_recorded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`incident_id`, `comment_id`, `description`, `time_recorded`, `username`) VALUES
(1, '0000', 'hello', '2021-12-12 09:43:10', 'vk'),
(1, '0001', 'Descriptionjk', '2021-12-12 09:48:06', 'vk'),
(1, '001', 'sample description', '2021-12-12 04:35:37', 'johnsmith'),
(1, '002', 'sample description', '2021-12-12 04:35:41', 'vk'),
(2, '003', 'sample description 3', '2021-12-12 04:35:47', 'johnsmith'),
(2, '004', 'sample description 4', '2021-12-12 04:35:51', 'vk');

-- --------------------------------------------------------

--
-- Table structure for table `incident`
--

CREATE TABLE `incident` (
  `incident_id` int(11) NOT NULL,
  `incident_type` varchar(10) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `state` varchar(10) DEFAULT NULL,
  `incident_title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `incident`
--

INSERT INTO `incident` (`incident_id`, `incident_type`, `date_created`, `state`, `incident_title`) VALUES
(1, 'Legal', '2020-12-14', 'open', 'Legal Problem'),
(2, 'Fire', '2020-12-14', 'open', 'Fire'),
(4, 'Water', '2021-02-22', 'open', 'Water problem'),
(5, 'Electric', '2022-02-22', 'open', 'Electric Shock'),
(8, 'Electric', '2021-12-12', 'Open', 'Short Circuit');

-- --------------------------------------------------------

--
-- Table structure for table `incident_ip`
--

CREATE TABLE `incident_ip` (
  `incident_id` int(11) NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `association` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `incident_ip`
--

INSERT INTO `incident_ip` (`incident_id`, `ip_address`, `association`) VALUES
(1, '107.162.5.5', 'owns the fax machine'),
(1, '192.168.1.0', 'Owns the printer'),
(1, '74.8.255.211', 'john also owns this computer');

-- --------------------------------------------------------

--
-- Table structure for table `incident_person`
--

CREATE TABLE `incident_person` (
  `incident_id` int(11) NOT NULL,
  `person_email` varchar(50) NOT NULL,
  `association` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `incident_person`
--

INSERT INTO `incident_person` (`incident_id`, `person_email`, `association`) VALUES
(2, 'joshhazzlewood@gmail.com', 'caused the jamming.');

-- --------------------------------------------------------

--
-- Table structure for table `incident_responder`
--

CREATE TABLE `incident_responder` (
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `incident_responder`
--

INSERT INTO `incident_responder` (`lastname`, `firstname`, `username`, `password`) VALUES
('elizabeth', 'carter', 'carter', '123'),
('john', 'smith', 'johnsmith', '123'),
('virtual', 'K', 'vk', '123'),
('Shaheer Ahmed', 'Farooqui', 'vk12', '123');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `person_email` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `job_title` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`person_email`, `last_name`, `first_name`, `job_title`) VALUES
('1', '1', '1', '1'),
('12@gmail.com', '123', '123', 'aa'),
('2', '1', '23', '2'),
('21', '123', '123', '2'),
('john123@gmail.com', 'Smith', 'John', 'Plumber'),
('JohnAhmed@gmail.com', 'Vinay kumar R', 'Steve', 'Driver'),
('johnsmith@gmail.com', 'john', 'smith', 'plumber'),
('joshhazzlewood@gmail.com', 'josh', 'hazzlewood', 'athlete');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`incident_id`,`comment_id`),
  ADD KEY `comment_index` (`incident_id`),
  ADD KEY `username_fk` (`username`);

--
-- Indexes for table `incident`
--
ALTER TABLE `incident`
  ADD PRIMARY KEY (`incident_id`);

--
-- Indexes for table `incident_ip`
--
ALTER TABLE `incident_ip`
  ADD PRIMARY KEY (`incident_id`,`ip_address`),
  ADD KEY `ip_index` (`incident_id`);

--
-- Indexes for table `incident_person`
--
ALTER TABLE `incident_person`
  ADD PRIMARY KEY (`incident_id`,`person_email`),
  ADD KEY `person_index` (`incident_id`),
  ADD KEY `incident_person_ibfk_2` (`person_email`);

--
-- Indexes for table `incident_responder`
--
ALTER TABLE `incident_responder`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`person_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `incident`
--
ALTER TABLE `incident`
  MODIFY `incident_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`incident_id`) REFERENCES `incident` (`incident_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `username_fk` FOREIGN KEY (`username`) REFERENCES `incident_responder` (`username`);

--
-- Constraints for table `incident_ip`
--
ALTER TABLE `incident_ip`
  ADD CONSTRAINT `incident_ip_ibfk_1` FOREIGN KEY (`incident_id`) REFERENCES `incident` (`incident_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `incident_person`
--
ALTER TABLE `incident_person`
  ADD CONSTRAINT `incident_person_ibfk_1` FOREIGN KEY (`incident_id`) REFERENCES `incident` (`incident_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `incident_person_ibfk_2` FOREIGN KEY (`person_email`) REFERENCES `person` (`person_email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
