-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 15, 2022 lúc 11:34 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE cnpm;
USE cnpm;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cnpm`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dondatphong`
--

CREATE TABLE `dondatphong` (
  `id_dondat` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `hoten` varchar(128) NOT NULL,
  `sdt` int(11) NOT NULL,
  `cmnd` int(11) NOT NULL,
  `id_phong` int(11) NOT NULL,
  `monan` longtext NOT NULL,
  `ngay` text NOT NULL,
  `gio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `id_hoadon` int(11) NOT NULL,
  `hoten` varchar(128) NOT NULL,
  `sdt` int(11) NOT NULL,
  `cmnd` int(11) NOT NULL,
  `thoigiansudung` text NOT NULL,
  `id_phong` int(11) NOT NULL,
  `tienmonan` int(11) NOT NULL,
  `tienphong` int(11) NOT NULL,
  `tongtien` int(11) NOT NULL,
  `monan` longtext NOT NULL,
  `ngayvao` text NOT NULL,
  `giovao` text NOT NULL,
  `ngayhd` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hoadon`
--

INSERT INTO `hoadon` (`id_hoadon`, `hoten`, `sdt`, `cmnd`, `thoigiansudung`, `id_phong`, `tienmonan`, `tienphong`, `tongtien`, `monan`, `ngayvao`, `giovao`, `ngayhd`) VALUES
(13, 'Trần Văn Thọ', 132455656, 2147483647, '00 Giờ 00 Phút', 2, 185, 0, 185, '1?1?BIA TIGER/1?2?BIA HENIKEN/1?3?STRONGBOW/1?4?BIA CORONA/1?5?BIA SAIGON/7?6?7 UP', '15/05/2022', '04:20pm', '15/05/2022'),
(14, 'Văn phát ', 2147483647, 386234534, '00 Giờ 00 Phút', 2, 240, 0, 240, '3?1?BIA TIGER/4?2?BIA HENIKEN/3?3?STRONGBOW/1?4?BIA CORONA/4?7?COCA/1?12?ĐẬU PHỘNG', '15/05/2022', '04:34pm', '15/05/2022');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `luongnhanvien`
--

CREATE TABLE `luongnhanvien` (
  `id_luong` int(11) NOT NULL,
  `id_nhanvien` int(11) NOT NULL,
  `luongcoban` int(11) NOT NULL,
  `chisoluong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `luongnhanvien`
--

INSERT INTO `luongnhanvien` (`id_luong`, `id_nhanvien`, `luongcoban`, `chisoluong`) VALUES
(3, 59, 2000000, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `monan`
--

CREATE TABLE `monan` (
  `id_monan` int(11) NOT NULL,
  `hinhanh` varchar(128) NOT NULL,
  `giamon` int(11) NOT NULL,
  `available` int(11) NOT NULL,
  `Tenmon` varchar(128) NOT NULL,
  `phanloai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `monan`
--

INSERT INTO `monan` (`id_monan`, `hinhanh`, `giamon`, `available`, `Tenmon`, `phanloai`) VALUES
(1, 'tiger', 15, 1, 'BIA TIGER', 1),
(2, 'heniken', 15, 1, 'BIA HENIKEN', 1),
(3, 'strongbow', 15, 1, 'STRONGBOW', 1),
(4, 'corona', 20, 1, 'BIA CORONA', 1),
(5, 'saigon', 15, 1, 'BIA SAIGON', 1),
(6, '7up', 15, 1, '7 UP', 1),
(7, 'coca', 15, 1, 'COCA', 1),
(8, 'nuocsuoi', 15, 1, 'NƯỚC SUỐI', 1),
(9, 'olongtea', 15, 1, 'TRÀ Ô LÔNG', 1),
(10, 'pepsi', 15, 1, 'PEPSI', 1),
(11, 'sting', 15, 1, 'STING', 1),
(12, 'dauphongdaca', 10, 1, 'ĐẬU PHỘNG', 0),
(13, 'khoaitay', 10, 1, 'SNACK KHOAY TÂY', 0),
(14, 'khoaitaychien', 20, 1, 'KHOAY TÂY CHIÊN', 0),
(15, 'mitsay', 25, 1, 'MÍT SẤY', 0),
(16, 'traicay', 30, 1, 'TRÁI CÂY', 0),
(25, '25', 50, 1, 'Cá viên chiên ', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phong`
--

CREATE TABLE `phong` (
  `id_phong` int(11) NOT NULL,
  `tenphong` varchar(128) NOT NULL,
  `giaphong` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `check_room` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `phong`
--

INSERT INTO `phong` (`id_phong`, `tenphong`, `giaphong`, `active`, `check_room`) VALUES
(1, 'PHÒNG 1', 100, 0, 0),
(2, 'PHÒNG VIP 1', 200, 0, 1),
(4, 'PHÒNG VIP 3', 200, 0, 1),
(5, 'PHÒNG 2', 100, 0, 0),
(6, 'PHÒNG 3', 100, 0, 0),
(7, 'PHÒNG 4', 100, 0, 0),
(8, 'PHÒNG 5', 100, 0, 0),
(9, 'PHÒNG 6', 100, 0, 0),
(10, 'PHÒNG 7', 100, 0, 0),
(12, 'PHÒNG VIP 4', 200, 0, 1),
(13, 'PHÒNG VIP 5 ', 200, 0, 1),
(15, 'PHÒNG VIP 2', 200, 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phonghoatdong`
--

CREATE TABLE `phonghoatdong` (
  `username` varchar(128) NOT NULL,
  `hoten` varchar(128) NOT NULL,
  `sdt` varchar(128) NOT NULL,
  `cmnd` int(11) NOT NULL,
  `id_phong` int(11) NOT NULL,
  `monan` longtext NOT NULL,
  `ngay` text NOT NULL,
  `gio` text NOT NULL,
  `id_hoatdong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role`
--

CREATE TABLE `role` (
  `id_role` varchar(128) NOT NULL,
  `chucnang` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `id_permisson` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `role`
--

INSERT INTO `role` (`id_role`, `chucnang`, `username`, `id_permisson`) VALUES
('0', 'ALL', 'admin', 1),
('1', 'Limit', 'Khách Hàng', 0),
('2', 'ALL', 'NHANVIEN', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `fullname` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(120) NOT NULL,
  `id_role` varchar(128) DEFAULT NULL,
  `cmnd` int(11) DEFAULT NULL,
  `sdt` int(11) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `address` varchar(128) NOT NULL,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id_user`, `fullname`, `username`, `password`, `id_role`, `cmnd`, `sdt`, `email`, `address`, `active`) VALUES
(1, 'Đinh Nhựt Minh', 'admin', '$2y$10$ZzL7/JPWzCvWtM1cNa1GOOmT.qJ4A6CpkMHMrVMQkBjt3VGpA4Ox.', '0', 535234, 234234234, 'mndx1t@gmail.com', '18/16 tan phong', 1),
(59, 'Lê Vĩ Tâm', 'tamle', '$2y$10$iWx4E0rbiQnCbw/fp7r3GOACr2Fd6ieC7s5rnbyEpEF5AmyuMnA1i', '2', 453645674, 88845524, 'mndx5t@gmail.com', '60 đường Hùng Vương', 1),
(60, 'Nguyễn Văn Phát', 'vanphat', '$2y$10$kriwROhor5gorKg3oGY5AuZYB74aTV.hO.g8vFJUSBG4GHsxfED/S', '1', 2147483647, 1214563287, 'pgkml@gmail.com', '36/2 Hùng Vương, Khu phố 6', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `dondatphong`
--
ALTER TABLE `dondatphong`
  ADD PRIMARY KEY (`id_dondat`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`id_hoadon`);

--
-- Chỉ mục cho bảng `luongnhanvien`
--
ALTER TABLE `luongnhanvien`
  ADD PRIMARY KEY (`id_luong`);

--
-- Chỉ mục cho bảng `monan`
--
ALTER TABLE `monan`
  ADD PRIMARY KEY (`id_monan`);

--
-- Chỉ mục cho bảng `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`id_phong`);

--
-- Chỉ mục cho bảng `phonghoatdong`
--
ALTER TABLE `phonghoatdong`
  ADD PRIMARY KEY (`id_hoatdong`);

--
-- Chỉ mục cho bảng `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `dondatphong`
--
ALTER TABLE `dondatphong`
  MODIFY `id_dondat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `id_hoadon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `luongnhanvien`
--
ALTER TABLE `luongnhanvien`
  MODIFY `id_luong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `monan`
--
ALTER TABLE `monan`
  MODIFY `id_monan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `phong`
--
ALTER TABLE `phong`
  MODIFY `id_phong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `phonghoatdong`
--
ALTER TABLE `phonghoatdong`
  MODIFY `id_hoatdong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
