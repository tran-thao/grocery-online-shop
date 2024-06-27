SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `assignment1` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `assignment1`;

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `categories` (`category_id`, `category_name`, `parent_id`) VALUES
(2, 'Fruit & Veg', NULL),
(3, 'Fruit', 2),
(4, 'Vegetables', 2),
(5, 'Meat & Seafood', NULL),
(6, 'Meat & Poultry', 5),
(7, 'Seafood', 5),
(9, 'Dairy, Eggs & Fridge', NULL),
(10, 'Milk', 9),
(11, 'Cheese', 9),
(12, 'Yoghurt', 9),
(13, 'Eggs', 9),
(14, 'Snacks', NULL),
(15, 'Chips', 14),
(16, 'Biscuits', 14),
(17, 'Confectionery', 14),
(18, 'Drinks', NULL),
(19, 'Soft drinks', 18),
(20, 'Tea & Coffee', 18);

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) DEFAULT NULL,
  `unit_price` float(8,2) DEFAULT NULL,
  `unit_quantity` varchar(15) DEFAULT NULL,
  `in_stock` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=882004 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `products` (`product_id`, `product_name`, `unit_price`, `unit_quantity`, `in_stock`, `category_id`, `image_url`) VALUES
(11000, 'Cheddar Cheese', 8.00, '500 gram', 1000, 11, './img/products/cheddar.jpg'),
(11001, 'Cheddar Cheese', 15.00, '1000 gram', 1000, 11, './img/products/cheddar.jpg'),
(6000, 'T Bone Steak', 7.00, '1000 gram', 194, 6, './img/products/steak.jpg'),
(2000, 'Navel Oranges', 3.99, 'Bag 20', 1, 3, './img/products/orange.jpg'),
(2001, 'Bananas', 1.49, 'Kilo', 1, 3, './img/products/bananas.jpg'),
(2002, 'Peaches', 2.99, 'Kilo', 500, 3, './img/products/peaches.jpg'),
(2003, 'Grapes', 3.50, 'Kilo', 0, 3, './img/products/grapes.jpg'),
(2004, 'Apples', 1.99, 'Kilo', 500, 3, './img/products/apples.jpg'),
(20000, 'Earl Grey Tea Bags', 2.49, 'Pack 25', 1199, 20, './img/products/earlgrey1.jpg'),
(20001, 'Earl Grey Tea Bags', 7.25, 'Pack 100', 1199, 20, './img/products/earlgrey1.jpg'),
(20002, 'Earl Grey Tea Bags', 13.00, 'Pack 200', 799, 20, './img/products/earlgrey2.jpg'),
(20003, 'Instant Coffee', 2.89, '200 gram', 500, 20, './img/products/instantCoffee1.jpg'),
(20004, 'Instant Coffee', 5.10, '500 gram', 500, 20, './img/products/instantcoffee2.jpg'),
(19000, 'Cola', 1.99, '1.25 liter', 999, 19, './img/products/cola.jpg'),
(4000, 'Carrots', 1.99, '1 kg', 1200, 4, './img/products/carrots.jpg'),
(4001, 'Broccoli', 2.49, '1 bunch', 1000, 4, './img/products/broccoli.jpg'),
(4002, 'Spinach', 2.29, '200 gram', 800, 4, './img/products/spinach.jpg'),
(4003, 'Tomatoes', 1.79, '500 gram', 900, 4, './img/products/tomatoes.jpg'),
(4004, 'Potatoes', 1.49, '1 kg', 1100, 4, './img/products/potatoes.jpg'),
(4005, 'Cucumbers', 1.69, '3 pieces', 1000, 4, './img/products/cucumber.jpg'),
(6001, 'Beef', 7.99, '500 gram', 1498, 6, './img/products/beef.jpg'),
(6002, 'Chicken', 5.99, '1 kg', 995, 6, './img/products/chicken.jpg'),
(6003, 'Pork', 6.99, '500 gram', 1200, 6, './img/products/pork.jpg'),
(6005, 'Chicken Wings', 6.49, '500 gram', 1200, 7, './img/products/chickenwings.jpg'),
(7000, 'Salmon Fillet', 12.99, '250 gram', 800, 7, './img/products/salmon.jpg'),
(7001, 'Prawns', 15.49, '500 gram', 1000, 7, './img/products/prawns.jpg'),
(7002, 'Fish Fillet', 10.99, '500 gram', 1200, 7, './img/products/fishfilet.jpg'),
(10000, 'Full Cream Milk', 2.99, '1 liter', 1499, 10, './img/products/fullcreammilk.jpg'),
(10001, 'Skim Milk', 2.49, '1 liter', 1198, 10, './img/products/skimmilk.jpg'),
(10002, 'Soy Milk', 3.49, '1 liter', 899, 10, './img/products/soymilk.jpg'),
(11002, 'Mozzarella Cheese', 6.49, '200 gram', 1200, 11, './img/products/mozarella.jpg'),
(11003, 'Brie Cheese', 7.99, '200 gram', 900, 11, './img/productsbrie.jpg'),
(12000, 'Greek Yoghurt', 3.49, '500 gram', 1500, 12, './img/products/greekyoghurt.jpg'),
(12001, 'Natural Yoghurt', 2.99, '500 gram', 1200, 12, './img/products/naturalyoghurt.jpg'),
(12002, 'Fruit Yoghurt', 3.99, '500 gram', 900, 12, './img/products/fruityoghurt.jpg'),
(13000, 'Free Range Eggs (Dozen)', 4.99, '12 eggs', 800, 13, './img/products/freerangeeggs.jpg'),
(13001, 'Cage-Free Eggs (Dozen)', 3.49, '12 eggs', 1000, 13, './img/products/cagefreeeggs.jpg'),
(13002, 'Organic Eggs (Dozen)', 5.99, '12 eggs', 1200, 13, './img/products/organiceggs.jpg'),
(15000, 'Potato Chips', 3.49, '150 gram', 0, 15, './img/products/potatochips.jpg'),
(15001, 'Corn Chips', 2.99, '200 gram', 1199, 15, './img/products/cornchips.jpg'),
(15002, 'Tortilla Chips', 3.99, '', 900, 15, './img/products/tortillachips.jpg'),
(16000, 'Chocolate Chip Cookies', 4.49, '200 gram', 999, 16, './img/products/chocolatecookies.jpg'),
(16001, 'Shortbread Biscuits', 3.99, '250 gram', 1199, 16, './img/products/shortbread.jpg'),
(16002, 'Digestive Biscuits', 2.99, '300 gram', 900, 16, './img/products/digestives.jpg'),
(17000, 'Gummy Bears', 2.49, '200 gram', 1499, 17, './img/products/gummy.jpg'),
(17001, 'Licorice Allsorts', 3.99, '', 1200, 17, './img/products/licorice.jpg'),
(17002, 'Chocolate Bar', 1.99, '100 gram', 900, 17, './img/products/chocolatebar.jpg'),
(19001, 'Lemonade', 1.49, '1.5 liter', 1199, 19, './img/products/lemonade.jpg'),
(19002, 'Orange Soda', 1.79, '1.5 liter', 899, 19, './img/products/orangesoda.jpg'),
(20005, 'English Breakfast Tea', 3.49, '50 tea bags', 800, 20, './img/products/englishbreakfast.jpg'),
(20006, 'Green Tea', 2.99, '25 tea bags', 1000, 20, './img/products/greentea.jpg'),
(20007, 'Peppermint Tea', 2.49, '20 tea bags', 1200, 20, './img/products/pepperminttea.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
