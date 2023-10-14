








SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;











CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;





INSERT INTO `categories` (`id`, `name`) VALUES
(15, 'BOOTS'),
(12, 'ELBOW PADS'),
(14, 'FULL BODY GEAR'),
(11, 'GLOVES'),
(10, 'HELMETS'),
(13, 'KNEE PADS');







CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;





INSERT INTO `customers` (`id`, `fullname`, `address`, `phone`, `created_at`) VALUES
(6, 'Fernan Galabin', 'Begong', '09109036621', '2023-08-13'),
(7, 'Allen', 'Begong', '123546789', '2023-08-13'),
(9, 'JM', 'Begong tigbao ZDS', '09518869104', '2023-08-13'),
(10, 'Bryne khent ', 'sagon', '09123456789', '2023-08-18'),
(11, 'dex', 'tad', '123121', '2023-10-10'),
(12, 'qweq', 'qweq', '123121', '2023-10-10'),
(13, 'Nixon', 'pagadian', '09275474259', '2023-10-10');







CREATE TABLE `media` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;





INSERT INTO `media` (`id`, `file_name`, `file_type`) VALUES
(4, 'gloves.png', 'image/png'),
(5, 'elbow pads.png', 'image/png'),
(6, 'knee pads.png', 'image/png'),
(7, 'full body gear.jpg', 'image/jpeg'),
(8, 'boots.png', 'image/jpeg'),
(9, 'evo vxr-4000 plain.jpg', 'image/jpeg');







CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `buy_price` decimal(25,2) DEFAULT NULL,
  `sale_price` decimal(25,2) NOT NULL,
  `categorie_id` int(11) UNSIGNED NOT NULL,
  `media_id` int(11) DEFAULT 0,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;





INSERT INTO `products` (`id`, `name`, `quantity`, `buy_price`, `sale_price`, `categorie_id`, `media_id`, `date`) VALUES
(15, 'EVO VXR-4000 PLAIN', '10', 4100.00, 4100.00, 10, 9, '2023-08-04 02:22:44'),
(16, 'EVO ELBOW PADS', '1', 1499.00, 1499.00, 12, 5, '2023-08-04 02:26:30'),
(17, 'EVO GLOVES', '5', 1000.00, 1000.00, 11, 4, '2023-08-04 02:26:54'),
(18, 'EVO KNEE PADS', '8', 3000.00, 3000.00, 13, 6, '2023-08-04 02:27:14'),
(19, 'EVO FULL BODY GEAR', '0', 19999.00, 19999.00, 14, 7, '2023-08-04 02:27:39'),
(20, 'EVO BOOTS', '4', 10000.00, 10000.00, 15, 8, '2023-08-04 02:28:04');








CREATE TABLE `sales` (
  `id` int(11) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(25,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;





INSERT INTO `sales` (`id`, `customer_id`, `product_id`, `qty`, `price`, `date`) VALUES
(19, 6, 16, 2, 2998.00, '2023-08-14'),
(20, 7, 19, 1, 19999.00, '2023-08-13'),
(21, 7, 19, 1, 19999.00, '2023-08-13'),
(22, 7, 19, 5, 99995.00, '2023-08-13'),
(23, 6, 19, 1, 19999.00, '2023-08-13'),
(24, 9, 18, 1, 3000.00, '2023-08-13'),
(25, 9, 19, 1, 19999.00, '2023-08-13'),
(26, 9, 20, 1, 10000.00, '2023-08-13'),
(27, 7, 19, 1, 19999.00, '2023-08-18'),
(28, 9, 19, 1, 19999.00, '2023-08-18'),
(29, 9, 18, 1, 3000.00, '2023-08-18'),
(30, 7, 19, 1, 19999.00, '2023-08-18'),
(31, 7, 16, 1, 1499.00, '2023-08-18'),
(32, 7, 17, 1, 1000.00, '2023-08-18'),
(33, 11, 20, 1, 10000.00, '2023-10-10'),
(34, 11, 17, 1, 1000.00, '2023-10-10'),
(35, 11, 19, 94, 1879906.00, '2023-10-10'),
(36, 13, 20, 2, 20000.00, '2023-10-10');







CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` int(11) NOT NULL,
  `image` varchar(255) DEFAULT 'no_image.jpg',
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;





INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_level`, `image`, `status`, `last_login`) VALUES
(1, 'Admin', 'Admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'pspsq971.png', 1, '2023-10-12 08:11:33'),
(3, 'User', 'User', '12dea96fec20593566ab75692c9949596833adc9', 3, 'no_image.png', 1, '2023-10-12 08:12:07');







CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;





INSERT INTO `user_groups` (`id`, `group_name`, `group_level`, `group_status`) VALUES
(1, 'Admin', 1, 1),
(2, 'special', 2, 1),
(3, 'User', 3, 1);








ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);




ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);




ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);




ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `categorie_id` (`categorie_id`),
  ADD KEY `media_id` (`media_id`);




ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);




ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_level` (`user_level`);




ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_level` (`group_level`);








ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;




ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;




ALTER TABLE `media`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;




ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;




ALTER TABLE `sales`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;




ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;




ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;








ALTER TABLE `products`
  ADD CONSTRAINT `FK_products` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;




ALTER TABLE `sales`
  ADD CONSTRAINT `SK` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;




ALTER TABLE `users`
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`user_level`) REFERENCES `user_groups` (`group_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
