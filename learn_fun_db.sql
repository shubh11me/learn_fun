-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2022 at 08:56 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `learn_fun_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `auhor_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `joined_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`auhor_id`, `firstname`, `lastname`, `email_id`, `password`, `gender`, `age`, `role`, `joined_date`) VALUES
(1, 'Shubham', 'Todkar', 'todkarshubham11@gmail.com', 'shubh', 'male', 19, 0, '2021-09-30 06:52:09'),
(2, 'Prasad', 'Hingmire', 'Prasad@gmail.com', 'Prasad@gmail.com', 'male', 21, 0, '2021-10-07 06:48:46'),
(3, 'Sayali', 'Pawar', 'sayali@gmail.com', 'sayali@gmail.com', 'male', 20, 0, '2021-10-09 03:57:24');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `course_category` varchar(50) NOT NULL,
  `reg_course_fee` int(11) NOT NULL,
  `prm_course_fee` int(11) NOT NULL,
  `discount_course_fee` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `description`, `course_category`, `reg_course_fee`, `prm_course_fee`, `discount_course_fee`, `date`, `author_id`) VALUES
(4, 'Python Begin to advance', 'Python is an interpreted high-level general-purpose programming language. Its design philosophy emphasizes code readability with its use of significant indentation. Its language constructs as well as its object-oriented approach aim to help programmers write clear, logical code for small and large-scale projects.', 'Computer', 600, 200, 300, '2021-09-30 03:07:20', 1),
(5, 'C++', NULL, 'Computer', 500, 200, 300, '2021-09-30 04:49:57', 1),
(6, 'Google Appsheet', 'Google Certification Training Courses have been introduced into the market to help working professionals prepare themselves to advance in their field of choice. The certificate holders have the acquired skills to succeed in their area of specialization. Those who complete any of the Google Certification Training courses have the opportunity to enroll in high paying jobs at a national or international level.', 'Computer', 900, 600, 500, '2021-09-30 04:50:40', 1),
(7, 'Ruby', 'Ruby is an interpreted, high-level, general-purpose programming language. It was designed and developed in the mid-1990s by Yukihiro \"Matz\" Matsumoto in Japan. Ruby is dynamically typed and uses garbage collection and just-in-time compilation.', 'Computer', 1500, 1200, 1300, '2021-10-07 06:52:05', 2),
(8, 'C++', 'C++ is a general-purpose programming language created by Bjarne Stroustrup as an extension of the C programming language, or \"C with Classes\".', 'Computer', 1880, 0, 1600, '2021-10-09 03:58:09', 3),
(9, 'DJANGO', ',ab,fbalnf', 'Computer', 500, 30, 300, '2021-12-11 06:41:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `influencer`
--

CREATE TABLE `influencer` (
  `influ_id` int(11) NOT NULL,
  `influ_firstname` varchar(60) NOT NULL,
  `influ_lastname` varchar(60) NOT NULL,
  `influ_email` varchar(60) NOT NULL,
  `influ_password` varchar(60) NOT NULL,
  `role` int(11) NOT NULL,
  `gender` varchar(60) NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `influencer`
--

INSERT INTO `influencer` (`influ_id`, `influ_firstname`, `influ_lastname`, `influ_email`, `influ_password`, `role`, `gender`, `age`) VALUES
(1, 'Shubham', 'Todkar', 'todkarshubham11@gmail.com', 'todkarshubham11@gmail.com', 1, 'male', 20);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `course_prod_id` int(11) NOT NULL,
  `product_name` varchar(60) NOT NULL,
  `product_img_src` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `course_prod_id`, `product_name`, `product_img_src`) VALUES
(1, 6, 'Sewing Machine', '.\\product img\\sewing_machine.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_track`
--

CREATE TABLE `product_track` (
  `product_track_id` int(11) NOT NULL,
  `product_id_for_track` int(11) DEFAULT NULL,
  `user_prod_track_id` int(11) DEFAULT NULL,
  `track_status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `subscription_id` int(11) NOT NULL,
  `user_sub_id` int(11) NOT NULL,
  `course_sub_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `payment_id` varchar(60) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`subscription_id`, `user_sub_id`, `course_sub_id`, `name`, `email`, `amount`, `payment_status`, `payment_id`, `added_on`) VALUES
