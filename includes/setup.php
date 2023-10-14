<?php
try {
    $database = 'inventory_system';
    $db = new PDO('mysql:host=localhost', 'root', '');
    $query = "CREATE DATABASE IF NOT EXISTS $database";
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec($query);
    $db->exec("USE $database");

    $db->exec("
        CREATE TABLE IF NOT EXISTS `categories` (
          `id` INT PRIMARY KEY AUTO_INCREMENT,
          `name` VARCHAR(60) NOT NULL
        );
    ");

    $db->exec("
        CREATE TABLE IF NOT EXISTS `customers` (
          `id` INT PRIMARY KEY AUTO_INCREMENT,
          `fullname` VARCHAR(255),
          `address` VARCHAR(255),
          `phone` VARCHAR(255),
          `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
        );
        ");

    $db->exec("
        CREATE TABLE IF NOT EXISTS `media` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `file_name` varchar(255) NOT NULL,
            `file_type` varchar(100) NOT NULL
        );
    ");


    $db->exec("
    CREATE TABLE IF NOT EXISTS `products` (
        `id` INT PRIMARY KEY AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `quantity` varchar(50) DEFAULT NULL,
        `buy_price` decimal(25,2) DEFAULT NULL,
        `sale_price` decimal(25,2) NOT NULL,
        `categorie_id` int(11) NOT NULL,
        `media_id` int(11) DEFAULT 0,
        `date` datetime NOT NULL,
        FOREIGN KEY (categorie_id) REFERENCES categories(id) ON DELETE CASCADE ON UPDATE CASCADE
    );
    ");


    $db->exec("
        CREATE TABLE IF NOT EXISTS `sales` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `customer_id` int(11) NOT NULL,
            `product_id` int(11) NOT NULL,
            `qty` int(11) NOT NULL,
            `price` decimal(25,2) NOT NULL,
            `date` date NOT NULL,
            FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE ON UPDATE CASCADE,
            FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE ON UPDATE CASCADE
        );
        ");


    $db->exec("
        CREATE TABLE IF NOT EXISTS `user_groups` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `group_name` varchar(150) NOT NULL,
            `group_level` int(11) NOT NULL,
            `group_status` int(1) NOT NULL
    ); 
    ");

    $db->exec("
        CREATE TABLE IF NOT EXISTS `users` (
            `id` INT PRIMARY KEY AUTO_INCREMENT,
            `name` varchar(60) NOT NULL,
            `username` varchar(50) NOT NULL,
            `password` varchar(255) NOT NULL,
            `user_level` int(11) NOT NULL,
            `image` varchar(255) DEFAULT 'no_image.jpg',
            `status` int(1) NOT NULL,
            `last_login` datetime DEFAULT NULL,
            FOREIGN KEY (user_level) REFERENCES user_groups(id) ON DELETE CASCADE ON UPDATE CASCADE
    );
    ");

    $db->exec("
        INSERT IGNORE INTO `categories` (`id`, `name`) VALUES
        (1, 'BOOTS'),
        (2, 'ELBOW PADS'),
        (3, 'FULL BODY GEAR'),
        (4, 'GLOVES'),
        (5, 'HELMETS'),
        (6, 'KNEE PADS');
    ");

    $db->exec("
        INSERT IGNORE INTO `media` (`id`, `file_name`, `file_type`) VALUES
        (1, 'gloves.png', 'image/png'),
        (2, 'elbow pads.png', 'image/png'),
        (3, 'knee pads.png', 'image/png'),
        (4, 'full body gear.jpg', 'image/jpeg'),
        (5, 'boots.png', 'image/jpeg'),
        (6, 'evo vxr-4000 plain.jpg', 'image/jpeg');
    ");

    $db->exec("
        INSERT IGNORE INTO `products` (`id`, `name`, `quantity`, `buy_price`, `sale_price`, `categorie_id`, `media_id`, `date`) VALUES
        (1, 'EVO VXR-4000 PLAIN', '10', 4100.00, 4100.00, 5, 6, CURRENT_TIMESTAMP),
        (2, 'EVO ELBOW PADS', '10', 1499.00, 1499.00, 2, 2, CURRENT_TIMESTAMP),
        (3, 'EVO GLOVES', '10', 1000.00, 1000.00, 4, 1, CURRENT_TIMESTAMP),
        (4, 'EVO KNEE PADS', '10', 3000.00, 3000.00, 6, 3, CURRENT_TIMESTAMP),
        (5, 'EVO FULL BODY GEAR', '10', 19999.00, 19999.00, 3, 4, CURRENT_TIMESTAMP),
        (6, 'EVO BOOTS', '10', 10000.00, 10000.00, 1, 5, CURRENT_TIMESTAMP);
        ");

    $db->exec("
            INSERT IGNORE INTO `user_groups` (`id`, `group_name`, `group_level`, `group_status`) VALUES
            (1, 'Admin', 1, 1),
            (2, 'special', 2, 1),
            (3, 'User', 3, 1);
        ");

    $db->exec("
        INSERT IGNORE INTO `users` (`id`, `name`, `username`, `password`, `user_level`, `image`, `status`, `last_login`) VALUES
        (1, 'Admin', 'Admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'pspsq971.png', 1, CURRENT_TIMESTAMP),
        (2, 'User', 'User', '12dea96fec20593566ab75692c9949596833adc9', 3, 'no_image.png', 1, CURRENT_TIMESTAMP);
    ");
    $db->beginTransaction();
    $db->commit();
} catch (PDOException $e) {
    die("Error creating database: " . $e->getMessage());
}
