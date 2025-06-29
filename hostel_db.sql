-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2025 at 04:53 PM
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
-- Database: `hostel_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` varchar(10) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Role` varchar(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `Name`, `Role`, `Email`) VALUES
('A001', 'Mr. Prakash', 'Warden', 'prakash@hostel.com'),
('A002', 'Ms. Nadeesha', 'Admin Officer', 'nadeesha@hostel.com');

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `ID` int(11) NOT NULL,
  `Admin_ID` varchar(20) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`ID`, `Admin_ID`, `Password`) VALUES
(1, 'admin01', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `Complaint_ID` int(11) NOT NULL,
  `Student_ID` varchar(30) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Status` enum('Processing','Completed') DEFAULT 'Processing',
  `complaint_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`Complaint_ID`, `Student_ID`, `Date`, `Status`, `complaint_text`) VALUES
(1, '2022E110', '2025-06-26', 'Processing', 'The fan which is in my room C102 is not working'),
(2, '2022E104', '2025-06-26', 'Processing', 'The table light which is in my room B002 is not working');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp(),
  `action` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `time`, `action`) VALUES
(1, '2025-06-16 19:00:10', 'Admin admin01 logged in'),
(2, '2025-06-17 13:31:10', 'Admin admin01 logged in'),
(3, '2025-06-17 14:24:07', 'Admin admin01 logged in'),
(4, '2025-06-17 14:27:52', 'Admin admin01 logged in'),
(5, '2025-06-24 22:22:12', 'Admin admin01 logged in'),
(6, '2025-06-24 23:49:51', 'Admin admin01 logged in'),
(7, '2025-06-25 10:51:54', 'Admin admin01 logged in'),
(8, '2025-06-25 11:11:03', 'Admin admin01 logged in'),
(9, '2025-06-25 11:19:34', 'Admin admin01 logged in'),
(10, '2025-06-25 11:24:53', 'Admin admin01 logged in'),
(11, '2025-06-25 11:32:31', 'Admin admin01 logged in'),
(12, '2025-06-25 11:43:41', 'Admin admin01 logged in'),
(13, '2025-06-25 14:49:37', 'Admin admin01 logged in'),
(14, '2025-06-25 15:38:59', 'Admin admin01 logged in'),
(15, '2025-06-25 18:51:19', 'Admin admin01 logged in'),
(16, '2025-06-25 18:56:04', 'Admin admin01 logged in'),
(17, '2025-06-25 19:30:58', 'Admin admin01 logged in'),
(18, '2025-06-25 19:34:18', 'Admin admin01 logged in'),
(19, '2025-06-25 19:37:58', 'Admin admin01 logged in'),
(20, '2025-06-25 19:40:39', 'Admin admin01 logged in'),
(21, '2025-06-25 20:03:49', 'Admin admin01 logged in'),
(22, '2025-06-25 20:03:58', 'Admin admin01 logged in'),
(23, '2025-06-25 21:16:17', 'Admin admin01 logged in'),
(24, '2025-06-25 21:44:56', 'Admin admin01 logged in'),
(25, '2025-06-25 22:04:05', 'Admin admin01 logged in'),
(26, '2025-06-25 22:23:49', 'Admin admin01 logged in'),
(27, '2025-06-25 22:25:50', 'Admin admin01 logged in'),
(28, '2025-06-25 23:02:03', 'Admin admin01 logged in'),
(29, '2025-06-25 23:15:19', 'Admin admin01 logged in'),
(30, '2025-06-25 23:23:13', 'Admin admin01 logged in'),
(31, '2025-06-26 19:55:39', 'Admin admin01 logged in'),
(32, '2025-06-26 21:45:38', 'Admin admin01 logged in'),
(33, '2025-06-26 21:55:37', 'Admin admin01 logged in'),
(34, '2025-06-26 22:08:11', 'Admin admin01 logged in'),
(35, '2025-06-26 22:17:53', 'Admin admin01 logged in'),
(36, '2025-06-26 22:19:49', 'Admin admin01 logged in'),
(37, '2025-06-26 22:49:40', 'Admin admin01 logged in'),
(38, '2025-06-26 22:52:37', 'Admin admin01 logged in'),
(39, '2025-06-27 10:58:49', 'Admin admin01 logged in'),
(40, '2025-06-28 00:48:56', 'Admin admin01 logged in'),
(41, '2025-06-28 11:04:53', 'Admin admin01 logged in'),
(42, '2025-06-28 13:22:15', 'Admin admin01 logged in'),
(43, '2025-06-28 23:27:01', 'Admin admin01 logged in'),
(44, '2025-06-29 13:16:11', 'Admin admin01 logged in'),
(45, '2025-06-29 17:08:51', 'Admin admin01 logged in');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `message`, `date`) VALUES
(1, 'Room Details ', 'Hi, Please check the available rooms', '2025-06-16'),
(2, 'Regarding Complaints', 'Hi there, if you have any problems please let us know', '2025-06-25');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `Payment_ID` int(11) NOT NULL,
  `Student_ID` varchar(10) DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`Payment_ID`, `Student_ID`, `Amount`, `Date`, `Status`) VALUES
(1, '2022E110', 3500.00, '2025-06-25', 'Approved'),
(2, '2022E104', 2500.00, '2025-06-25', 'MasterCard'),
(3, '2023A168', 3500.00, '2025-06-26', 'Visa');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `Room_ID` varchar(20) NOT NULL,
  `Room_Type` varchar(50) DEFAULT NULL,
  `Capacity` int(11) DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`Room_ID`, `Room_Type`, `Capacity`, `Status`) VALUES
('A101', 'Four', 4, 'Available'),
('A102', 'Four', 4, 'Available'),
('A103', 'Double', 2, 'Available'),
('A104', 'Single', 1, 'Available'),
('B001', 'Double', 2, 'Occupied'),
('B002', 'Double', 2, 'Occupied'),
('B003', 'Four', 4, 'Available'),
('B004', 'Double', 2, 'Available'),
('C101', 'Double', 2, 'Available'),
('C102', 'Double', 2, 'Occupied'),
('C103', 'Four', 4, 'Available'),
('C104', 'Four', 4, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `Student_ID` varchar(20) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Contact` varchar(15) DEFAULT NULL,
  `Room_ID` varchar(20) DEFAULT NULL,
  `Faculty` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`Student_ID`, `Name`, `Contact`, `Room_ID`, `Faculty`) VALUES
