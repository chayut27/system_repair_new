-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2020 at 08:45 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `system_repair`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL,
  `is_delete` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `type`, `name`, `is_active`, `is_delete`, `updated_at`, `created_at`) VALUES
(5, 3, 'Acer', 'Y', 'N', '2020-03-31 15:06:42', '2020-03-31 15:06:42'),
(6, 3, 'HP', 'Y', 'N', '2020-03-31 15:06:42', '2020-03-31 15:06:42'),
(7, 3, 'Lenovo', 'Y', 'N', '2020-03-31 15:06:42', '2020-03-31 15:06:42'),
(8, 3, 'Asus', 'Y', 'N', '2020-03-31 15:06:42', '2020-03-31 15:06:42'),
(9, 2, 'Acer', 'Y', 'N', '2020-03-31 15:06:42', '2020-03-31 15:06:42'),
(10, 2, 'Lenovo', 'Y', 'N', '2020-03-31 15:06:42', '2020-03-31 15:06:42'),
(11, 2, 'Asus', 'Y', 'N', '2020-03-31 15:06:42', '2020-03-31 15:06:42'),
(13, 5, 'Canon', 'Y', 'N', '2020-04-01 18:02:29', '2020-04-01 18:02:29'),
(14, 7, 'Acer', 'Y', 'N', '2020-04-02 04:26:34', '2020-04-02 04:26:34'),
(15, 5, 'HP', 'Y', 'N', '2020-04-02 04:27:59', '2020-04-02 04:27:59');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `is_delete` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `is_active`, `is_delete`, `updated_at`, `created_date`) VALUES
(18, 'Electrical appliances', 'Y', 'Y', '2020-04-01 17:46:28', '2019-12-27 17:58:28'),
(19, 'อุปกรณ์สำนักงาน', 'Y', 'N', '2020-04-01 17:46:48', '2019-12-27 17:58:48'),
(20, 'อื่นๆ', 'Y', 'N', '2020-04-01 17:46:34', '2019-12-27 18:12:28');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `serial_number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `brand` int(11) NOT NULL,
  `photo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` enum('Y','N','RP','WO') COLLATE utf8_unicode_ci NOT NULL,
  `is_delete` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `name`, `serial_number`, `category`, `type`, `brand`, `photo`, `is_active`, `is_delete`, `updated_at`, `created_at`) VALUES
(8, 'Acer01', 'A10001', 19, 2, 9, '1585828966_26.jpg', 'Y', 'N', '2020-04-03 22:04:33', '2020-01-03 17:02:16'),
(11, 'MACER1001', 'MACER1001', 19, 7, 14, '1585801630_26.jpg', 'RP', 'N', '2020-04-03 22:04:59', '2020-04-02 04:27:09'),
(12, 'HP Deskjet 1001', 'hpdeskjet1001', 19, 5, 15, '1585801700_26.jpg', 'Y', 'N', '2020-04-03 22:05:21', '2020-04-02 04:28:19'),
(13, 'AIO Lenovo 1001', 'aiolenove1001', 19, 3, 7, '1585801812_26.jpg', 'Y', 'N', '2020-04-03 22:05:39', '2020-04-02 04:30:12');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `per_id` int(11) NOT NULL,
  `per_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`per_id`, `per_name`) VALUES
(1, 'ผู้ดูแล'),
(2, 'ผู้ใช้งาน'),
(3, 'ช่างซ่อม'),
(4, 'หัวหน้าช่าง');

-- --------------------------------------------------------

--
-- Table structure for table `problem`
--

CREATE TABLE `problem` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL,
  `is_delete` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `problem`
--

INSERT INTO `problem` (`id`, `name`, `is_active`, `is_delete`, `updated_at`, `created_at`) VALUES
(2, 'เปิดไม่ติด', 'Y', 'N', '2020-04-02 21:06:43', '2020-04-02 21:06:43'),
(5, 'Printer', 'Y', 'N', '2020-04-02 21:09:03', '2020-04-02 21:09:03'),
(6, 'Internet ใช้งานไม่ได้', 'Y', 'N', '2020-04-02 21:10:08', '2020-04-02 21:10:08');

-- --------------------------------------------------------

--
-- Table structure for table `repair`
--

