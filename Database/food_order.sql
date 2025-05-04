-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2025 at 06:08 PM
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
-- Database: `food_order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `created_at`, `password`) VALUES
(10, 'Janvi Soni', 'admin', '2025-04-23 09:11:59', '$2y$10$7cNVqR7gIxs7JXfr.BKfMOZCPmnRqdeZ9dkKOXYchfuDjFMwTqocK'),
(14, 'Kashish ', 'Web developer', '2025-04-23 09:22:54', '$2y$10$ogi.jrw6.SUnv9zUhp1ErONSWPKsIzjM0TmktsbcYOBqBIaeW1zkm');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `id` int(30) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `feature` varchar(40) NOT NULL,
  `active` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`id`, `title`, `image_name`, `feature`, `active`) VALUES
(1, 'Sandwich', 'sandwich.jpg', 'Yes', 'Yes'),
(2, 'Pizza', 'pizza2.jpg', 'Yes', 'Yes'),
(3, 'Burger', 'Burger1.jpg', 'Yes', 'Yes'),
(4, 'Pasta', 'Pasta1.jpg', 'Yes', 'Yes'),
(5, 'Chinese', 'chinese.jpg', 'Yes', 'Yes'),
(6, 'Soup', 'soup.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_contact`
--

INSERT INTO `tbl_contact` (`id`, `name`, `email`, `subject`, `message`, `submitted_at`) VALUES
(1, 'janvi lumbhani', 'lumbhanijanvi59@gmail.com', 'regarding a delivary..', 'your service is really good...', '2025-05-01 12:48:10'),
(2, 'janvi lumbhani', 'lumbhanijanvi59@gmail.com', 'regarding a delivary..', 'your service is really good...', '2025-05-01 12:51:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(30) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(200) NOT NULL,
  `description` varchar(300) NOT NULL,
  `category_id` int(40) UNSIGNED NOT NULL,
  `feature` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `price`, `image_name`, `description`, `category_id`, `feature`, `active`) VALUES
