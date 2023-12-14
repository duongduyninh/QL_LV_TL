-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 04, 2023 lúc 05:09 AM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `da3_demo`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` int(11) NOT NULL,
  `faculty_name` varchar(200) NOT NULL,
  `faculty_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='faculty';

--
-- Đang đổ dữ liệu cho bảng `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `faculty_name`, `faculty_code`) VALUES
(1, 'Công nghệ thông tin', 'CNTT'),
(2, 'Điện - Điện tử - Viễn thông', 'Đ-ĐT-VT'),
(3, 'Kỹ thuật cơ khí', 'KTCK'),
(4, 'Kỹ Thuật xây dựng', 'KTXD'),
(5, 'Quản lý công nghiệp', 'QLCN'),
(6, 'Công nghệ Sinh hóa - Thực phẩm', 'CNSH-TP'),
(7, 'Khoa học xã hội', 'KHXH'),
(18, 'test', 'test'),
(19, 'test4', 'test7'),
(20, 'test3', 'tesst3'),
(21, 'test8', 'test8'),
(22, 'test9', 'test9'),
(23, 'test10', 'test10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `news_topic` varchar(100) NOT NULL,
  `news_link` varchar(300) NOT NULL,
  `news_date-add` int(11) NOT NULL,
  `news_date-update` int(11) NOT NULL,
  `news_img` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='news';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `per`
--

CREATE TABLE `per` (
  `p_id` int(11) NOT NULL,
  `p_code` int(11) NOT NULL,
  `p_name` varchar(200) NOT NULL COMMENT 'Tên người làm luận văn, tiểu luận vì có thể làm nhóm',
  `p_email` varchar(200) NOT NULL,
  `topic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `topic`
--

CREATE TABLE `topic` (
  `topic_id` int(11) NOT NULL,
  `topic_name` varchar(200) NOT NULL COMMENT 'tên đề tài',
  `topic_file` varchar(300) NOT NULL COMMENT 'Tên file, đường dẫn, upload 1 file pdf thôi',
  `topic_description` varchar(300) NOT NULL,
  `topic_detail` varchar(300) NOT NULL,
  `topic_type` int(11) NOT NULL COMMENT 'luận văn hay tiểu luận',
  `topic_date_add` int(11) NOT NULL,
  `topic_date_updata` int(11) NOT NULL,
  `topic_code` int(11) NOT NULL COMMENT 'Mã đề tài',
  `faculty_id` int(11) NOT NULL COMMENT 'Mã khoa nha, đề tài thuộc khoa nào',
  `user_id` int(11) NOT NULL COMMENT 'được đăng bởi ai, ai đăng thì cũng là người hướng dẫn'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_code` int(11) NOT NULL COMMENT 'Mã SV',
  `user_account` varchar(200) NOT NULL COMMENT 'Tài khoản',
  `user_password` varchar(200) NOT NULL,
  `user_name` varchar(200) NOT NULL COMMENT 'Họ tên',
  `user_sex` int(11) DEFAULT NULL,
  `user_tel` int(11) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_position` int(11) NOT NULL COMMENT '3: admin, 2:sinh viên, 1: giảng viên',
  `user_date_add` date NOT NULL,
  `user_date_update` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='user';

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`user_id`, `user_code`, `user_account`, `user_password`, `user_name`, `user_sex`, `user_tel`, `user_email`, `user_position`, `user_date_add`, `user_date_update`) VALUES
(3, 1231233, 'qweasdqwe', 'qweqweasdqwe', 'qweqwe', 0, 1231231233, 'qwe@gmail.com', 2, '0000-00-00', '0000-00-00'),
(7, 190015151, 'nguyenbaduy', 'nguyenbaduy', 'Nguyễn Bá Duy', 0, 967311513, 'nbduy@ctuet.edu.vn', 1, '0000-00-00', '0000-00-00'),
(8, 190015152, 'nguyentanphu', 'nguyentanphu', 'Nguyễn Tấn Phú', 0, 967311513, 'ntphu@ctuet.edu.vn', 1, '0000-00-00', '0000-00-00'),
(9, 1900151353, 'tranthithuyduong', 'tranthithuyduong', 'Trần Thị Thùy Dương', 1, 967311513, 'tttduong@ctuet.edu.vn', 1, '0000-00-00', '0000-00-00'),
(10, 190015151, 'nguyenxuanhagiang', 'nguyenxuanhagiang', 'Nguyễn Xuân Hà Giang', 1, 96731153, 'nxhgiang@ctuet.edu.vn', 1, '0000-00-00', '0000-00-00'),
(11, 190015155, 'nguyentrungviet', 'nguyentrungviet', 'Nguyễn Trung Việt', 0, 967311513, 'ntviet@ctuet.edu.vn', 1, '0000-00-00', '0000-00-00'),
(17, 19000788, 'hieule', '0c2fb7c0a8be5b2c84228b67fb82c5f3', 'adminhfhg', NULL, 2147483647, 'adminfhggfh@ctuet.edu.vn', 2, '0000-00-00', '0000-00-00'),
(21, 15155656, 'user44', '0c2fb7c0a8be5b2c84228b67fb82c5f3', 'adminhfhg', NULL, 2147483647, 'adminfhgggggfh@ctuet.edu.vn', 2, '0000-00-00', '0000-00-00'),
(23, 1900093, 'admin', '0c2fb7c0a8be5b2c84228b67fb82c5f3', 'admin', NULL, 1234567891, 'admin@ctuet.edu.vn', 3, '0000-00-00', '2022-12-27'),
(25, 19000988, 'user7', '0c2fb7c0a8be5b2c84228b67fb82c5f3', 'Nguyễn Văn A', NULL, 123456780, 'nva1900077@ctuet.edu.vn', 2, '0000-00-00', '0000-00-00'),
(26, 1231233, 'user2', '8a1148a74ba479fcaca5e34f5de73d45', 'Nguyễn Văn B', NULL, 1234567890, 'nvb1899999@ctuet.edu.vn', 2, '0000-00-00', '0000-00-00'),
(27, 1888888, 'user5', '0c2fb7c0a8be5b2c84228b67fb82c5f3', 'user_tt', NULL, 1234567890, 'user5@ctuet.edu.vn', 2, '0000-00-00', '2022-12-29'),
(28, 1900095, 'user10', '70906c1a90bcdf3023663a9dec1578c9', 'user user', NULL, 2147483647, 'user10@ctuet.edu.vn', 1, '0000-00-00', '0000-00-00'),
(31, 1990069, 'user15', '0c2fb7c0a8be5b2c84228b67fb82c5f3', 'user user test', NULL, 1234567890, 'user15@ctuet.edu.vn', 1, '2022-12-27', '0000-00-00');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Chỉ mục cho bảng `per`
--
ALTER TABLE `per`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `topic_performer` (`topic_id`);

--
-- Chỉ mục cho bảng `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `topic_user_id` (`user_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `faculty`
--
ALTER TABLE `faculty`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `per`
--
ALTER TABLE `per`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `topic`
--
ALTER TABLE `topic`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `per`
--
ALTER TABLE `per`
  ADD CONSTRAINT `topic_performer` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `topic_ibfk_2` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
