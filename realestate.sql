-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 29, 2023 at 01:53 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `realestate`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_num` varchar(20) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `name`, `email`, `username`, `password`, `address`, `contact_num`, `image`) VALUES
(1, 'Jephthah', 'jephthahlandicho1212@gmail.com', 'jeph12', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '', '', ''),
(2, 'Clarence', 'clarence@gmail.com', 'clarence', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `id` int(11) NOT NULL,
  `property_id` varchar(100) NOT NULL,
  `amenities` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `property_id`, `amenities`) VALUES
(0, 'RS-0000008', 'Near beach'),
(0, 'RS-0000008', ' hello world'),
(0, 'RS-0000008', ' maganda dine'),
(0, 'RS-0000008', ' bilhin mo na'),
(0, 'RS-0000009', 'Near the beach'),
(0, 'RS-0000009', ' nice view'),
(0, 'RS-0000009', ' good location'),
(0, 'RS-0000010', 'Have a nice view'),
(0, 'RS-0000010', ' 3 floors'),
(0, 'RS-0000010', ' swimming pool'),
(0, 'RS-0000011', 'Good ambiance'),
(0, 'RS-0000011', ' happy happy'),
(0, 'RS-0000011', ' 1 floor'),
(0, 'RS-0000012', 'Near the hospital'),
(0, 'RS-0000012', ' near the commercial space'),
(0, 'RS-0000012', ' have a great ambiance'),
(0, 'RS-0000015', 'The best view'),
(0, 'RS-0000015', ' have a great ambiance');

-- --------------------------------------------------------

--
-- Table structure for table `buyer_login`
--

CREATE TABLE `buyer_login` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_num` varchar(20) NOT NULL,
  `image` text NOT NULL,
  `verified` int(11) NOT NULL,
  `code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buyer_login`
--