(1, ' Breakfast Sandwiches', 100.00, 'breckfastsandwich.jpg', ' Spiced, grilled paneer cubes with onions and green chutney inside toasted bread.\r\n\r\n', 1, 'Yes', 'Yes'),
(2, 'Vegetarian Sandwiches', 110.00, 'vegitariansandwich.jpg', ' A mix of fresh veggies like cucumber, tomato, and lettuce with sauces.', 1, 'Yes', 'Yes'),
(3, 'Classic Sandwiches', 160.00, 'classicsandwich.jpg', 'Club Sandwich – Triple-layered with  lettuce, tomato, bacon, and mayo.\r\n\r\n', 1, 'Yes', 'Yes'),
(4, 'Specialty Sandwiches', 180.00, 'specialsandwich.jpg', 'Sub Sandwich – Long roll filled with meats, veggies, and cheese (customizable).\r\n\r\n', 1, 'Yes', 'Yes'),
(5, 'Paneer Tikka Pizza ', 279.00, 'PaneerTikkaPizza.jpg', 'Spiced paneer chunks with capsicum and onion on a cheesy base with Indian herbs.', 2, 'Yes', 'Yes'),
(6, 'Pepperoni Pizza ', 299.00, 'PepperoniPizza.jpg', 'Crispy and spicy pepperoni slices over gooey cheese and tangy tomato sauce.', 2, 'Yes', 'Yes'),
(7, 'Farmhouse Pizza', 249.00, 'FarmHousePizza.jpg', 'Loaded with onions, capsicum, tomatoes, mushrooms, and mozzarella — perfect for veggie lovers.', 2, 'Yes', 'Yes'),
(8, 'Margherita Pizza', 199.00, 'cheese_pizza.jpg', 'Classic Italian pizza topped with fresh tomatoes, mozzarella cheese, and basil.', 2, 'Yes', 'Yes'),
(9, 'Crispy Chicken Burger', 159.00, 'CrispyChickenBurger.jpg', 'Crispy fried chicken patty with lettuce and tangy mayo in a toasted bun.', 3, 'Yes', 'Yes'),
(10, 'Paneer Burger', 149.00, 'PaneerBurger.jpg', 'Grilled paneer slice marinated in Indian spices with lettuce and spicy mayo.', 3, 'Yes', 'Yes'),
(11, 'Cheese Burger', 129.00, 'CheeseBurger.jpg', 'Loaded with cheddar cheese, fresh veggies, and a grilled patty for a cheesy delight.', 3, 'Yes', 'Yes'),
(12, 'Classic Veg Burger', 99.00, 'ClassicVegBurger.jpg', 'Crispy vegetable patty with lettuce, tomato, onion, and creamy mayo in a soft bun.', 3, 'Yes', 'Yes'),
(13, 'Mix Sauce Pasta', 189.00, 'MixSaucePasta.jpg', 'A delicious blend of white and red sauces with veggies and Italian herbs.\r\n\r\n', 4, 'Yes', 'Yes'),
(14, 'Red Sauce Pasta', 169.00, 'RedSaucePasta.jpg', 'Pasta cooked in a tangy tomato-based sauce with garlic, chili flakes, and basil.', 4, 'Yes', 'Yes'),
(15, 'White Sauce Pasta', 179.00, 'WhiteSaucePasta.jpg', 'Creamy pasta tossed in rich white sauce with herbs, garlic, and sautéed vegetables.', 4, 'Yes', 'Yes'),
(16, 'Veggie Delight Pasta ', 169.00, 'VeggieDelightPasta.jpg', 'Colorful mix of bell peppers, broccoli, corn, and onions in your choice of sauce.', 4, 'Yes', 'Yes'),
(17, 'Veg Fried Rice', 139.00, 'VegFriedRice.jpg', 'Fragrant rice stir-fried with carrots, beans, spring onions, and soy sauce.', 5, 'Yes', 'Yes'),
(18, 'Veg Hakka Noodles ', 149.00, 'VegHakkaNoodles.jpg', 'Stir-fried noodles with mixed vegetables, soy sauce, and Chinese spices.\r\n\r\n', 5, 'Yes', 'Yes'),
(19, 'Veg Manchurian', 159.00, 'VegManchurian.jpg', 'Fried vegetable balls in a spicy Indo-Chinese sauce.', 5, 'Yes', 'Yes'),
(20, 'Spring Rolls', 129.00, 'SpringRollsVeg.jpg', 'Crispy rolls stuffed with seasoned vegetables and deep-fried to perfection.', 5, 'Yes', 'Yes'),
(21, 'Manchow Soup (Veg)', 119.00, 'ManchowSoupVeg.jpg', 'Thick spicy soup with chopped vegetables, garlic, and crispy noodles topping.', 6, 'Yes', 'Yes'),
(22, 'Hot and Sour Soup (Veg)', 119.00, 'HotandSourSoupVeg.jpg', 'Spicy and tangy soup made with vegetables, vinegar, and soy sauce.', 6, 'Yes', 'Yes'),
(23, 'Sweet Corn Soup (Veg)', 109.00, 'SweetCornSoupVeg.jpg', 'Mild and creamy soup with sweet corn kernels and chopped vegetables.', 6, 'Yes', 'Yes'),
(24, 'Tomato Soup', 99.00, 'TomatoSoup.jpg', 'Classic creamy tomato soup garnished with herbs and croutons.', 6, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `food` varchar(150) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `customer_contact` varchar(20) DEFAULT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `customer_address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'Pepperoni Pizza ', 299.00, 2, 598.00, '2025-05-02 19:20:04', 'Ordered', 'kashish solanki', '9724850209', 'lumbhanijanvi59@gmail.com', 'hariparpad,mtv hotel\r\ngreen view park'),
(2, 'Pepperoni Pizza ', 299.00, 2, 598.00, '2025-05-02 19:28:28', 'Ordered', 'kashish solanki', '9724850209', 'lumbhanijanvi59@gmail.com', 'hariparpad,mtv hotel\r\ngreen view park'),
(3, 'Paneer Tikka Pizza ', 279.00, 2, 558.00, '2025-05-02 19:29:17', 'Ordered', 'jigna soni', '3456776543', 'jigna@gmail.com', 'raiya chocdi,rajkot'),
(4, 'Paneer Tikka Pizza ', 279.00, 2, 558.00, '2025-05-02 19:31:40', 'Completed', 'jigna soni', '3456776543', 'jigna@gmail.com', 'raiya chocdi,rajkot'),
(5, ' Breakfast Sandwiches', 100.00, 2, 200.00, '2025-05-02 19:36:26', 'Ordered', 'jinal lunagariya', '2345678923', 'jinal@gmail.com', 'sadhu vasvani road, rajkot'),
(6, ' Breakfast Sandwiches', 100.00, 2, 200.00, '2025-05-02 19:40:56', 'Ordered', 'jinal lunagariya', '2345678923', 'jinal@gmail.com', 'sadhu vasvani road, rajkot'),
(7, ' Breakfast Sandwiches', 100.00, 1, 100.00, '2025-05-02 19:41:29', 'Ordered', 'xyz', '2345678987', 'judhfd@gmail.com', 'ndjfbgfkgkd'),
(8, ' Breakfast Sandwiches', 100.00, 1, 100.00, '2025-05-02 19:47:21', 'Ordered', 'cxv', '3434457667', 'admin@gmail.com', 'rajkot,gujarat\r\n-'),
(9, ' Breakfast Sandwiches', 100.00, 1, 100.00, '2025-05-02 19:52:38', 'Ordered', 'cxv', '3434457667', 'admin@gmail.com', 'rajkot,gujarat\r\n'),
(10, ' Breakfast Sandwiches', 100.00, 1, 100.00, '2025-05-02 19:57:50', 'Ordered', 'cxv', '3434457667', 'admin@gmail.com', 'rajkot,gujarat\r\n'),
(12, 'White Sauce Pasta', 179.00, 2, 358.00, '2025-05-03 08:24:07', 'Ordered', 'janvi lumbhani', '09945678934', 'admin@gmail.com', 'hariparpad,mtv hotel\r\ngreen view park'),
(13, 'Vegetarian Sandwiches', 110.00, 1, 110.00, '2025-05-03 08:55:50', 'Ordered', 'jiten jodiya', '1234567892', 'jiten23@gmail.com', 'nanavati chock,rajkot-360006');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UName` (`username`);

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(30) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
