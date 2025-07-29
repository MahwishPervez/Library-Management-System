-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2025 at 07:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `mobile` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `mobile`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin@1234', 1148458757);

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `author_id` int(11) NOT NULL,
  `author_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `author_name`) VALUES
(102, 'M D Guptaa'),
(103, 'Chetan Bhagat'),
(104, 'Munshi Prem Chand');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `isbn` int(4) NOT NULL,
  `title` varchar(250) NOT NULL,
  `author` varchar(50) NOT NULL,
  `category` varchar(20) NOT NULL,
  `description` varchar(250) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `isbn`, `title`, `author`, `category`, `description`, `status`) VALUES
(1, 1682, 'Software engineering', 'Taiheu Komak', 'Computer Science', 'kdsfdkldklfkdslf', 'available'),
(2, 9273, 'Data structure', 'Dr. Jaheeruddin', 'Algorithmics', 'sdfkjkdsfkdk', 'issued'),
(10, 3005, 'The Engineering Mindset', 'Sairish Aliya', 'engineering', 'kdfjkdjkjdkjdk', 'available'),
(11, 202, 'The Business Mindset', 'Mahwish', 'business-management', 'HEHEHEHE', 'issued'),
(12, 7845, 'half Girlfriend', 'Chetan Bhagat', 'romance', 'kdfksjf', 'available'),
(13, 7687, 'The Silent Echo', 'Arjun Mehta', 'humanities', 'A journalist uncovers secrets behind a decades-old unsolved case, revealing hidden truths and unexpected betrayals.', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'Computer Science Engineering '),
(2, 'Novel'),
(4, 'Motivational'),
(5, 'Story');

-- --------------------------------------------------------

--
-- Table structure for table `ebooks`
--

CREATE TABLE `ebooks` (
  `book_id` int(11) NOT NULL,
  `isbn` int(4) NOT NULL,
  `title` varchar(250) NOT NULL,
  `author` varchar(50) NOT NULL,
  `category` varchar(20) NOT NULL,
  `description` varchar(250) NOT NULL,
  `pdf_file` longblob DEFAULT NULL,
  `pdf_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ebooks`
--

INSERT INTO `ebooks` (`book_id`, `isbn`, `title`, `author`, `category`, `description`, `pdf_file`, `pdf_path`) VALUES
(1, 1682, 'Software engineering', 'Taiheu Komak', 'Computer Science', 'kdsfdkldklfkdslf', NULL, NULL),
(2, 9273, 'Data structure', 'Dr. Jaheeruddin', 'Algorithmics', 'sdfkjkdsfkdk', NULL, NULL),
(11, 202, 'The Business Mindset', 'Mahwish', 'business-management', 'HEHEHEHE', NULL, NULL),
(13, 7687, 'The Silent Echo', 'Arjun Mehta', 'humanities', 'A journalist uncovers secrets behind a decades-old unsolved case, revealing hidden truths and unexpected betrayals.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `issued_books`
--

CREATE TABLE `issued_books` (
  `s_no` int(11) NOT NULL,
  `isbn` int(4) NOT NULL,
  `book_name` varchar(200) NOT NULL,
  `book_author` varchar(200) NOT NULL,
  `student_id` int(11) NOT NULL,
  `fine` int(11) DEFAULT 0,
  `fine_status` varchar(20) NOT NULL DEFAULT 'paid',
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL,
  `reserve` varchar(10) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issued_books`
--

INSERT INTO `issued_books` (`s_no`, `isbn`, `book_name`, `book_author`, `student_id`, `fine`, `fine_status`, `issue_date`, `due_date`, `reserve`) VALUES
(1, 6541, 'Data structure', 'D S Gupta', 202098764, 0, 'paid', '2025-02-05', '2025-03-13', 'Yes'),
(20, 202, 'The Business Mindset', 'Mahwish', 202184937, 0, 'No Fine', '2025-02-27', '2025-03-13', 'No');

--
-- Triggers `issued_books`
--
DELIMITER $$
CREATE TRIGGER `update_fine` BEFORE INSERT ON `issued_books` FOR EACH ROW BEGIN
    DECLARE days_late INT;
    
    -- Calculate how many days the book is overdue
    SET days_late = DATEDIFF(CURDATE(), NEW.due_date);
    
    -- Update the fine only if the book is overdue
    IF days_late > 0 THEN
        SET NEW.fine = days_late * 10;
    ELSE
        SET NEW.fine = 0;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `reserved_books`
--

CREATE TABLE `reserved_books` (
  `s_no` int(11) NOT NULL,
  `isbn` int(4) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `reserved_date` date NOT NULL,
  `due_date` date NOT NULL,
  `university_id` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reserved_books`
--

INSERT INTO `reserved_books` (`s_no`, `isbn`, `title`, `author`, `reserved_date`, `due_date`, `university_id`) VALUES
(7, 6541, 'Data structure', 'D S Gupta', '2025-02-27', '2025-03-13', '202305581');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `university_id` varchar(9) NOT NULL,
  `phone` int(10) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'student',
  `status` varchar(10) NOT NULL DEFAULT 'active',
  `borrowed_books` int(20) NOT NULL DEFAULT 0,
  `limit` int(20) NOT NULL DEFAULT 8
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `university_id`, `phone`, `role`, `status`, `borrowed_books`, `limit`) VALUES
(4, 'user', 'user@gmail.com', 'user@1234', '202098764', 2147483644, 'student', 'active', 1, 8),
(7, 'hemant', 'hemant@gmail.com', 'hemant@123', '202184937', 2147483644, 'student', 'active', 1, 8),
(8, 'Rameez Siddiqui', 'siddrameez71@gmail.com', 'rameez786', '202305581', 2147483647, 'student', 'active', 2, 8),
(10, 'John Doe', 'johndoe@gmail.com', 'john786', '202345786', 2147483647, 'librarian', 'active', 0, 8),
(11, 'New User', 'newuser@gmail.com', 'user786', '202378799', 2147483647, 'teacher', 'active', 0, 8),
(12, 'Admin', 'admin@gmail.com', 'admin', '', 1111111111, 'admin', 'active', 0, 8),
(13, 'Meera Sharma', 'meera@gmail.com', 'meera786', '202099978', 2147483647, 'student', 'active', 0, 8),
(14, 'Jumanji', 'jumanji@gmail.com', 'jumanji786', '202108865', 2147483647, 'teacher', 'active', 0, 8),
(15, 'Latest User', 'user123@gmail.com', '111111111', '111111111', 2147483647, 'student', 'active', 0, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD UNIQUE KEY `isbn` (`isbn`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `ebooks`
--
ALTER TABLE `ebooks`
  ADD PRIMARY KEY (`book_id`),
  ADD UNIQUE KEY `isbn` (`isbn`);

--
-- Indexes for table `issued_books`
--
ALTER TABLE `issued_books`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `reserved_books`
--
ALTER TABLE `reserved_books`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `university_id` (`university_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ebooks`
--
ALTER TABLE `ebooks`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `issued_books`
--
ALTER TABLE `issued_books`
  MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `reserved_books`
--
ALTER TABLE `reserved_books`
  MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
