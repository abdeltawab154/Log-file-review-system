-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2023 at 11:40 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logfilereview`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `PBA_Code` varchar(255) NOT NULL,
  `Tact_Time` varchar(255) DEFAULT NULL,
  `Top_Model` varchar(255) DEFAULT NULL,
  `Shared_PCB` varchar(255) DEFAULT NULL,
  `PCB_Code` varchar(255) DEFAULT NULL,
  `Time` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id`, `PBA_Code`, `Tact_Time`, `Top_Model`, `Shared_PCB`, `PCB_Code`, `Time`) VALUES
(1, '', '', '', '', '', NULL),
(2, 'dnfvkld', 'djkf', 'djfi', 'dkfo', 'kffkl', NULL),
(3, 'klmdkvlms', 'dfnvklerv', 'dpfmv;dmv', 'mkvkldmfvkl', 'klmfklvmdlf', NULL),
(4, '555', '', '', '', '', NULL),
(5, '5555', '', '', '', '', NULL),
(6, 'BN94-00053Y', '60', 'QA70', 'DJCSDJCS', 'BN41-02992A', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `logout_time` datetime DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`id`, `user_id`, `login_time`, `logout_time`, `username`) VALUES
(1, 1, '2023-11-11 13:56:55', NULL, NULL),
(4, 1, '2023-11-11 14:07:59', NULL, 'mohamed.ahm'),
(5, 1, '2023-11-11 14:36:29', NULL, 'mohamed.ahm'),
(6, 1, '2023-11-11 14:44:02', NULL, 'mohamed.ahm'),
(7, 1, '2023-11-11 14:47:52', NULL, 'mohamed.ahm'),
(8, 1, '2023-11-11 14:48:32', NULL, 'mohamed.ahm'),
(9, 1, '2023-11-11 14:56:24', NULL, 'mohamed.ahm'),
(10, 1, '2023-11-11 14:58:35', NULL, 'mohamed.ahm'),
(11, 1, '2023-11-11 20:05:37', NULL, 'mohamed.ahm'),
(12, 1, '2023-11-11 20:19:51', NULL, 'mohamed.ahm');

-- --------------------------------------------------------

--
-- Table structure for table `seq`
--

