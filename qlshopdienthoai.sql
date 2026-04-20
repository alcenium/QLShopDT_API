-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2026 at 04:38 PM
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
-- Database: `qlshopdienthoai`
--
DROP DATABASE IF EXISTS qlshopdienthoai;
CREATE DATABASE qlshopdienthoai;

USE qlshopdienthoai;
-- --------------------------------------------------------

--
-- Table structure for table `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `madh` int(11) NOT NULL,
  `masp` int(11) NOT NULL,
  `sl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`madh`, `masp`, `sl`) VALUES
(1, 1, 1),
(1, 3, 1),
(2, 1, 1),
(3, 2, 10),
(3, 3, 1),
(3, 4, 1),
(4, 5, 1),
(4, 6, 1),
(5, 8, 1),
(6, 7, 1),
(6, 10, 1),
(7, 12, 2),
(8, 9, 1),
(9, 5, 1),
(9, 12, 2),
(10, 6, 1),
(11, 7, 1),
(11, 8, 1),
(12, 10, 1),
(12, 11, 1),
(12, 16, 1),
(13, 10, 1),
(14, 13, 1),
(14, 14, 2),
(14, 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `danhmuc`
--

CREATE TABLE `danhmuc` (
  `madm` int(11) NOT NULL,
  `tendm` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `danhmuc`
--

INSERT INTO `danhmuc` (`madm`, `tendm`) VALUES
(1, 'Điện thoại'),
(2, 'Laptop'),
(5, 'ad');

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
--

CREATE TABLE `donhang` (
  `madh` int(11) NOT NULL,
  `makh` int(11) NOT NULL,
  `ngaydat` datetime NOT NULL,
  `manv` int(11) NOT NULL,
  `trigia` double NOT NULL,
  `trangthai` varchar(50) NOT NULL DEFAULT 'Chờ xác nhận'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`madh`, `makh`, `ngaydat`, `manv`, `trigia`, `trangthai`) VALUES
(1, 3, '2025-12-24 00:00:00', 2, 39690000, 'Chờ xác nhận'),
(2, 3, '2025-12-24 00:00:00', 2, 15000000, 'Chờ xác nhận'),
(3, 3, '2025-12-24 00:00:00', 2, 206490000, 'Chờ xác nhận'),
(4, 4, '2025-01-10 00:00:00', 8, 49980000, 'Chờ xác nhận'),
(5, 5, '2025-01-12 00:00:00', 8, 27990000, 'Chờ xác nhận'),
(6, 6, '2026-01-14 00:00:00', 9, 39980000, 'Chờ xác nhận'),
(7, 7, '2026-01-15 00:00:00', 9, 17990000, 'Chờ xác nhận'),
(8, 4, '2026-01-16 00:00:00', 8, 35990000, 'Chờ xác nhận'),
(9, 5, '2026-01-17 00:00:00', 9, 44980000, 'Chờ xác nhận'),
(10, 6, '2025-06-18 00:00:00', 8, 19990000, 'Chờ xác nhận'),
(11, 7, '2025-07-19 00:00:00', 9, 52980000, 'Chờ xác nhận'),
(12, 3, '2025-08-20 00:00:00', 2, 33980000, 'Đã giao'),
(13, 4, '2025-09-21 00:00:00', 8, 9990000, 'Đã xác nhận'),
(14, 5, '2025-10-22 00:00:00', 9, 50000000, 'Đã giao');

-- --------------------------------------------------------

--
-- Table structure for table `giohang`
--

CREATE TABLE `giohang` (
  `magio` int(11) NOT NULL,
  `makh` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `giohang`
--

INSERT INTO `giohang` (`magio`, `makh`) VALUES
(1, 3),
(2, 4),
(3, 5),
(4, 6),
(5, 7),
(7, 11);

-- --------------------------------------------------------

--
-- Table structure for table `giohang_item`
--

CREATE TABLE `giohang_item` (
  `maitem` int(11) NOT NULL,
  `magio` int(11) NOT NULL,
  `masp` int(11) NOT NULL,
  `sl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `giohang_item`
--

INSERT INTO `giohang_item` (`maitem`, `magio`, `masp`, `sl`) VALUES
(1, 1, 2, 1),
(2, 1, 10, 2),
(3, 1, 16, 1),
(4, 2, 5, 1),
(5, 2, 8, 1),
(6, 2, 13, 2),
(7, 3, 4, 1),
(8, 3, 14, 1),
(9, 3, 15, 3),
(10, 4, 3, 1),
(11, 4, 9, 1),
(12, 4, 11, 2),
(13, 5, 1, 2),
(14, 5, 12, 1),
(15, 5, 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `makh` int(11) NOT NULL,
  `tenkh` varchar(50) NOT NULL,
  `diachi` varchar(50) DEFAULT NULL,
  `sdt` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`makh`, `tenkh`, `diachi`, `sdt`) VALUES
(3, 'theanh', 'a', '1'),
(4, 'Nguyễn Văn A', '123 Nguyễn Huệ, Q1, TP.HCM', '0901234567'),
(5, 'Trần Thị B', '456 Lê Lợi, Q3, TP.HCM', '0912345678'),
(6, 'Phạm Văn C', '789 Trần Hưng Đạo, Hà Nội', '0923456789'),
(7, 'Lê Thị D', '321 Hai Bà Trưng, Đà Nẵng', '0934567890'),
(11, 'Anbeo', 'HaNoi', '0766432452');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `manv` int(11) NOT NULL,
  `tennv` varchar(50) NOT NULL,
  `diachi` varchar(50) NOT NULL,
  `sdt` varchar(30) NOT NULL,
  `ns` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`manv`, `tennv`, `diachi`, `sdt`, `ns`) VALUES
(1, 'Admin', '', '', '2026-04-20'),
(2, 'Hùng', 'a', '0', '2025-12-01'),
(8, 'Hoàng Văn E', '111 Võ Văn Tần, Q3, TP.HCM', '0945678901', '1995-05-15'),
(9, 'Vũ Thị F', '222 Điện Biên Phủ, Hà Nội', '0956789012', '1998-08-20');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `masp` int(11) NOT NULL,
  `tensp` varchar(50) NOT NULL,
  `gia` double NOT NULL,
  `sl` int(11) NOT NULL,
  `hang` varchar(30) NOT NULL,
  `baohanh` int(11) NOT NULL,
  `ghichu` varchar(255) NOT NULL,
  `hinhanh` varchar(255) NOT NULL,
  `madm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`masp`, `tensp`, `gia`, `sl`, `hang`, `baohanh`, `ghichu`, `hinhanh`, `madm`) VALUES
(1, 'Samsung S22 Ultra', 15000000, 495, 'Samsung', 12, 'Samsung S22 Ultra 256Gbg', 'galaxy-s22-ultra-burgundy.jpg.webp', 1),
(2, 'Iphone 16e', 17500000, 189, 'Apple', 12, 'Iphone 16e 256GB - Trắng', 'iphone-16e-trang.jpg.webp', 1),
(3, 'IPhone 17', 24690000, 97, 'Apple', 12, 'IPhone 17 Tím', 'iphone-17-tim.jpg.webp', 1),
(4, 'IPhone 12', 6800000, 99, 'Apple', 12, 'IPhone 12 Pro Max Xanh', 'iphone-12-pro-max-xanh.jpg.webp', 1),
(5, 'iPhone 16 Pro', 29990000, 50, 'Apple', 12, 'iPhone 16 Pro 256GB - Titan Tự Nhiên', 'iphone-16-pro-titan-tu-nhien.jpg.webp', 1),
(6, 'iPhone 15 Plus', 19990000, 80, 'Apple', 12, 'iPhone 15 Plus 128GB - Xanh Dương', 'iphone-15-plus-xanh-duong.jpg.webp', 1),
(7, 'iPhone 14 Pro', 24990000, 45, 'Apple', 12, 'iPhone 14 Pro 256GB - Tím', 'iphone-14pro-tim-chinh-thuc.png.webp', 1),
(8, 'Samsung Galaxy S24 Ultra', 27990000, 60, 'Samsung', 12, 'Samsung S24 Plus Xám Marble', 'samsung-galaxy-s24-plus-xam-marble.jpg.webp', 1),
(9, 'Samsung Galaxy Z Fold 5', 35990000, 30, 'Samsung', 12, 'Samsung Z Fold 5 512GB - Màu kem', 'samsung-galaxy-z-fold-5-cream.jpg.webp', 1),
(10, 'Samsung Galaxy A54', 9990000, 120, 'Samsung', 12, 'Samsung A54 5G 128GB - Trắng', 'samsung a54 trang.png', 1),
(11, 'Xiaomi 14 Civi', 21990000, 40, 'Xiaomi', 12, 'Xiaomi 14 Civi 5G 512GB - Xanh lá', 'xiaomi-14-civi-5g-xanh-la.jpg.webp', 1),
(12, 'Xiaomi 13 Ultra', 7990000, 150, 'Xiaomi', 12, 'Xiaomi 13 Ultra 256GB - Xanh Lá', 'xiaomi-13-ultra-xanh.jpg.webp', 1),
(13, 'OPPO Find N3 Flip', 24990000, 25, 'OPPO', 12, 'OPPO Find N3 Flip 256GB - Hồng', 'oppo-find-n3-flip-hong.jpg.webp', 1),
(14, 'OPPO Reno 14', 10990000, 90, 'OPPO', 12, 'OPPO Reno 14 5G 256GB - Tím', 'oppo-reno14-pro-tim.jpg.webp', 1),
(15, 'Vivo Y29', 9990000, 70, 'Vivo', 12, 'Vivo Y29 256GB - Trắng', 'vivo-y29-trang.jpg.webp', 1),
(16, 'Realme 11', 8990000, 85, 'Realme', 12, 'Realme 11 256GB - Vàng', 'realme-11-vang.jpg.webp', 1),
(17, 'Realme 14 Pro Plus', 23990000, 35, 'Google', 12, 'Realme Pro Plus 256GB - Trắng mạ vàng', 'realme-14-pro-plus-trang-ma-vang.jpg.webp', 1),
(18, 'Realme 9 Pro Plus', 5990000, 65, 'Nokia', 12, 'Realme 9 Pro Plus 128GB - Xanh bình minh', 'realme-9-pro-plus-xanh-binh-minh.jpg.webp', 1),
(19, 'Realme GT5', 19990000, 45, 'OnePlus', 12, 'Realme GT5 256GB - Xanh Lá', 'realme-gt5-xanh.jpg.webp', 1),
(21, 'iPhone 15', 25000000, 10, 'Apple', 12, '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `matk` int(11) NOT NULL,
  `tentk` varchar(50) NOT NULL,
  `mk` varchar(255) NOT NULL,
  `role` int(11) NOT NULL COMMENT '0: Khách hàng, 1: Admin, 2: Nhân viên'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`matk`, `tentk`, `mk`, `role`) VALUES
(1, 'admin', '123', 1),
(2, 'Hùng', '123456', 2),
(3, 'theanh', '123456', 0),
(4, 'nguyenvana', '123456', 0),
(5, 'tranthib', '123456', 0),
(6, 'phamvanc', '123456', 0),
(7, 'lethid', '123456', 0),
(8, 'nhanvien1', '123456', 2),
(9, 'nhanvien2', '123456', 2),
(11, 'An', '$2y$10$RzyOoPyGxFbby/tsMweGNeQcu7jw8VEltddv6nvKxYIe6sfS9/oQm', 0);

-- --------------------------------------------------------

--
-- Table structure for table `thanhtoan`
--

CREATE TABLE `thanhtoan` (
  `matt` int(11) NOT NULL,
  `madh` int(11) NOT NULL,
  `phuongthuc` varchar(50) NOT NULL COMMENT 'Tiền mặt, Chuyển khoản, Thẻ, Ví điện tử',
  `ngaythanhtoan` datetime NOT NULL,
  `sotien` double NOT NULL,
  `trangthai` varchar(30) NOT NULL COMMENT 'Chờ xác nhận, Đã thanh toán, Thất bại',
  `ghichu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `thanhtoan`
--

INSERT INTO `thanhtoan` (`matt`, `madh`, `phuongthuc`, `ngaythanhtoan`, `sotien`, `trangthai`, `ghichu`) VALUES
(1, 4, 'Chuyển khoản', '2025-01-10 14:30:00', 49980000, 'Đã thanh toán', 'Thanh toán qua VietQR'),
(2, 5, 'Tiền mặt', '2025-01-12 10:15:00', 27990000, 'Đã thanh toán', 'Thanh toán khi nhận hàng'),
(3, 6, 'Thẻ', '2025-01-14 16:45:00', 39980000, 'Đã thanh toán', 'Thanh toán bằng thẻ Visa'),
(4, 1, 'Chuyển khoản', '2025-12-24 09:20:00', 39690000, 'Đã thanh toán', 'Thanh toán qua MoMo'),
(5, 2, 'Tiền mặt', '2025-12-24 11:45:00', 15000000, 'Đã thanh toán', 'Thanh toán tại cửa hàng'),
(6, 3, 'Ví điện tử', '2025-12-24 15:30:00', 206490000, 'Đã thanh toán', 'Thanh toán qua ZaloPay'),
(7, 7, 'Chuyển khoản', '2026-01-15 13:25:00', 17990000, 'Đã thanh toán', 'Thanh toán qua VietQR'),
(8, 8, 'Ví điện tử', '2026-01-16 10:30:00', 35990000, 'Đã thanh toán', 'Thanh toán qua MoMo'),
(9, 9, 'Thẻ', '2026-01-17 14:15:00', 44980000, 'Đã thanh toán', 'Thanh toán bằng thẻ Mastercard'),
(10, 10, 'Chuyển khoản', '2025-02-18 09:45:00', 19990000, 'Đã thanh toán', 'Thanh toán qua VietQR'),
(11, 11, 'Tiền mặt', '2025-04-19 16:20:00', 52980000, 'Đã thanh toán', 'Thanh toán khi nhận hàng'),
(12, 12, 'Ví điện tử', '2025-11-20 11:00:00', 33980000, 'Đã thanh toán', 'Thanh toán qua ZaloPay'),
(13, 13, 'Chuyển khoản', '2025-07-21 15:30:00', 9990000, 'Chờ xác nhận', 'Đang chờ xác nhận giao dịch'),
(14, 14, 'Thẻ', '2025-10-22 10:45:00', 48980000, 'Đã thanh toán', 'Thanh toán bằng thẻ Visa'),
(15, 4, 'Ví điện tử', '2026-01-10 17:00:00', 49980000, 'Chờ xác nhận', 'Đang xử lý thanh toán qua ShopeePay'),
(16, 5, 'Thẻ', '2026-01-12 12:30:00', 27990000, 'Thất bại', 'Giao dịch bị từ chối - Thẻ hết hạn'),
(17, 6, 'Tiền mặt', '2026-01-14 18:00:00', 39980000, 'Chờ xác nhận', 'Chờ khách hàng thanh toán khi nhận hàng');

-- --------------------------------------------------------

--
-- Table structure for table `thongso`
--

CREATE TABLE `thongso` (
  `mats` int(11) NOT NULL,
  `tents` varchar(50) NOT NULL,
  `masp` int(11) NOT NULL,
  `giatri` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `thongso`
--

INSERT INTO `thongso` (`mats`, `tents`, `masp`, `giatri`) VALUES
(1, 'RAM', 2, '8GB'),
(2, 'RAM', 3, '8GB'),
(3, 'RAM', 1, '4GB'),
(4, 'RAM', 5, '8GB'),
(5, 'Bộ nhớ', 5, '256GB'),
(6, 'Chip', 5, 'Apple A17 Pro'),
(7, 'RAM', 6, '6GB'),
(8, 'Bộ nhớ', 6, '128GB'),
(9, 'Chip', 6, 'Apple A16 Bionic'),
(10, 'RAM', 7, '8GB'),
(11, 'Bộ nhớ', 7, '256GB'),
(12, 'Chip', 7, 'Apple A16 Bionic'),
(13, 'RAM', 8, '12GB'),
(14, 'Bộ nhớ', 8, '512GB'),
(15, 'Chip', 8, 'Snapdragon 8 Gen 3'),
(16, 'RAM', 9, '12GB'),
(17, 'Bộ nhớ', 9, '512GB'),
(18, 'Chip', 9, 'Snapdragon 8 Gen 2'),
(19, 'RAM', 10, '8GB'),
(20, 'Bộ nhớ', 10, '128GB'),
(21, 'Chip', 10, 'Exynos 1380'),
(22, 'RAM', 11, '16GB'),
(23, 'Bộ nhớ', 11, '512GB'),
(24, 'Chip', 11, 'Snapdragon 8 Gen 3'),
(25, 'RAM', 12, '8GB'),
(26, 'Bộ nhớ', 12, '256GB'),
(27, 'Chip', 12, 'Snapdragon 7s Gen 2'),
(28, 'RAM', 13, '12GB'),
(29, 'Bộ nhớ', 13, '256GB'),
(30, 'Chip', 13, 'MediaTek Dimensity 9200'),
(31, 'RAM', 14, '8GB'),
(32, 'Bộ nhớ', 14, '256GB'),
(33, 'Chip', 14, 'MediaTek Dimensity 8200');

-- --------------------------------------------------------

--
-- Table structure for table `vanchuyen`
--

CREATE TABLE `vanchuyen` (
  `mavc` int(11) NOT NULL,
  `madh` int(11) NOT NULL,
  `makh` int(11) NOT NULL,
  `ngaygiao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `vanchuyen`
--

INSERT INTO `vanchuyen` (`mavc`, `madh`, `makh`, `ngaygiao`) VALUES
(1, 2, 3, '2025-12-26'),
(2, 4, 4, '2025-01-15'),
(3, 5, 5, '2025-01-17'),
(4, 6, 6, '2025-01-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`madh`,`masp`),
  ADD KEY `masp` (`masp`);

--
-- Indexes for table `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`madm`);

--
-- Indexes for table `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`madh`),
  ADD KEY `makh` (`makh`),
  ADD KEY `manv` (`manv`);

--
-- Indexes for table `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`magio`),
  ADD KEY `makh` (`makh`);

--
-- Indexes for table `giohang_item`
--
ALTER TABLE `giohang_item`
  ADD PRIMARY KEY (`maitem`),
  ADD KEY `magio` (`magio`),
  ADD KEY `masp` (`masp`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`makh`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`manv`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`masp`),
  ADD KEY `madm` (`madm`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`matk`);

--
-- Indexes for table `thanhtoan`
--
ALTER TABLE `thanhtoan`
  ADD PRIMARY KEY (`matt`),
  ADD KEY `madh` (`madh`);

--
-- Indexes for table `thongso`
--
ALTER TABLE `thongso`
  ADD PRIMARY KEY (`mats`),
  ADD KEY `masp` (`masp`);

--
-- Indexes for table `vanchuyen`
--
ALTER TABLE `vanchuyen`
  ADD PRIMARY KEY (`mavc`),
  ADD KEY `madh` (`madh`),
  ADD KEY `makh` (`makh`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `madm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `madh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `giohang`
--
ALTER TABLE `giohang`
  MODIFY `magio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `giohang_item`
--
ALTER TABLE `giohang_item`
  MODIFY `maitem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `masp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `matk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `thanhtoan`
--
ALTER TABLE `thanhtoan`
  MODIFY `matt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `thongso`
--
ALTER TABLE `thongso`
  MODIFY `mats` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `vanchuyen`
--
ALTER TABLE `vanchuyen`
  MODIFY `mavc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `chitietdonhang_ibfk_1` FOREIGN KEY (`madh`) REFERENCES `donhang` (`madh`) ON DELETE CASCADE,
  ADD CONSTRAINT `chitietdonhang_ibfk_2` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`masp`) ON DELETE CASCADE;

--
-- Constraints for table `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`makh`) REFERENCES `khachhang` (`makh`) ON DELETE CASCADE,
  ADD CONSTRAINT `donhang_ibfk_2` FOREIGN KEY (`manv`) REFERENCES `nhanvien` (`manv`) ON DELETE CASCADE;

--
-- Constraints for table `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`makh`) REFERENCES `khachhang` (`makh`) ON DELETE CASCADE;

--
-- Constraints for table `giohang_item`
--
ALTER TABLE `giohang_item`
  ADD CONSTRAINT `giohang_item_ibfk_1` FOREIGN KEY (`magio`) REFERENCES `giohang` (`magio`) ON DELETE CASCADE,
  ADD CONSTRAINT `giohang_item_ibfk_2` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`masp`) ON DELETE CASCADE;

--
-- Constraints for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD CONSTRAINT `khachhang_ibfk_1` FOREIGN KEY (`makh`) REFERENCES `taikhoan` (`matk`) ON DELETE CASCADE;

--
-- Constraints for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_ibfk_1` FOREIGN KEY (`manv`) REFERENCES `taikhoan` (`matk`) ON DELETE CASCADE;

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`madm`) REFERENCES `danhmuc` (`madm`) ON DELETE CASCADE;

--
-- Constraints for table `thanhtoan`
--
ALTER TABLE `thanhtoan`
  ADD CONSTRAINT `thanhtoan_ibfk_1` FOREIGN KEY (`madh`) REFERENCES `donhang` (`madh`) ON DELETE CASCADE;

--
-- Constraints for table `thongso`
--
ALTER TABLE `thongso`
  ADD CONSTRAINT `thongso_ibfk_1` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`masp`) ON DELETE CASCADE;

--
-- Constraints for table `vanchuyen`
--
ALTER TABLE `vanchuyen`
  ADD CONSTRAINT `vanchuyen_ibfk_1` FOREIGN KEY (`madh`) REFERENCES `donhang` (`madh`) ON DELETE CASCADE,
  ADD CONSTRAINT `vanchuyen_ibfk_2` FOREIGN KEY (`makh`) REFERENCES `khachhang` (`makh`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
