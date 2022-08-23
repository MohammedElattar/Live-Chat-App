-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 23, 2022 at 09:30 AM
-- Server version: 10.5.16-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id19341347_online_chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) NOT NULL,
  `content` text NOT NULL,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `opened` tinyint(1) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `content`, `user1`, `user2`, `opened`, `date`) VALUES
(1, 'Hi Man', 2, 1, 1, '2022-07-29 09:29:56'),
(2, 'Whast Up', 2, 1, 1, '2022-07-29 09:30:05'),
(3, 'Iam Good And U', 1, 2, 1, '2022-07-29 09:30:30'),
(4, 'also good', 1, 2, 1, '2022-07-29 09:30:37'),
(5, 'Nice', 2, 1, 1, '2022-07-29 09:30:43'),
(6, 'it,s now a good time to think yo', 1, 2, 1, '2022-07-29 09:53:48'),
(7, 'انت اللي عامل اي والله يعم ', 1, 2, 1, '2022-07-29 09:55:12'),
(8, 'انا كويس والله الحمد لله \n', 1, 2, 1, '2022-07-29 09:55:21'),
(9, 'How are U Man ! ', 2, 1, 1, '2022-07-31 03:59:16'),
(10, 'i\'m not okay and u ? ', 2, 1, 1, '2022-07-31 03:59:27'),
(11, 'not nice too ! ', 2, 1, 1, '2022-07-31 03:59:32'),
(12, 'welcome man ', 1, 2, 1, '2022-07-31 04:00:04'),
(13, 'how are u ', 1, 2, 1, '2022-07-31 04:00:08'),
(14, 'i\'m okay and u ', 2, 1, 1, '2022-07-31 04:00:14'),
(15, 'nice man thanks', 1, 2, 1, '2022-07-31 04:00:22'),
(16, 'انت اللي عامل اي والله يعم واحشني والله ', 1, 2, 1, '2022-07-31 04:00:31'),
(17, 'انت اكتر والله يصحبي يارب تكون كويس دايما ', 2, 1, 1, '2022-07-31 04:00:40'),
(18, 'الحمد لله يارب ديما \n', 1, 2, 1, '2022-07-31 04:00:45'),
(19, 'طيب تمم الحمد لله ', 2, 1, 1, '2022-07-31 04:00:52'),
(20, 'Hello From the other side man ', 4, 1, 0, '2022-08-06 18:11:31'),
(21, 'How Are U ', 4, 1, 0, '2022-08-06 18:11:38'),
(22, 'How U Doing', 4, 2, 1, '2022-08-06 18:11:59'),
(23, 'i\'m Nice And U', 2, 4, 1, '2022-08-06 18:12:55'),
(24, 'انت عامل اي ', 2, 4, 1, '2022-08-06 18:13:01'),
(25, 'انا كويس الحمد لله\n', 4, 2, 1, '2022-08-06 18:13:07'),
(26, 'طيب الحمد لله ', 2, 4, 1, '2022-08-06 18:13:16'),
(27, 'Hi', 6, 4, 1, '2022-08-07 18:20:52'),
(28, 'انت عامل اي ', 4, 6, 1, '2022-08-07 18:21:15'),
(29, 'كويس الحمد لله انت كويس ؟', 6, 4, 1, '2022-08-07 18:21:26'),
(30, 'اه الحمد لله تمم ', 4, 6, 1, '2022-08-07 18:21:33'),
(31, 'طيب يارب ديما ', 6, 4, 1, '2022-08-07 18:21:38'),
(32, 'الحمد لله ', 4, 6, 1, '2022-08-07 18:21:46'),
(33, 'يرحمك لله ', 4, 6, 1, '2022-08-07 18:21:51'),
(34, 'يهديهكم الله ويصلح بالكم', 6, 4, 1, '2022-08-07 18:22:01'),
(35, 'طيب الحمد لله ', 6, 4, 1, '2022-08-07 18:23:01'),
(36, 'يارب ', 4, 6, 1, '2022-08-07 18:23:07'),
(37, 'ازيك عامل اي ', 4, 1, 0, '2022-08-10 19:36:06'),
(38, 'عال مي \n', 4, 2, 1, '2022-08-10 19:36:47'),
(39, 'hello', 4, 1, 0, '2022-08-23 09:10:28'),
(40, 'it is me ', 4, 1, 0, '2022-08-23 09:10:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'default.png',
  `last_seen` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `Name`, `username`, `password`, `date`, `avatar`, `last_seen`) VALUES
(1, 'Mohamed Attar', 'mohamedattar2302', '$2y$10$cOQnMXmXh3yI98U0U7u8EOMwXt/Dcof2D3oSC.SFUxpgYXTalGJIW', '2022-07-29 09:14:22', '3831292Screenshot 2022-07-28 125331.png', '2022-07-31 04:01:38'),
(2, 'Ahmed Mohamed', 'mohamedattar23022', '$2y$10$FOoY.W3MJIViC4xAGbEJ4OTivWvUMWz49lTpk7YvNy03/Lrs0ahKm', '2022-07-29 09:26:08', '7147977Screenshot 2022-07-28 211512.png', '2022-08-10 19:36:51'),
(3, 'ى', 'mohamedattar230222', '$2y$10$WSyUDTNFCzB6jhVa6x2AIeODTcUkgFMCxxWYeyjjkHwFSwjgy0Oqa', '2022-07-29 10:25:34', '9969918code.png', '2022-07-29 10:25:42'),
(4, 'Ahmed Mohamed', 'mohamedattar', '$2y$10$76HAuOKXLyV3WPLH2LtYDOgMoDdXvvLeGj4T0r5JRlSsfsmbrEOU2', '2022-07-31 12:33:26', '7586094Screenshot 2022-07-31 013759.png', '2022-08-23 09:12:25'),
(5, 'Omar', 'Omar', '$2y$10$VuGHb8qp.Jj1ZD0l/iLdRezEQUTFGRI8wa9GMSZmpPF5FLRzmWOdG', '2022-08-07 18:00:35', '2156644inbound8641435995386063346.jpg', '2022-08-07 18:00:52'),
(6, 'Ahmed Attar', 'ahmedattar2302', '$2y$10$luMOuH1KEfwGz53swbkspOaRU0uQ.Q4ONonDlOTDZ6jb4O1yr6OIy', '2022-08-07 18:20:38', '1391238code.png', '2022-08-07 18:24:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Messages` (`user1`),
  ADD KEY `messages_2` (`user2`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `Messages` FOREIGN KEY (`user1`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_2` FOREIGN KEY (`user2`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
