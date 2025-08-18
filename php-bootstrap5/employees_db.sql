-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2025 at 03:06 AM
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
-- Database: `employees_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name_th` varchar(100) NOT NULL,
  `short_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name_th`, `short_name`) VALUES
(1, 'ฝ่ายเทคโนโลยีสารสนเทศ', 'IT'),
(2, 'ฝ่ายทรัพยากรบุคคล', 'HR'),
(3, 'ฝ่ายบัญชี', 'ACC'),
(4, 'ฝ่ายการตลาด', 'SALE'),
(5, 'ฝ่ายไร่', 'FM2'),
(6, 'ฝ่ายจัดซื้อ', 'PUR'),
(7, 'ฝ่ายผลิต', 'PROD'),
(8, 'ฝ่ายซ่อมบำรุง', 'MTN'),
(9, 'ฝ่ายควบคุมคุณภาพ', 'QC'),
(10, 'ฝ่ายวิจัยและพัฒนา', 'R&D'),
(11, 'ฝ่ายกฎหมาย', 'LAW'),
(12, 'ฝ่ายการเงิน', 'FIN'),
(13, 'ฝ่ายขนส่ง', 'TRN'),
(14, 'ฝ่ายบริการลูกค้า', 'CS'),
(15, 'ฝ่ายพัฒนาธุรกิจ', 'BD'),
(16, 'ฝ่ายประชาสัมพันธ์', 'PR'),
(17, 'ฝ่ายสิ่งแวดล้อม', 'ENV'),
(18, 'ฝ่ายความปลอดภัย', 'SEC'),
(19, 'ฝ่ายฝึกอบรม', 'TRN2'),
(20, 'ฝ่ายสื่อสารองค์กร', 'COM'),
(21, 'ฝ่ายคลังสินค้า', 'WH'),
(22, 'ฝ่ายวิศวกรรม', 'ENG'),
(23, 'ฝ่ายซัพพลายเชน', 'SCM'),
(24, 'ฝ่ายวางแผนการผลิต', 'PP'),
(25, 'ฝ่ายตรวจสอบภายใน', 'IA'),
(26, 'ฝ่ายกลยุทธ์องค์กร', 'STR'),
(27, 'ฝ่ายพัฒนาแอปพลิเคชัน', 'APP'),
(28, 'ฝ่ายดูแลระบบเครือข่าย', 'NET'),
(29, 'ฝ่ายวิเคราะห์ข้อมูล', 'DATA'),
(30, 'ฝ่ายจัดกิจกรรม', 'EVT'),
(31, 'ฝ่ายบริการภาคสนาม', 'FSV'),
(32, 'ฝ่ายประกันคุณภาพ', 'QA'),
(33, 'ฝ่ายสรรหาและคัดเลือก', 'REC'),
(34, 'ฝ่ายจัดการสัญญา', 'CON'),
(35, 'ฝ่ายวิศวกรรมซอฟต์แวร์', 'SWE'),
(36, 'ฝ่ายออกแบบผลิตภัณฑ์', 'DES'),
(37, 'ฝ่ายวิจัยการตลาด', 'MKT-R'),
(38, 'ฝ่ายสื่อดิจิทัล', 'MD'),
(39, 'ฝ่ายพัฒนาบุคลากร', 'HRD'),
(40, 'ฝ่ายควบคุมเอกสาร', 'DOC'),
(41, 'ฝ่ายรับเรื่องร้องเรียน', 'CRM'),
(42, 'ฝ่ายพัฒนาระบบ ERP', 'ERP'),
(43, 'ฝ่ายโครงการพิเศษ', 'SPP'),
(44, 'ฝ่ายพลังงาน', 'ENE'),
(45, 'ฝ่ายจัดเก็บข้อมูล', 'DBA'),
(46, 'ฝ่ายประสานงานโครงการ', 'PCO'),
(47, 'ฝ่ายตรวจสอบคุณภาพอ้อย', 'QC-FM'),
(48, 'ฝ่ายเครื่องจักรกลการเกษตร', 'AGM'),
(49, 'ฝ่ายพัฒนาผลิตภัณฑ์ใหม่', 'NPD'),
(50, 'ฝ่ายดูแลลูกค้ารายสำคัญ', 'KAM'),
(51, 'ฝ่ายควบคุมต้นทุน', 'CST'),
(52, 'ฝ่ายบริการเทคนิค', 'TSV'),
(53, 'ฝ่ายวิจัยเกษตร', 'AGR'),
(54, 'ฝ่ายพัฒนาเครือข่ายพันธมิตร', 'PNR'),
(55, 'ฝ่ายพัฒนาระบบ SmartFarm', 'SFM'),
(56, 'ชื่อฝ่าย', ''),
(57, 'sdsd', ''),
(58, 'sdsd', ''),
(59, '2323', ''),
(60, '2323', ''),
(62, 'asas', ''),
(69, 'sdsd', ''),
(70, 'dfdf', '');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `emp_code` varchar(20) NOT NULL,
  `fullname_th` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `salary` decimal(10,2) NOT NULL DEFAULT 0.00,
  `hired_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `emp_code`, `fullname_th`, `email`, `phone`, `dept_id`, `salary`, `hired_at`) VALUES
(1, 'EMP001', 'นายสมชาย ใจดี', 'somchai@example.com', '081-000-1111', 1, 35000.00, '2023-05-10'),
(2, 'EMP002', 'นางสาวอรทัย สุขสันต์', 'ornthai@example.com', '082-222-3333', 2, 30000.00, '2024-01-15'),
(3, 'EMP003', 'นายกิตติพงษ์ เก่งงาน', 'kitti@example.com', '083-444-5555', 2, 42000.00, '2022-11-01'),
(4, 'EMP004', 'นางสาววรัญญา มานะ', 'warunya@example.com', '084-666-7777', 5, 38000.00, '2025-03-20'),
(5, 'EMP005', 'ศุภกร ขำสุวรรณ', 'supakorn.k@ktisgroup.com', '0935232597', 5, 20000.00, '2025-08-14');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `name_th` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name_th`) VALUES
(1, 'เจ้าหน้าที่'),
(2, 'หัวหน้าแผนก'),
(3, 'ผู้จัดการ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `departments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
