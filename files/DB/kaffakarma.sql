-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 15, 2013 at 10:10 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.6-1ubuntu1.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kaffakarma`
--

-- --------------------------------------------------------

--
-- Table structure for table `billitems`
--

CREATE TABLE IF NOT EXISTS `billitems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` double NOT NULL,
  `unit_price` double NOT NULL,
  `amount` double NOT NULL,
  `shipping_amount` double NOT NULL,
  `tax` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bill_id` (`bill_id`,`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE IF NOT EXISTS `bills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_number` varchar(255) NOT NULL,
  `bill_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shipping` smallint(6) NOT NULL DEFAULT '1',
  `shipping_amount` double NOT NULL,
  `tax` double NOT NULL,
  `discount` int(11) NOT NULL,
  `bill_amount` double(10,2) DEFAULT '0.00',
  `bill_status_id` int(11) NOT NULL DEFAULT '1',
  `paymentoption_id` int(11) NOT NULL,
  `paymentdate` int(11) NOT NULL,
  `payment_status_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bill_number` (`bill_number`,`bill_date`),
  KEY `customer_id` (`customer_id`),
  KEY `paymentoption_id` (`paymentoption_id`),
  KEY `payment_status_id` (`payment_status_id`),
  KEY `bill_status_id` (`bill_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE IF NOT EXISTS `business` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `day` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `time_zone` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `comments` text,
  `date` datetime NOT NULL,
  `ipaddress` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city_name` varchar(100) NOT NULL DEFAULT '',
  `state_id` int(10) unsigned DEFAULT NULL,
  `country_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `country_id` (`country_id`,`state_id`,`city_name`),
  KEY `state_id` (`state_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city_name`, `state_id`, `country_id`) VALUES
(13, '', 0, 0),
(14, 'Kochi', NULL, 99),
(15, 'Kochi', 0, 0),
(16, 'cochin', 0, 0),
(17, 'ere', 52, 38),
(18, 'afadsf', 4, 226),
(19, 'abc', 57, 38),
(20, 'city', 0, 38),
(21, 'txtcity', 0, 38);

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

CREATE TABLE IF NOT EXISTS `configurations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `configuration_name` varchar(255) NOT NULL,
  `page_id` int(11) NOT NULL,
  `value` text NOT NULL,
  `description` varchar(255) NOT NULL,
  `language_id` int(11) NOT NULL,
  `configurationtype_id` int(11) NOT NULL,
  `publish` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`,`language_id`),
  KEY `configurationtype_id` (`configurationtype_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `configurationtypes`
--

CREATE TABLE IF NOT EXISTS `configurationtypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `configurationtype_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `configurationtypes`
--

INSERT INTO `configurationtypes` (`id`, `configurationtype_name`, `description`) VALUES
(1, 'Text', 'Text content- can provide link - html editor'),
(2, 'Dynamic Text', 'Text content- no html editor, no link'),
(3, 'Messages', 'Text Messages (Error, Info ...) - can have link - html editor'),
(4, 'Captions', 'Html Elements Captions - can have link - html editor'),
(5, 'Object Captions', 'HTML object caption - no html editor, no link is attaced'),
(6, 'System Conf', 'System Configuration - no link , no html editor');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `country` varchar(100) NOT NULL,
  `country_name` varchar(100) NOT NULL,
  `iso2` char(2) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numericcode` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `country_name` (`country_name`),
  UNIQUE KEY `iso2` (`iso2`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=241 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country`, `country_name`, `iso2`, `iso3`, `numericcode`) VALUES
(38, 'CANADA', 'Canada', 'CA', 'CAN', 124);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `emailid` varchar(100) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `ipaddress` varchar(16) DEFAULT NULL,
  `gender_id` int(11) DEFAULT NULL,
  `registrationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `shipping_address` text NOT NULL,
  `shipping_street` varchar(255) NOT NULL,
  `shipping_city` varchar(255) NOT NULL,
  `shipping_state_id` int(11) NOT NULL,
  `shipping_country_id` int(11) NOT NULL,
  `shipping_postal_code` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `state_id` (`state_id`,`country_id`),
  KEY `shipping_state_id` (`shipping_state_id`,`shipping_country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `address`, `street`, `city`, `state_id`, `country_id`, `postal_code`, `emailid`, `phone`, `ipaddress`, `gender_id`, `registrationdate`, `shipping_address`, `shipping_street`, `shipping_city`, `shipping_state_id`, `shipping_country_id`, `shipping_postal_code`) VALUES
(1, 'pramod', 'menon', 'sreerangam', 'vennala', 'kochi', 51, 38, '123456', 'test@test.com', '123456', '127.0.0.1', -1, '2013-07-22 23:05:53', 'sreerangam', 'vennala', 'kochi', 51, 38, '123456'),
(2, 'Pramod', 'Menon', 'Sreerangam', 'vennala', 'kochi', 51, 38, '123456', 'pramod@legreens.com', '987654', '127.0.0.1', -1, '2013-08-06 00:47:54', 'Sreerangam', 'vennala', 'kochi', 51, 38, '123456'),
(3, 'Pramod', 'Menon', 'Sreerangam', 'vennala', 'kochi', 51, 38, '123456', 'pramod@legreens.com', '987654', '127.0.0.1', -1, '2013-08-06 00:49:34', 'Sreerangam', 'vennala', 'kochi', 51, 38, '123456'),
(4, 'Pramod', 'Menon', 'Sreerangam', 'vennala', 'kochi', 51, 38, '123456', 'pramod@legreens.com', '987654', '127.0.0.1', -1, '2013-08-06 00:50:39', 'Sreerangam', 'vennala', 'kochi', 51, 38, '123456'),
(5, 'Pramod', 'Menon', 'test', 'vennala', 'kochi', 61, 38, '123456', 'pramod@legreens.com', '987654', '127.0.0.1', -1, '2013-08-06 02:13:45', 'test', 'vennala', 'kochi', 61, 38, '123456'),
(6, 'Buyer', 'Test', 'test address', 'street', 'city', 51, 38, '123456', 'buyer-test@kaffakarma.com', '654321', '127.0.0.1', -1, '2013-08-21 01:44:01', 'test address', 'street', 'city', 51, 38, '123456'),
(7, 'pramod', 'menon', 'legreens', 'vennala', 'kochi', 51, 38, '123456', 'pramod@test.com', '654987', '127.0.0.1', -1, '2013-08-27 02:00:39', 'legreens', 'vennala', 'kochi', 51, 38, '123456'),
(8, 'buyer', 'buyer', 'buyer', 'street', 'city', 51, 38, '123456', 'buyer-test@kaffakarma.com', '654321', '127.0.0.1', -1, '2013-08-31 04:54:44', 'buyer', 'street', 'city', 51, 38, '123456'),
(9, 'pramod', 'pramod', 'address', 'vennala', 'city', 51, 38, '123456', 'pramod@test.com', '654321', '127.0.0.1', -1, '2013-09-01 08:56:00', 'address', 'vennala', 'city', 51, 38, '123456'),
(10, 'buyer', 'tester', 'address', 'street', 'city', 52, 38, '123456', 'buyer-test@kaffakarma.com', '654321', '127.0.0.1', -1, '2013-09-02 01:52:48', 'address', 'street', 'city', 52, 38, '123456'),
(11, 'abcd', 'efg', 'address,\\r\\nabcd street', 'abcd', 'abcd', 51, 38, '123456', 'abcd@abcd.com', '654321', '127.0.0.1', -1, '2013-09-03 02:25:00', 'address,\\r\\nabcd street', 'abcd', 'abcd', 51, 38, '123456'),
(12, 'abcd', 'efg', 'address', 'abcd', 'abcd', 51, 38, '123456', 'abcd@abcd.com', '654321', '127.0.0.1', -1, '2013-09-03 02:55:23', '', '', '', -1, -1, ''),
(13, 'abcd', 'efg', 'dasfadf', 'abcd', 'abcd', 51, 38, '123456', 'abcd@abcd.com', '654321', '127.0.0.1', -1, '2013-09-03 02:56:56', 'dasfadf', 'abcd', 'abcd', 51, 38, '123456'),
(14, 'abcd', 'efg', 'aswdad', 'abcd', 'abcd', 52, 38, '123456', 'abcd@abcd.com', '654321', '127.0.0.1', -1, '2013-09-03 02:59:36', 'aswdad', 'abcd', 'abcd', 52, 38, '123456'),
(15, 'abcd', 'efg', 'asdaSD', 'abcd', 'abcd', 51, 38, '123456', 'abcd@abcd.com', '654321', '127.0.0.1', -1, '2013-09-03 03:00:29', '', '', '', -1, -1, ''),
(16, 'abcd', 'efg', 'asdaSD', 'abcd', 'abcd', 51, 38, '123456', 'abcd@abcd.com', '654321', '127.0.0.1', -1, '2013-09-03 03:03:22', '', '', '', -1, -1, ''),
(17, 'abcd', 'efg', 'asdaSD', 'abcd', 'abcd', 51, 38, '123456', 'abcd@abcd.com', '654321', '127.0.0.1', -1, '2013-09-03 03:03:43', '', '', '', -1, -1, ''),
(18, 'HELLO', 'HELLO', 'HELLO', 'HELLO', 'HELLO', 60, 38, '123456', 'hello@hello.com', '654321', '127.0.0.1', -1, '2013-09-03 03:05:31', '', '', '', -1, -1, ''),
(19, 'abcd', 'efg', 'test', 'street', 'city', 51, 38, '123456', 'abcd@abcd.com', '654321', '127.0.0.1', -1, '2013-09-03 03:08:08', '', '', '', -1, -1, ''),
(20, 'abcd', 'efg', 'test', 'street', 'city', 51, 38, '123456', 'abcd@abcd.com', '654321', '127.0.0.1', -1, '2013-09-03 03:08:56', '', '', '', -1, -1, ''),
(21, 'abcd', 'efg', 'test', 'street', 'city', 51, 38, '123456', 'abcd@abcd.com', '654321', '127.0.0.1', -1, '2013-09-03 03:10:05', '', '', '', -1, -1, ''),
(22, 'abcd', 'efg', 'test', 'street', 'city', 51, 38, '123456', 'abcd@abcd.com', '654321', '127.0.0.1', -1, '2013-09-03 03:11:06', '', '', '', -1, -1, ''),
(23, 'sdf', 'sdf', 'sdf', 'abcd', 'abcd', 52, 38, '123456', 'abcd@abcd.com', '654321', '127.0.0.1', -1, '2013-09-03 03:11:31', '', '', '', -1, -1, ''),
(24, 'abcd', 'efg', 'asf', 'abcd', 'abcd', 51, 38, '123456', 'abcd@abcd.com', '654321', '127.0.0.1', -1, '2013-09-03 03:12:15', '', '', '', -1, -1, ''),
(25, 'abcd', 'efg', 'adsfaf', 'abcd', 'abcd', 54, 38, '123456', 'abcd@abcd.com', '654321', '127.0.0.1', -1, '2013-09-05 03:02:19', '', '', '', -1, -1, ''),
(26, 'abcd', 'efg', 'adsfaf', 'abcd', 'abcd', 54, 38, '123456', 'abcd@abcd.com', '654321', '127.0.0.1', -1, '2013-09-05 03:03:17', '', '', '', -1, -1, ''),
(27, 'abcd', 'efg', 'dfghd', 'abcd', 'abcd', 51, 38, '123456', 'abcd@abcd.com', '654321', '127.0.0.1', -1, '2013-09-10 01:19:52', '', '', '', -1, -1, ''),
(28, 'abcd', 'efg', '123', 'abcd', 'abcd', 52, 38, '123456', 'abcd@abcd.com', '654321', '127.0.0.1', -1, '2013-09-10 01:26:46', '', '', '', -1, -1, ''),
(29, 'abcd', 'efg', 'vbnjf', 'abcd', 'abcd', 51, 38, '123456', 'abcd@abcd.com', '654321', '127.0.0.1', -1, '2013-09-10 01:27:51', '', '', '', -1, -1, ''),
(30, 'abcd', 'efg', 'erewqr', 'abcd', 'abcd', 61, 38, '123456', 'abcd@abcd.com', '654321', '127.0.0.1', -1, '2013-09-10 01:30:41', '', '', '', -1, -1, ''),
(31, 'abcd', 'efg', 'dgh', 'abcd', 'abcd', 51, 38, '123456', 'abcd@abcd.com', '654321', '127.0.0.1', -1, '2013-09-10 01:38:55', '', '', '', -1, -1, ''),
(32, 'abcd', 'efg', 'hmg', 'j', 'abcd', 51, 38, '123456', 'abcd@abcd.com', '654321', '127.0.0.1', -1, '2013-09-10 01:39:51', 'hmg', 'j', 'abcd', 51, 38, '123456'),
(33, 'abcd', 'efg', 'srtewt', 'abcd', 'abcd', 51, 38, '123456', 'abcd@abcd.com', '654321', '127.0.0.1', -1, '2013-09-10 01:40:46', 'srtewt', 'abcd', 'abcd', 51, 38, '123456'),
(34, 'abcd', 'efg', 'yghfjhfgjfghj', 'abcd', 'abcd', 51, 38, '123456', 'abcd@abcd.com', '654321', '127.0.0.1', -1, '2013-09-10 01:46:40', 'yghfjhfgjfghj', 'abcd', 'abcd', 51, 38, '123456');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `answer` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`) VALUES
(1, 'How does the partnership between Kaffa Karma and my Non-Profit group or organization work?', '1. Kaffa Karma will create a personalized web site for your Non-Profit Organization FREE of charge to you.\r\n2. You promote coffee sales through the Non-Profit website to generate income for your group. Buy your own coffee and refer others to do the same.\r\n3. Kaffa Karma does all the time consuming work for you by handling all your Non-Profit group sales and product delivery. You just handle the promotion'),
(2, 'How does Kaffa Karma help my Non-Profit group make money?', 'At the end of the month, all sales for the Non-Profit group are totaled and a check is mailed for a percentage of the sales. This is truly stress-free fund raising!'),
(3, 'What is the pricing for the coffee and the percentage of commission paid?', 'Please contact us using the Contact Us link on the website and we will discuss this with you.'),
(4, 'How do members and supporters of the organization pay for the coffee they buy?', 'Kaffa Karma takes payment for coffee orders by Paypal.'),
(5, 'Will I receive confirmation of my order?', 'Yes.\r\n1. Paypal will send a confirmation notification to you by email when your payment is successfully processed.\r\n2. Kaffa Karma will also email an Order Confirmation when your order is complete.'),
(6, 'When will my coffee be delivered?', 'We ship our coffee orders every Wednesday, by courier.'),
(7, 'What is the cost of shipping?', 'The cost of delivery and GST are calculated in the purchase price so there are no additional charges. If you live outside of Alberta, please contact us.'),
(8, 'Are you able to ship to a Post Office Box?', 'No. Kaffa Karma uses a courier so there must be a physical address.'),
(9, 'Do you ship to locations outside of Alberta?', 'At the present time we are shipping locally, however, we plan to expand to other areas so please contact us to make arrangements.'),
(10, 'Do you have questions that are not answered in this FAQ?', 'Please contact us using the Contact Us link on the website and we will get back to you as quickly as possible. Usually you will hear from us within 48 hours, however it could be much sooner than that. We look forward to speaking with you. Thanks.');

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE IF NOT EXISTS `genders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`id`, `name`, `description`) VALUES
(1, 'Male', NULL),
(2, 'Female', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `item_status_id` int(11) NOT NULL,
  `item_type_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `keywords` text,
  `unit_price` double NOT NULL,
  `unit_weight` double NOT NULL,
  `max_shipping_unit` double NOT NULL,
  `shipping_rate` double NOT NULL,
  `tax_item` double NOT NULL,
  `tax_shipping` double NOT NULL,
  `commission` double NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `item_status_id` (`item_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `item_status_id`, `item_type_id`, `image`, `keywords`, `unit_price`, `unit_weight`, `max_shipping_unit`, `shipping_rate`, `tax_item`, `tax_shipping`, `commission`) VALUES
(1, 'Medium Roast', 'Our Paradise Mountain beans are roasted to a full medium roast to produce a sweet, lightly dry cup with a pleasant flowery aroma. Well-balanced with a delicate body, our Single-Farm Medium offers an exceptionally vibrant beginning with a honey like, dry finish. It is a likable and easy drinking cup of coffee to enjoy anytime of the day.', 1, 1, 'MediumRoast.jpeg', 'Coffee', 15, 1, 25, 12.5, 0, 5, 1),
(2, 'Dark Roast', 'Our Paradise Mountain dark beans are slow roasted to create a dark, exotic cup with an intensely bold flavor. Lively, with an earthy, acidic undertone and a slightly chocolate aroma, our dark roast is full bodied with a spicy dry finish. This coffee is excellent in the morning or paired with your favorite dessert.', 1, 1, 'DarkRoast.jpeg', 'Coffee', 15, 1, 25, 12.5, 0, 5, 1),
(3, 'Estate Blend', 'This blend was specially developed to produce a coffee that reflects all of the characteristics of Paradise Mountain Organic Coffee. Each varietal is individually roasted in order to showcase its own unique profile. Right from the start, this coffee presents an exotic flowery aroma. In the cup, it is full bodied with a wide range of depth. The finish is slightly smoky with hints of mocha and berries. This coffee is best enjoyed on its own to appreciate its complexity.', 1, 1, 'EstateBlend.jpeg', 'Estate Blend Coffee Kaffakarma', 15, 1, 25, 12.5, 0, 5, 1),
(4, 'Angel’s Espresso Blend', 'This blend a rare combination of six origin beans makes up this highly popular, smooth, rich espresso. A combination of South American and Indonesian beans this espresso is flavored for its slightly sweet and winey undertones. With a pleasant, dry mocha finish, this espresso carries well with any milk based drink or especially on its own.', 1, 1, 'Expresso.jpeg', 'Angel’s Espresso Blend Coffee Kaffakarma Angel', 15, 1, 25, 12.5, 0, 5, 1),
(5, 'SWP Decaf Blend', 'From our farm in Thailand we bring our green beans to Burnaby, Canada, where they are decaffeinated via the Swiss Water Process. This is the only method that preserves the organic status of coffee. The distinct characteristics of our Thailand farm coffees are as present as ever. Exotic flowery aromas, smooth yet full bodied and a slightly dry mocha finish, just now available in decaffeinated version.', 1, 1, 'decaf.jpeg', 'SWP Decaf Blend Coffee Kaffakarma', 15, 1, 25, 12.5, 0, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `itemstatuses`
--

CREATE TABLE IF NOT EXISTS `itemstatuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `itemstatuses`
--

INSERT INTO `itemstatuses` (`id`, `name`, `description`) VALUES
(1, 'In Stock', 'In Stock'),
(2, 'Out of Stock', 'Out of Stock');

-- --------------------------------------------------------

--
-- Table structure for table `itemtypes`
--

CREATE TABLE IF NOT EXISTS `itemtypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `itemtypes`
--

INSERT INTO `itemtypes` (`id`, `name`, `description`) VALUES
(1, 'Kaffakarma Only', 'Items used in Kaffakarma subsites Only'),
(2, 'All', 'Items used in all other subsites');

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE IF NOT EXISTS `keywords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language_name` varchar(255) NOT NULL,
  `publish` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language_name`, `publish`) VALUES
(1, 'English', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentmessage_id` int(11) DEFAULT NULL,
  `fromuser_id` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `address` varchar(50) NOT NULL DEFAULT '',
  `phone` int(11) NOT NULL DEFAULT '0',
  `emailid` text NOT NULL,
  `ipaddress` text NOT NULL,
  `touser_id` int(11) NOT NULL DEFAULT '0',
  `submit_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `subject` text NOT NULL,
  `content` text NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '0',
  `messagetype_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `messagetypes`
--

CREATE TABLE IF NOT EXISTS `messagetypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `messagetype_name` varchar(20) NOT NULL DEFAULT '',
  `description` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `messagetypes`
--

INSERT INTO `messagetypes` (`id`, `messagetype_name`, `description`) VALUES
(1, 'Guestbook', ''),
(2, 'Messageboard', ''),
(3, 'Quickcontact', ''),
(4, 'Forum', '');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE IF NOT EXISTS `orderitems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` double NOT NULL,
  `unit_price` double NOT NULL,
  `amount` double NOT NULL,
  `shipping_amount` double NOT NULL,
  `tax` double NOT NULL,
  `commission` double NOT NULL,
  `commission_amount` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`,`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_number` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shipping` smallint(6) NOT NULL DEFAULT '1',
  `shipping_amount` double NOT NULL,
  `tax` double NOT NULL,
  `order_amount` double(10,2) DEFAULT '0.00',
  `commission_amount` double NOT NULL,
  `order_status_id` int(11) NOT NULL DEFAULT '1',
  `paymentoption_id` int(11) NOT NULL DEFAULT '1',
  `paymentdate` datetime DEFAULT NULL,
  `paymentdetail` varchar(255) DEFAULT NULL,
  `payment_status_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_number` (`order_number`,`order_date`),
  KEY `customer_id` (`customer_id`),
  KEY `order_status_id` (`order_status_id`),
  KEY `paymentoption_id` (`paymentoption_id`),
  KEY `payment_status_id` (`payment_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_name`) VALUES
(1, 'index'),
(2, 'sitemap'),
(3, 'terms_of_use'),
(4, 'disclaimer'),
(5, 'privacy_policy'),
(6, 'contact_us'),
(7, 'about_us'),
(8, 'about_the_coffee'),
(9, 'coffee');

-- --------------------------------------------------------

--
-- Table structure for table `paymentoptions`
--

CREATE TABLE IF NOT EXISTS `paymentoptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `paymentoptions`
--

INSERT INTO `paymentoptions` (`id`, `name`, `description`) VALUES
(1, 'Cash', 'Cash Payment'),
(2, 'PayPal', 'Paypal Payment');

-- --------------------------------------------------------

--
-- Table structure for table `paypal`
--

CREATE TABLE IF NOT EXISTS `paypal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `txn_id` varchar(255) DEFAULT NULL,
  `txn_date` datetime NOT NULL,
  `txn_type` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `notification` text NOT NULL,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `securityquestions`
--

CREATE TABLE IF NOT EXISTS `securityquestions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `securityquestions`
--

INSERT INTO `securityquestions` (`id`, `question`) VALUES
(1, 'What is your pet''s name?'),
(2, 'What is your favourite food? '),
(3, 'who is your favourite celebrity?'),
(4, 'I hate ?');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `state_name` varchar(100) NOT NULL DEFAULT '',
  `statecode` char(3) DEFAULT NULL,
  `country_id` smallint(5) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `state_name` (`state_name`,`country_id`),
  KEY `country_id` (`country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state_name`, `statecode`, `country_id`) VALUES
(51, 'Alberta', 'AAC', 38),
(52, 'British Columbia', 'BCC', 38),
(53, 'Manitoba', 'MAC', 38),
(54, 'New Brunswick', 'NBC', 38),
(55, 'Newfoundland and Labrador', 'NLC', 38),
(57, 'Nova Scotia', 'NSC', 38),
(59, 'Ontario', 'OOC', 38),
(60, 'Prince Edward Island', 'PEC', 38),
(61, 'Quebec', 'QCC', 38),
(62, 'Saskatchewan', 'SNC', 38),
(63, 'Yukon', 'YNC', 38);

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE IF NOT EXISTS `userdetails` (
  `id` int(10) unsigned NOT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `fax` varchar(16) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `description` text,
  `gender_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `useritems`
--

CREATE TABLE IF NOT EXISTS `useritems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `unit_price` double NOT NULL,
  `active` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL DEFAULT '',
  `userpassword` varchar(32) NOT NULL DEFAULT '',
  `usertype_id` tinyint(3) unsigned NOT NULL DEFAULT '3',
  `firstname` varchar(100) NOT NULL DEFAULT '',
  `lastname` varchar(100) NOT NULL DEFAULT '',
  `emailid` varchar(100) NOT NULL DEFAULT '',
  `address` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `city_id` varchar(100) DEFAULT NULL,
  `state_id` int(10) unsigned DEFAULT NULL,
  `country_id` smallint(5) unsigned DEFAULT NULL,
  `ipaddress` varchar(16) DEFAULT NULL,
  `registrationdate` datetime NOT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `userstatus_id` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `image` varchar(255) DEFAULT NULL,
  `securityquestion_id` int(11) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`),
  KEY `usertype_id` (`usertype_id`),
  KEY `userstatus_id` (`userstatus_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `userpassword`, `usertype_id`, `firstname`, `lastname`, `emailid`, `address`, `street`, `city_id`, `state_id`, `country_id`, `ipaddress`, `registrationdate`, `lastlogin`, `userstatus_id`, `image`, `securityquestion_id`, `answer`) VALUES
(1, 'admin', '85587e3aa839ec03b0967408ca2192f9', 1, 'Admin', '', '', '', NULL, '16', 0, 0, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, NULL, 1, 'neelan');

-- --------------------------------------------------------

--
-- Table structure for table `userstatuses`
--

CREATE TABLE IF NOT EXISTS `userstatuses` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `userstatus_name` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `userstatus_name` (`userstatus_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `userstatuses`
--

INSERT INTO `userstatuses` (`id`, `userstatus_name`, `description`) VALUES
(1, 'Active', 'Active'),
(2, 'To be activated', 'Email activation required'),
(3, 'Suspended', 'Suspended'),
(4, 'Disabled', 'Disabled');

-- --------------------------------------------------------

--
-- Table structure for table `usertypes`
--

CREATE TABLE IF NOT EXISTS `usertypes` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `usertype_name` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `loggedin_page` varchar(255) NOT NULL DEFAULT 'profile.php',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usertype_name` (`usertype_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `usertypes`
--

INSERT INTO `usertypes` (`id`, `usertype_name`, `description`, `loggedin_page`) VALUES
(1, 'Admin', 'Administrator', 'profile.php'),
(2, 'Employee', 'Employee', 'profile.php'),
(3, 'User[charity]', 'Registered User', 'profile.php');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
