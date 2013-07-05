-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 05, 2013 at 03:34 PM
-- Server version: 5.1.67
-- PHP Version: 5.3.2-1ubuntu4.18

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kaff`
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

--
-- Dumping data for table `billitems`
--


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

--
-- Dumping data for table `bills`
--


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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `business`
--


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

--
-- Dumping data for table `categories`
--


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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city_name`, `state_id`, `country_id`) VALUES
(13, '', 0, 0),
(14, 'Kochi', NULL, 99),
(15, 'Kochi', 0, 0),
(16, 'cochin', 0, 0),
(17, 'ere', 52, 38),
(18, 'afadsf', 4, 226);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`id`, `configuration_name`, `page_id`, `value`, `description`, `language_id`, `configurationtype_id`, `publish`) VALUES
(1, 'Home Page Content', 1, '<p>Kaffa Karma is a family owned and operated company that was founded on the principles of Paying It Forward.</p><br />\n<p>The owners have been an active part of the Calgary community for four generations and have watched this thriving metropolis take form.</p><br />\n<p>Over the years, as our children have grown and participated in community events, sporting groups and clubs, we&#39;ve been involved in a TON of fund raisers. Kaffa Karma is just that! Fund raising on cruise control!</p><br /><p>We work with your group or organization to raise funds without the early morning bottle drives or hours working in a bingo hall. Kaffa Karma will brand and market Organic Gourmet 100% Arabica Coffee for your group. We handle the order processing and arrange for the delivery of the product... so, all you do is collect a check at the end of the month.</p><br /><div id = "fund_raiser_button"></div><!--div id = "equipments_big_button"></div--><br />\n          <br />\n', 'Dynamic index content', 1, 1, 0),
(2, 'Our Showcase', 8, '<p>&nbsp;</p><h1>Our Showcase</h1>At 800-1,500 feet above sea level, located in the Northern Chiang Mai Region of Thailand, Paradise Mountain Organic Farm lies within the virgin forest. Thousands of indigenous trees create a canopy of shade for young coffee seedlings and a resting and nesting habitat for local and migratory birds. Today, if you were to view our farm from above you would never know there was a farm of any kind in this undisturbed forest. It is here that we grow 100% World class single farm, organic Arabica coffee.<br /><p>Using a method known as rustic traditional coffee farming, we grow our coffee without chemical fertilizers or pesticides. When we first began planting we did so without killing a single tree, this wild crafted method of planting is slow and difficult but it fits our vision of a good farm. Our neighboring rain forest and small scale tea growers are also free of any pesticides and chemicals so no cross contamination occurs on or around our farm. All strains of our coffee are planted on GPS coordinated plots in correspondence with the plantation area in order for us to identify and separate the various types of coffee we grow. Our coffee is shade grown and all of the foliage and mulch is put back into the soil to be used as a natural fertilizer, after months of care and preparation our coffee is ready for harvest, here we hand sort and follow the wet processing method using creek spring water. From here we leave our coffee in its final parchment stage in order to maintain the coffee&rsquo;s integrity and provide a natural barrier. Upon orders our coffee is hulled and the green beans are then shipped to the Rocky Mountains to be roasted exclusively by renowned Roast Master Shawn McDonald and the roasters at Joffee&rsquo;s Coffee, Calgary&rsquo;s only certified organic roasting plant.</p><p>After years of hard work the Paradise Mountain Organics family now extends from Thailand to British Columbia and Alberta. Each and every person involved in this project shares a passion for coffee and a great deal of respect for both humanity and the environment. In every cup we pass along our story and vision in hopes to educate coffee lovers on the ethical, direct trade and sustainable practices of the coffee industry. From growing to roasting to now enjoying a cup of this world class coffee we welcome you to be a part of Paradise Mountain Organics.<br />&nbsp;</p>', 'Dynamic about_the_coffee content', 1, 1, 1),
(3, 'Contact Information', 6, '<br />\n<h1>Contact Information</h1><br />\nKaffa Karma <br /><br />\nCanada<br /><br />\nemail:  admin@kaffakarma.com<br /><br />\nPh: 123456789<br /><br />\n          <br />\n', 'Dynamic contact_us content', 1, 1, 0),
(4, 'About Us', 7, '<br /> <h1>About Us</h1><br />Kaffa Karma is just ... fund raising on cruise control!<br /><br /> Kaffa Karma is a family owned and operated company that was founded on the principals of paying it forward. The owners have been an active part of the Calgary community for four generations and have watched this thriving metropolis take form. over the years as our children have grown and participated in community events, sporting groups and clubs and as such we''ve been involved in a TON of fund raisers.<br />   <br />', 'Dynamic about_us content', 1, 1, 1),
(5, 'Home Page Content', 1, '<p>Kaffa Karma is a family owned and operated company that was founded on the principles of Paying It Forward.</p><br />\n<p>The owners have been an active part of the Calgary community for four generations and have watched this thriving metropolis take form.</p><br />\n<p>Over the years, as our children have grown and participated in community events, sporting groups and clubs, we&#39;ve been involved in a TON of fund raisers. Kaffa Karma is just that! Fund raising on cruise control!</p><br /><p>We work with your group or organization to raise funds without the early morning bottle drives or hours working in a bingo hall. Kaffa Karma will brand and market Organic Gourmet 100% Arabica Coffee for your group. We handle the order processing and arrange for the delivery of the product... so, all you do is collect a check at the end of the month.</p><br /><div id = "fund_raiser_button"></div><!--div id = "equipments_big_button"></div--><br />\n          <br />\n', 'Dynamic index content', 0, 0, 0),
(6, 'Terms and Conditions', 3, '<br />\n<h1>Terms and Conditions</h1><br />\n<p>Terms and Conditions .. </p><br />\n          <br />\n', 'Dynamic terms_of_use content', 0, 0, 0),
(7, 'Disclaimer', 4, '<br />\n<h1>Disclaimer</h1><br />\n<p>Disclaimer content .. </p><br />\n          <br />\n', 'Dynamic disclaimer content', 0, 0, 0),
(8, 'Sitemap', 2, '<br />\n<h1>Sitemap</h1><br />\n<p>sitemap content .. </p><br />\n          <br />\n', 'Dynamic sitemap content', 0, 0, 0),
(9, 'Privacy Policy', 5, '<br />\n<h1>Privacy Policy</h1><br />\n<p>privacy policy content .. </p><br />\n          <br />\n', 'Dynamic privacy_policy content', 0, 0, 0);

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
(38, 'CANADA', 'Canada', 'CA', 'CAN', 124),
(226, 'UNITED STATES', 'United States', 'US', 'USA', 840),
(240, 'Other', 'Other', '', NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `address`, `street`, `city`, `state_id`, `country_id`, `postal_code`, `emailid`, `phone`, `ipaddress`, `gender_id`, `registrationdate`, `shipping_address`, `shipping_street`, `shipping_city`, `shipping_state_id`, `shipping_country_id`, `shipping_postal_code`) VALUES
(1, 'dafa', 'afsf', 'afa', 'afaf', 'afsaf', 5, 38, 'afasf', 'pramod@test.com', 'afsasf', '127.0.0.1', -1, '2013-06-27 23:04:43', '', '', '', 0, 0, '');

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
  `tax_item` double NOT NULL,
  `tax_shipping` double NOT NULL,
  `commission` double NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `item_status_id` (`item_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `item_status_id`, `item_type_id`, `image`, `keywords`, `unit_price`, `tax_item`, `tax_shipping`, `commission`) VALUES
(1, 'Medium Roast', 'Our Paradise Mountain beans are roasted to a full medium roast to produce a sweet, lightly dry cup with a pleasant flowery aroma. Well-balanced with a delicate body, our Single-Farm Medium offers an exceptionally vibrant beginning with a honey like, dry finish. It is a likable and easy drinking cup of coffee to enjoy anytime of the day.', 1, 2, 'MediumRoast.jpeg', 'Coffee', 15, 5, 5, 1),
(2, 'Dark Roast', 'Our Paradise Mountain dark beans are slow roasted to create a dark, exotic cup with an intensely bold flavor. Lively, with an earthy, acidic undertone and a slightly chocolate aroma, our dark roast is full bodied with a spicy dry finish. This coffee is excellent in the morning or paired with your favorite dessert.', 1, 1, 'DarkRoast.jpeg', 'Coffee', 15, 5, 5, 1),
(3, 'Estate Blend', 'This blend was specially developed to produce a coffee that reflects all of the characteristics of Paradise Mountain Organic Coffee. Each varietal is individually roasted in order to showcase its own unique profile. Right from the start, this coffee presents an exotic flowery aroma. In the cup, it is full bodied with a wide range of depth. The finish is slightly smoky with hints of mocha and berries. This coffee is best enjoyed on its own to appreciate its complexity.', 1, 1, 'EstateBlend.jpeg', 'Estate Blend Coffee Kaffakarma', 15, 5, 5, 1),
(4, 'Angel’s Espresso Blend', 'This blend a rare combination of six origin beans makes up this highly popular, smooth, rich espresso. A combination of South American and Indonesian beans this espresso is flavored for its slightly sweet and winey undertones. With a pleasant, dry mocha finish, this espresso carries well with any milk based drink or especially on its own.', 1, 1, 'Expresso.jpeg', 'Angel’s Espresso Blend Coffee Kaffakarma Angel', 15, 5, 5, 1),
(5, 'SWP Decaf Blend', 'From our farm in Thailand we bring our green beans to Burnaby, Canada, where they are decaffeinated via the Swiss Water Process. This is the only method that preserves the organic status of coffee. The distinct characteristics of our Thailand farm coffees are as present as ever. Exotic flowery aromas, smooth yet full bodied and a slightly dry mocha finish, just now available in decaffeinated version.', 1, 1, 'decaf.jpeg', 'SWP Decaf Blend Coffee Kaffakarma', 15, 5, 5, 1);

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

--
-- Dumping data for table `keywords`
--


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

--
-- Dumping data for table `messages`
--


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

--
-- Dumping data for table `orderitems`
--


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

--
-- Dumping data for table `orders`
--


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

--
-- Dumping data for table `paypal`
--


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
(1, 'Alabama', 'AL', 226),
(2, 'Alaska', 'AK', 226),
(3, 'Arizona', 'AZ', 226),
(4, 'Arkansas', 'AR', 226),
(5, 'California', 'CA', 226),
(6, 'Colorado', 'CO', 226),
(7, 'Connecticut', 'CT', 226),
(8, 'Delaware', 'DE', 226),
(9, 'Florida', 'FL', 226),
(10, 'Georgia', 'GA', 226),
(11, 'Hawaii', 'HI', 226),
(12, 'Idaho', 'ID', 226),
(13, 'Illinois', 'IL', 226),
(14, 'Indiana', 'IN', 226),
(15, 'Iowa', 'IA', 226),
(16, 'Kansas', 'KS', 226),
(17, 'Kentucky', 'KY', 226),
(18, 'Louisiana', 'LA', 226),
(19, 'Maine', 'ME', 226),
(20, 'Maryland', 'MD', 226),
(21, 'Massachusetts', 'MA', 226),
(22, 'Michigan', 'MI', 226),
(23, 'Minnesota', 'MN', 226),
(24, 'Mississippi', 'MS', 226),
(25, 'Missouri', 'MO', 226),
(26, 'Montana', 'MT', 226),
(27, 'Nebraska', 'NE', 226),
(28, 'Nevada', 'NV', 226),
(29, 'New Hampshire', 'NH', 226),
(30, 'New Jersey', 'NJ', 226),
(31, 'New Mexico', 'NM', 226),
(32, 'New York', 'NY', 226),
(33, 'North Carolina', 'NC', 226),
(34, 'North Dakota', 'ND', 226),
(35, 'Ohio', 'OH', 226),
(36, 'Oklahoma', 'OK', 226),
(37, 'Oregon', 'OR', 226),
(38, 'Pennsylvania', 'PA', 226),
(39, 'Rhode Island', 'RI', 226),
(40, 'South Carolina', 'SC', 226),
(41, 'South Dakota', 'SD', 226),
(42, 'Tennessee', 'TN', 226),
(43, 'Texas', 'TX', 226),
(44, 'Utah', 'UT', 226),
(45, 'Vermont', 'VT', 226),
(46, 'Virginia', 'VA', 226),
(47, 'Washington', 'WA', 226),
(48, 'West Virginia', 'WV', 226),
(49, 'Wisconsin', 'WI', 226),
(50, 'Wyoming', 'WY', 226),
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
(63, 'Yukon', 'YNC', 38),
(64, 'Other', NULL, 240);

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

--
-- Dumping data for table `userdetails`
--


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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `useritems`
--

INSERT INTO `useritems` (`id`, `user_id`, `item_id`, `unit_price`, `active`) VALUES
(1, 2, 1, 15, 1),
(2, 2, 2, 15, 1),
(3, 2, 3, 15, 1),
(4, 2, 4, 15, 1),
(5, 2, 5, 15, 1),
(6, 2, 6, 15, 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `userpassword`, `usertype_id`, `firstname`, `lastname`, `emailid`, `address`, `street`, `city_id`, `state_id`, `country_id`, `ipaddress`, `registrationdate`, `lastlogin`, `userstatus_id`, `image`, `securityquestion_id`, `answer`) VALUES
(1, 'admin', '85587e3aa839ec03b0967408ca2192f9', 1, 'Admin', '', '', '', NULL, '16', 0, 0, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, NULL, 1, 'neelan'),
(2, 'legreens', 'e10adc3949ba59abbe56e057f20f883e', 2, 'legreens', 'legree', 'legreens@test.com', 'afaf', NULL, '18', 4, 226, NULL, '2013-02-25 13:25:29', '0000-00-00 00:00:00', 1, '', 4, 'dfd');

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
(3, 'User', 'Registered User', 'profile.php');
