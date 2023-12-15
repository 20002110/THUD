-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th12 06, 2023 lúc 09:47 PM
-- Phiên bản máy phục vụ: 10.6.12-MariaDB-0ubuntu0.22.04.1
-- Phiên bản PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `MovieTicket`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Movies`
--

CREATE TABLE `Movies` (
  `movieID` int(255) NOT NULL,
  `typeID` int(255) NOT NULL,
  `Name` varchar(125) NOT NULL,
  `director` varchar(255) NOT NULL,
  `performer` text NOT NULL,
  `time` time NOT NULL,
  `language` varchar(125) NOT NULL,
  `premiere` datetime NOT NULL,
  `describes` mediumtext NOT NULL,
  `cost` int(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `theater`
--

CREATE TABLE `theater` (
  `theaterID` int(125) NOT NULL,
  `theaterName` varchar(255) NOT NULL,
  `location` mediumtext NOT NULL,
  `num_row` int(45) NOT NULL,
  `num_column` int(45) NOT NULL,
  `seats` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`seats`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `theater`
--

INSERT INTO `theater` (`theaterID`, `theaterName`, `location`, `num_row`, `num_column`, `seats`) VALUES
(1, 'test', 'Test subcontent', 5, 5, '[{\"seatName\":\"A1\",\"user_id\":0,\"status\":0},{\"seatName\":\"A2\",\"user_id\":0,\"status\":0},{\"seatName\":\"A3\",\"user_id\":0,\"status\":0},{\"seatName\":\"A4\",\"user_id\":0,\"status\":0},{\"seatName\":\"A5\",\"user_id\":0,\"status\":0},{\"seatName\":\"B1\",\"user_id\":0,\"status\":0},{\"seatName\":\"B2\",\"user_id\":0,\"status\":0},{\"seatName\":\"B3\",\"user_id\":0,\"status\":0},{\"seatName\":\"B4\",\"user_id\":0,\"status\":0},{\"seatName\":\"B5\",\"user_id\":0,\"status\":0},{\"seatName\":\"C1\",\"user_id\":0,\"status\":0},{\"seatName\":\"C2\",\"user_id\":0,\"status\":0},{\"seatName\":\"C3\",\"user_id\":0,\"status\":0},{\"seatName\":\"C4\",\"user_id\":0,\"status\":0},{\"seatName\":\"C5\",\"user_id\":0,\"status\":0},{\"seatName\":\"D1\",\"user_id\":0,\"status\":0},{\"seatName\":\"D2\",\"user_id\":0,\"status\":0},{\"seatName\":\"D3\",\"user_id\":0,\"status\":0},{\"seatName\":\"D4\",\"user_id\":0,\"status\":0},{\"seatName\":\"D5\",\"user_id\":0,\"status\":0},{\"seatName\":\"E1\",\"user_id\":0,\"status\":0},{\"seatName\":\"E2\",\"user_id\":0,\"status\":0},{\"seatName\":\"E3\",\"user_id\":0,\"status\":0},{\"seatName\":\"E4\",\"user_id\":0,\"status\":0},{\"seatName\":\"E5\",\"user_id\":0,\"status\":0}]');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ticket`
--

CREATE TABLE `ticket` (
  `ticketID` int(255) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `theaterID` int(11) NOT NULL,
  `movieID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `TypeMovie`
--

CREATE TABLE `TypeMovie` (
  `typeID` int(255) NOT NULL,
  `typeName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `userInfor`
--

CREATE TABLE `userInfor` (
  `user_id` int(255) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `phone` int(45) NOT NULL,
  `date_of_birth` date NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(125) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`) VALUES
(1, 'danhnt1211@gmail.com', '$2y$10$t1iw4tdu7bNiKL7WpSkCfu.AWFqqKPS7NyEUojXxA8XjKK/aVNHWK'),
(2, 'nguyentruongdanh_t65@hus.edu.vn', '$2y$10$oRsDZ7/3P/a1glaHUuKlK.6MK7MWkmXfSTAKnyDjAavA0cGZtya5C'),
(3, 'admin@gmail.com', '$2y$10$62oschW.kraOX4f0W3Y1U.pf5/WluuFIQw3IkrErq3FtThcswiH7C'),
(4, 'q@gmail.com', '$2y$10$d5XB8UqJzXRhYVtMgYHbQOFJ9nj2IGhWXIwk7c8M.dGO1bHtYWkJO'),
(5, 'anhquan102030@gmail.com', '$2y$10$NRD.RPdg7YBAlD5BPeUkBuKJdA7PQ6aQViSeoGNmsjdZHKi42HwvS'),
(6, 'nguyentunganh21122002@gmail.com', '$2y$10$qvzPVtsy4AhUYhBY63w.BuUcBsqwNUS8d6uN5pNqgVKB27hHdUGde'),
(7, 'vianhquan_t65@hus.edu.vn', '$2y$10$545RhwhlXtkw1Dygv.AX9OulNWYAwIpGImQdyfTVpibB2S.7zftm6'),
(8, 'khuatdangson2002@gmail.com', '$2y$10$c65bXPtt5gXijqx90oUFyO8bN/D4Su.fHirMm2d16erMR3n1d8Q2.'),
(9, 'ytbfqun@gmail.com', '$2y$10$ngD3yNDVONSSJemsIyW5mOA4LpvAjiKSMsvd.7DCiLfH9JkmMLboe');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `Movies`
--
ALTER TABLE `Movies`
  ADD PRIMARY KEY (`movieID`),
  ADD KEY `typeID` (`typeID`);

--
-- Chỉ mục cho bảng `theater`
--
ALTER TABLE `theater`
  ADD PRIMARY KEY (`theaterID`);

--
-- Chỉ mục cho bảng `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticketID`),
  ADD KEY `movieID` (`movieID`),
  ADD KEY `theaterID` (`theaterID`),
  ADD KEY `user_Id` (`user_Id`);

--
-- Chỉ mục cho bảng `TypeMovie`
--
ALTER TABLE `TypeMovie`
  ADD PRIMARY KEY (`typeID`);

--
-- Chỉ mục cho bảng `userInfor`
--
ALTER TABLE `userInfor`
  ADD PRIMARY KEY (`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `Movies`
--
ALTER TABLE `Movies`
  MODIFY `movieID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `theater`
--
ALTER TABLE `theater`
  MODIFY `theaterID` int(125) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticketID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `TypeMovie`
--
ALTER TABLE `TypeMovie`
  MODIFY `typeID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(125) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`movieID`) REFERENCES `Movies` (`movieID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`theaterID`) REFERENCES `theater` (`theaterID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_ibfk_3` FOREIGN KEY (`user_Id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `userInfor`
--
ALTER TABLE `userInfor`
  ADD CONSTRAINT `userInfor_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