(1, 2, 6, 'Shubham', 'todkarshubham11@gmail.coms', 500, 'complete', 'pay_I5wnHdTw0SMQpq', '2021-10-06 08:11:24'),
(2, 2, 4, 'Shubham', 'todkarshubham11@gmail.com', 300, 'pending', '', '2021-10-06 08:27:13'),
(3, 2, 4, 'Shubham', 'todkarshubham11@gmail.com', 300, 'pending', '', '2021-10-06 08:27:16'),
(4, 2, 4, 'Shubham', 'todkarshubham11@gmail.com', 300, 'pending', '', '2021-10-06 08:27:17'),
(5, 2, 4, 'Shubham', 'todkarshubham11@gmail.com', 300, 'pending', '', '2021-10-06 08:27:19'),
(6, 2, 4, 'Shubham', 'todkarshubham11@gmail.com', 300, 'pending', '', '2021-10-06 08:27:20'),
(7, 2, 4, 'Shubham', 'todkarshubham11@gmail.com', 300, 'pending', '', '2021-10-06 08:27:20'),
(8, 2, 4, 'Shubham', 'todkarshubham11@gmail.com', 300, 'pending', '', '2021-10-06 08:27:20'),
(9, 2, 4, 'Shubham Todkar', 'todkarshubham11@gmail.com', 300, 'pending', '', '2021-10-06 08:27:33'),
(10, 2, 4, 'SHubham', 'todkarshubham11@gmail.coms', 300, 'pending', '', '2021-10-06 08:28:12'),
(11, 2, 4, 'SHubham', 'todkarshubham11@gmail.coms', 300, 'pending', '', '2021-10-06 08:28:14'),
(12, 2, 4, 'SHubham', 'todkarshubham11@gmail.com', 300, 'pending', '', '2021-10-06 08:28:18'),
(13, 2, 4, 'SHubham', 'todkarshubham11@gmail.com', 300, 'pending', '', '2021-10-06 08:28:19'),
(14, 2, 4, 'SHubham', 'todkarshubham11@gmail.com', 300, 'pending', '', '2021-10-06 08:28:19'),
(15, 2, 4, 'SHubham', 'todkarshubham11@gmail.com', 300, 'pending', '', '2021-10-06 08:28:19'),
(16, 2, 4, 'SHubham', 'todkarshubham11@gmail.com', 300, 'pending', '', '2021-10-06 08:28:19'),
(17, 2, 4, 'SHubham', 'todkarshubham11@gmail.com', 300, 'pending', '', '2021-10-06 08:28:20'),
(18, 2, 4, 'SHubham', 'todkarshubham11@gmail.com', 300, 'pending', '', '2021-10-06 08:28:20'),
(19, 2, 4, 'SHubham TOdkar', 'todkarshubham11@gmail.com', 300, 'pending', '', '2021-10-06 08:28:27'),
(20, 2, 4, 'SHubham TOdkar', 'todkarshubham11@gmail.com', 300, 'pending', '', '2021-10-06 08:28:27'),
(21, 2, 4, 'SHubham TOdkar', 'todkarshubham11@gmail.com', 300, 'pending', '', '2021-10-06 08:28:27'),
(22, 2, 4, 'SHubham TOdkar', 'todkarshubham11@gmail.com', 300, 'pending', '', '2021-10-06 08:28:27'),
(23, 2, 4, 'SHubham TOdkar', 'todkarshubham11@gmail.com', 300, 'pending', '', '2021-10-06 08:28:28'),
(24, 2, 4, 'SHubham TOdkar', 'todkarshubham11@gmail.com', 300, 'pending', '', '2021-10-06 08:28:28'),
(25, 2, 4, 'SHubham TOdkar', 'todkarshubham11@gmail.com', 300, 'pending', '', '2021-10-06 08:28:28'),
(26, 2, 4, 'SHubham TOdkar', 'todkarshubham11@gmail.com', 300, 'pending', '', '2021-10-06 08:30:01'),
(27, 2, 4, 's', 'sinhgad@gmail.com', 300, 'pending', '', '2021-10-06 08:30:22'),
(28, 2, 4, 's', 'sinhgad@gmail.com', 300, 'pending', '', '2021-10-06 08:33:41'),
(29, 9, 6, 'Sumeet Prachande', 'sumeetprachande@gmail.com', 500, 'complete', 'pay_I6W9LBP0Fuv8FA', '2021-10-07 06:46:41'),
(30, 9, 7, 'shubh', 'shubh@gmail.com', 1300, 'complete', 'pay_I6WLj9nLVZjQIn', '2021-10-07 06:58:31'),
(31, 11, 8, 'Sayali Pawar', 'sayali@gmail.com', 1600, 'complete', 'pay_I7GRmaIIpqqIHk', '2021-10-09 04:04:11');

-- --------------------------------------------------------

--
-- Table structure for table `topics_course`
--

