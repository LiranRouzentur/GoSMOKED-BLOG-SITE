-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 09, 2019 at 09:18 AM
-- Server version: 5.6.44-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gosmoked`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `article` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `article`, `date`) VALUES
(1, 1, 'test post1', 'asdasdasdasdasdasd', '2019-10-05 12:55:11'),
(2, 1, 'firest test post', 'asdasdasdasdasdasd', '2019-10-05 12:55:24'),
(3, 1, 'asdasdasdasd', 'asdasdadasdsd', '2019-10-05 23:15:56'),
(4, 1, 'alksjflsjlksjdsad', 'asdasodkaslkdals;kdsd', '2019-10-06 09:07:12'),
(5, 1, 'דגלכחךלדגחכלךדגכח', 'דךגלחכדךלגחכגדלךכחחגדכ', '2019-10-07 10:59:37'),
(6, 1, 'dsfsdsdfsdf', 'sdfsdfdsf\r\nsdfsdfsdfsdf\r\nsdfsdfsdf\r\ns\r\ndgrhwe\r\nfd\r\nsbs\r\nbsd', '2019-10-07 11:09:54'),
(7, 6, 'lsjhfdshfsdjkhdsjkhsdjghjh', 'lskdfjsdlkjsdkljfsdkjfsdlkjf', '2019-10-17 14:12:43'),
(8, 7, 'xxzzxcxzczxc', 'zxxcxzcxzcxzc', '2019-10-17 14:37:19'),
(9, 8, 'asdasdsad', 'asdasdasdasd', '2019-10-17 14:39:14'),
(10, 9, 'ldskfjdskljfkl', 'sdkjsdlkjfdsklfjsd', '2019-10-17 14:44:17'),
(30, 14, 'fdgdfgdfgdfg', 'dfgdfgdffdg', '2019-10-21 05:11:46'),
(31, 14, 'khjgjhgjhgjhg', 'kjgjkhjhjhg', '2019-10-21 05:12:12'),
(32, 4, 'dffgdfgdfgdfgdfgdfgdfgdffd', 'fdgfdfddgfdfgfdfdfdfdgfdfddf', '2019-10-21 05:12:51'),
(33, 13, 'new test online server', 'sodfsdfjdksfjkdsfjdsjfsdf', '2019-10-21 05:17:22'),
(34, 15, 'היי', 'היי', '2019-10-21 07:39:15'),
(35, 16, 'חרא אתר', 'ממש אבל', '2019-10-21 23:10:18'),
(36, 1, 'sami', 'savir beyoter', '2019-10-21 23:11:25'),
(37, 17, 'כל הכבוד חיים ', 'תותך, כפרה))', '2019-10-21 23:23:30'),
(38, 18, 'Bilbi lohlum', 'Lalalala', '2019-10-22 05:24:21'),
(39, 11, 'jgfgfgffhgfhgfgf', 'jhhfghgfhgfhgfhgf', '2019-10-25 10:56:05'),
(40, 20, ' !!!גאה בך ילד שלי!!! כל הכבוד', ' !!!גאה בך ילד שלי!!! כל הכבוד', '2019-10-27 03:00:14'),
(41, 15, 'bdika', 'bdika\r\nbdika', '2019-10-30 07:55:35'),
(42, 21, 'liralisfjlfj', 'ksdjlksdjlksdfsdlfksdf', '2019-10-30 08:01:25'),
(44, 22, 'This is post', 'WhatsApp?', '2019-10-31 06:06:05'),
(45, 24, 'helo', 'great job❤', '2019-11-01 04:43:59'),
(47, 27, 'My first post', 'ggg', '2019-11-05 06:04:48'),
(49, 28, 'sddsdsds', 'xvdxvcxzvxzvzv', '2019-11-05 16:36:51'),
(50, 29, 'post', 'toppppp Liran', '2019-11-07 10:34:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Avi Cohan', 'avi@gmail.com', '$2y$10$pIC.pDiqUP4WMKccJ8HGlubX1POZQpsMTf/NqfYvFzUN89jHZ3uwa'),
(2, 'Mosha Lavi', 'mosh@gmail.com', '$2y$10$pIC.pDiqUP4WMKccJ8HGlubX1POZQpsMTf/NqfYvFzUN89jHZ3uwa'),
(3, 'albert bbb', 'albert@gmail.com', '$2y$10$l5aurPIy6eAqXZ0mJ/47Ueu6ERdCwjrtZrq.7MzCWVFlAW/FJjJEW'),
(4, 'Liran', 'liran@gmail.com', '$2y$10$ymGWyt42OVIYzJEhKWcwbO4sIzJ7xoR3YoZbgRQfsAKEU3fONYcoe'),
(5, 'dov', 'dov@gmail.com', '$2y$10$BfNZR0RH.BjuA1sgRJTV8eQUe2y9NRhMiBm.FoOwVLDkpdLiTDW8O'),
(9, 'baby', 'baby@gmail.com', '$2y$10$BRWZtlVgR1Xp.M3qlT7tb.X.p8Ed9bQX.ObexVXXYuUReSef1Blbm'),
(10, 'test', 'test@gmail.com', '$2y$10$GpHfUi3PsIuWt364hdLj.OvlA0MxY4g.etLq.P9SJ8UejD2D4N9SK'),
(11, 'lital', 'lital@gmail.com', '$2y$10$UzyB2qVBpgrNbv//ZAVSm.TCBNNY3bbM1NdZzabJc4NHK3M2UHXCi'),
(12, 'ziv', 'ziv@gmail.com', '$2y$10$/COeu0nUHsUeZc5nSmmdw.QYQyf9y0yEJAHdfjzuq.dwg1.gyoTxi'),
(13, 'dor', 'dor@gmail.com', '$2y$10$J6R2T9VFfgOhR7nUJsr6TOMPzcSfcOXTrkbx/a78XmcId/RvumcTC'),
(14, 'kof', 'kof@gmail.com', '$2y$10$ds9TMJa1cw2d3UB5Wvf/luoDwcucYvAdIgPjmuwaUtGSP44acqzqu'),
(15, 'dor levy', 'ddl105095@gmail.com', '$2y$10$u4TIetXuV2QYRBlQzI41V.R/sruyJEwbFixeoYG5yLvuUL0xoxbX6'),
(16, 'sasas', 'sadasf@dasd.com', '$2y$10$ZU8m5DH9XQpS6ou/QTlbEeW5z9tou4N801rKOLQz4LSuanIZa7Xz2'),
(17, 'Jen Teller', 'jennytrushevsky@gmail.com', '$2y$10$Qi8.vrH5OviXKy7iKh6UZOaHs7jz.lr3x/rNg4O7XOYHo2Ujsi5Ze'),
(18, 'Isai', 'isai.naza@gmail.com', '$2y$10$iaErzoRDELBW68UM2kGqP.ofFnvzr5BbbBd7CJb30Jg4GmbJojzj.'),
(19, 'eldad', 'eldad@gmail.com', '$2y$10$ERGj67.Kb9gtOn/qva8UwOrMe1ZmF0oZhwCOPgOg2GF/YHcve.1uC'),
(20, 'Raya ', 'rayarouzentur@gmail.com', '$2y$10$Cmsc1ALtBLeMt82vly/5LO9.EbUgcQ9oIyCqoac9h8KvRZipzzBmK'),
(21, 'waka', 'waka@gmail.com', '$2y$10$a.ByKrrcLvNIq/KQ4sr1FeUPDhypxczRtip.Gey29wfjeEa/RBM5m'),
(22, 'Pasha', 'pasha@gmail.com', '$2y$10$X6SZmUAA489lh8GOd.urZ.QkqyPB8509CAV9d64XM81AaKDNp5FKK'),
(23, 'Avi cohen', 'hen@gmail.com', '$2y$10$s/AouxeMI2Z15wyMuX92c.En2v6tNVlD.OZ0eaPF/RvWrgIvuWXRi'),
(24, 'eden', 'alice123321@walla.com', '$2y$10$GgSM6uj51eH7JkqVrkb2Y.wuBraIYL3CkKb.CiFpvxf1NZ.271y9i'),
(25, 'eldad', 'eldad0476@gmail.com', '$2y$10$mxHbd5X9Ol8tDYiyxN0R6u9dzJAMa/tcW84UXj/luCyGdFJwm3o.u'),
(26, 'jen', 'jen@gmail.com', '$2y$10$fsYx70CdIpAdmoBd7IQBKOg.hdxbCDuW1K7W20wXNBNP8oPcNtB.W'),
(27, 'Victoria', 'vika@gmail.com', '$2y$10$JhyqnWezWV2es3jDyxOwKuFUFcR4VQzMM9kEox0z/Fg0vgvXR9P7K'),
(28, 'yomero', 'yomero@gmail.com', '$2y$10$qxN9X3bn74wyE8VNu8LlzuGQUXD6NqYF/Vcr2XIqkoFOHIlYR08pC'),
(29, 'reuven', 'benit@gmail.com', '$2y$10$DFGD2DsmkaP/v4DfQRTRM.LRhrRYUwqJaxKIVSSLJESqhCmLMn6mC');

-- --------------------------------------------------------

--
-- Table structure for table `users_profile`
--

CREATE TABLE `users_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `profile_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_profile`
--