CREATE TABLE `repair` (
  `id` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `problem` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `technician` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `repair`
--

INSERT INTO `repair` (`id`, `inventory_id`, `problem`, `description`, `user_id`, `technician`, `updated_at`, `created_at`) VALUES
(2, 8, 2, 'ssss', 26, 41, '2020-04-03 21:00:41', '2020-04-03 17:00:00'),
(3, 11, 2, 'tg', 26, 41, '2020-04-03 21:00:52', '2020-04-03 21:00:52');

-- --------------------------------------------------------

--
-- Table structure for table `repair_detail`
--

CREATE TABLE `repair_detail` (
  `id` int(11) NOT NULL,
  `repair_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `repair_detail`
--

INSERT INTO `repair_detail` (`id`, `repair_id`, `status_id`, `note`, `updated_at`, `created_at`) VALUES
(2, 2, 14, '', '2020-04-03 20:58:32', '2020-04-03 20:58:32'),
(3, 3, 14, '', '2020-04-03 21:00:52', '2020-04-03 21:00:52'),
(4, 2, 1, 'กำลังดำเนินการ', '2020-04-03 22:58:16', '2020-04-03 22:58:16');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bg_color` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `text_color` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '#000000',
  `is_active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL,
  `is_delete` enum('Y','N') COLLATE utf8_unicode_ci DEFAULT 'N',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`, `bg_color`, `text_color`, `is_active`, `is_delete`, `updated_at`, `created_at`) VALUES
(1, 'กำลังดำเนินการ', '#0080ff', '#ffffff', 'Y', 'N', '2020-04-01 01:41:34', '2020-04-01 01:41:34'),
(2, 'สำเร็จ', '#008040', '#ffffff', 'Y', 'N', '2020-04-01 01:41:34', '2020-04-01 01:41:34'),
(3, 'ยกเลิก', '#ff0000', '#ffffff', 'Y', 'N', '2020-04-01 01:41:34', '2020-04-01 01:41:34'),
(12, 'ส่งซ่อมศูนย์', '#8000ff', '#ffffff', 'Y', 'N', '2020-04-01 17:48:18', '2020-04-01 17:48:18'),
(13, 'ส่งร้านนอก', '#800080', '#ffffff', 'Y', 'N', '2020-04-01 17:48:24', '2020-04-01 17:48:24'),
(14, 'แจ้งซ่อม', '#80ffff', '#000000', 'Y', 'N', '2020-04-02 12:05:30', '2020-04-02 12:05:30'),
(15, 'ไม่สำเร็จ', '#ff8000', '#000000', 'Y', 'N', '2020-04-02 12:06:04', '2020-04-02 12:06:04'),
(16, 'รออะไหล่', '#808000', '#ffffff', 'Y', 'N', '2020-04-02 12:06:12', '2020-04-02 12:06:12'),
(17, 'รอตรวจสอบ', '#ffff00', '#000000', 'Y', 'N', '2020-04-03 01:28:19', '2020-04-03 01:28:19');

-- --------------------------------------------------------

--
-- Table structure for table `system`
--

CREATE TABLE `system` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `system`
--

INSERT INTO `system` (`id`, `title`, `name`, `updated_at`, `created_at`) VALUES
(1, 'ระบบแจ้งซ่อม', 'ระบบแจ้งซ่อม', '2020-04-01 18:12:01', '2019-12-26 18:36:13');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL,
  `is_delete` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `category`, `name`, `is_active`, `is_delete`, `updated_at`, `created_at`) VALUES
(2, 19, 'โน๊ตบุ๊ค', 'Y', 'N', '2020-04-01 17:47:20', '2020-01-03 17:32:34'),
(3, 19, 'คอมพิวเตอร์', 'Y', 'N', '2020-04-01 17:47:10', '2020-03-31 14:57:06'),
(4, 20, 'test', 'Y', 'Y', '2020-04-01 17:47:04', '2020-04-01 08:21:56'),
(5, 19, 'ปริ้นเตอร์', 'Y', 'N', '2020-04-01 17:47:41', '2020-04-01 17:47:31'),
(6, 19, 'เครื่องถ่ายเอกสาร', 'Y', 'N', '2020-04-01 17:47:58', '2020-04-01 17:47:58'),
(7, 19, 'หน้าจอ', 'Y', 'N', '2020-04-02 04:25:27', '2020-04-02 04:25:27');

-- --------------------------------------------------------

--
-- Table structure for table `ui_language`
--

