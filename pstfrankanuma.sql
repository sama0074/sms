-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2023 at 04:54 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pstfrankanuma`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL,
  `age` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `others` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `number`, `group_id`, `age`, `gender`, `others`) VALUES
(1, 'Sama Yanick', '653766939', 6, '28', 'Male', 0),
(2, 'Neba Yvonne', '671824509', 11, '29', 'Female', 0),
(5, 'Ashime Rose', '675247828', 11, '56', 'Female', 0),
(7, 'Gana Sama Emanuel', '677650948', 11, '58', 'Male', 0),
(10, 'Mac Alunge', '653957382', 8, '32', 'Male', 0),
(11, 'Prince Enobi Micheal', '675411309', 7, '35', 'Male', 0),
(12, 'Naomi Ndiaka', '680164928', 11, '28', 'Female', 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_created` varchar(255) NOT NULL,
  `others` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `date_created`, `others`) VALUES
(5, 'Entertainers', 'Friday 30 Dec 2022', 0),
(6, 'Pastor', 'Friday 30 Dec 2022', 0),
(7, 'Event Organizers', 'Friday 30 Dec 2022', 0),
(8, 'Artist', 'Friday 30 Dec 2022', 0),
(9, 'Banks', 'Friday 30 Dec 2022', 0),
(10, 'Hospitals ', 'Friday 30 Dec 2022', 0),
(11, 'Business People ', 'Friday 30 Dec 2022', 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `is_group` int(11) NOT NULL,
  `is_contact` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `is_sent` int(11) NOT NULL,
  `is_draft` int(11) NOT NULL,
  `is_bulk` int(11) NOT NULL,
  `date_sent` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `content`, `subject`, `is_group`, `is_contact`, `group_id`, `contact_id`, `is_sent`, `is_draft`, `is_bulk`, `date_sent`) VALUES
(47, 'Hi man', 'Redirect not working ', 0, 1, 0, 1, 1, 0, 0, 'Monday 31 Oct 2022'),
(50, 'All is well now', 'User Logins', 0, 0, 0, 0, 1, 0, 1, 'Monday 31 Oct 2022'),
(51, 'Hi, greetings sir. This is Sama from Ohipopo Technologies. Please would want to find out if you are still interested in using our services so that we properly close October and enter November with a new itineraries. You can reply via: https://wa.me/message/4EES7TRFXDDPE1', 'Maflekumen University', 1, 0, 4, 0, 0, 1, 0, 'Monday 31 Oct 2022'),
(53, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex distinctio a consequatur error, dignissimos eligendi praesentium possimus expedita qui, assumenda blanditiis! Quod tempore repellendus ipsa odio ducimus earum dolorem sequi!', 'Redirect not working ', 0, 0, 0, 0, 1, 0, 653766939, 'Monday 31 Oct 2022'),
(54, 'ok boy', 'Main Testing', 0, 0, 0, 0, 1, 0, 653766939, 'Monday 31 Oct 2022'),
(61, 'Hey bi man. How are you doing today?', 'Hello Greetings', 0, 0, 0, 0, 1, 0, 653766939, 'Friday 04 Nov 2022'),
(62, 'Hey bi man. How are you doing today?', 'Hello Greetings', 0, 0, 0, 653766939, 0, 1, 0, 'Friday 04 Nov 2022'),
(64, 'Hello Main man, how are you doing today? Hope great.', 'Just for Testing ', 0, 0, 0, 0, 1, 0, 653766939, 'Friday 30 Dec 2022'),
(65, 'Hello, greeting Prince Enobi, this is Ohips-SMS marketing services. We will like to propose a great sms marketing campaigns to you. Please you get to us via https://wa.me/message/4EES7TRFXDDPE1', 'Marketing', 0, 0, 0, 0, 1, 0, 1, 'Friday 30 Dec 2022'),
(67, 'Hello, greetings Mac, this is Ohips-SMS marketing services. We will like to propose a great sms marketing campaigns with your brand name. Please you get to us via https://wa.me/message/4EES7TRFXDDPE1', 'Marketing', 0, 1, 0, 10, 1, 0, 0, 'Friday 30 Dec 2022'),
(68, 'Neo stoss, na me this... we fit do this for Uncle Oliva ei bank... how u see am', 'Showcase', 0, 1, 0, 12, 1, 0, 0, 'Friday 30 Dec 2022');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `member_name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `country` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `hobbies` varchar(255) NOT NULL,
  `id_no` varchar(255) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `code` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `image` mediumblob NOT NULL,
  `employee_id` mediumblob NOT NULL,
  `employee_application` varchar(255) NOT NULL,
  `surety_name` varchar(255) NOT NULL,
  `surety_occupation` varchar(255) NOT NULL,
  `surety_phone` varchar(50) NOT NULL,
  `surety_id` varchar(255) NOT NULL,
  `surety_relationship` varchar(50) NOT NULL,
  `surety_address` varchar(50) NOT NULL,
  `surety_agreement` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `other` varchar(255) NOT NULL,
  `isUser` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `member_name`, `position`, `dob`, `country`, `gender`, `address`, `hobbies`, `id_no`, `start_date`, `code`, `phone`, `image`, `employee_id`, `employee_application`, `surety_name`, `surety_occupation`, `surety_phone`, `surety_id`, `surety_relationship`, `surety_address`, `surety_agreement`, `username`, `password`, `other`, `isUser`) VALUES
(42, 'Ohipopo Technologies', 'Owner', '2019-07-15', 'Cameroon', 'Male', 'Mile 4 Limbe', 'Technology, IT', '1', '2022-11-01', '#U3357', '652137960', 0x666161313932636265353931343564636533393739323361646564666364366631663231643138662d3330363938393836365f323933313234393538373031393038375f313835333837383739343830373833303934315f6e2e6a7067, '', '', 'Sama Yanick', 'Pastor', '653766939', '112219914', 'CEO', 'Limbe', '', 'admin', '6cb6cfbfd1a9438942d16083cf3085bc', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