CREATE TABLE `seq` (
  `id` int(11) NOT NULL,
  `PBA_Code` varchar(255) NOT NULL,
  `Seq1` varchar(255) DEFAULT NULL,
  `Seq2` varchar(255) DEFAULT NULL,
  `Seq3` varchar(255) DEFAULT NULL,
  `Seq4` varchar(255) DEFAULT NULL,
  `Seq5` varchar(255) DEFAULT NULL,
  `Seq6` varchar(255) DEFAULT NULL,
  `Seq7` varchar(255) DEFAULT NULL,
  `Seq8` varchar(255) DEFAULT NULL,
  `Seq9` varchar(255) DEFAULT NULL,
  `Seq10` varchar(255) DEFAULT NULL,
  `Seq11` varchar(255) DEFAULT NULL,
  `Seq12` varchar(255) DEFAULT NULL,
  `Seq13` varchar(255) DEFAULT NULL,
  `Seq14` varchar(255) DEFAULT NULL,
  `Seq15` varchar(255) DEFAULT NULL,
  `Seq16` varchar(255) DEFAULT NULL,
  `Seq17` varchar(255) DEFAULT NULL,
  `Seq18` varchar(255) DEFAULT NULL,
  `Seq19` varchar(255) DEFAULT NULL,
  `Seq20` varchar(255) DEFAULT NULL,
  `Seq21` varchar(255) DEFAULT NULL,
  `Seq22` varchar(255) DEFAULT NULL,
  `Seq23` varchar(255) DEFAULT NULL,
  `Seq24` varchar(255) DEFAULT NULL,
  `Seq25` varchar(255) DEFAULT NULL,
  `Seq26` varchar(255) DEFAULT NULL,
  `Seq27` varchar(255) DEFAULT NULL,
  `Seq28` varchar(255) DEFAULT NULL,
  `Seq29` varchar(255) DEFAULT NULL,
  `Seq30` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seq`
--

INSERT INTO `seq` (`id`, `PBA_Code`, `Seq1`, `Seq2`, `Seq3`, `Seq4`, `Seq5`, `Seq6`, `Seq7`, `Seq8`, `Seq9`, `Seq10`, `Seq11`, `Seq12`, `Seq13`, `Seq14`, `Seq15`, `Seq16`, `Seq17`, `Seq18`, `Seq19`, `Seq20`, `Seq21`, `Seq22`, `Seq23`, `Seq24`, `Seq25`, `Seq26`, `Seq27`, `Seq28`, `Seq29`, `Seq30`) VALUES
(1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'gyugg', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'dnfvkld', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'klmdkvlms', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '555', '', 'djkjsds', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '5555', 'sjidkcjs', '', '', 'sdjclksmd', '', 'djnkfvndkf', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'BN94-00053Y', 'Make sure that all sequence is ok', 'Make sure that all sequence is ok', 'Make sure that all sequence is ok', 'Make sure that all sequence is ok', 'Make sure that all sequence is ok', 'Make sure that all sequence is ok', 'Make sure that all sequence is ok', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sequencestatus`
--

CREATE TABLE `sequencestatus` (
  `id` int(11) NOT NULL,
  `PBA_Code` varchar(255) GENERATED ALWAYS AS (substr(`serial_number`,5,10)) VIRTUAL,
  `serial_number` varchar(255) DEFAULT NULL,
  `seq1` varchar(255) DEFAULT NULL,
  `seq2` varchar(255) DEFAULT NULL,
  `seq3` varchar(255) DEFAULT NULL,
  `seq4` varchar(255) DEFAULT NULL,
  `seq5` varchar(255) DEFAULT NULL,
  `seq6` varchar(255) DEFAULT NULL,
  `seq7` varchar(255) DEFAULT NULL,
  `seq8` varchar(255) DEFAULT NULL,
  `seq9` varchar(255) DEFAULT NULL,
  `seq10` varchar(255) DEFAULT NULL,
  `seq11` varchar(255) DEFAULT NULL,
  `seq12` varchar(255) DEFAULT NULL,
  `seq13` varchar(255) DEFAULT NULL,
  `seq14` varchar(255) DEFAULT NULL,
  `seq15` varchar(255) DEFAULT NULL,
  `seq16` varchar(255) DEFAULT NULL,
  `seq17` varchar(255) DEFAULT NULL,
  `seq18` varchar(255) DEFAULT NULL,
  `seq19` varchar(255) DEFAULT NULL,
  `seq20` varchar(255) DEFAULT NULL,
  `seq21` varchar(255) DEFAULT NULL,
  `seq22` varchar(255) DEFAULT NULL,
  `seq23` varchar(255) DEFAULT NULL,
  `seq24` varchar(255) DEFAULT NULL,
  `seq25` varchar(255) DEFAULT NULL,
  `seq26` varchar(255) DEFAULT NULL,
  `seq27` varchar(255) DEFAULT NULL,
  `seq28` varchar(255) DEFAULT NULL,
  `seq29` varchar(255) DEFAULT NULL,
  `seq30` varchar(255) DEFAULT NULL,
  `seq31` varchar(255) DEFAULT NULL,
  `total_status` varchar(255) DEFAULT NULL,
  `review_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `PBA_Model` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sequencestatus`
--

INSERT INTO `sequencestatus` (`id`, `serial_number`, `seq1`, `seq2`, `seq3`, `seq4`, `seq5`, `seq6`, `seq7`, `seq8`, `seq9`, `seq10`, `seq11`, `seq12`, `seq13`, `seq14`, `seq15`, `seq16`, `seq17`, `seq18`, `seq19`, `seq20`, `seq21`, `seq22`, `seq23`, `seq24`, `seq25`, `seq26`, `seq27`, `seq28`, `seq29`, `seq30`, `seq31`, `total_status`, `review_date`, `PBA_Model`) VALUES
(24, 'hkkkkkkkkkkkkkkkkkkkkkk', 'ok', 'ok', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ok', '2023-11-11 11:17:05', NULL),
(25, 'hkkkkkkkkkkkkkkkkkkkkkk', 'ok', 'ok', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ok', '2023-11-11 11:17:05', NULL),
(26, 'jjjjjjjj', 'ok', 'ok', 'ng', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ng', '2023-11-11 11:17:05', NULL),
(27, 'EG10BN9418165ZHHHHHHH', 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ok', '2023-11-11 11:17:05', NULL),
(28, 'EG10BN9416868YAWAL10', 'ok', 'ok', 'ng', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ng', '2023-11-11 11:17:05', NULL),
(29, 'EG10BN9418165ZHHHHHHH', 'ok', 'ok', 'ok', 'ng', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ng', '2023-11-11 11:17:05', NULL),
(30, 'EG10BN9418165ZHHHHHHH', 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ok', '2023-11-11 11:17:05', NULL),
(31, 'EG10BN9418165ZHHHHHHH', 'ok', 'ok', 'ok', 'ok', 'ng', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ng', '2023-11-11 11:17:05', NULL),
(32, 'EG10BN9418165ZHHHHHHH', 'ok', 'ok', 'ok', 'ng', 'ng', 'ng', 'ng', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ng', '2023-11-11 11:17:05', NULL),
(33, 'EG10BN9400053YAWAL10', 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ok', '2023-11-11 11:37:08', NULL),
(34, 'EG10BN9418165ZHHHHHHH', 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ok', '2023-11-11 11:17:05', NULL),
(35, 'EG10BN9400053YAWAL10', 'ok', 'ok', 'ok', 'ng', 'ng', 'ng', 'ok', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ng', '2023-11-11 11:29:42', NULL),
(36, 'EG10BN9418165ZHHHHHHH', 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ok', '2023-11-11 11:43:41', NULL),
(37, NULL, 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ok', '2023-11-11 21:56:32', NULL),
(38, NULL, 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ok', '2023-11-11 22:08:32', NULL),
(39, NULL, 'ok', 'ok', 'ng', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ng', '2023-11-11 22:13:03', NULL),
(40, 'kjklkm;lkdmlc', 'ok', 'ok', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ok', '2023-11-11 22:18:13', 'km;--lkdmlc'),
(41, 'uuuuuuuuuuuuu', 'ok', 'ok', 'ok', 'ng', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ng', '2023-11-11 22:20:34', 'uuu--uuuuuu'),
(42, 'uuuuuuuuuuuuu', 'ng', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ng', '2023-11-11 22:23:09', 'uuu--uuuuuu'),
(43, 'uuuuuuuuuuuuu', 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ok', '2023-11-11 22:33:57', 'uuu--uuuuuu'),
(44, 'uuuuuuuuuuuuu', 'ok', 'ok', 'ng', 'ok', 'ng', 'ok', 'ok', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ng', '2023-11-11 22:40:15', 'uuu--uuuuuu');

--
-- Triggers `sequencestatus`
--
DELIMITER $$
CREATE TRIGGER `add_dash_after_3_chars` BEFORE INSERT ON `sequencestatus` FOR EACH ROW BEGIN
   SET NEW.PBA_Code = CONCAT(SUBSTRING(NEW.PBA_Code, 1, 3), '-', SUBSTRING(NEW.PBA_Code, 4));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `add_dash_after_BN94` BEFORE INSERT ON `sequencestatus` FOR EACH ROW BEGIN
   IF NEW.PBA_Code LIKE 'BN94%' THEN
      SET NEW.PBA_Code = CONCAT(SUBSTRING(NEW.PBA_Code, 1, 4), '-', SUBSTRING(NEW.PBA_Code, 5));
   END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_PBA_Model_before_insert` BEFORE INSERT ON `sequencestatus` FOR EACH ROW BEGIN
   SET NEW.PBA_Model = CONCAT(SUBSTRING(NEW.PBA_Code, 1, 4), '-', SUBSTRING(NEW.PBA_Code, 5));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_columns_after_insert` AFTER INSERT ON `sequencestatus` FOR EACH ROW BEGIN
   DECLARE tact_time_temp VARCHAR(255);
   DECLARE PCB_Code_temp VARCHAR(255);

   SELECT Tact_Time, PCB_Code INTO tact_time_temp, PCB_Code_temp
   FROM data
   WHERE data.PBA_Code= NEW.PBA_Model;

   IF tact_time_temp IS NOT NULL AND PCB_Code_temp IS NOT NULL THEN
      UPDATE sequencestatus
      SET tact_time = tact_time_temp,
          PCB_Code = PCB_Code_temp
      WHERE PBA_Model = NEW.PBA_Model;
   END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_tact_time_top_model_and_pcb_code_on_update` AFTER UPDATE ON `sequencestatus` FOR EACH ROW BEGIN
  DECLARE v_Tact_Time varchar(255);
  DECLARE v_Top_Model varchar(255);
  DECLARE v_PCB_Code varchar(255);

  SELECT Tact_Time, Top_Model, PCB_Code INTO v_Tact_Time, v_Top_Model, v_PCB_Code
  FROM data
  WHERE PBA_Code = NEW.PBA_Model;

  UPDATE sequencestatus
  SET tact_time = v_Tact_Time, Top_Model = v_Top_Model, PCB_Code = v_PCB_Code
  WHERE id = NEW.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `is_active`) VALUES
(1, 'mohamed.ahm', '154598', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `PBA_Code` (`PBA_Code`);

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `seq`
--
ALTER TABLE `seq`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UC_PBA_Code` (`PBA_Code`);

--
-- Indexes for table `sequencestatus`
--
ALTER TABLE `sequencestatus`
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
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `seq`
--
ALTER TABLE `seq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sequencestatus`
--
ALTER TABLE `sequencestatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_history`
--
ALTER TABLE `login_history`
  ADD CONSTRAINT `login_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `seq`
--
ALTER TABLE `seq`
  ADD CONSTRAINT `seq_ibfk_1` FOREIGN KEY (`PBA_Code`) REFERENCES `data` (`PBA_Code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