CREATE TABLE `ui_language` (
  `id` int(11) NOT NULL,
  `en` text COLLATE utf8_unicode_ci NOT NULL,
  `th` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ui_language`
--

INSERT INTO `ui_language` (`id`, `en`, `th`) VALUES
(2, 'Login', 'เข้าสู่ระบบ'),
(3, 'Thailand', 'ภาษาไทย'),
(4, 'English', 'ภาษาอังกฤษ'),
(5, 'Username', 'ชื่อผู้ใช้งาน'),
(6, 'Password', 'รหัสผ่าน'),
(7, 'Welcome', 'ยินดีต้อนรับ'),
(9, 'Dashboard', 'แดชบอร์ด'),
(10, 'Home', 'หน้าแรก'),
(11, 'Profile', 'โปรไฟล์'),
(12, 'Logout', 'ออกจากระบบ'),
(13, 'Users', 'ผู้ใช้งาน'),
(14, 'Systems', 'ระบบ'),
(15, 'Settings', 'ตั้งค่า'),
(16, 'Category', 'หมวดหมู่'),
(17, 'Type', 'ประเภท'),
(18, 'Brand', 'ยี่ห้อ'),
(19, 'Problems', 'ปัญหา'),
(20, 'Status', 'สถานะ'),
(21, 'Inventory', ''),
(22, 'Repair', 'แจ้งซ่อม'),
(23, 'Enabled', 'เปิดใช้งาน'),
(24, 'Disabled', 'ปิดใช้งาน'),
(25, 'Background Color', 'สีพื้นหลัง'),
(26, 'Select Color', 'เลือกสี'),
(27, 'Text Color', 'สีข้อความ'),
(28, 'Save', 'บันทึก'),
(29, 'Problem', 'ปัญหา'),
(30, 'Name', 'ชื่อ'),
(31, 'Color', 'สี'),
(32, 'Edit', 'แก้ไข'),
(33, 'Delete', 'ลบ'),
(34, 'Select All', '้เลือกทั้งหมด'),
(35, 'Trash', 'ถังขยะ'),
(36, 'No', 'ไม่'),
(37, 'Yes', 'ใช่'),
(38, 'Are you want to delete all?', 'คุณต้องการลบทั้งหมด?'),
(39, 'Do you want to delete this information?', 'คุณต้องการลบข้อมูลนี้หรือไม่?'),
(40, 'Please Enter Name', 'โปรดระบุชื่อ'),
(41, 'New Inventory', ''),
(42, 'Picture', 'รูปภาพ'),
(43, 'Send to Repair', 'ส่งซ่อม'),
(44, 'Worn out', 'ชำรุด'),
(45, 'Choose File', 'เลือกไฟล์'),
(46, 'Serial Number', 'รหัสเครื่อง'),
(48, 'Please Select Category', 'โปรดเลือกหมวดหมู่'),
(49, 'Please Select Type', 'โปรดเลือกประเภท'),
(50, 'Please Select Brand', 'โปรดเลือกยี่ห้อ'),
(51, 'Please Enter Serial Number', 'โปรดระบุรหัสเครื่อง'),
(52, 'Disnabled', ''),
(53, 'Extensions Support', ''),
(54, 'Hone', ''),
(55, 'Please Enter Problem', 'โปรดระบุปัญหา'),
(56, 'Please Enter Brand', 'โปรดระบุยี่ห้อ'),
(58, 'Title', 'หัวข้อ'),
(59, 'Data update successful.', ''),
(60, 'Please Enter Title', 'โปรดระบุหัวข้อ'),
(61, 'Please Enter Type', 'โปรดระบุประเภท'),
(62, 'Please Enter Category', 'โปรดระบุหมวดหมู่'),
(64, 'New User', ''),
(65, 'Full Name', ''),
(66, 'Position', 'ตำแหน่ง'),
(67, 'View', 'ดู'),
(68, 'User', ''),
(69, 'Prolfile', ''),
(70, 'Email', ''),
(71, 'Gender', 'เพศ'),
(72, 'BirthDay', 'วันเกิด'),
(73, 'Phone Number', 'เบอร์โทร'),
(74, 'Male', 'ชาย'),
(75, 'First Name', ''),
(76, 'Last Name', ''),
(77, 'Gendor', ''),
(78, 'Female', 'หญิง'),
(80, 'Upload', 'อัพโหลด'),
(81, 'Info', 'ข้อมูล'),
(82, 'Change Password', 'เปลี่ยนรหัสผ่าน'),
(83, 'Current Password', 'รหัสผ่านปัจจุบัน'),
(84, 'New Password', 'รหัสผ่านใหม่'),
(85, 'Confirm Password', 'ยืนยันรหัสผ่าน'),
(86, 'Please Enter Username', ''),
(87, 'Please Enter First Name', ''),
(88, 'Please Enter Last Name', ''),
(89, 'Please Enter Email', ''),
(90, 'Please Enter Current Password', ''),
(91, 'Please Enter New Password', ''),
(92, 'Your password must be at least 6 characters long.', ''),
(93, 'Please Enter Confirm Password', ''),
(94, 'Please enter the same password as above.', ''),
(95, 'Uoload', ''),
(96, 'Last Namee', ''),
(97, 'Repair List', ''),
(98, 'Date', ''),
(99, 'Repairer', ''),
(100, 'Technician', ''),
(101, 'Please Select Inventory', ''),
(102, 'Please Select Problem', ''),
(103, 'Description', ''),
(104, 'Techician', ''),
(105, 'Please Select Technician', ''),
(106, 'No results found', ''),
(107, 'Please Enter Description', ''),
(108, 'Successful data deletion.', ''),
(109, 'Repair Today', ''),
(110, 'View More', ''),
(111, 'Successfully saved data.', ''),
(112, 'Inventory Enabled', ''),
(113, 'Inventory Disabled', ''),
(114, 'Inventory Send To Repair', ''),
(115, 'Inventory Worn out', ''),
(116, 'Do you want to Logout?', ''),
(117, 'Language', 'ภาษา'),
(118, 'EN', 'อังกฤษ'),
(119, 'TH', 'ไทย'),
(120, 'Detail', ''),
(121, 'Repair Update', ''),
(122, 'Note', ''),
(123, 'Close', ''),
(124, 'Add', ''),
(125, 'Cancel successful.', ''),
(126, 'Repair Info', ''),
(127, 'List Repair', ''),
(128, 'Teahician', ''),
(129, 'List Techician', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('M','F') COLLATE utf8_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `profile` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL DEFAULT 2,
  `is_active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `is_delete` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `gender`, `birthdate`, `email`, `phone_number`, `profile`, `position`, `is_active`, `is_delete`, `updated_at`, `created_at`) VALUES
