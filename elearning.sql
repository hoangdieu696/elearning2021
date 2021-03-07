-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 07, 2021 lúc 05:15 PM
-- Phiên bản máy phục vụ: 10.4.17-MariaDB
-- Phiên bản PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `elearning`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `uid` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `totals` bigint(255) NOT NULL,
  `role` text COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`uid`, `username`, `password`, `display_name`, `phone`, `create_at`, `totals`, `role`) VALUES
(1, 'admin@gmail.com', '123456789', 'Phạm Chiến Trung', NULL, '2021-02-28 06:23:26', 0, 'Role_Admin'),
(4, 'dieuhoang@gmail.com', '123456', 'Hoàng Diệu', NULL, '2021-02-28 06:23:26', 260, 'Role_User'),
(5, 'minhvuong@gmail.com', '1234567', 'Nguyễn Minh Vương', NULL, '2021-02-28 06:23:26', 180, 'Role_User'),
(6, 'dieu@gmail.com', '123456', 'Dori Hoang', NULL, '2021-11-28 06:23:26', 0, 'Role_Admin'),
(10, 'test1@gmail.com', '123456789', 'Tester', '0987654376', '2021-02-28 06:24:39', 0, 'Role_Admin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `exam`
--

CREATE TABLE `exam` (
  `exam_id` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `start_exam` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `end_exam` timestamp NULL DEFAULT current_timestamp(),
  `is_actived` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `exam`
--

INSERT INTO `exam` (`exam_id`, `name`, `start_exam`, `end_exam`, `is_actived`) VALUES
('3cl1bv2mz3jqc7dvl5kn', 'test', '2021-03-06 21:52:43', '2021-03-06 20:13:42', 0),
('3mzveeofoguttwjk9g5p', 'test', '2021-03-06 22:24:11', '2021-03-06 20:14:38', 1),
('w9glzszppj8s57szbj4x', 'test2', '2021-03-06 21:54:25', '2021-03-06 20:40:16', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `score`
--

CREATE TABLE `score` (
  `id` bigint(11) NOT NULL,
  `exam_id` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `team_id` bigint(20) NOT NULL,
  `uid` bigint(11) DEFAULT NULL,
  `score_part_1` int(12) DEFAULT NULL,
  `score_part_2` int(12) DEFAULT NULL,
  `score_part_3` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `team`
--

CREATE TABLE `team` (
  `team_id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `exam_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `uploadfile`
--

CREATE TABLE `uploadfile` (
  `file_id` bigint(11) NOT NULL,
  `path_part_1` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `path_part_2` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `path_part_3` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `size_1` bigint(255) NOT NULL,
  `size_2` bigint(225) NOT NULL,
  `size_3` bigint(225) NOT NULL,
  `exam_id` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `uploadfile`
--

INSERT INTO `uploadfile` (`file_id`, `path_part_1`, `path_part_2`, `path_part_3`, `size_1`, `size_2`, `size_3`, `exam_id`) VALUES
(8, '../upload/exams/20210307ket_qua_toan_nhom_thi.xls', '../upload/exams/20210307ket_qua_toan_nhom_thi.xls', '../upload/exams/20210307ket_qua_toan_nhom_thi.xls', 13824, 13824, 13824, '3cl1bv2mz3jqc7dvl5kn');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `user` (`username`);

--
-- Chỉ mục cho bảng `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`exam_id`);

--
-- Chỉ mục cho bảng `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `uploadfile`
--
ALTER TABLE `uploadfile`
  ADD PRIMARY KEY (`file_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `score`
--
ALTER TABLE `score`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `uploadfile`
--
ALTER TABLE `uploadfile`
  MODIFY `file_id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
