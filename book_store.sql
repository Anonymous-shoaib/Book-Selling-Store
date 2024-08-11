-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 07, 2024 at 03:09 PM
-- Server version: 8.0.36
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `genre` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `isbn` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `cover_photo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pdf_file` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `author_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `author_description` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `genre`, `isbn`, `description`, `price`, `cover_photo`, `pdf_file`, `author_name`, `author_description`, `created_at`) VALUES
(14, 'testing', 'action', 'asdd', 'goood', 1234.00, 'uploads/mask_4.png', 'uploads/Database_Team_Project_Data_V1_2024.pdf', 'me', 'dfgh', '2024-08-07 06:12:10');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mobile_number` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `zip_code` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `address` text COLLATE utf8mb4_general_ci NOT NULL,
  `payment_method` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `book_id` int NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `first_name`, `last_name`, `mobile_number`, `email`, `zip_code`, `address`, `payment_method`, `book_id`, `subtotal`, `created_at`, `status`) VALUES
(1, 'shoaib', 'ahmad', '123455', 'example@gmail.com', 'qwe123', 'pak', 'paypal', 13, 173.00, '2024-08-04 12:09:35', 'Pending'),
(2, 'gsgs', 'sdgfsdfg', 'sfgs', 'test@gmail.com', 't553rgf', 'sdfgvsf', 'paypal', 13, 173.00, '2024-08-04 12:24:38', 'Pending'),
(3, 'dfsdf', 'fsfdgsd', 'fgsd', 'admin@gmail.com', 'sdgf', 'dfsdf', 'paypal', 13, 173.00, '2024-08-04 12:25:35', 'Pending'),
(4, 'dfsdf', 'fsfdgsd', 'fgsd', 'admin@gmail.com', 'sdgf', 'dfsdf', 'paypal', 13, 173.00, '2024-08-04 13:10:49', 'Pending'),
(5, 'dfsdf', 'fsfdgsd', 'fgsd', 'admin@gmail.com', 'sdgf', 'dfsdf', 'paypal', 13, 173.00, '2024-08-04 13:13:59', 'Pending'),
(6, 'dfsdf', 'fsfdgsd', 'fgsd', 'admin@gmail.com', 'sdgf', 'dfsdf', 'paypal', 13, 173.00, '2024-08-04 13:14:38', 'Pending'),
(7, 'aaaa', 'df', 'sdaf', 'admin@gmail.com', 'sdf', 'asdfasdf', 'paypal', 13, 173.00, '2024-08-04 13:14:55', 'Pending'),
(8, 'aaaa', 'df', 'sdaf', 'admin@gmail.com', 'sdf', 'asdfasdf', 'paypal', 13, 173.00, '2024-08-04 13:15:33', 'Pending'),
(9, 'ssss', 'asfd', 'fsad', 'asfsadf@g.co', 'adfa', 'af', 'paypal', 13, 173.00, '2024-08-04 13:15:51', 'Pending'),
(10, 'zzzz', 'sdfgs', 'fsf', 'admin@gmail.com', 'adsfa', 'dsf', 'paypal', 13, 173.00, '2024-08-04 13:18:03', 'Pending'),
(11, 'asdcccccc', 'sfgsd', 'gssg', 'asfsadf@g.co', 'adf', 'adfsd', 'paypal', 13, 173.00, '2024-08-04 13:20:40', 'Pending'),
(12, 'asdcccccc', 'sfgsd', 'gssg', 'asfsadf@g.co', 'adf', 'adfsd', 'paypal', 13, 173.00, '2024-08-04 13:33:17', 'Pending'),
(13, 'asdcccccc', 'sfgsd', 'gssg', 'asfsadf@g.co', 'adf', 'adfsd', 'paypal', 13, 173.00, '2024-08-04 13:56:39', 'Pending'),
(14, 'awqsaswa', 'sdf', 'fdas', 'admin@gmail.com', 'adfas', 'f', 'paypal', 13, 173.00, '2024-08-04 13:57:28', 'Pending'),
(15, 'awqsaswa', 'sdf', 'fdas', 'admin@gmail.com', 'adfas', 'fadf', 'paypal', 13, 173.00, '2024-08-04 14:39:44', 'Pending'),
(16, 'qqqqqqqqqq', 'asdf', 'fd', 'admin@gmail.comasf', 'afasd', 'af', 'paypal', 13, 173.00, '2024-08-04 14:46:07', 'Pending'),
(17, 'awaraa', 'asdfg', 'asf', 'admin@gmail.com', 'sdf', 'sdfsf', 'paypal', 11, 60.00, '2024-08-05 05:56:01', 'Pending'),
(18, 'awaraa', 'asdfg', 'asf', 'admin@gmail.com', 'sdf', 'sdfsf', 'paypal', 11, 60.00, '2024-08-05 06:06:10', 'Pending'),
(19, 'aswqqqqq', 'dfs', 'dsfsa', 'asfsadf@g.co', 'af', 'f', 'paypal', 11, 60.00, '2024-08-05 06:19:18', 'Pending'),
(20, 'asdf', 'asdf', 'sfa', 'admin@gmail.comadf', 'df', 'sdffd', 'paypal', 13, 173.00, '2024-08-05 06:21:22', 'Pending'),
(21, 'sdsfs', 'afaf', 'fasfas', 'asfg@gmail.com', 'afad', 'afaaf', 'paypal', 11, 60.00, '2024-08-05 06:33:01', 'Pending'),
(22, 'gsegsegf', 'geg', 'erg', 'admin@gmail.com', 'sfg', 'dsfgfd', 'paypal', 11, 60.00, '2024-08-06 15:22:34', 'Pending'),
(23, 'vs', 'sfsf', 'asf', 'asfg@gmail.com', 'afasdd', 'sdfadf', 'paypal', 14, 1284.00, '2024-08-07 12:16:32', 'Pending'),
(24, 'vs', 'sfsf', 'asf', 'asfg@gmail.com', 'afasdd', 'sdfadf', 'paypal', 14, 1284.00, '2024-08-07 12:26:13', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `book_id` int NOT NULL,
  `review_date` datetime NOT NULL,
  `comment` text COLLATE utf8mb4_general_ci NOT NULL,
  `rating` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_general_ci DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `profile` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`, `profile`) VALUES
(1, 'shoaib', 'admin@gmail.com', '$2y$10$f..nr9KqwKzGuYJQDd1DY.TFM9GDK.WVRRVYSx1zG8sH.hVP8wL0G', 'admin', '2024-08-02 05:43:19', 'uploads/Picsart_23-06-09_12-18-54-904.jpg'),
(2, 'ali', 'user@gmail.com', '$2y$10$1IickVRDXKQiOVWKK6lVNuAeCQ/XxrwT.uilS147nTZDWpiVlGN7C', 'user', '2024-08-02 06:01:12', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `reviews_ibfk_2` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