(26, 'admin', '$2y$10$puG6JHNZuW58X1KfqGIMkup1sYj2sj9J0pIXMB9SZRDClLrfNAFgK', 'ชยุตม์', 'แซ่ว่อง', 'M', '1994-02-27', 'chayut.270294@gmail.com', '0629739386', '1577429363_26.jpg', 1, 'Y', 'N', '2020-04-02 11:22:03', '2019-12-27 04:28:27'),
(41, 'user02', '$2y$10$qQHacxdGFA7mW2oPOAvHouuiyLSX8H50aFW765/GJ0TZP57hN.1ou', 'user', '02', 'M', '0000-00-00', 'user02@mail.com', '0629739386', '', 3, 'Y', 'N', '2020-04-03 21:59:42', '2020-04-02 21:31:40'),
(42, 'user01', '$2y$10$TgXp6.3aaoMKKG9P754le.QJ9upDOpLj0lQuJIgO.0/VQ0b5BQaaO', 'user', '01', 'M', '0002-02-07', 'user@mail.com', '', '', 2, 'Y', 'N', '2020-04-03 21:59:20', '2020-04-03 21:59:20'),
(43, 'user03', '$2y$10$UXnWKnIGTkX0z0cciDHo9ud0vFZrZdY2HZs5zMr.teKwP/RkD1Jf2', 'user', '03', 'M', '0000-00-00', 'user03@mail.com', '', '', 4, 'Y', 'N', '2020-04-03 22:00:01', '2020-04-03 22:00:01'),
(44, 'user04', '$2y$10$K48uT8TJT41NSh6z5kBbt.NU.JOyDTS9M3YvTTZFkN6M3qa2iuWH.', 'user', '04', 'M', '0000-00-00', 'user04@mail.com', '', '', 3, 'Y', 'N', '2020-04-03 22:59:26', '2020-04-03 22:00:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`per_id`);

--
-- Indexes for table `problem`
--
ALTER TABLE `problem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repair`
--
ALTER TABLE `repair`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repair_detail`
--
ALTER TABLE `repair_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `repair_id` (`repair_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ui_language`
--
ALTER TABLE `ui_language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `problem`
--
ALTER TABLE `problem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `repair`
--
ALTER TABLE `repair`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `repair_detail`
--
ALTER TABLE `repair_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `system`
--
ALTER TABLE `system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ui_language`
--
ALTER TABLE `ui_language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `repair_detail`
--
ALTER TABLE `repair_detail`
  ADD CONSTRAINT `repair` FOREIGN KEY (`repair_id`) REFERENCES `repair` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