('2021ET024', 'Sowmiya K', '0774982156', 'A102', 'E_Technology'),
('2022BT019', 'Maheshi R', '0769831499', 'A102', 'B_Technology'),
('2022E073', 'Shaanuga K', '0771597532', 'B001', 'Engineering'),
('2022E104', 'Kisothana P', '0751234567', 'B002', 'Engineering'),
('2022E110', 'Yogarasa P', '0771234567', 'C102', 'Engineering'),
('2022E158', 'Vithyashini T', '0704683030', 'B001', 'Engineering'),
('2022E160', 'Antonyraj T', '0717418529', 'B002', 'Engineering'),
('2022ET166', 'Lawanya A', '0778944532', 'A103', 'E_Technology'),
('2023A008', 'Kavimoli A', '0712345678', 'A101', 'Agriculture'),
('2023A045', 'Priyanga L', '0712984566', 'A101', 'Agriculture'),
('2023A168', 'Balasundar K', '0777885596', 'C102', 'Agriculture'),
('2023ET046', 'Mathumitha S', '0774361895', 'A102', 'E_Technology');

-- --------------------------------------------------------

--
-- Table structure for table `student_login`
--

CREATE TABLE `student_login` (
  `student_id` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_login`
--

INSERT INTO `student_login` (`student_id`, `username`, `password`) VALUES
('2022BT019', 'Maheshi R', '$2y$10$nuYR/oATbJ1BrRngT8Y5Qu7Fq979z8DsnmkOwZLYaVKnpShbix0xO'),
('2022E104', 'Kisothana P', '$2y$10$QnW.cg/l5s2Bci7I5UAlzO2Zn8ys5b7eCd6ulLyHTpNnh1hiX4tBy'),
('2022E110', 'Yogarasa P', '$2y$10$LHPg2kkITnFKkxZDqoZZL.iG6FXt1nZY58qUzbhIDPvYyC26gsexS'),
('2023A168', 'Balasundar K', '$2y$10$v5cLzcJ4ZMtT77of2Lntr.sE9K5xeb.D9uVD89vkI46QqorFHW79m');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Admin_ID` (`Admin_ID`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`Complaint_ID`),
  ADD KEY `Student_ID` (`Student_ID`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`Payment_ID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`Room_ID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`Student_ID`);

--
-- Indexes for table `student_login`
--
ALTER TABLE `student_login`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `Complaint_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `Payment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `students` (`Student_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_login`
--
ALTER TABLE `student_login`
  ADD CONSTRAINT `student_login_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`Student_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
