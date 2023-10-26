-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.34 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table egrocery.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table egrocery.category: ~3 rows (approximately)
INSERT INTO `category` (`id`, `category_name`) VALUES
	(1, 'cat 1'),
	(2, 'cat 2'),
	(3, 'cat 3');

-- Dumping structure for table egrocery.order
CREATE TABLE IF NOT EXISTS `order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `oid` mediumtext NOT NULL,
  `date` date DEFAULT NULL,
  `orderStatus_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_orderStatus1_idx` (`orderStatus_id`),
  KEY `fk_order_user1_idx` (`user_id`),
  CONSTRAINT `fk_order_orderStatus1` FOREIGN KEY (`orderStatus_id`) REFERENCES `orderstatus` (`id`),
  CONSTRAINT `fk_order_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table egrocery.order: ~1 rows (approximately)
INSERT INTO `order` (`id`, `oid`, `date`, `orderStatus_id`, `user_id`) VALUES
	(1, '123', '2023-10-05', 1, 2);

-- Dumping structure for table egrocery.orderstatus
CREATE TABLE IF NOT EXISTS `orderstatus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table egrocery.orderstatus: ~2 rows (approximately)
INSERT INTO `orderstatus` (`id`, `status`) VALUES
	(1, 'Pending'),
	(2, 'Deliverd');

-- Dumping structure for table egrocery.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `discription` longtext,
  `img_path` varchar(45) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  `category_id` int NOT NULL,
  `priceQty` varchar(45) DEFAULT NULL,
  `unit_id` int NOT NULL,
  `smapleDis` longtext,
  PRIMARY KEY (`id`),
  KEY `fk_product_category_idx` (`category_id`),
  KEY `fk_product_unit1_idx` (`unit_id`),
  CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `fk_product_unit1` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table egrocery.product: ~14 rows (approximately)
INSERT INTO `product` (`id`, `name`, `discription`, `img_path`, `price`, `category_id`, `priceQty`, `unit_id`, `smapleDis`) VALUES
	(1, 'Apple', 'Crisp and sweet, apples are a versatile and nutritious fruit available in various types for your everyday needs', 'poductimg1.jpeg', '1500', 1, '1', 1, 'Crisp and sweet, apples are a versatile and nutritious fruit available in various types for your everyday needs'),
	(2, 'Bananas', 'Creamy and energy-packed, our bananas are your daily fuel, perfect for on-the-go snacking and adding a natural sweetness to smoothies.', 'poductimg1.jpeg', '2580', 1, '500', 3, 'In publishing and graphic design, Lorem ipsum'),
	(3, 'Oranges', 'Zesty, vitamin C-rich orbs of refreshment, bringing a burst of health and natural tang to your day.', 'poductimg1.jpeg', '2693', 1, '1', 1, 'In publishing and graphic design, Lorem ipsum'),
	(4, 'Strawberries', 'Our succulent strawberries are sweet, antioxidant-packed delights, perfect for guilt-free snacking and adding a burst of flavor to your meals', 'poductimg1.jpeg', '100', 1, '1', 3, 'In publishing and graphic design, Lorem ipsum'),
	(5, 'Lettuce', 'Crisp, fresh, and versatile, our lettuce elevates salads and sandwiches, adding a burst of greens to your meals', 'poductimg1.jpeg', '1000', 1, '1', 2, 'In publishing and graphic design, Lorem ipsum'),
	(6, 'Tomatoes', 'Juicy, ripe, and vibrant, our tomatoes infuse dishes with natural sweetness and a pop of color.', 'poductimg1.jpeg', '1000', 1, '1', 2, 'In publishing and graphic design, Lorem ipsum'),
	(7, 'Carrots', 'Crunchy, sweet, and nutrient-packed, our carrots make snacking and cooking healthier and tastier.', 'poductimg1.jpeg', '1000', 1, '1', 2, 'In publishing and graphic design, Lorem ipsum'),
	(8, 'Broccoli', 'Nutrient-rich, tender, and versatile, our broccoli adds a delicious, wholesome touch to your favorite recipes.', 'poductimg1.jpeg', '1000', 1, '1', 2, 'In publishing and graphic design, Lorem ipsum'),
	(9, 'product 9', '', 'poductimg1.jpeg', '1000', 2, '1', 2, 'In publishing and graphic design, Lorem ipsum'),
	(10, 'product 10', '', 'poductimg1.jpeg', '1000', 2, '1', 2, 'In publishing and graphic design, Lorem ipsum'),
	(11, 'product 11', '', 'poductimg1.jpeg', '5560', 3, '1', 2, 'In publishing and graphic design, Lorem ipsum'),
	(12, 'product 13', '', 'poductimg1.jpeg', '5560', 3, '1', 2, 'In publishing and graphic design, Lorem ipsum'),
	(13, 'product 14', '', 'poductimg1.jpeg', '5560', 3, '1', 2, 'In publishing and graphic design, Lorem ipsum'),
	(16, 'product 15', '', 'poductimg1.jpeg', '5560', 3, '1', 2, 'In publishing and graphic design, Lorem ipsum');

-- Dumping structure for table egrocery.unit
CREATE TABLE IF NOT EXISTS `unit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table egrocery.unit: ~3 rows (approximately)
INSERT INTO `unit` (`id`, `unit_name`) VALUES
	(1, 'uni1'),
	(2, 'unit 2'),
	(3, 'uni 3');

-- Dumping structure for table egrocery.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` longtext NOT NULL,
  `date` date NOT NULL,
  `contact` varchar(50) NOT NULL,
  `address` mediumtext NOT NULL,
  `userType_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_userType1_idx` (`userType_id`),
  CONSTRAINT `fk_user_userType1` FOREIGN KEY (`userType_id`) REFERENCES `usertype` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table egrocery.user: ~2 rows (approximately)
INSERT INTO `user` (`id`, `name`, `email`, `pass`, `date`, `contact`, `address`, `userType_id`) VALUES
	(1, 'admin', 'admin@gmail.com', '$2y$10$NhYc7mLEyKFtCdT6bYpR5eeJcDXg7B4GZ5wyiskEWlSTOuvvzXTdy', '2023-10-02', '07716154855', 'admin add', 2),
	(2, 'user', 'user@gmail.com', '$2y$10$NhYc7mLEyKFtCdT6bYpR5eeJcDXg7B4GZ5wyiskEWlSTOuvvzXTdy', '2023-10-04', '0771617400', 'usser add', 1);

-- Dumping structure for table egrocery.usertype
CREATE TABLE IF NOT EXISTS `usertype` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userType` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table egrocery.usertype: ~2 rows (approximately)
INSERT INTO `usertype` (`id`, `userType`) VALUES
	(1, 'user'),
	(2, 'admin');

-- Dumping structure for table egrocery.user_has_product
CREATE TABLE IF NOT EXISTS `user_has_product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `order_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_has_product_product1_idx` (`product_id`),
  KEY `fk_user_has_product_user1_idx` (`user_id`),
  KEY `fk_user_has_product_order1_idx` (`order_id`),
  CONSTRAINT `fk_user_has_product_order1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  CONSTRAINT `fk_user_has_product_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_user_has_product_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table egrocery.user_has_product: ~2 rows (approximately)
INSERT INTO `user_has_product` (`id`, `user_id`, `product_id`, `order_id`) VALUES
	(1, 2, 10, 1),
	(2, 2, 3, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