INSERT INTO `buyer_login` (`id`, `name`, `username`, `email`, `password`, `address`, `contact_num`, `image`, `verified`, `code`) VALUES
(1, 'Jephthah Jehosaphat Landicho', 'jeph12', 'landichojjl@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '', '', '', 0, 151306),
(3, 'Maxine', 'max', 'maxine@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '', '', '', 1, 0),
(4, 'Jessica', 'jessica', 'jessica@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '', '', '', 0, 0),
(7, 'Jephthah Jehosaphat Landicho', 'johndoe', 'johndoe@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Sitio Mahabang Parang Malaruhatan', '09468853244', '6435482d23030-agent-3.jpg', 0, 0),
(8, 'Jephthah Jehosaphat Landicho', 'landichojeph', 'jephthahlandicho1212@gmail.com', '7f4002c758853392831e0b584d85e122ec383902', 'Sitio Mahabang Parang Malaruhatan', '09468853244', '6435695f11fdf-agent-6.jpg', 1, 836844);

-- --------------------------------------------------------

--
-- Table structure for table `buyer_survey`
--

CREATE TABLE `buyer_survey` (
  `id` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `price` float NOT NULL,
  `customer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buyer_survey`
--

INSERT INTO `buyer_survey` (`id`, `type`, `price`, `customer`) VALUES
('SRVY-01', 'House', 2000000, 3),
('SRVY-02', 'All', 500000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `message` varchar(150) NOT NULL,
  `user_target` int(11) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `notif_type` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user`, `message`, `user_target`, `user_type`, `notif_type`, `created_at`, `status`) VALUES
(1, 1, 'New property posted', 0, 'Admin', 'Posted', '2023-04-06 13:49:51', 'Read'),
(2, 1, 'New property posted', 0, 'Admin', 'Posted', '2023-04-06 14:27:34', 'Read'),
(3, 0, 'Property Approved', 1, 'Agent', 'Posted', '2023-04-11 07:59:47', 'Read'),
(4, 0, 'Property Approved', 1, 'Agent', 'Posted', '2023-04-13 10:09:50', 'Read'),
(5, 0, 'Property Approved', 1, 'Agent', 'Posted', '2023-04-28 12:53:30', 'Read');

-- --------------------------------------------------------

--
-- Table structure for table `saved_property`
--

CREATE TABLE `saved_property` (
  `id` int(11) NOT NULL,
  `property_id` varchar(100) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saved_property`
--

INSERT INTO `saved_property` (`id`, `property_id`, `customer_id`, `date`) VALUES
(1, 'RS-0000004', 1, '2023-04-09'),
(2, 'RS-0000010', 1, '2023-04-10'),
(3, 'RS-0000008', 1, '2023-04-10'),
(4, 'RS-0000006', 3, '2023-04-10');

-- --------------------------------------------------------

--
-- Table structure for table `seller_login`
--

CREATE TABLE `seller_login` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_num` varchar(20) NOT NULL,
  `image` text NOT NULL,
  `verified` int(11) NOT NULL,
  `code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller_login`
--

INSERT INTO `seller_login` (`id`, `name`, `username`, `email`, `password`, `address`, `contact_num`, `image`, `verified`, `code`) VALUES
(1, 'Jephthah Jehosaphat Landicho', 'jeph12', 'landichojjl@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '', '', '', 0, 0),
(3, 'Jephthah', 'jephthah', 'jephthahlandicho1212@gmail.com', '084ba824281b516e15968c396882cb1ccbc28cdc', '', '', '', 1, 781589),
(7, 'Kimberly Panganiban', 'k1mby', 'kimby@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '', '', '', 0, 0),
(8, 'Clarence Phol Andino', 'clarence', 'clarenceeee@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '', '', '', 0, 0),
(9, '', '', '', '', '', '', '', 0, 0),
(10, 'Hello World', 'hello', 'helloworld@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '', '', '', 0, 0),
(14, 'Jephthah Jehosaphat Landicho', 'johndoeeee', 'johndoeeee@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Sitio Mahabang Parang Malaruhatan', '09468853244', '6435486cd0c8a-mini-testimonial-2.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `seller_property`
--

CREATE TABLE `seller_property` (
  `id` varchar(150) NOT NULL,
  `title` varchar(150) NOT NULL,
  `more_info` text NOT NULL,
  `price` float NOT NULL,
  `sqm` float NOT NULL,
  `type` varchar(50) NOT NULL,
  `approved` varchar(5) NOT NULL,
  `status` varchar(10) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `latitude` varchar(150) NOT NULL,
  `longitude` varchar(150) NOT NULL,
  `location` varchar(150) NOT NULL,
  `bedroom` int(11) NOT NULL,
  `garages` int(11) NOT NULL,
  `cr` int(11) NOT NULL,
  `image` text NOT NULL,
  `date` date NOT NULL,
  `floor_sqm` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller_property`
--

INSERT INTO `seller_property` (`id`, `title`, `more_info`, `price`, `sqm`, `type`, `approved`, `status`, `seller_id`, `latitude`, `longitude`, `location`, `bedroom`, `garages`, `cr`, `image`, `date`, `floor_sqm`) VALUES
('RS-0000001', '', '', 0, 0, '', '', '', 9, '', '', '', 0, 0, 0, '', '2023-03-13', 0),
('RS-0000003', 'Symfoni Lian', 'Strategically planned and intuitively designed, Symfoni Kamias hits the right notes. This property is in proximity to major universities and institutions, setting the stage for a thoroughly convenient lifestyle\r\n\r\nAmenities:\r\nSwimming Pool\r\nFitness Gym\r\nCommercial Area\r\nAmenity Lounge', 15000000, 250, 'House and Lot', 'Yes', 'Sold', 1, '14.040319011246499', '120.66286386843454', 'Malaruhatan, Lian, Batangas, Calabarzon, Philippines', 2, 1, 3, '26.jpg', '2023-03-31', 0),
('RS-0000004', 'Solaya Calatagan', 'Beyond the given innate beauty of nature, Solaya Calatagan extends the best experience of owning a HOME for Batangueños, to grow their dreams and make a living. A piece of nature that is a good investment to start for the future of their families.', 5000000, 199, 'House', 'Yes', 'Sold', 1, '13.8329883', '120.6322361', 'Calatagan, Batangas, Calabarzon, 4215, Philippines', 2, 2, 3, '3.jpg', '2023-03-31', 0),
('RS-0000005', 'Grand Villa', 'Grand Mesa Residences is one of the prime developments by Wee Comm located in Quezon City. It is designed with nature-inspired architecture and lifestyle features, making it the right choice for those who want to experience nature living in the heart of the city. Located just five minutes from La Mesa Ecopark, all homeowners can enjoy a living space to slow down, escape the fast-paced city life, and marvel at the view of the distant mountain range of Rizal. To live at Grand Mesa Residences is to live conveniently, especially with the MRT-7 which promises a hassle-free commute around the metro.', 20000000, 400, 'House and Lot', 'Yes', 'Sold', 1, '13.9382014', '120.7294838', 'Balayan, Batangas, Calabarzon, 4213, Philippines', 3, 2, 5, '16.jpg', '2023-03-31', 0),
('RS-0000006', 'Bahay ni Cleo', 'sdgsdgsdg', 12000000, 100, 'House', 'Yes', 'For Sale', 1, '14.036155647535658', '120.65333066330446', 'Knights of Columbus Hall, Lian-Calatagan Road, Dos, Quatro, Lian, Batangas, Calabarzon, 4216, Philippines', 2, 1, 2, '8.jpg', '2023-04-03', 0),
('RS-0000008', 'Lot a lot', 'zdgdsgkdggrtfgg', 2000000, 200, 'Lot', 'Yes', 'Sold', 1, '14.03680615', '120.67948718635498', 'Bagong Pook Elementary School, Palico-Lian Provincial Road, Bagoong Pook, Lian, Batangas', 0, 0, 0, 'lot4.jpg', '2023-04-06', 0),
('RS-0000009', 'Lian House', 'This is more information', 2340000, 200, 'House', 'Yes', 'Sold', 1, '14.0734578', '120.6322736', 'Nasugbu, Batangas, Calabarzon, 4231, Philippines', 2, 1, 3, '15.jpg', '2023-04-06', 150),
('RS-0000010', 'The Mansion', 'Bili na kayo. please lang', 60000000, 500, 'House', 'Yes', 'Sold', 1, '14.0423328', '120.6262978', 'San Diego, Lian, Batangas, Calabarzon, Philippines', 5, 2, 6, '16.jpg', '2023-04-06', 298),
('RS-0000011', 'House and Lot for Sale', 'dsgdfgdfgdfgdfgdfg', 6500000, 200, 'House and Lot', 'Yes', 'Sold', 1, '14.0563395', '120.641824', 'Nasugbu-Lian Road, Palm Estate, Nasugbu, Batangas', 2, 1, 3, '16.jpg', '2023-04-06', 100),
('RS-0000012', 'The best place', 'This is the best place to be', 1000000, 200, 'Lot', 'Yes', 'Sold', 1, '14.0361178', '120.653454', 'Lian, Batangas, Calabarzon, 4216, Philippines', 0, 0, 0, 'lot2.jpg', '2023-04-06', 0),
('RS-0000015', 'The best Lot', 'sdsdfsdfsdfsdf', 1234570, 123, 'Lot', 'No', 'Sold', 1, '13.9518077', '120.6200148', 'Matabungkay, Lian, Batangas, Calabarzon, 4216, Philippines', 0, 0, 0, 'lot1.jpg', '2023-04-06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `seller_property_photos`
--

CREATE TABLE `seller_property_photos` (
  `id` int(11) NOT NULL,
  `property_id` varchar(150) NOT NULL,
  `photos` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller_property_photos`
--

INSERT INTO `seller_property_photos` (`id`, `property_id`, `photos`) VALUES
(70, 'RS-0000001', ''),
(178, 'RS-0000003', '../uploads/25.jpg'),
(179, 'RS-0000004', '../uploads/18.jpg'),
(180, 'RS-0000004', '../uploads/19.jpg'),
(181, 'RS-0000004', '../uploads/20.jpg'),
(182, 'RS-0000004', '../uploads/21.jpg'),
(183, 'RS-0000005', '../uploads/23.jpg'),
(184, 'RS-0000005', '../uploads/24.jpg'),
(185, 'RS-0000005', '../uploads/25.jpg'),
(186, 'RS-0000005', '../uploads/26.jpg'),
(187, 'RS-0000003', '../uploads/18.jpg'),
(188, 'RS-0000006', '../uploads/19.jpg'),
(189, 'RS-0000006', '../uploads/20.jpg'),
(194, 'RS-0000008', '../uploads/lot2.jpg'),
(195, 'RS-0000008', '../uploads/lot3.jpg'),
(196, 'RS-0000009', '../uploads/19.jpg'),
(197, 'RS-0000009', '../uploads/20.jpg'),
(198, 'RS-0000009', '../uploads/21.jpg'),
(199, 'RS-0000010', '../uploads/19.jpg'),
(200, 'RS-0000010', '../uploads/20.jpg'),
(201, 'RS-0000010', '../uploads/21.jpg'),
(202, 'RS-0000011', '../uploads/19.jpg'),
(203, 'RS-0000011', '../uploads/20.jpg'),
(204, 'RS-0000011', '../uploads/21.jpg'),
(205, 'RS-0000012', '../uploads/lot3.jpg'),
(218, 'RS-0000015', '../uploads/lot2.jpg'),
(219, 'RS-0000015', '../uploads/lot3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sold_property`
--

CREATE TABLE `sold_property` (
  `id` int(11) NOT NULL,
  `property_id` varchar(100) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `buyer_login`
--
ALTER TABLE `buyer_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buyer_survey`
--
ALTER TABLE `buyer_survey`
  ADD KEY `customer` (`customer`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saved_property`
--
ALTER TABLE `saved_property`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `seller_login`
--
ALTER TABLE `seller_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller_property`
--
ALTER TABLE `seller_property`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `seller_property_photos`
--
ALTER TABLE `seller_property_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `sold_property`
--
ALTER TABLE `sold_property`
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `property_id` (`property_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `buyer_login`
--
ALTER TABLE `buyer_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `saved_property`
--
ALTER TABLE `saved_property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seller_login`
--
ALTER TABLE `seller_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `seller_property_photos`
--
ALTER TABLE `seller_property_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `amenities`
--
ALTER TABLE `amenities`
  ADD CONSTRAINT `amenities_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `seller_property` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `buyer_survey`
--
ALTER TABLE `buyer_survey`
  ADD CONSTRAINT `buyer_survey_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `buyer_login` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `saved_property`
--
ALTER TABLE `saved_property`
  ADD CONSTRAINT `saved_property_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `seller_property` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `saved_property_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `buyer_login` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seller_property`
--
ALTER TABLE `seller_property`
  ADD CONSTRAINT `seller_property_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `seller_login` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seller_property_photos`
--
ALTER TABLE `seller_property_photos`
  ADD CONSTRAINT `seller_property_photos_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `seller_property` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sold_property`
--
ALTER TABLE `sold_property`
  ADD CONSTRAINT `sold_property_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `seller_property` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sold_property_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `buyer_login` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