CREATE TABLE `topics_course` (
  `topic_id` int(11) NOT NULL,
  `course_id_top` int(11) NOT NULL,
  `topic_name` varchar(50) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `joined_by_role` int(11) DEFAULT NULL,
  `joined_by_id` int(11) DEFAULT NULL,
  `role` int(11) NOT NULL,
  `payment_status` tinyint(1) DEFAULT NULL,
  `payment_id` varchar(50) NOT NULL,
  `joined_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `username`, `email_id`, `password`, `joined_by_role`, `joined_by_id`, `role`, `payment_status`, `payment_id`, `joined_date`) VALUES
(1, 'Shubham', 'Todkar', 'shubh123', 'todkarshubham11@gmail.com', 'shubh123', NULL, NULL, 2, 0, '', '2021-10-06 06:04:23'),
(2, 'Shubham', 'Todkar', 'shubh123', 'todkarshubham11@gmail.com', 'shubh123', NULL, NULL, 2, 1, 'pay_I5udgIKQ6DIucU', '2021-10-06 06:05:05'),
(3, 'Shubham', 'Todkar', 'prasad@gmail.com', 'prasad@gmail.com', 'prasad@gmail.com', 0, 0, 2, 0, '', '2021-10-06 08:03:13'),
(6, 'Prasad', 'Hingmire', 'prasad@gmail.com', 'prasad@gmail.com', 'prasad@gmail.com', 0, 1, 2, 0, '', '2021-10-06 08:11:50'),
(7, 'Prasad', 'Hingmire', 'prasad@gmail.com', 'prasad@gmail.com', 'prasad@gmail.com', 0, 1, 2, 0, '', '2021-10-06 08:13:34'),
(8, 'Prasad', 'Hingmire', 'prasad@gmail.com', 'prasad@gmail.com', 'prasad@gmail.com', 0, 1, 2, 1, 'pay_I697wk2w7otMR7', '2021-10-06 08:15:26'),
(9, 'Sumeet', 'Prachande', 'sumeetprachande@gmail.com', 'sumeetprachande@gmail.com', 'sumeetprachande@gmail.com', NULL, NULL, 2, 1, 'pay_I6W6tWxBF5MDPu', '2021-10-07 06:44:21'),
(10, 'Aniker', 'Todkar', 'ani@gmail.com', 'ani@gmail.com', 'ani@gmail.com', 1, 1, 2, 1, 'pay_I6WYYRD7fkmKrv', '2021-10-07 07:10:39'),
(11, 'Sayali', 'Pawar', 'sayali@gmail.com', 'sayali@gmail.com', 'sayali@gmail.com', NULL, NULL, 2, 1, 'pay_I7GPilcrUA5sNu', '2021-10-09 04:02:03'),
(12, 'Shubham', 'Vrushali', 'root', 'shubh@gmail.com', 'op', NULL, NULL, 2, 0, '', '2021-11-23 08:19:37');

-- --------------------------------------------------------

--
-- Table structure for table `videos_course`
--

CREATE TABLE `videos_course` (
  `video_id` int(11) NOT NULL,
  `course_id_vid` int(11) NOT NULL,
  `video_name` varchar(150) NOT NULL,
  `video_src` varchar(250) NOT NULL,
  `vid_tag` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videos_course`
--

INSERT INTO `videos_course` (`video_id`, `course_id_vid`, `video_name`, `video_src`, `vid_tag`) VALUES
(4, 6, 'Vehicle Inspection Build Promo.mp4', '../videos/Vehicle Inspection Build Promo.mp4', 'info'),
(5, 6, 'Automation Intro - Vehicle Inspection Build - S3.0.mp4', '../videos/Automation Intro - Vehicle Inspection Build - S3.0.mp4', 'default'),
(6, 4, 'Setting up columns pt. 3 - Vehicle Inspection Build - S1.4.mp4', '../videos/Setting up columns pt. 3 - Vehicle Inspection Build - S1.4.mp4', 'info'),
(7, 4, 'Bot that saves pdf on form completion and emails automatically - Vehicle Inspection Build - S3.5.mp4', '../videos/Bot that saves pdf on form completion and emails automatically - Vehicle Inspection Build - S3.5.mp4', 'default'),
(8, 4, 'Template expressions using google sheets - Vehicle Inspection Build - S3.3.mp4', '../videos/Template expressions using google sheets - Vehicle Inspection Build - S3.3.mp4', 'default'),
(9, 7, 'Actions.mp4', '../videos/Actions.mp4', 'info'),
(10, 7, 'Branding Your App.mp4', '../videos/Branding Your App.mp4', 'default'),
(11, 7, 'Expression Assistant.mp4', '../videos/Expression Assistant.mp4', 'default'),
(12, 8, 'Actions.mp4', '../videos/Actions.mp4', 'default'),
(13, 8, 'Creating an App and Connecting it to Your Data.mp4', '../videos/Creating an App and Connecting it to Your Data.mp4', 'info'),
(14, 8, 'Data Tab Overview.mp4', '../videos/Data Tab Overview.mp4', 'default'),
(15, 9, 'Actions.mp4', '../videos/Actions.mp4', 'default'),
(16, 9, 'Branding Your App.mp4', '../videos/Branding Your App.mp4', 'default');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`auhor_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `influencer`
--
ALTER TABLE `influencer`
  ADD PRIMARY KEY (`influ_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_track`
--
ALTER TABLE `product_track`
  ADD PRIMARY KEY (`product_track_id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`subscription_id`);

--
-- Indexes for table `topics_course`
--
ALTER TABLE `topics_course`
  ADD PRIMARY KEY (`topic_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `videos_course`
--
ALTER TABLE `videos_course`
  ADD PRIMARY KEY (`video_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `auhor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `influencer`
--
ALTER TABLE `influencer`
  MODIFY `influ_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_track`
--
ALTER TABLE `product_track`
  MODIFY `product_track_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `subscription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `topics_course`
--
ALTER TABLE `topics_course`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `videos_course`
--
ALTER TABLE `videos_course`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
