-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2023 at 11:38 AM
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
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admininfo`
--

CREATE TABLE `admininfo` (
  `adminid` varchar(7) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admininfo`
--

INSERT INTO `admininfo` (`adminid`, `password`) VALUES
('TAR1234', 'aaa'),
('', '');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_id` int(2) NOT NULL,
  `event_title` varchar(100) NOT NULL,
  `event_description` varchar(500) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `place` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `seat` int(100) NOT NULL,
  `seatremain` int(5) NOT NULL,
  `price` float NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `event_title`, `event_description`, `genre`, `place`, `date`, `seat`, `seatremain`, `price`, `image`) VALUES
(1, '\'70s Rock N Romance Cruise', '\"For a cruise with a little bit of boogie thrown in, this themed voyage has a number of famous acts performing including The Hollies, Don Felder of The Eagles, The Bay City Rollers, Leo Sayer and loads more. And if you think you can do better then there’s special themed karaoke, alongside trivia contests and panel discussions.\"', 'Rock', 'Celebrity Cruise', '2023-05-25', 500, 470, 599, 'cruise music.jpg'),
(2, 'Mawazine Music Festival', '\"Africans know how to party and Morocco’s Mawazine Festival is a testament to that. With annual attendance around the 2.65 million mark, they pull huge acts such as Christina Aguilera, Justin Timberlake and Rod Stewart, as well as a large number of African luminaries such as Amadou & Mariam, and Tinariwen. A celebration of Moroccan culture and arts, it was started by the personal secretary to King Mohammad IV and lives on as an incredible tribute to African music.\"', 'Diverse World Music Pop Music', 'Rabat, Morocco', '2023-05-01', 500, 400, 200, 'mawazine.jpg'),
(3, 'RICHARD ASHCROFT + OCEAN COLOUR SCENE', '\"Richard Ashcroft will perform an exclusive outdoor show in the stunning grounds of Englefield, near Pangbourne in Berkshire this summer, as part of the Heritage Live concert series. The iconic singer-songwriter will perform in the grounds of the Elizabethan country house and estate on Saturday 22nd July 2023, alongside special guests for the event Ocean Colour Scene and The Sherlocks.\"', 'Rock and Indie', 'Englefield House', '2023-07-22', 320, 50, 500, 'heritage.jpg'),
(4, 'HONNE', 'British electro-R&B duo HONNE – comprising Andy Clutterbug and James Hatcher – will be returning to Malaysia for a one-night-only show at ZEPP KL. The band released their latest album in 2021 titled Let’s Just Say the World Ended a Week from Now, What Would You Do? and helped produce BTS RM’s Closer last year.', 'electro-R&B', 'Zepp KL', '2023-05-21', 570, 500, 100, 'honne.png'),
(5, 'Crowd Lu: C’mon Live Concert Tour', 'Mandopop lovers in Malaysia are in for a treat. Taiwanese indie singer, songwriter, and composer, Crowd Lu, will be crooning to his Malaysian fans at Plenary Hall KL in May for his C’Mon Live Concert tour.', 'Mandopop', 'Plenary Hall', '2023-05-27', 400, 200, 500, 'crowd_lu.png');

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE `participant` (
  `student_id` int(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `profile_pic` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `participant`
--

INSERT INTO `participant` (`student_id`, `email`, `password`, `profile_pic`) VALUES
(2209417, 'lohxl-wm22@student.tarc.edu.my', 'xinling_21', '64535f58341f7.jpeg'),
(2209428, 'celynloh1028@gmail.com', 'kaiying_21', '64539a47566b3.jpg'),
(2209432, '123yunghao@gmail.com', 'xxll12345', '6455c1b05648d.jpg'),
(2209654, 'lohxl-wm22@student.tarc.edu.my', 'xxx12345', '6455ffd41beea.png');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `student_id` int(20) NOT NULL,
  `course` varchar(50) NOT NULL,
  `class` varchar(10) NOT NULL,
  `phone_num` int(10) NOT NULL,
  `events` varchar(100) NOT NULL,
  `qty` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `student_name`, `student_id`, `course`, `class`, `phone_num`, `events`, `qty`) VALUES
(10, 'loh xin ling', 2209417, 'IT', 'DFT1Y1S3', 12345678, 'Mawazine Music Festival', 6),
(11, 'ong kai ying', 2209428, 'IT', 'DFT1Y1S3', 123456789, 'HONNE', 8),
(12, 'ong kai ying', 2209428, 'IT', 'DFT1Y1S3', 123456789, 'Crowd Lu: C’mon Live Concert Tour', 3),
(13, 'loh xin ling', 2209417, 'IT', 'DFT1Y1S3', 12345678, 'Mawazine Music Festival', 1),
(14, 'loh xin ling', 2209417, 'IT', 'DFT1Y1S3', 12345678, '\'70s Rock N Romance Cruise', 1),
(15, 'loh xin ling', 2209417, 'IT', 'DFT1Y1S3', 12345678, 'Crowd Lu: C’mon Live Concert Tour', 6),
(16, 'loh xin ling', 2209417, 'IT', 'DFT1Y1S3', 12345678, '\'70s Rock N Romance Cruise', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