INSERT INTO `users_profile` (`id`, `user_id`, `profile_image`) VALUES
(1, 1, 'default_profile.png'),
(2, 2, 'default_profile.png'),
(3, 3, 'default_profile.png'),
(4, 4, 'default_profile.png'),
(5, 5, 'default_profile.png'),
(9, 9, '2019.10.17.11.44.09-baby.jpeg'),
(10, 10, 'default_profile.png'),
(11, 11, 'default_profile.png'),
(12, 12, 'default_profile.png'),
(13, 13, 'default_profile.png'),
(14, 14, '2019.10.21.11.56.02-kof.png'),
(15, 15, '2019.10.21.14.37.55-bgc.jpg'),
(16, 16, '2019.10.22.06.09.41-16.10.19.23.35.54-cthulhu-2-t-shirt.jpg'),
(17, 17, 'default_profile.png'),
(18, 18, 'default_profile.png'),
(19, 19, 'default_profile.png'),
(20, 20, 'default_profile.png'),
(21, 21, 'default_profile.png'),
(22, 22, 'default_profile.png'),
(23, 23, 'default_profile.png'),
(24, 24, 'default_profile.png'),
(25, 25, 'default_profile.png'),
(26, 26, 'default_profile.png'),
(27, 27, 'default_profile.png'),
(28, 28, 'default_profile.png'),
(29, 29, '2019.11.07.17.50.12-defult_profil.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users_profile`
--
ALTER TABLE `users_profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users_profile`
--
ALTER TABLE `users_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
