-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-03-01 21:57:03
-- 伺服器版本： 10.4.17-MariaDB
-- PHP 版本： 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

DROP DATABASE IF EXISTS `gk`;
CREATE DATABASE IF NOT EXISTS `gk` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `gk`;

--
-- 資料庫： `gk`
--

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `id` int(11) UNSIGNED NOT NULL,
  `type` varchar(1) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `creatDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`id`, `type`, `username`, `password`, `name`, `tel`, `address`, `creatDate`) VALUES
(1, '1', 'admin', 'admin', '管理者', '04-1234567', '台中市', '2021-02-20 21:14:54'),
(2, '2', 'member1', 'member1', '阿雞', '04-7654321', '台中市', '2021-02-20 21:15:35');

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `id` int(11) UNSIGNED NOT NULL,
  `memberId` int(11) UNSIGNED NOT NULL,
  `type` varchar(1) NOT NULL,
  `name` varchar(20) NOT NULL,
  `tel` varchar(12) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` varchar(1) NOT NULL,
  `orderDate` datetime NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 資料表結構 `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) UNSIGNED NOT NULL,
  `orderId` int(11) UNSIGNED NOT NULL,
  `productId` int(11) UNSIGNED NOT NULL,
  `size` varchar(1) NOT NULL,
  `ih` varchar(1) NOT NULL,
  `price` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `size` varchar(1) NOT NULL,
  `ih` varchar(1) NOT NULL,
  `priceL` int(11) DEFAULT NULL,
  `priceM` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='menu' ROW_FORMAT=DYNAMIC;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`id`, `code`, `name`, `size`, `ih`, `priceL`, `priceM`) VALUES
(1, 'FT01', '黃金柳橙綠', '1', '1', 45, NULL),
(2, 'FT02', '凍頂檸檬', '1', '3', 45, NULL),
(3, 'FT03', '翡翠檸檬', '1', '3', 45, NULL),
(4, 'FT04', '檸檬蜜', '1', '3', 45, NULL),
(5, 'FT05', '檸檬紅茶', '1', '3', 45, NULL),
(6, 'FT06', '檸檬三寶(珍/蘆/椰)', '1', '1', 45, NULL),
(7, 'FT07', '檸檬蘆薈', '1', '1', 40, NULL),
(8, 'FT08', '百香雙Q(珍/椰)', '1', '1', 40, NULL),
(9, 'FT09', '百香綠茶', '1', '1', 35, NULL),
(10, 'FT10', '冬瓜檸檬', '1', '3', 35, NULL),
(11, 'FT11', '檸檬汁', '1', '3', 35, NULL),
(12, 'FT12', '甘蔗青茶', '1', '3', 50, NULL),
(13, 'FT13', '甘蔗檸檬', '1', '3', 55, NULL),
(14, 'FT14', '甘蔗柳橙', '1', '3', 65, NULL),
(15, 'TT01', '日月潭紅茶', '1', '3', 25, NULL),
(16, 'TT02', '名間綠茶', '1', '3', 25, NULL),
(17, 'TT03', '高山烏龍', '1', '3', 25, NULL),
(18, 'TT04', '鐵觀音', '1', '3', 25, NULL),
(19, 'TT05', '台灣四季春', '1', '3', 25, NULL),
(20, 'TT06', '黃金大麥茶', '1', '3', 25, NULL),
(21, 'ST01', '古早味冬瓜茶', '1', '3', 25, NULL),
(22, 'ST02', '仙草甘茶', '1', '1', 25, NULL),
(23, 'ST03', '冬瓜青茶', '1', '3', 30, NULL),
(24, 'ST04', '冬瓜鐵觀音', '1', '3', 30, NULL),
(25, 'ST05', '冬瓜小芋園', '1', '3', 35, NULL),
(26, 'ST06', '蜂蜜紅/綠', '1', '3', 35, NULL),
(27, 'ST07', '蜂蜜冰露', '1', '3', 35, NULL),
(28, 'FM01', '日月潭紅鮮奶', '3', '3', 50, 40),
(29, 'FM02', '大麥鮮奶', '3', '3', 50, 40),
(30, 'FM03', '名間綠鮮奶', '3', '3', 50, 40),
(31, 'FM04', '烏龍鮮奶', '3', '3', 50, 40),
(32, 'FM05', '觀音群奶', '3', '3', 50, 40),
(33, 'FM06', '四季春鮮奶', '3', '3', 50, 40),
(34, 'FM07', '冬瓜鮮奶', '3', '3', 50, 40),
(35, 'FM08', '抹茶鮮奶', '1', '3', 60, NULL),
(36, 'FM09', '9453鮮奶茶(珍/芋/布)', '1', '3', 50, NULL),
(37, 'FM10', '布丁鮮奶茶', '1', '3', 50, NULL),
(38, 'FM11', '珍珠鮮奶茶', '3', '3', 55, 45),
(39, 'FM12', '小芋園鮮奶茶', '3', '3', 55, 45),
(40, 'FM13', '巧克力鮮奶', '3', '3', 50, 40),
(41, 'FM14', '大甲芋鮮奶', '3', '3', 55, 45),
(42, 'FM15', '珍珠鮮奶', '3', '3', 60, 50),
(43, 'MT01', '珍珠奶茶', '1', '3', 35, NULL),
(44, 'MT02', '珍珠奶綠', '1', '3', 35, NULL),
(45, 'MT03', '奶茶', '1', '3', 30, NULL),
(46, 'MT04', '奶綠', '1', '3', 30, NULL),
(47, 'MT05', '烏龍奶茶', '1', '3', 30, NULL),
(48, 'MT06', '觀音奶茶', '1', '3', 30, NULL),
(49, 'MT07', '9453奶茶(珍/芋/布)', '1', '3', 40, NULL),
(50, 'MT08', '布丁奶茶', '1', '3', 40, NULL),
(51, 'MT09', '小芋圓奶茶', '1', '3', 40, NULL),
(52, 'MT10', '巧克力奶茶', '1', '3', 35, NULL),
(53, 'VT01', '多多綠', '1', '1', 45, NULL),
(54, 'VT02', '百香多多', '1', '1', 45, NULL),
(55, 'VT03', '蘆薈蘋果醋', '1', '1', 45, NULL),
(56, 'VT04', '蘆薈蔓越莓醋', '1', '1', 45, NULL);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `memberId` (`memberId`) USING BTREE;

--
-- 資料表索引 `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `productId` (`productId`) USING BTREE,
  ADD KEY `order_detail_ibfk_1` (`orderId`) USING BTREE;

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`memberId`) REFERENCES `member` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 資料表的限制式 `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
