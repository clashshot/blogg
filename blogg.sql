-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 28, 2016 at 12:10 PM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogg`
--

-- --------------------------------------------------------

--
-- Table structure for table `Blog`
--

CREATE TABLE `Blog` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `slug` varchar(255) CHARACTER SET latin1 NOT NULL,
  `title` varchar(60) CHARACTER SET latin1 NOT NULL,
  `description` varchar(255) CHARACTER SET latin1 NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Blog`
--

INSERT INTO `Blog` (`id`, `user_id`, `slug`, `title`, `description`, `visible`) VALUES
(4, 9, 'morot', 'Morot', 'Morot', 1),
(7, 5, 'Rickardhs_blogg', 'Rickardhs blogg', 'Här skriver jag för att testa', 1),
(13, 7, 'dankmemes', 'The Dankes of Memes', 'Git soam of dat dank maymay mah niggah', 1),
(24, 6, 'CSGO', 'CSGO sverige', 'tips om CSGO', 1),
(26, 8, 'progamer', 'Mina coola wow-karaktärererererer', 'Cool stufffffffffffffffffffffffffffffffffffff', 1),
(35, 4, 'mina-feta-bilar', 'Mina feta bilar', 'Jag äger feta bilar vettu', 1),
(37, 4, 'jaha', 'JAHA', 'NÄHE', 0),
(44, 8, 'pollopen', 'Pollopen', '22-årig programmerare och vegan med en förkärlek för Gifs, gaming och matlagning.', 1),
(55, 9, 'snygga-bilar', 'Snygga bilar', 'Jag är cool och gillar sport bilar speciellt japanska sport bilar', 1),
(56, 4, 'emil-ar-den-tuffaste-karlsborgaren-ever', 'emil är den tuffaste karlsborgaren ever', 'Jag heter Emil, jag är från Karlsborg.', 1),
(57, 10, 'stinas-perfekta-perforerade-paket', 'Stinas Perfekta Perforerade Paket', 'Jag är en irriterande person.', 1),
(58, 5, 'shrek', 'Shrek', 'Shrek is love. Shrek is life', 1),
(59, 9, 'car-memes', 'Car memes', 'Jag gillar bilar och memes', 1),
(60, 5, 'pelles-hastar', 'Pelles hästar', 'Saker jag gillar', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Blog_moderator`
--

CREATE TABLE `Blog_moderator` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Blog_moderator`
--

INSERT INTO `Blog_moderator` (`id`, `user_id`, `blog_id`) VALUES
(54, 5, 26),
(56, 5, 13),
(57, 4, 26),
(65, 9, 26),
(66, 6, 57);

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE `Category` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `name` varchar(40) COLLATE utf8_bin NOT NULL,
  `slug` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Category`
--

INSERT INTO `Category` (`id`, `blog_id`, `name`, `slug`) VALUES
(1, 4, 'Bananer', 'bananer'),
(28, 24, 'Japp', 'japp'),
(29, 13, 'TFW/MFW', 'tfw-mew'),
(41, 24, 'preben', 'preben'),
(42, 26, 'Politisk propaganda', 'politisk-propaganda'),
(43, 7, '&lt;div&gt;Hej&lt;/div&gt;', 'div-hej-div'),
(45, 7, '&lt;/div&gt;', 'div'),
(46, 7, '&lt;/div&gt;&lt;br /&gt;&lt;hr&gt;', 'div-br-hr'),
(47, 56, 'Mitt liv', 'mitt-liv'),
(48, 35, 'Kalle', 'allahu-akbar'),
(49, 35, 'cancer', 'cancer'),
(50, 13, 'Random', 'random'),
(51, 55, 'subaru', 'subaru'),
(52, 13, 'PSA', 'psa'),
(53, 57, '#nes', 'nes'),
(54, 57, 'Aha-FTW', 'aha-ftw'),
(55, 57, 'FEY', 'fey'),
(56, 24, 'fordon', 'fordon'),
(57, 35, 'Stefan', 'stefan'),
(58, 60, 'Bilar', 'bilar');

-- --------------------------------------------------------

--
-- Table structure for table `Comment`
--

CREATE TABLE `Comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8_bin NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `flagged` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `user_agent` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `ip_adress` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Comment`
--

INSERT INTO `Comment` (`id`, `user_id`, `post_id`, `comment_id`, `comment`, `created`, `updated`, `flagged`, `deleted`, `user_agent`, `ip_adress`) VALUES
(17, 5, 16, NULL, 'Hej på dig', '2016-10-14 14:04:34', NULL, 0, 0, '', ''),
(35, NULL, 8, NULL, 'Hej jag är anonym bdsfsdf ', '2016-10-15 15:06:40', '2016-10-19 09:59:30', 0, 0, '', ''),
(84, NULL, 2, NULL, 'hej\r\n', '2016-10-17 14:39:50', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(85, NULL, 2, NULL, 'test\r\n', '2016-10-17 14:40:27', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(86, 8, 2, NULL, 'tjenare', '2016-10-17 14:40:55', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(87, 8, 2, 84, 'dfsfsddfs', '2016-10-17 14:48:13', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(92, 9, 2, 87, 'yo', '2016-10-18 09:28:59', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.59 Safari/537.36', '62.20.62.223'),
(109, NULL, 30, NULL, 'Hej', '2016-10-19 08:40:11', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '62.20.62.214'),
(110, NULL, 30, NULL, 'Jag gillar bananer', '2016-10-19 08:40:24', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '62.20.62.214'),
(111, 8, 24, NULL, 'blobb', '2016-10-19 09:36:58', '2016-10-19 09:37:10', 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(112, 8, 24, 111, 'kastrull', '2016-10-19 09:37:23', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(113, 5, 30, NULL, '&#039; select * from blog&#039;\r\nHej&lt;/&gt;&lt;li&gt;&lt;ul&gt;Jag vill bara kolla en sak', '2016-10-19 09:57:58', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '62.20.62.214'),
(114, NULL, 8, NULL, 'sasfasf', '2016-10-19 09:59:07', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '62.20.62.214'),
(115, NULL, 8, 35, 'saasfasdfasd\r\n', '2016-10-19 09:59:38', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '62.20.62.214'),
(116, 5, 8, 115, 'sfsdfsdfsf', '2016-10-19 10:00:22', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '62.20.62.214'),
(117, 5, 8, 115, 'gerrgerg\r\n', '2016-10-19 10:00:42', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '62.20.62.214'),
(118, 5, 8, 116, 'yyyyy', '2016-10-19 10:00:51', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '62.20.62.214'),
(119, 5, 8, 115, 'gfdfgdfgdfg', '2016-10-19 10:00:57', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '62.20.62.214'),
(120, 5, 8, 117, 'sdfsdf', '2016-10-19 10:03:32', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '62.20.62.214'),
(121, 5, 8, 120, 'sdfsdfsdf', '2016-10-19 10:03:38', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '62.20.62.214'),
(122, 5, 8, 121, 'hhhhhh', '2016-10-19 10:03:43', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '62.20.62.214'),
(123, 5, 8, 122, 'jhkhjkfhkf \r\n', '2016-10-19 10:04:05', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '62.20.62.214'),
(124, 5, 8, 123, '6575eruhty teryeryt ert yeryyr', '2016-10-19 10:04:13', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '62.20.62.214'),
(125, 5, 8, 124, 'rt rty rh fddgfh dfgh fdhg', '2016-10-19 10:04:19', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '62.20.62.214'),
(126, 5, 8, 125, 'dfgh dfh fdh fdh fdg hfdg hdfgh fdgh ', '2016-10-19 10:04:25', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '62.20.62.214'),
(127, 5, 8, 126, 'df ghfd hfd hfd hfdhfd hfd hfd hfd hgfdhgfdhfdhg', '2016-10-19 10:04:33', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '62.20.62.214'),
(128, 5, 8, 127, 'fd ghdf hfd hfd hfd hfdg hfdgh fdg hfdgh fdghfdhfdg hfd', '2016-10-19 10:04:41', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '62.20.62.214'),
(129, NULL, 30, 110, 'Dom är goda', '2016-10-19 12:05:24', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '62.20.62.214'),
(131, 5, 24, 112, 'Banan', '2016-10-19 15:14:38', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '62.20.62.214'),
(132, NULL, 45, NULL, 'GG', '2016-10-21 09:43:36', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(133, NULL, 45, 132, 'sdadsaasdasd', '2016-10-21 09:46:54', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(135, 7, 44, NULL, 'asdasdasd', '2016-10-21 14:04:58', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(136, 7, 44, NULL, 'asdasd', '2016-10-21 14:14:55', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(137, 8, 44, NULL, 'ssdasda', '2016-10-21 14:33:14', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(138, 8, 44, 137, 'sdaasdasdsda', '2016-10-21 14:33:36', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(139, 8, 44, 137, 'xzx', '2016-10-21 14:33:52', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(140, 8, 44, NULL, 'sdsdadas', '2016-10-21 14:41:49', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(141, 8, 44, 138, 'ssdaasdasdasdf', '2016-10-21 14:42:05', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(142, 8, 44, 135, 'zcsfsdfasfasf', '2016-10-21 14:43:07', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(143, NULL, 44, 135, 'asd', '2016-10-21 14:44:31', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(145, 8, 64, NULL, 'daadsdasdass', '2016-10-24 09:21:33', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(146, 8, 72, NULL, 'Hej', '2016-10-24 12:08:12', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(147, 8, 67, NULL, 'Tja', '2016-10-24 12:08:41', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(148, 5, 69, NULL, 'Mycket bra!', '2016-10-24 12:14:07', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '62.20.62.214'),
(149, 4, 44, 135, '', '2016-10-24 12:25:53', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(150, 4, 44, 135, '', '2016-10-24 12:26:03', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(161, 5, 74, NULL, 'Håller med', '2016-10-24 14:38:18', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '62.20.62.214'),
(162, 5, 75, NULL, 'Hej på dig Karlsson', '2016-10-24 14:41:52', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '62.20.62.214'),
(163, 6, 44, NULL, 'holy FUCK', '2016-10-24 14:42:39', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(164, 6, 77, NULL, 'Den som kommentarar förs vinner en kaka', '2016-10-24 14:46:12', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(165, 5, 77, 164, 'Hej', '2016-10-25 08:55:06', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '62.20.62.214'),
(166, NULL, 81, NULL, 'Hey, that&#039;s pretty good', '2016-10-25 09:14:39', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(167, NULL, 81, 166, 'ikr??!?!?!?!?!??! ?!XDXDXDXDXDXDXXDXDXDXDXDX jajajajajajajajjajajajajajajajajaajjaajjajajajajajaja', '2016-10-25 09:15:07', '2016-10-25 10:00:10', 0, 1, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(168, 5, 81, 166, 'Vad skrev han?', '2016-10-25 12:43:42', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '62.20.62.214'),
(170, 7, 81, 168, 'Att du är ful :&#039;C', '2016-10-25 13:02:46', '2016-10-28 10:27:06', 0, 1, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(171, 8, 83, NULL, '5/5 toasters', '2016-10-25 13:39:44', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(172, 4, 77, 164, 'Du e tattare', '2016-10-25 13:40:02', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(174, 4, 82, NULL, 'abc@@@23£€$64++´ää_&gt;_&gt;_&gt;_Ddf+2+&lt;/divvvv&gt;&gt;\r\n', '2016-10-25 13:48:25', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(175, 4, 82, 174, 'ja det är han\r\n', '2016-10-25 13:48:42', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '::1'),
(177, 4, 67, 147, 'Tjo bror', '2016-10-26 08:56:57', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', '::1'),
(178, 10, 67, NULL, 'Oj va fint\r\n', '2016-10-26 10:34:33', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', '62.20.62.212'),
(179, 10, 2, NULL, 'https://www.youtube.com/watch?v=Gf1WT8VEZxk', '2016-10-26 10:58:09', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', '62.20.62.212'),
(180, 10, 2, 92, 'https://www.youtube.com/watch?v=Gf1WT8VEZxk', '2016-10-26 10:58:28', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', '62.20.62.212'),
(181, 10, 2, 180, 'https://www.youtube.com/watch?v=Gf1WT8VEZxk', '2016-10-26 10:58:38', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', '62.20.62.212'),
(182, 10, 2, 181, 'https://www.youtube.com/watch?v=Gf1WT8VEZxk', '2016-10-26 10:58:55', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', '62.20.62.212'),
(183, 10, 2, 182, 'https://www.youtube.com/watch?v=Gf1WT8VEZxk', '2016-10-26 10:59:03', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', '62.20.62.212'),
(184, 10, 2, 183, 'https://www.youtube.com/watch?v=Gf1WT8VEZxk', '2016-10-26 10:59:12', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', '62.20.62.212'),
(185, 10, 2, 183, 'https://www.youtube.com/watch?v=Gf1WT8VEZxkaasdasd', '2016-10-26 10:59:25', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', '62.20.62.212'),
(186, 5, 74, NULL, 'Den är så dålig', '2016-10-27 12:49:51', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', '62.20.62.214'),
(187, 5, 81, 170, ':(', '2016-10-28 07:31:11', NULL, 0, 0, 'Mozilla/5.0 (iPad; CPU OS 9_3_5 like Mac OS X) AppleWebKit/601.1 (KHTML, like Gecko) CriOS/53.0.2785.109 Mobile/13G36 Safari/601.1.46', '83.252.69.8'),
(188, 10, 98, NULL, 'Jag gillar bilar!', '2016-10-28 10:19:02', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', '62.20.62.216'),
(189, 5, 98, NULL, 'Hej på dig', '2016-10-28 10:21:13', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', '62.20.62.221'),
(190, 5, 98, 188, 'Jag med', '2016-10-28 10:22:08', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', '62.20.62.221'),
(191, 10, 98, 190, 'Det säger du bara!\r\n', '2016-10-28 10:22:24', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', '62.20.62.216');

-- --------------------------------------------------------

--
-- Table structure for table `Comment_like`
--

CREATE TABLE `Comment_like` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Comment_like`
--

INSERT INTO `Comment_like` (`id`, `user_id`, `comment_id`) VALUES
(34, 9, 87),
(35, 9, 92),
(36, 9, 86),
(57, 6, 84),
(58, 6, 87),
(59, 6, 92),
(60, 6, 85),
(61, 6, 86),
(64, 5, 110),
(67, 5, 115),
(87, 5, 162),
(88, 6, 164),
(89, 8, 164),
(90, 8, 165),
(100, 7, 170),
(101, 4, 172),
(102, 4, 165),
(103, 4, 164),
(106, 4, 147);

-- --------------------------------------------------------

--
-- Table structure for table `Favorite`
--

CREATE TABLE `Favorite` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Favorite`
--

INSERT INTO `Favorite` (`id`, `user_id`, `post_id`, `created`) VALUES
(3, 7, 7, '2016-10-21 09:07:34'),
(4, 4, 4, '2016-10-21 09:07:34'),
(5, 6, 48, '2016-10-21 10:49:39'),
(6, 5, 55, '2016-10-21 10:54:26'),
(7, 5, 54, '2016-10-21 10:55:05'),
(13, 6, 65, '2016-10-21 14:37:11'),
(17, 8, 64, '2016-10-24 10:35:57'),
(18, 8, 67, '2016-10-24 10:36:12'),
(22, 8, 45, '2016-10-24 14:31:06'),
(23, 6, 45, '2016-10-24 14:42:24'),
(24, 6, 44, '2016-10-24 14:42:45'),
(25, 5, 75, '2016-10-24 14:42:57'),
(26, 6, 77, '2016-10-24 14:45:33'),
(27, 6, 61, '2016-10-24 14:52:11'),
(30, 10, 2, '2016-10-26 10:57:57'),
(31, 5, 94, '2016-10-27 13:04:03'),
(32, 5, 93, '2016-10-27 13:04:05'),
(34, 5, 92, '2016-10-27 13:04:11'),
(35, 10, 98, '2016-10-28 10:19:21'),
(36, 5, 98, '2016-10-28 10:20:01');

-- --------------------------------------------------------

--
-- Table structure for table `Pages`
--

CREATE TABLE `Pages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `blog_id` int(11) DEFAULT NULL,
  `title` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `slug` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `content` text CHARACTER SET latin1,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Pages`
--

INSERT INTO `Pages` (`id`, `user_id`, `blog_id`, `title`, `slug`, `content`, `created`, `updated`) VALUES
(1, 4, 35, 'About me', 'about', 'ja', '2016-10-13 16:00:00', NULL),
(2, 4, 35, 'My family', 'about', 'ja', '2016-10-13 16:00:00', NULL),
(9, 7, 13, 'How to make a Dank Meme', 'how-to-make-a-dank-meme', '[size=24px]1.You find something meme-worthy\r\n\r\n2.You go into your basement and get something dank. If you do not have a basement, either steal one of your neighbours basements or get something dank from your local cleaning cupboard.\r\n\r\n3.Put the meme and the dank in a Blendtec Total Blender. Other blenders are available, however expect a lackluster result.\r\n\r\n4.blnd dat sht niqqha!!1\r\n\r\n5.Our the contents down the drain.\r\n\r\n6.Now you got to be fast; you need to loosen the pipes so that the mixture slowly leaks out.\r\n\r\n7.Collect the leakage in a plastic bowl. Remember; the colour of the bowl should reflect the opposite of your current mood. Just like in stage 3, you can expect lackluster results if you choose another bowl.\r\n\r\n8.Spice the meme to your own taste.\r\n\r\n9.Put the mixture in the oven. The oven\'s heat will reflect how trending the meme will be, but remember; a very Hot meme will go stale very fast!\r\n\r\n10.After 69 seconds, you got a fresh Dank Meme![/size]\r\n\r\n\r\n[font=Trebuchet MS][color=#ff0000][size=50px]Congratulations, you now know how to make some Dank Maymays![/size][/color][/font]', '2016-10-20 14:24:22', '2016-10-20 15:15:01'),
(10, 8, 26, 'Hejsanjdtjddtu', 'hejsan', 'sssssssssssssssssssssssssss', '2016-10-21 12:46:29', '2016-10-21 13:28:14'),
(13, 6, 24, 'what', 'what', '', '2016-10-21 12:55:10', NULL),
(31, 9, 4, 'hej', 'hej-383115', 'dfthfdth mep', '2016-10-21 14:40:10', NULL),
(32, 9, 4, 'ghuk', 'ghuk', 'ghuk', '2016-10-24 09:23:49', NULL),
(33, 9, 4, 'hgu', 'hgu', 'hguk', '2016-10-24 09:23:55', NULL),
(34, 9, 4, 'dsrg', 'dsrg', 'sdrg', '2016-10-24 09:36:29', NULL),
(35, 8, 44, 'Gaming', 'gaming', 'Lista på spel som jag spelar eller har spelat och eventuellt min åsikt på just det spelet.', '2016-10-24 13:15:33', '2016-10-24 13:16:42'),
(36, 10, 57, '&lt;/div&gt;Jag kan!&lt;/div&gt;&lt;b&gt;asdasd&lt;/b&gt;', 'div-jag-kan-div-b-asdasd-b', 'aadasdasd[youtube]Gf1WT8VEZxk[/youtube]', '2016-10-26 04:49:54', NULL),
(37, 5, 58, 'Om mig', 'om-mig', '[size=150]Hej på dig\r\n[/size]Jag skriver om Shrek på den här bloggen så att alla vet hur bra han är\r\nHär kommer text om första filmen som jag tog ifrån imdb\r\n\r\nA Scottish man (voiced by [url=http://www.imdb.com/name/nm0000196/]Mike Myers[/url]) reads a fairy tale from a book:\r\n\r\n"[i]Once upon a time there was a lovely princess. But she had an enchantment upon her of a fearful sort which could only be broken by love\'s first kiss. She was locked away in a castle guarded by a terrible fire-breathing dragon. Many brave knights had attempted to free her from this dreadful prison but none prevailed. She waited in the dragon\'s keep in the highest room of the tallest tower for her true love and true love\'s first kiss.[/i]"\r\n\r\n(laughing) A green hand rips the page out of the book. "Like that\'s ever gonna happen." Cut to an outhouse exterior. The toilet flushes. "What a load of..." The door slams open, revealing the man, a green ogre. He sees his house, built into the bottom of a large tree stump, and breathes a happy sigh. He lives a normal life (for an ogre). He undresses and takes a (mud) shower outside. He brushes his teeth (using a caterpillar\'s guts as toothpaste). He smiles into the mirror (but it cracks as in "The Munsters"). He jumps into a pond (and farts). Some dead fish float up, and he grabs one. After he gets dressed, he gets a giant slug out of a hollow log (for his dinner). Finally, he paints a "BEWARE. OGRE" sign and posts it.\r\n\r\nMen burst out of a tavern in the town and plan to capture the ogre for a reward. They grab pitchforks and torches and head for his place. The ogre is eating a bowl of eyeballs. He burps to light his fireplace, swallows the fish, and then relaxes in his easy chair. The men finally arrive at the ogre\'s house at night. The ogre hears them, and sneaks up behind them. He frightens them by telling them what he could do to them, then he roars and they all flee in fear. The ogre sees a poster on the ground and picks it up: "WANTED. FAIRY TALE CREATURES. REWARD". He tosses it back on the ground and walks away.\r\n\r\nIn the forest, various fairy tale creatures are being loaded into wagons for the rewards: The Seven Dwarfs, a witch, an elf, Pinocchio, The Three Bears, Tinker Bell, etc. A talking donkey (voiced by [url=http://www.imdb.com/name/nm0000552/]Eddie Murphy[/url]) is next in line after Pinocchio (voiced by [url=http://www.imdb.com/name/nm0970606/]Cody Cameron[/url]). The Captain of the Guards (voiced by [url=http://www.imdb.com/name/nm0191906/]Jim Cummings[/url]) gives Gepetto (voiced by [url=http://www.imdb.com/name/nm3735491/]Chris Miller[/url]) five shillings for the "possessed toy". The donkey\'s owner (voiced by [url=http://www.imdb.com/name/nm0293466/]Kathleen Freeman[/url]) can\'t get him to talk when asked by the knights, so they drag her away. As she struggles with the knights, she kicks the lantern holding Tinker Bell, and it flies into the air, landing on the donkey and spilling pixie dust on him. He floats into the air. The donkey talks [i]now[/i] as he floats away, saying, "You might have seen a house fly, maybe even a super fly, but I bet you aint never seen a donkey fly!" (copying the crows in "Dumbo"). Peter Pan (voiced by [url=http://www.imdb.com/name/nm2542558/]Michael Galasso[/url]) and the Three Little Pigs (voiced by [url=http://www.imdb.com/name/nm0970606/]Cody Cameron[/url]) are surprised that he can fly, but the Captain of the Guards is more surprised that he can talk. The pixie dust wears off, and the donkey falls to the ground. The knights try to seize him, but he runs into the forest.\r\n\r\nThe donkey bumps into the back of the ogre, who was posting a "KEEP OUT" poster on a tree. When the knights approach, the donkey hides behind the ogre. The Captain of the Guards announces that Lord Farquaad authorized him to arrest them and transport them to a designated resettlement facility. The ogre says, "Oh, really. You and what army?" The Captain looks back and sees that the other knights have run away, so he too runs away, yelling in fear. As the ogre walks away the donkey follows him and compliments him on how great he was with the guards. The donkey says that he doesn\'t have any friends and asks to stay with the ogre, who then tries to scare him away. The donkey just gives him a compliment on how scary that was and sings. The ogre tells the donkey that he is an ogre, but the donkey doesn\'t care. The donkey asks for the ogre\'s name, and he replies, "Shrek." Shrek lets the donkey stay at his house for one night (outside).\r\n\r\nAs Shrek eats his dinner, he hears a noise and shouts at the donkey to stay outside. He looks back at his table and sees the Three Blind Mice (voiced by [url=http://www.imdb.com/name/nm0971017/]Christopher Knights[/url] and [url=http://www.imdb.com/name/nm0971239/]Simon J. Smith[/url]). When he grabs the mice, The Seven Dwarfs push the case with Snow White onto the table. They tell Shrek it\'s because the bed\'s taken, and Shrek sees that The Big Bad Wolf is in it. He grabs the wolf and tosses him out, but sees hundreds of fairy tale creatures camped outside his house. Pinocchio and one of the pigs tell Shrek that Lord Farquaad evicted them and put them there. The donkey tells Shrek that he knows where Lord Farquaad is, so Shrek announces that their welcome is worn out, that he will see Farquaad right now so that he can get them all off his swamp and back where they all came from. They all cheer. Shrek tells the donkey that he is coming with him. The donkey is happy and says, "Shrek and Donkey, on a whirlwind big city adventure." Donkey then starts singing "On The Road Again", but Shrek makes him hum it instead.\r\n\r\nIn a castle, the town\'s lord walks down a hallway. When he reaches the guards at the end, it\'s obvious that he is a dwarf. He enters the torture chamber where the executioner, Thelonius (voiced by [url=http://www.imdb.com/name/nm0971017/]Christopher Knights[/url]), is drowning The Gingerbread Man (voiced by [url=http://www.imdb.com/name/nm0970447/]Conrad Vernon[/url]) in a glass of milk. The lord (voiced by [url=http://www.imdb.com/name/nm0001475/]John Lithgow[/url]) torments The Gingerbread Man, and then crumbles one of his severed legs. He tells The Gingerbread Man that he and all the other fairy tale trash are monsters that are poisoning his perfect world. He demands that The Gingerbread Man tell him where the others are and starts to tear off one of his gumdrop buttons. The Gingerbread Man then rambles on about The Muffin Man, but they are interrupted by knights who bring in The Evil Queen\'s Magic Mirror. The lord knocks The Gingerbread Man into a trash can then asks, "Mirror mirror on the wall, is this not the most perfect kingdom of them all?" The Magic Mirror (voiced by [url=http://www.imdb.com/name/nm3735491/]Chris Miller[/url]) replies that he is not technically a king yet, but can become one by marrying a princess. The Magic Mirror then presents the eligible bachelorettes, "Dating Game" style: Cinderella, Snow White, and Princess Fiona (in the castle guarded by a dragon). Upon prompting by Thelonius, Lord Farquaad picks Princess Fiona. The Magic Mirror then displays Princess Fiona while playing "Escape (The Piña Colada Song)". Lord Farquaad says that she\'s perfect, and that finally he will be the perfect king. The Magic Mirror tries to tell him what happens at night after sunset, but he tells the mirror to be quiet. Lord Farquaad then announces that they are going to have a tournament.\r\n\r\nShrek and Donkey reach the castle at Duloc. The parking lot is arranged like the one at Disneyland. Shrek remarks that it must be Lord Farquaad\'s castle. It\'s extremely tall, and Shrek jokes that he could be compensating for something. As they approach the roped lines for the ticket booth, Shrek tries to talk to Duloc\'s costumed mascot (voiced by [url=http://www.imdb.com/name/nm0011470/]Andrew Adamson[/url]), which looks like Lord Farquaad, but he runs away in fear through the lines. Shrek walks straight through the ropes, dragging them along as Donkey follows, and tries to calm the mascot down. The mascot gets knocked out when he runs into the turnstile. Shrek and Donkey go through the turnstile. Elevator music plays in the otherwise quiet and deserted courtyard. The souvenir shop only has Lord Farquaad items. Donkey sees an information booth and pulls the lever. There is some clicking, and then the doors open, revealing music and wooden puppets (like in "It\'s a Small World") that sing the rules for Duloc, "a perfect place". The doors shut and a camera takes Shrek and Donkey\'s picture, then their photo comes out, showing them stunned.\r\n\r\nShrek and Donkey hear fanfare and go in that direction. Lord Farquaad is high upon a balcony announcing that the tournament winner (champion) will have the privilege to go rescue Princess Fiona. Shrek and Donkey march past the contestants (knights), then Farquaad instead tells the knights that the one who kills the ogre will be named champion. Shrek bursts open a wine barrel to slip up some knights, then slides through the brew, swinging at them with one of their axes like a hockey player. Donkey climbs onto the other barrel and rolls over some more knights. When more knights arrive, Shrek jumps into a corral and fights them like a professional wrestler. After a while, the crowd cheers for Shrek. Donkey joins in, "tag team" style, knocking out another knight. After Shrek sits on another knight, a woman (voiced by [url=http://www.imdb.com/name/nm0055444/]Jacquie Barnbrook[/url]) shouts for Shrek to give "give him the chair", so he whacks him over the head with a chair. After Shrek throws the last knight, Donkey kicks him, knocking him out. Shrek hams it up for the crowd. Lord Farquaad signals to the knights with crossbows, but instead of giving the order to kill Shrek, he proclaims that Shrek is the champion. Farquaad tells Shrek that he won the honor to go on the quest. Shrek replies that he is already on a quest to get his swamp back, where Farquaad dumped the fairy tale creatures. Farquaad offers a deal to Shrek that if he goes on this quest, Farquaad will give him his swamp back, with the squatters gone, so Shrek agrees.\r\n\r\nOn the way to rescue Princess Fiona, Shrek and Donkey pass through various vegetable fields. As Shrek munches on some vegetables, Donkey asks Shrek why he\'s going to fight a dragon and rescue a princess to get his swamp back, which Farquaad filled with "freaks". He tells Shrek that he should act like an ogre, and lay siege to his fortress and grind his bones. Shrek sarcastically suggests that instead he could have decapitated some villagers and drank their fluids. Shrek tells Donkey that there\'s a lot more to ogres than people think, that they are like onions and have layers.\r\n\r\nShrek and Donkey pass a run-down windmill. After two days, they finally reach the castle where Princess Fiona is held, up on a mountain. Dried lava and brimstone are everywhere. Donkey thinks the smell is from Shrek, but Shrek tells Donkey that if it were him, Donkey would be dead. They reach a footbridge over a river of lava leading to the castle. Donkey is afraid to cross, but Shrek backs him up, tricking him to cross.\r\n\r\nInside the castle, Shrek tells Donkey to look for stairs so they can reach Princess Fiona. Shrek puts on some armor of a dead knight. Suddenly, the dragon breathes fire and chases after Donkey. Shrek grabs the dragon\'s tail, but it shakes him off, sending him flying into Princess Fiona\'s room and waking her up. Meanwhile, the dragon has Donkey trapped. Donkey complements it on its white teeth, notices that it\'s a girl dragon, and gives it more appropriate compliments. The dragon picks him up with her teeth and walks happily away. While Shrek recovers, Princess Fiona lies back down on the bed and pretends to sleep. Shrek approaches her but instead of kissing her, he shakes her forcefully and shouts for her to wake up. Princess Fiona (voiced by [url=http://www.imdb.com/name/nm0000139/]Cameron Diaz[/url]) wants romance, but Shrek keeps his helmet on and drags her down the stairs. Down below, the dragon is cuddling and romancing Donkey. Shrek grabs a hanging chain and swings towards the dragon, but the chain is stuck up above. He shakes it loose, and he falls, knocking Donkey away as the dragon is about to kiss him. The dragon kisses Shrek\'s naked butt. The chain\'s frame falls around the dragon\'s neck like a collar. Shrek and Donkey run away, then Shrek grabs Donkey and Fiona as the dragon chases them, repeatedly breathing fire. They crisscross the castle and the chain tangles around all the pillars. Shrek locks the chain into the floor with a sword. As they run across the bridge the dragon burns half of it up, but they make it safely across. The dragon tries to fly after them, but the chain holds it back.\r\n\r\nSafely on the other side, Fiona demands that Shrek remove his helmet and kiss her. He removes his helmet, and she is shocked and disappointed that he is an ogre. Shrek tells her that Lord Farquaad sent him, that [b]he\'s[/b] the one who wants to marry her. Princess Fiona tells him in that case that Lord Farquaad should rescue her and she refuses to leave. Shrek picks her up then they head back to Duloc. When Shrek finally sets Fiona down she asks Shrek and Donkey what Duloc and Lord Farquaad are like. Shrek and Donkey start making short jokes about him. She says that they are just jealous of him. When she hears that they will get to Duloc the next day, Fiona gets upset and insists that they make camp immediately. They find a rock cliff, and Princess Fiona sleeps alone in a small enclosure on it. Shrek tells Donkey stories about the stars, and then says that things are more than they appear. Donkey wonders what they will do when they get back to their swamp, but Shrek tells him that it\'s [b]his[/b] swamp, and he is going to build a ten-foot wall around his land. Donkey thinks that Shrek is trying to keep people out, then Shrek shouts at Donkey that he\'s trying to keep [b]everyone[/b] out. Fiona wakes up and slides the door open, then overhears Shrek telling Donkey how people judge him before they even know him, and that\'s why he\'s better off alone. Fiona closes the door then Donkey and Shrek talk about the stars again.\r\n\r\nAt his castle, Lord Farquaad is in bed with a drink and repeatedly makes the Magic Mirror show him the picture of Princess Fiona. He says that she\'s perfect.\r\n\r\nThe next morning, Princess Fiona sings with a bird, but it explodes when she hits a high note. She cooks the bird\'s eggs for breakfast. Fiona tells Shrek and Donkey that she is making it up to them because they got off to a bad start yesterday; after all, they rescued her. As they walk towards Duloc, Shrek burps then Fiona burps too. Suddenly a man (voiced by [url=http://www.imdb.com/name/nm0001993/]Vincent Cassel[/url]) swinging from a vine grabs Fiona. He calls out for his Merry Men. They all appear, dancing and singing about him, Robin Hood. As he brandishes a knife, Robin Hood finishes the song by saying he will cut out Shrek\'s heart, but Fiona swings down and knocks him into a boulder. She defeats the Merry Men with Kung Fu mixed with "The Matrix". Shrek and Donkey are amazed. Shrek asks Fiona where she learned that, and she replies that when one lives alone one has to learn these things. She sees that there\'s an arrow in Shrek\'s butt. Donkey starts panicking, so Fiona sends him off looking for a blue flower with red thorns. When Fiona tries to pull out the arrow from Shrek\'s butt, he squirms, falls to the ground, and Fiona lands on him -- just as Donkey returns with the flower. Donkey gets mad because he thinks they just wanted to be alone. When Fiona pulls out the arrow, Donkey sees the blood and faints. Shrek picks him up, and they head back to Duloc.\r\n\r\nIn a field, Princess Fiona grabs a spider\'s web and gathers up the flying bugs bothering Shrek, giving it to him, who eats it like cotton candy. Shrek catches a frog and inflates it like a balloon, handing it to Fiona. Fiona grabs a snake off a tree branch and inflates it like a balloon, and gives it to Shrek. They push each other playfully, then run off together, and their balloons float away into the air.\r\n\r\nThey finally reach the windmill and see Duloc in the distance. Shrek shrugs and tells Princess Fiona that her future awaits her, and she\'s surprised to see Duloc. Donkey interrupts, and tells Fiona that Shrek thinks Lord Farquaad is compensating for something. Donkey starts to say that it means Farquaad "has a really..." Shrek knocks him down, a little too hard, and then tells Fiona that they should move on and starts walking. Fiona tells Shrek that she\'s worried about Donkey, that he doesn\'t look so good. Shrek comes over and plays along with her pretense, and says that he looks awful. Fiona tells Donkey that she\'ll make him some tea. Donkey then acts like a hypochondriac. Shrek and Fiona go to find dinner and firewood. Fiona likes the food Shrek cooked (weed rat), saying that it\'s delicious. She sighs, then looks at Duloc and says that she\'ll be eating differently tomorrow night. He hopes that she will visit him in the swamp, because he\'ll cook for her. She says that she would like that, and then they smile and look at each other. Shrek begins to ask Fiona something important, but changes his mind and asks for the rest of her food. They lean towards each other, about to kiss. Donkey butts in, saying that the sunset is romantic. Fiona jumps up, panicking. She pretends to be afraid of the dark, and Donkey tells her that [b]he[/b] is afraid of the dark too. Fiona goes into the windmill to sleep by herself, glancing back briefly at Shrek. Donkey tells Shrek that he can tell with his animal instincts that Shrek and Fiona "were digging on each other," and says that Shrek should tell Fiona how he feels about her. Shrek tries to deny that he likes her, and then dejectedly says that Fiona is a princess and he is an ogre. He walks off and tells Donkey that he\'s getting more firewood, but Donkey sees that there\'s still a large pile of firewood there. Shrek sits alone by a field of sunflowers, staring at Duloc until night.\r\n\r\nDonkey, afraid to be alone by himself in the dark, goes inside the windmill looking for Princess Fiona. A large green hand grabs the ladder, and then a female ogre looks down on Donkey as he wanders around. All the sights and sounds frighten Donkey. The ogre falls through the wood and screams as she lands on the floor, frightening Donkey even more. He\'s terrified when she stands up, and he screams for Shrek. Donkey asks her what she did with the princess. She tries to calm and quiet him down, saying that it\'s her, in this body. He thinks that she ate the princess and shouts at her stomach, then calls for Shrek again. She finally calms him down and convinces him that she [b]is[/b] the princess. He wonders what happened to her, telling her that she\'s... different. She admits that she\'s ugly. Donkey thinks it\'s because she ate the weed rat, but she tells him that she\'s been this way as long as she can remember. She says that it only happens when the sun goes down. She looks at her reflection in a barrel of water and recites a spell: "[i]By night one way, by day another. This shall be the norm until you find love\'s first kiss and then take love\'s true form[/i]." She tells Donkey that when she was a little girl a witch cast a spell on her; every night she becomes "[i]this[/i], this horrible, ugly beast"; she was placed in a tower to await the day her true love would rescue her. Fiona sits down and tells Donkey that it\'s why she has to marry Farquaad tomorrow before the suns sets and he sees her like this. She cries, and then Donkey tries to console her. He says that she\'s ugly, but adds that she only looks like this at night, and that Shrek is ugly all the time. She replies that she\'s a princess, and it\'s not how a princess should look. Donkey suggests that she shouldn\'t marry Farquaad. She insists that she has to, because only her true love\'s first kiss can break the spell. Donkey tells her that she\'s an ogre, and Shrek\'s an ogre, and that they have a lot in common.\r\n\r\nShrek walks back to the windmill, holding a sunflower. He\'s rehearsing what he will say to Princess Fiona when he gives it to her. When he climbs the steps of the windmill, he overhears Fiona telling Donkey that she just can\'t marry whomever she wants, and to take a good look at her. She asks Donkey, "Who could ever love a beast so hideous and ugly? Princess and ugly don\'t go together. That\'s why I can\'t stay here with Shrek. My only chance to live happily ever after is to marry my true love." She tells Donkey that it\'s just how it should be. Shrek becomes disheartened because he thinks Fiona was calling him ugly, and then throws the sunflower down and storms off towards Duloc. Fiona tells Donkey that it\'s the only way to break the spell. He tells her that she has to tell Shrek the truth and starts to leave, but she says that no one must ever know and makes Donkey promise not to tell anyone. Donkey says that [b]she[/b] should tell Shrek, then goes outside. Fiona opens the door and looks around, but only sees the sunflower and takes it inside. Donkey looks around then sleeps by the campfire.\r\n\r\nIn the morning, Princess Fiona picks off the petals of the sunflower, reciting the "He loves me, he loves me not" game, but instead saying, "I tell him, I tell him not." She pulls off the last petal, excited that she should tell Shrek about her spell. She opens the door and calls for him, but only sees Donkey outside snoring. The sun rises and she transforms back to human form. Shrek walks up and she rushes to greet him, but he angrily walks past her and sits on the steps. She says that she has to tell him something, but he replies that he heard everything she said last night. She says that she thought he would understand. He says he understands, quoting her asking, "Who could ever love a hideous, ugly beast?" She says that she thought it wouldn\'t matter to him, but he says that it does. A horse whinnies and they turn around. Fanfare announces Lord Farquaad\'s arrival as he rides towards them, accompanied by some knights, then Donkey wakes up. Farquaad greets Princess Fiona, and then Shrek demands that Farquaad give him the deed to his swamp, as promised. Farquaad tells Shrek that the swamp is cleared out as agreed, then tells him to take the deed and go before he changes his mind. Shrek grabs the deed and stands aside. Farquaad calls Fiona beautiful. She tells him that she was just saying a short farewell, just as a knight sets him on the ground. Farquaad says that it\'s sweet, that she doesn\'t have to waste good manners on the ogre; it doesn\'t have feelings. Fiona agrees that "it" doesn\'t. Farquaad grabs her hand and proposes to her. She looks at Shrek, who is staring at his deed, then accepts. Farquaad jumps up happily and tells her that he\'ll make plans for them to marry tomorrow. She stops him and says that they should get married today, before the sun sets. Shrek angrily walks back to his swamp. Farquaad agrees that they should get married today, and talks about all the things to prepare. They both get on the horse and head to Duloc, and then Fiona tells Shrek "fare-thee-well." Donkey tries to stop Shrek and says that there\'s something he doesn\'t know about Fiona. Shrek shouts at Donkey that he heard what they said last. He tells Donkey that since he and Fiona are great friends, Donkey should follow [b]her[/b] home. Donkey replies that he wants to go with Shrek. Shrek continues shouting at Donkey that he lives alone in his swamp, not with anyone else, "especially useless, pathetic, annoying, talking donkeys!" Shrek storms off to his swamp.\r\n\r\n("Hallelujah" by John Cale plays in the background.) At his swamp, Shrek sees that the fairy tale creatures are gone; only their tents remain, along with some debris. He sighs heavily and walks back to his house. Donkey walks through the forest, sadly glancing back. Shrek sees his reflection in a puddle of water, and then sadly lowers his head. Princess Fiona, in her wedding gown, looks sadly out the window. Shrek looks sadly out his window, then angrily takes a sunflower off the table and throws it into the fireplace. Fiona sadly looks at herself again in the mirror. Farquaad looks at himself in the Magic Mirror, which smiles only when he\'s looking at it. Fiona looks at the wedding cake and pushes the figurine of Farquaad down to its proper height. She turns around and quizzically looks at the suit of armor. At the same spot, in his house, Shrek leans sadly against the table and stares at the fireplace. Donkey drinks from a pond by the forest, then is startled when he hears and sees the dragon crying; they console each other. Shrek is alone, and tries to eat at his table; Fiona is alone, and tries to eat at her table; they both put their faces in their hands.\r\n\r\nShrek hears a thumping sound outside and opens the door to see Donkey putting branches on the ground. Donkey tells him that it\'s a wall. Shrek tells him that a wall should go around his swamp. Donkey replies that it [b]does[/b] go around his half of the swamp, and that Donkey gets the other half. Donkey tells Shrek that he earned half of the swamp because he did half of the work rescuing the princess. They argue over ownership of the swamp. Shrek gives up and walks away, saying that he\'s done with Donkey, then Donkey chases after him. Donkey says that Shrek just thinks about himself; he\'s mean to Donkey, insults him, doesn\'t appreciate him, and pushes him around or away. Shrek asks Donkey that if he treated him so bad, why did he come back? Donkey replies that it\'s what friends do: they forgive each other. Shrek agrees, and then he shouts that he forgives Donkey for stabbing him in the back. Shrek goes into the outhouse and slams the door. Donkey tells Shrek that he\'s so wrapped up like onion layers in his feelings. Shrek tells Donkey to go away, but he tells Shrek that he\'s "doing it again," like he did to Fiona; all she ever did was love him. Shrek replies that he heard their conversation, that she called him ugly, a hideous creature. Donkey tells him that she wasn\'t talking about him, but was talking about somebody else. Shrek comes out and asks who she [b]was[/b] talking about. Donkey refuses to tell him because Shrek doesn\'t listen to him. Shrek apologizes, and admits that he is just a big, stupid, ugly ogre. Donkey forgives him because that\'s what friends are for. Shrek wonders what Fiona said about him, but Donkey tells him to ask [b]her[/b]. Shrek cries out that they won\'t make the wedding in time. Donkey whistles and the dragon flies down. Shrek climbs the chain up then the dragon puts Donkey up too. They fly away to Duloc.\r\n\r\nAt the castle, the bishop (voiced by [url=http://www.imdb.com/name/nm0079353/]Val Bettin[/url]) is marrying Princess Fiona and Lord Farquaad. Thelonius holds the rings. Two men hold up cue cards for the audience\'s appropriate response. Fiona interrupts and asks the bishop to skip to the "I do\'s". Farquaad chuckles and tells the bishop to continue. The dragon lands outside, and then the knights run away fearfully. Shrek goes to the door of the church, but Donkey tells him to wait until the preacher says, "Speak now or forever hold your peace", then for Shrek to say, "I object!" Shrek says that he doesn\'t have time for this, but Donkey replies that chicks like romance. They go to the side of the church and Shrek repeatedly throws Donkey up to look through a window. Donkey tells Shrek that they are already married. Shrek bursts into the church just before Farquaad and Fiona kiss, shouting that he objects. Fiona and Farquaad are annoyed to see him. Shrek wants to talk to Fiona, but she says that it\'s too late and tries to kiss Farquaad. Shrek grabs her hand and tells her that Farquaad only wants to marry her so that he can be king, then tells her that Farquaad is not her true love. Fiona asks him what [b]he[/b] knows about true love. Shrek stammers, and Farquaad laughs because Shrek loves the princess. Farquaad cues the laughter. Fiona asks Shrek if it\'s true, but Farquaad grabs her hand and insists that she kiss him now. Fiona looks at the setting sun and recalls her spell. She walks to the window and tells Shrek that she wanted to show this to him before. She transforms into an ogre, and then grins sheepishly at Shrek. The audience is shocked. Farquaad sees Fiona and says that "it" is disgusting and orders his guards to get "it" out of his sight, to get them both. As Shrek and Fiona try to reach each other, Farquaad declares that the marriage is still binding, that he is still king, and puts on the crown. As guards drag Shrek away, Farquaad tells that he\'ll beg for death. He then tells Fiona that he\'ll lock her back in that tower for the rest of her life. Shrek frees one of his hands and whistles. The dragon bursts through the large stained glass window with Donkey on top and swallows Farquaad, killing him, then burps out his crown. Shrek tells Fiona that he loves her, and she tells him that he loves him too. They kiss, and then Fiona begins her transformation as her voice-over recounts the rest of the spell. She rises up into the air, glowing. Bright light radiates from her, then a shock wave from her shatters all the windows in the church except one (which the dragon later breaks). Fiona completes her transformation, and then returns to the floor and collapses. Shrek helps Fiona up. She\'s still an ogre, and tells Shrek that she doesn\'t understand, that she\'s supposed to be beautiful. Shrek tells her that she [b]is[/b] beautiful, and they kiss again.\r\n\r\nAt the swamp, Shrek and Fiona get married, with Donkey and all the fairy tale creatures as guests. The wedding song is "I\'m a Believer", by Smash Mouth. One of the fairy godmothers transforms the three blind mice into horses, and a garlic bulb into a carriage, and then Shrek and Fiona leave in the carriage. Donkey takes over the song, with the others singing and dancing. The wedding celebration continues while Shrek and Fiona ride away into the sunset.\r\n\r\nThe fairy tale ends with "And they lived ugly ever after. The end." The book closes, revealing the fairy tale to be "Shrek", and the song ends.', '2016-10-28 02:36:52', NULL),
(38, 5, 60, 'Om mig', 'om-mig', ':D:D:D:D', '2016-10-28 04:23:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Post`
--

CREATE TABLE `Post` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `slug` varchar(255) CHARACTER SET latin1 NOT NULL,
  `title` varchar(100) CHARACTER SET latin1 NOT NULL,
  `content` mediumtext COLLATE utf8_bin NOT NULL,
  `visibility` tinyint(1) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL,
  `allow_comments` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Post`
--

INSERT INTO `Post` (`id`, `blog_id`, `category_id`, `user_id`, `slug`, `title`, `content`, `visibility`, `created`, `updated`, `allow_comments`) VALUES
(2, 4, 3, 4, 'Most-secure-and-effective-way-of-generating-Unique-API-Key', 'Jakob jappar', 'Jakobiii yjdyjdgfjydftujh tfj tfj fdthftdh fdth fdth fdht fdthfdth fdth fdthd fth dfth fdth ftdh dfthfdth fdth\r\n\'\r\ndtfh\r\ndft\r\nh\r\nfdth\r\nfd\r\nth\r\ndft\r\nh\r\ndft\r\nh\r\ndfth\r\nfd\r\nth\r\nfd\r\nth\r\nfd\r\nth\r\ndf\r\nth\r\ndfht', 1, '2016-10-11 04:53:14', '2016-10-21 13:52:36', 1),
(4, 7, 3, 5, 'test-2', 'Jakob jappar', 'Jakobiii', 1, '2016-10-12 15:06:09', NULL, 0),
(5, 7, 3, 5, 'test-3', 'Jakob jappar', 'Jakobiii', 1, '2016-10-12 20:42:05', NULL, 0),
(6, 7, 3, 5, 'test-4', 'Jakob jappar', 'Jakobiii', 1, '2016-10-12 20:42:21', NULL, 0),
(7, 7, 3, 5, 'test-5', 'Jakob jappar', 'Jakobiii', 1, '2016-10-12 20:42:34', NULL, 0),
(8, 7, 3, 5, 'test-6', 'Jakob jappar', 'Jakobiii', 1, '2016-10-12 20:42:49', NULL, 0),
(16, 35, 49, 4, 'ferrari', 'Jakob jappar', 'Jakobiii', 2, '2016-10-13 12:48:01', '2016-10-27 14:54:20', 0),
(24, 26, 13, 8, 'hej-2', 'testos', '[b][i][u][s][font=Comic Sans MS][color=#ff0000][quote][list][*][b][i][u][s][font=Comic Sans MS][color=#ff0000][size=200][quote][img width=700 height=300 title=Squad Goals]https://i.imgur.com/1b9pjOe.jpg[/img]fggssg[/quote][/size][/color][/font][/s][/u][/i][/b][/*][/list][list=1][*]tyifjyfyf[/*][/list][/quote][/color][/font][/s][/u][/i][/b][center][/center][center][/center][size=200]test\r\n[/size][font=Comic Sans MS]Comic sans\r\n[/font][font=Courier New]test2[/font]', 1, '2016-10-17 09:19:48', '2016-10-19 12:00:56', 0),
(30, 7, NULL, 5, 'hej', 'Hej på dig', 'H[b]ej på dig[/b]\nB[i]anan[/i][quote]﻿Kul[/quote][i][u]Abwqrbq[/u][/i]\n[img]http://www.produktivitetsbloggen.se/wp-content/uploads/2013/03/banana.jpg[/img]\n[url=https://myanimelist.net/animelist/rickfo&sclick=1][IMG]https://myanimelist.cdn-dena.com/signature/rickfo.png[/IMG][/url] ', 1, '2016-10-19 00:00:00', NULL, 1),
(32, 7, 7, 5, 'hej-pa-dig', 'Hej på dig', 'Hej på ddig', 1, '2016-10-19 09:08:02', NULL, 1),
(33, 7, NULL, 5, 'hdqwiuh', 'hdqwiuh', 'haoijveq', 2, '2016-10-19 09:08:34', NULL, 1),
(36, 26, 25, 8, 'rrereer', 'rrereer', 'xxzzxxxxxxxxxxx', 1, '2016-10-19 12:01:51', NULL, 1),
(37, 7, NULL, 5, 'fafw', 'FAfw Hej', '[font=Comic Sans MS]Ändra font\n[/font][size=200]Ändra size[/size]\n\nHej på dig\nJag är cool', 1, '2016-10-19 12:23:36', NULL, 1),
(40, 26, 12, 8, 'erwerwrwe', 'erwerwrwe', '[img width=100% height=100% title=wqweqweqwe]https://i.imgur.com/1b9pjOe.jpg[/img]', 1, '2016-10-19 12:32:35', NULL, 1),
(41, 26, 12, 8, 'eeeeee', 'eeeeee', '[img width=100% title=sadaadsasd]https://i.imgur.com/1b9pjOe.jpg[/img]', 1, '2016-10-19 12:50:46', '2016-10-19 14:30:34', 1),
(42, 7, 11, 5, 'kalinka', 'Kalinka gillar bulle', 'sadsadsadsaads', 3, '2016-10-19 14:56:57', '2016-10-19 15:02:52', 1),
(43, 7, NULL, 5, 'hej-pa-dig-2', 'Hej på dig #2', 'H[b]ej på dig[/b]\nB[i]anan[/i][quote]﻿Kul[/quote][i][u]Abwqrbq[/u][/i]\n[img]http://www.produktivitetsbloggen.se/wp-content/uploads/2013/03/banana.jpg[/img]\n[url=https://myanimelist.net/animelist/rickfo&amp;sclick=1][IMG]https://myanimelist.cdn-dena.com/signature/rickfo.png[/IMG][/url] ', 1, '2016-10-19 15:18:41', NULL, 1),
(44, 26, 42, 8, 'dormeeeeeeer', 'Dormeeeeeeer', '[img width=100% title=Dormer]http://66.media.tumblr.com/91103ddd51567f70a80de9d4ad39d4a8/tumblr_nlwiquUtyS1r7mqm8o1_500.gif[/img]', 1, '2016-10-19 15:26:23', '2016-10-25 14:53:13', 1),
(45, 26, 38, 8, 'do-you-believe-in-god', 'Do you believe in god?xssadasdasdasdasd', '[youtube]UqLtUf1QNx4[/youtube]\r\n[youtube]UqLtUf1QNx4[/youtube]', 1, '2016-10-20 09:09:04', '2016-10-24 10:33:14', 0),
(46, 7, 27, 5, 'en-gif', 'En gif', '[img width=100% title=Hej]https://upload-assets.vice.com/files/2016/07/06/1467830836GOT_ep_7_The_hound_s_wishful_thinking.gif[/img]', 2, '2016-10-20 09:25:45', NULL, 1),
(47, 7, 27, 5, 'gif', 'Gif', '[img width=100% title=Fint]https://media.giphy.com/media/3o6oziEt5VUgsuunxS/giphy.gif[/img]', 1, '2016-10-20 09:26:35', NULL, 1),
(48, 24, 28, 6, 'hej-hej', 'hej hej', 'idag tog jag en stor snus, så jävla stor så att grannarna klagade', 1, '2016-10-20 10:02:20', NULL, 1),
(49, 13, 29, 7, 'tfw-you-see-a-dank-blog', 'TFW you see a dank blog', '[img width=100% title=DankBlog]http://ci.memecdn.com/494/10282494.gif[/img]', 1, '2016-10-20 15:00:15', NULL, 1),
(50, 13, 29, 7, 'mfw-someone-links-to-chinese-cartoons', 'MFW someone links to chinese cartoons', '[img width=100% title=MFW someone links to chinese cartoons]http://ci.memecdn.com/186/4843186.gif[/img]', 1, '2016-10-20 15:04:06', NULL, 1),
(53, 7, 8, 5, 'afwq', 'afwq', 'Hej på dihg', 1, '2016-10-20 15:19:31', NULL, 1),
(54, 7, 4, 5, 'afw', 'afw', '[list][*]Pinkt[/*][*]Lista[/*][/list]', 1, '2016-10-20 15:20:13', NULL, 1),
(55, 7, 4, 5, 'dqbw', 'dqbw', '[list][*]Fungerar det?[/*][*]Jag[/*][*]Vet[/*][*]Inte[/*][/list]', 1, '2016-10-20 15:21:09', NULL, 1),
(56, 13, 29, 7, 'tfw-you-re-thirsty-af-but-your-squad-got-you-covered', 'TFW you&#039;re thirsty af but your squad got you covered', '[img width=100% title=SodaFountain]http://67.media.tumblr.com/a1ddf96b0ff18bb40d249d6688f6c266/tumblr_mrghgs6YC31qm62e6o10_400.gif[/img]', 1, '2016-10-20 15:30:49', NULL, 1),
(61, 24, 28, 6, 'meme', 'MEME', '[img width=100% title=swag]http://www.skruf.se/skruf2.0/ui/img/news/knox_bluewhite_nyhet_795x435.jpg[/img]', 1, '2016-10-21 10:58:59', NULL, 1),
(62, 13, 29, 7, 'mfw-someone-brags-about-their-specs', 'MFW someone brags about their specs', '[img width=100% title=K]http://www.reactiongifs.com/r/ktf.gif[/img]', 1, '2016-10-21 11:00:07', NULL, 1),
(63, 13, 29, 7, 'tfw-the-rest-of-your-suqd-shows-up-at-the-pool', 'TFW the rest of your squad shows up at the pool', '[img width=100% title=HereWeGo]https://media.giphy.com/media/3oEjHGO5OqyCCBqRsA/giphy.gif[/img]', 1, '2016-10-21 11:47:21', '2016-10-21 12:24:05', 1),
(64, 26, 37, 8, 'hejj', 'hejj', 'sssssss', 1, '2016-10-21 12:45:53', '2016-10-24 10:33:05', 1),
(65, 24, NULL, 6, 'true', 'true', '[img width=100% title=well]https://media.giphy.com/media/Vj2fBk4JWGdxu/giphy.gif[/img]', 1, '2016-10-21 12:51:49', NULL, 1),
(67, 4, 1, 9, 'hej-068088', 'hej', 'fgyjfgyjfgyj', 1, '2016-10-21 14:43:14', NULL, 1),
(69, 13, NULL, 7, 'does-this-look-like-the-face-of-mercy-to-you', 'Does this look like the face of mercy to you??', '[img width=100% title=NoHesitation]http://i.imgur.com/4XxN2By.jpg[/img]', 1, '2016-10-24 09:44:18', NULL, 1),
(70, 7, 9, 5, 'antoni-van-leeuwenhoek', 'Antoni van Leeuwenhoek', '[img width=100% title=Snubbe]http://www.thefamouspeople.com/profiles/images/antonie-van-leeuwenhoek-3.jpg[/img]\r\n\r\n[size=100]Det här är en snubbe som jag inte vet vem han är.\r\n[/size]Men han är på google idag så jag tänker kolla på vad han har gjort.\r\n[font=Lucida Sans Unicode][size=150]Han är en [b]naturforskare enligt wikipedia\r\n[quote]﻿[b]Antonie van Leeuwenhoek[/b], född [url=https://sv.wikipedia.org/wiki/24_oktober]24 oktober[/url] [url=https://sv.wikipedia.org/wiki/1632]1632[/url] i Delft, död [url=https://sv.wikipedia.org/wiki/27_augusti]27 augusti[/url] [url=https://sv.wikipedia.org/wiki/1723]1723[/url], var en nederländsk naturforskare.[/quote][/b][/size][/font]', 2, '2016-10-24 10:11:09', NULL, 1),
(71, 7, NULL, 5, 'pokmon', 'Pokémon', '[img width=100% title=Pokemon]https://upload.wikimedia.org/wikipedia/commons/thumb/9/98/International_Pok%C3%A9mon_logo.svg/2000px-International_Pok%C3%A9mon_logo.svg.png[/img][size=100]\r\nPokémon (ポケモン) också känt som Pocket Monsters (ポケットモンスター Pokettomonsutā) i [url=https://sv.wikipedia.org/wiki/Japan]Japan[/url], är en [url=https://sv.wikipedia.org/wiki/Japan]japansk[/url] [url=https://sv.wikipedia.org/wiki/Franchise_(popul%C3%A4rkultur)]media-franchise[/url]. Från början hette det Capsule Monsters. Pokémon finns bland annat som spel till[url=https://sv.wikipedia.org/wiki/Nintendo]Nintendos[/url] spelkonsoler, TV-serier, långfilmer, [url=https://sv.wikipedia.org/wiki/Samlarkortspel]samlarkortspel[/url], [url=https://sv.wikipedia.org/wiki/Serietidning]serietidningar[/url] m.m. Fenomenet skapades av [url=https://sv.wikipedia.org/wiki/Satoshi_Tajiri]Satoshi Tajiri[/url] kring [url=https://sv.wikipedia.org/wiki/1996]1996[/url]. Genom att utnyttja samverkan mellan olika medier kom Pokémon att bli ett kulturellt fenomen under andra halvan av [url=https://sv.wikipedia.org/wiki/1990-talet]1990-talet[/url] för vissa yngre åldersgrupper och framförallt figuren [i][url=https://sv.wikipedia.org/wiki/Pikachu]Pikachu[/url][/i] är närmast att betrakta som en global kulturikon. Ordet "Pokémon" är identiskt i både singular och plural. Det är alltså grammatiskt korrekt att säga "en Pokémon" och "många Pokémon", liksom "en Pikachu" och "många Pikachu". Det finns nu 722 olika Pokémon sedan releasen av Pokémonspelen X och Y.\r\n[url=https://sv.wikipedia.org/wiki/Produkt_(ekonomi)]Produkterna[/url] skapades av [url=https://sv.wikipedia.org/wiki/Game_Freak]Game Freak[/url] åt [url=https://sv.wikipedia.org/wiki/Nintendo]Nintendo[/url], som noga bevakar de [url=https://sv.wikipedia.org/wiki/Immaterialr%C3%A4tt]immateriella rättigheterna[/url]. [url=https://sv.wikipedia.org/wiki/Nintendo]Nintendo[/url] använder Pokémon som dragplåster för sin [url=https://sv.wikipedia.org/wiki/Game_Boy]Game Boy[/url]-plattform men också för [url=https://sv.wikipedia.org/wiki/Nintendo_GameCube]Nintendo GameCube[/url],[url=https://sv.wikipedia.org/wiki/Nintendo_DS]Nintendo DS[/url], [url=https://sv.wikipedia.org/wiki/Wii]Wii[/url], [url=https://sv.wikipedia.org/wiki/Wii_U]Wii U[/url], [url=https://sv.wikipedia.org/w/index.php?title=2_DS&action=edit&redlink=1]2 DS[/url] och [url=https://sv.wikipedia.org/w/index.php?title=3_DS&action=edit&redlink=1]3 DS[/url]\r\nI Pokémonvärlden finns det ett fåtal djur men de flesta är ersatta av Pokémon. I denna värld är det många ungdomars högsta önskan att bli en Pokémontränare och att fånga in Pokémon, träna dem, delta i strider samt att vinna Pokémon-Ligan. I spelen är spelaren oftast en Pokémontränare. Eftersom vissa Pokémon är kraftfulla används de inte bara av äventyrslystna ungdomar, utan även av onda rollfigurer, som den kriminella organisationen Team Rocket.\r\nOriginalet är på [url=https://sv.wikipedia.org/wiki/Japanska]japanska[/url] och uttydningen av namnet blir [i]"Pocket Monsters"[/i] ([i]fickmonster[/i]), vilket också de första spelen hette i [url=https://sv.wikipedia.org/wiki/Japan]Japan[/url]. När de sedan skulle lanseras i [url=https://sv.wikipedia.org/wiki/USA]USA[/url] fanns redan en [url=https://sv.wikipedia.org/wiki/Produkt_(ekonomi)]produkt[/url] registrerad under ett liknande namn. Man använde då istället den förkortning som bland [url=https://sv.wikipedia.org/wiki/Japanska]japanska[/url] Pokémonspelare hade blivit ett väl använt begrepp, "Pokémon". I Japan finns butiker som specifikt säljer Pokemon.[/size]', 1, '2016-10-24 10:20:43', '2016-10-24 10:25:45', 1),
(72, 7, 9, 8, 'test', 'test', 'Paprikaaaaaaa', 1, '2016-10-24 10:22:43', NULL, 1),
(73, 7, NULL, 5, 'dennis-bok', 'Dennis bok', '[list][*][url=https://sv.wikipedia.org/wiki/1260]1260[/url] – [url=https://sv.wikipedia.org/wiki/Saif_ad-Din_Qutuz]Saif ad-Din Qutuz[/url], [url=https://sv.wikipedia.org/wiki/Sultan]sultan[/url] av mamluksultanatet i [url=https://sv.wikipedia.org/wiki/Egypten]Egypten[/url], lönnmördas av [url=https://sv.wikipedia.org/wiki/Baibars]Baibars[/url] som griper makten i sultanatet.[/*][*][url=https://sv.wikipedia.org/wiki/1375]1375[/url] – Vid Valdemar Atterdags död utropar hans dotter [url=https://sv.wikipedia.org/wiki/Drottning_Margareta]Margareta[/url] sin son [url=https://sv.wikipedia.org/wiki/Olof_av_Danmark_och_Norge]Olof Håkansson[/url] till kung av Danmark, med henne som förmyndare.[/*][*][url=https://sv.wikipedia.org/wiki/1648]1648[/url] – [url=https://sv.wikipedia.org/wiki/Westfaliska_freden]Westfaliska freden[/url] undertecknas och markerar slutet på [url=https://sv.wikipedia.org/wiki/Trettio%C3%A5riga_kriget]trettioåriga kriget[/url].[/*][*][url=https://sv.wikipedia.org/wiki/1657]1657[/url] – Den danska [url=https://sv.wikipedia.org/wiki/F%C3%A4stning]fästningen[/url] [url=https://sv.wikipedia.org/wiki/Frederiksodde]Frederiksodde[/url] stormas och intas av svenska trupper, vilket var en av förutsättningarna för [url=https://sv.wikipedia.org/wiki/T%C3%A5get_%C3%B6ver_B%C3%A4lt]tåget över Bält[/url].[/*][*][url=https://sv.wikipedia.org/wiki/1929]1929[/url] – [url=https://sv.wikipedia.org/wiki/Svarta_torsdagen]Svarta torsdagen[/url] som blev inledningen till [url=https://sv.wikipedia.org/wiki/Wall_Street-kraschen]Wall Street-kraschen[/url].[/*][*][url=https://sv.wikipedia.org/wiki/1940]1940[/url][list][*]Färja med trupptransport av ingenjörer kantrar i sjön [url=https://sv.wikipedia.org/wiki/Armasj%C3%A4rvi_(sj%C3%B6)]Armasjärvi[/url] vid [url=https://sv.wikipedia.org/wiki/%C3%96vertorne%C3%A5_kommun]Övertorneå[/url] i [url=https://sv.wikipedia.org/wiki/Sverige]Sverige[/url]. Fyrtiosex man omkommer.[/*][*][url=https://sv.wikipedia.org/w/index.php?title=Svenska_Johnsonlinjen&action=edit&redlink=1]Svenska Johnsonlinjens[/url] tankmotorfartyg Janus torpederas. Fyra omkomna; 33 räddade av engelskt [url=https://sv.wikipedia.org/wiki/%C3%96rlogsfartyg]örlogsfartyg[/url].[/*][*]Tyskt enmotorigt jaktflygplan nödlandar utanför [url=https://sv.wikipedia.org/wiki/Karlstad]Karlstad[/url] på grund av kompassfel.Besättningsmannen, en [url=https://sv.wikipedia.org/wiki/Underofficer]underofficer[/url], och planet omhändertas av svensk militär.[/*][/list][/*][*][url=https://sv.wikipedia.org/wiki/1945]1945[/url] – [url=https://sv.wikipedia.org/wiki/FN-stadgan]FN-stadgan[/url] träder i kraft, till vars minne [url=https://sv.wikipedia.org/wiki/FN-dagen]FN-dagen[/url] firas.[sup][url=https://sv.wikipedia.org/wiki/24_oktober#cite_note-1][1][/url][/sup][/*][*][url=https://sv.wikipedia.org/wiki/1964]1964[/url] – [url=https://sv.wikipedia.org/wiki/Nordrhodesia]Nordrhodesia[/url] blir självständigt från [url=https://sv.wikipedia.org/wiki/Storbritannien]Storbritannien[/url] under namnet [url=https://sv.wikipedia.org/wiki/Zambia]Zambia[/url].[sup][url=https://sv.wikipedia.org/wiki/24_oktober#cite_note-2][2][/url] [/sup]Samtidigt byter [url=https://sv.wikipedia.org/wiki/Sydrhodesia]Sydrhodesia[/url] namn till [url=https://sv.wikipedia.org/wiki/Rhodesia]Rhodesia[/url].[url=https://sv.wikipedia.org/wiki/24_oktober#cite_note-3][sup][3][/sup][/url][/*][*][url=https://sv.wikipedia.org/wiki/1998]1998[/url] – [url=https://sv.wikipedia.org/wiki/Lucian_Pulvermacher]Lucian Pulvermacher[/url] väljs till påve med namnet Pius XIII men accepteras aldrig från officiellt romersk-katolskt håll.[/*][*][url=https://sv.wikipedia.org/wiki/2004]2004[/url] – Invigning av [url=https://sv.wikipedia.org/wiki/S%C3%B6dra_L%C3%A4nken]Södra Länken[/url], en [url=https://sv.wikipedia.org/wiki/Motorv%C3%A4g]motorväg[/url] i [url=https://sv.wikipedia.org/wiki/Nacka]Nacka[/url] och [url=https://sv.wikipedia.org/wiki/Stockholm]Stockholm[/url].[/*][/list][youtube]LC5OPzt1tsM[/youtube]', 1, '2016-10-24 13:32:09', '2016-10-24 13:38:05', 1),
(74, 7, 40, 5, 'jag-gillar-inte-denna', 'Jag gillar inte denna', '[youtube]d9TpRfDdyU0[/youtube]', 1, '2016-10-24 14:37:25', NULL, 1),
(75, 7, 40, 5, 'ful', 'Ful', '[youtube]MtcUKwGINNM[/youtube]\r\n[font=Courier New][size=200]H[sup]e[/sup]j [sub]på di[/sub]g [i][sup]som läser här.[/sup][/i][/size][/font]\r\n[i][b][u][font=Comic Sans MS][size=150]Denna är jätte ful som en åsna[/size][/font][/u][/b][/i]', 2, '2016-10-24 14:40:54', NULL, 1),
(76, 7, 10, 5, 'hej-667586', 'Hej', 'Svenska[[url=https://sv.wiktionary.org/w/index.php?title=hej&amp;action=edit§ion=1]redigera[/url]]Interjektion[[url=https://sv.wiktionary.org/w/index.php?title=hej&amp;action=edit§ion=2]redigera[/url]][b]hej[/b]\r\n[list=1][*]hälsningsfras[i][b]Hej[/b]! Hur mår du?[/i]Synonymer: [url=https://sv.wiktionary.org/wiki/hall%C3%A5]hallå[/url], [url=https://sv.wiktionary.org/wiki/hej_hej]hej hej[/url] [i](vardagligare)[/i], [url=https://sv.wiktionary.org/wiki/hejsan]hejsan[/url] [i](vardagligt)[/i], [url=https://sv.wiktionary.org/wiki/mors]mors[/url] [i](vardagligt)[/i], [url=https://sv.wiktionary.org/wiki/morsning]morsning[/url] [i](vardagligt)[/i], [url=https://sv.wiktionary.org/wiki/tja]tja[/url] [i](vardagligt)[/i], [url=https://sv.wiktionary.org/wiki/tjo]tjo[/url] [i](vardagligt)[/i], [url=https://sv.wiktionary.org/wiki/tjabba]tjabba[/url] [i](vardagligt)[/i], [url=https://sv.wiktionary.org/wiki/tjena]tjena[/url] [i](vardagligt)[/i], [url=https://sv.wiktionary.org/wiki/halloj]halloj[/url] [i](vardagligt)[/i], [url=https://sv.wiktionary.org/w/index.php?title=hallojsan&amp;action=edit&amp;redlink=1]hallojsan[/url] ([i]vardagligt[/i])[url=https://sv.wiktionary.org/wiki/tjenare]tjenare[/url] [i](vardagligt)[/i], [url=https://sv.wiktionary.org/wiki/tj%C3%A4nare]tjänare[/url] [i](vardagligt)[/i],[url=https://sv.wiktionary.org/wiki/tjenixen]tjenixen[/url] [i](vardagligt)[/i], [url=https://sv.wiktionary.org/w/index.php?title=tjena_mors&amp;action=edit&amp;redlink=1]tjena mors[/url] [i](vardagligt)[/i], [url=https://sv.wiktionary.org/wiki/god_dag]god dag[/url] [i](något formellt eller ålderdomligt)[/i][/*][*][i](något vardagligt)[/i] [i]kortform av[/i] [url=https://sv.wiktionary.org/wiki/hej_d%C3%A5]hej då[/url]; avslutande hälsningsfras[i]Det var trevligt att träffas. [b]Hej[/b]![/i][i]Jag måste gå. [b]Hej[/b] så länge.[/i]Synonymer: [i]se på uppslaget[/i] [url=https://sv.wiktionary.org/wiki/hej_d%C3%A5]hej då[/url][/*][*]hälsning som inleder ett brev[i][b]Hej[/b] Johanna! Tack för din ansökan till den lediga tjänsten.[/i]Jämför: [url=https://sv.wiktionary.org/wiki/b%C3%A4sta]bästa[/url], [url=https://sv.wiktionary.org/wiki/k%C3%A4ra]kära[/url], [url=https://sv.wiktionary.org/w/index.php?title=till_den_det_ber%C3%B6r&amp;action=edit&amp;redlink=1]till den det berör[/url][/*][/list]Etymologi: Av fornnordiska [i][url=https://sv.wiktionary.org/wiki/hei#Fornnordiska]hei[/url][/i].Fraser: [url=https://sv.wiktionary.org/wiki/hej_d%C3%A5]hej då[/url], [url=https://sv.wiktionary.org/wiki/hej_hej]hej hej[/url], [url=https://sv.wiktionary.org/wiki/hej_hopp]hej hopp[/url], [url=https://sv.wiktionary.org/w/index.php?title=hej_h%C3%A5&amp;action=edit&amp;redlink=1]hej hå[/url], [url=https://sv.wiktionary.org/w/index.php?title=hej_vilt&amp;action=edit&amp;redlink=1]hej vilt[/url], [url=https://sv.wiktionary.org/wiki/s%C3%A4ga_hej]säga hej[/url]Besläktade ord: [url=https://sv.wiktionary.org/wiki/heja]heja[/url], [url=https://sv.wiktionary.org/wiki/hejsan]hejsan[/url], [url=https://sv.wiktionary.org/w/index.php?title=hejdundrans&amp;action=edit&amp;redlink=1]hejdundrans[/url], [url=https://sv.wiktionary.org/w/index.php?title=hejdundrande&amp;action=edit&amp;redlink=1]hejdundrande[/url]Översättningar[[url=https://sv.wiktionary.org/w/index.php?title=hej&amp;action=edit§ion=3]redigera[/url]][[url=https://sv.wiktionary.org/wiki/hej]Visa ▼[/url]][url=https://sv.wiktionary.org/wiki/hej#]±[/url]hälsningsfras\r\n[[url=https://sv.wiktionary.org/wiki/hej]Visa ▼[/url]][url=https://sv.wiktionary.org/wiki/hej#]±[/url]avslutande hälsningsfras\r\nSubstantiv[[url=https://sv.wiktionary.org/w/index.php?title=hej&amp;action=edit§ion=4]redigera[/url]]Böjningar av[i][b]hej[/b] [/i]SingularPluralneutrumObestämdBestämdObestämdBestämdNominativGenitiv[b]hej[/b]\r\n[list=1][*]en hälsning av typen &quot;hej&quot;[b]2011[/b] (11 september): [i][url=http://www.dt.se/nyheter/falun/1.6268604-ett-hej-kan-forandra]DT.se – Ett &quot;hej&quot; kan förändra[/url]:[/i][i]Ett &quot;[b]hej[/b]&quot; kan förändra[/i][b]2013[/b] (18 december): [i][url=http://blog.svd.se/maratonbloggen/2013/12/18/hur-svart-ar-det-att-klamma-fram-ett-hej/]SvD Sport – Maratonbloggen – Hur svårt är det att klämma fram ett ”hej”?[/url]:[/i][i]Att någon skulle ta illa upp av ett [b]hej[/b] i joggingspåret har inte ens fallit mig in. Kanske tillhör jag en utdöende art som tycker att det är självklart att hälsa på folk?[/i][/*][/list]Översättningar[[url=https://sv.wiktionary.org/w/index.php?title=hej&amp;action=edit§ion=5]redigera[/url]]', 2, '2016-10-24 14:44:16', NULL, 1),
(77, 24, 41, 6, 'vem-fan-e-do-igentligen-preben', 'Vem fan e do igentligen??????? PREBEN', '[youtube]jVnxtBPlvIo[/youtube]', 1, '2016-10-24 14:45:07', NULL, 1),
(78, 26, NULL, 8, 'dank', 'Dank', '[img width=100% title=Make America Mexico again]http://starecat.com/content/wp-content/uploads/hey-kid-are-you-a-mexico-not-at-all-trump-for-president-keep-it-up-my-man-dios-mio-that-was-close.jpg[/img]', 1, '2016-10-25 09:00:42', '2016-10-25 09:01:57', 1),
(79, 7, 43, 5, 'bebe', 'Bebe', 'asebqw', 1, '2016-10-25 09:03:28', NULL, 1),
(80, 7, 46, 5, 'sdfdsf', 'sdfdsf', 'avwavawb', 1, '2016-10-25 09:05:10', NULL, 1),
(81, 13, 29, 7, 'mfw-someone-starts-to-speak-weeb-in-the-middle-of-a-sentence', 'MFW someone starts to speak weeb in the middle of a sentence', '[img width=100% title=Shame]http://i.imgur.com/DdURza4.gif[/img]', 1, '2016-10-25 09:12:24', NULL, 1),
(82, 26, 42, 8, 'dormer', 'DORMER', '[img width=100% title=DORMER]http://67.media.tumblr.com/d0605e392bb7f6c244d34fd749cbf26b/tumblr_nfaiw5Ykj21r1wyxno2_500.gif[/img]', 1, '2016-10-25 13:32:24', NULL, 1),
(83, 56, 47, 4, 'sven-ove-gar-pa-parkeringen', 'Sven Ove går på parkeringen', 'Idag satt jag och skrev ett inlägg när jag såg Sven Ove gå förbi ute på parkeringen, det var väldigt intressant. ', 1, '2016-10-25 13:38:19', NULL, 1),
(84, 13, 50, 7, 'trying-to-pick-dem-chicks-up', 'Trying to pick dem chicks up', '[img width=100% title=ChickPick]https://media.giphy.com/media/dFWZ6mC5CxIBy/giphy.gif[/img]', 1, '2016-10-25 13:56:25', NULL, 1),
(87, 57, 53, 10, 'this-is-a-never-ending-story', 'This is a never ending story....', '[youtube]Gf1WT8VEZxk[/youtube][youtube]Gf1WT8VEZxk[/youtube][youtube]Gf1WT8VEZxk[/youtube][font=Arial]sdfsdfsdf[/font][img width=100% title=asdasd]http://minbebis.com/blogg/stina/files/2013/10/IMG_1209.jpg[/img]', 1, '2016-10-26 04:55:24', NULL, 1),
(88, 57, 54, 10, 'take-on-me-no', 'Take on me... no?', '[youtube]djV11Xbc914[/youtube]', 1, '2016-10-26 05:04:53', NULL, 1),
(89, 57, NULL, 10, 'alphaville-skall-vi-vara-unga-for-evigt-ja', 'Alphaville... Skall vi vara unga för evigt?... JA!!!!!!', 'YOutube it...!!!! safasdfasdfasdf', 2, '2016-10-26 05:07:18', '2016-10-26 05:08:47', 1),
(90, 24, 56, 6, 'idag-kopte-jag-min-forsta-bil', 'Idag köpte jag min första bil!!!!!!', 'hejhej, idag så hade jag swag', 1, '2016-10-27 12:15:33', NULL, 1),
(91, 58, NULL, 5, 'shrek', 'Shrek', 'Shrek är min favorit film. Den handlar om ett träsktroll som heter Shrek och han gillar att vara ensam. Men han blir tvingad att gå och hämta princessan Fiona som satt i ett torn och väntade på att någon skulle komma.\r\n[img width=100% title=Shrek]https://images-na.ssl-images-amazon.com/images/M/MV5BMTk2NTE1NTE0M15BMl5BanBnXkFtZTgwNjY4NTYxMTE@._V1_UY1200_CR90,0,630,1200_AL_.jpg[/img]', 1, '2016-10-27 12:53:36', NULL, 1),
(92, 58, NULL, 5, 'shrek-2', 'Shrek 2', 'Shrek 2 är ett mästerverk som gjordes 2004 och är om när Shrek och Fiona ska till Fionas föräldrar och då och inte så bra i början men det slutar lyckligt med åsnan och katten sjunger livin la vida loca\r\n[img width=100% title=Shrek 2]https://i.jeded.com/i/shrek-2.11699.jpg[/img]', 1, '2016-10-27 12:56:41', NULL, 1),
(93, 58, NULL, 5, 'shrek-3', 'Shrek 3', 'Shrek 3 såg jag inte nyligen men det är när Shrek ska ta över kungadömet men han vill inte så han åker iväg för att hitta den som kan det.\r\n[img width=100% title=Hrek 3]http://www.richardcrouse.ca//wp-content/uploads/2013/09/Shrek3Wallpaper1024.jpg[/img]', 1, '2016-10-27 12:58:41', NULL, 1),
(94, 58, NULL, 5, 'shrek-4', 'Shrek 4', 'Shrek 4 är när Shrek blir trött på livet han har just nu och skriver ett kontrakt så att han får bli ett troll som han var förut. Men det han inte tänkte på var att när dagen var slut så kommer inte han finns mer och enda sättet att få kontraktet att bli slut är av true loves kiss.\r\n[img width=100% title=Shrek 4]https://images-na.ssl-images-amazon.com/images/I/91bCKSQTeeL._SL1500_.jpg[/img]', 1, '2016-10-27 13:00:38', NULL, 1),
(95, 13, NULL, 7, 'i-tried-this-on-simple-trick-now-i-don-t-have-to-work-for-the-rest-of-my-life', 'I tried this one simple trick, now I don\'t have to work for the rest of my life!', '[img width=100% title=It\'s so easy!]https://thechive.files.wordpress.com/2016/02/dank-memes-for-the-weekend-32-photos-9.jpg[/img]', 1, '2016-10-27 13:36:27', '2016-10-27 14:04:18', 1),
(96, 35, 48, 4, 'porsche', 'Porsche', 'adasadsdasadsads', 1, '2016-10-27 14:55:46', NULL, 1),
(97, 35, 57, 4, 'jappa-for-fullt', 'Jappa för fullt', 'asdadsads', 1, '2016-10-27 15:00:22', NULL, 1),
(98, 60, 58, 5, 'bil', 'Bil', '[b][i]Något[/i][/b]', 1, '2016-10-28 04:18:43', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Post_history`
--

CREATE TABLE `Post_history` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET latin1 NOT NULL,
  `content` mediumtext CHARACTER SET latin1 NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Post_history`
--

INSERT INTO `Post_history` (`id`, `post_id`, `title`, `content`, `created`) VALUES
(10, 24, 'Jakob jappar', 'Jakobiii', '2016-10-19 09:13:54'),
(11, 24, 'testos', 'fggssg', '2016-10-19 09:23:04'),
(12, 24, 'testos', '[b][i][u][s][font=Comic Sans MS][color=#ff0000][quote][list][*][b][i][u][s][font=Comic Sans MS][color=#ff0000][size=200][quote]fggssg[/quote][/size][/color][/font][/s][/u][/i][/b][/*][/list][list=1][*]tyifjyfyf[/*][/list][/quote][/color][/font][/s][/u][/i][/b][center][/center]', '2016-10-19 09:32:32'),
(13, 24, 'testos', '[b][i][u][s][font=Comic Sans MS][color=#ff0000][quote][list][*][b][i][u][s][font=Comic Sans MS][color=#ff0000][size=200][quote][img width=700 height=300 title=Squad Goals]https://i.imgur.com/1b9pjOe.jpg[/img]fggssg[/quote][/size][/color][/font][/s][/u][/i][/b][/*][/list][list=1][*]tyifjyfyf[/*][/list][/quote][/color][/font][/s][/u][/i][/b][center][/center][center][/center]', '2016-10-19 09:34:16'),
(14, 24, 'testos', '[b][i][u][s][font=Comic Sans MS][color=#ff0000][quote][list][*][b][i][u][s][font=Comic Sans MS][color=#ff0000][size=200][quote][img width=700 height=300 title=Squad Goals]https://i.imgur.com/1b9pjOe.jpg[/img]fggssg[/quote][/size][/color][/font][/s][/u][/i][/b][/*][/list][list=1][*]tyifjyfyf[/*][/list][/quote][/color][/font][/s][/u][/i][/b][center][/center][center][/center][size=200]test\r\n[/size][font=Comic Sans MS]Comic sans\r\n[/font][font=Courier New]test2[/font]', '2016-10-19 12:00:56'),
(18, 41, 'eeeeee', '[url=https://www.youtube.com/watch?v=haONsElcz1E]LÄNKAR[/url][video]haONsElcz1E[/video]', '2016-10-19 13:21:30'),
(19, 2, 'Jakob jappar', 'Jakobiii', '2016-10-19 13:26:35'),
(20, 41, 'eeeeee', '[img width=99% title=SAWEQE]https://i.imgur.com/1b9pjOe.jpg[/img]', '2016-10-19 13:29:11'),
(21, 41, 'eeeeee', '[img title=SAWEQE]https://i.imgur.com/1b9pjOe.jpg[/img]sdfsdfjasdfkasgukasd', '2016-10-19 13:32:07'),
(22, 37, 'FAfw', '[font=Comic Sans MS]Ändra font\r\n[/font][size=200]Ändra size[/size]', '2016-10-19 13:34:00'),
(23, 37, 'FAfw', '[font=Comic Sans MS]Ändra font\n[/font][size=200]Ändra size[/size]', '2016-10-19 13:37:33'),
(24, 37, 'FAfw', 'Jag är en banan som gillar att leka', '2016-10-19 13:37:45'),
(30, 41, 'eeeeee', '[img width="100%" title=dasasdasdasd]https://i.imgur.com/1b9pjOe.jpg[/img]', '2016-10-19 14:30:34'),
(31, 42, 'Kalinka', 'mm', '2016-10-19 14:57:25'),
(32, 37, 'FAfw Hej', '[font=Comic Sans MS]Ändra font\n[/font][size=200]Ändra size[/size]\n\nHej på dig\nJag är cool', '2016-10-19 15:02:37'),
(33, 42, 'Kalinka gillar bulle', 'sadsadsadsaads', '2016-10-19 15:02:41'),
(34, 42, 'Kalinka gillar bulle', 'sadsadsadsaads', '2016-10-19 15:02:45'),
(35, 42, 'Kalinka gillar bulle', 'sadsadsadsaads', '2016-10-19 15:02:52'),
(37, 63, 'TFW the rest of your suqd shows up at the pool', '[img width=100% title=HereWeGo]https://media.giphy.com/media/3oEjHGO5OqyCCBqRsA/giphy.gif[/img]', '2016-10-21 12:24:05'),
(38, 45, 'Do you believe in god?', '[youtube]UqLtUf1QNx4[/youtube]\r\n[youtube]UqLtUf1QNx4[/youtube]', '2016-10-21 13:43:01'),
(39, 2, 'Jakob jappar', 'Jakobiii', '2016-10-21 13:47:20'),
(40, 2, 'Jakob jappar', 'Jakobiii yjdyjdgfjydftujh tfj tfj fdthftdh fdth fdth fdht fdthfdth fdth fdthd fth dfth fdth ftdh dfthfdth fdth', '2016-10-21 13:52:35'),
(41, 45, 'Do you believe in god?', '[youtube]UqLtUf1QNx4[/youtube]\r\n[youtube]UqLtUf1QNx4[/youtube]', '2016-10-21 14:17:13'),
(42, 64, 'hejj', 'sssssss', '2016-10-24 10:33:05'),
(43, 45, 'Do you believe in god?xssadasdasdasdasd', '[youtube]UqLtUf1QNx4[/youtube]\r\n[youtube]UqLtUf1QNx4[/youtube]', '2016-10-24 10:33:14'),
(44, 44, 'Dormeeeeeeer', '[img width=100% title=Dormer]http://66.media.tumblr.com/91103ddd51567f70a80de9d4ad39d4a8/tumblr_nlwiquUtyS1r7mqm8o1_500.gif[/img]', '2016-10-24 10:33:25'),
(45, 73, 'Dennis bok', '[list][*][url=https://sv.wikipedia.org/wiki/1260]1260[/url] – [url=https://sv.wikipedia.org/wiki/Saif_ad-Din_Qutuz]Saif ad-Din Qutuz[/url], [url=https://sv.wikipedia.org/wiki/Sultan]sultan[/url] av mamluksultanatet i [url=https://sv.wikipedia.org/wiki/Egypten]Egypten[/url], lönnmördas av [url=https://sv.wikipedia.org/wiki/Baibars]Baibars[/url] som griper makten i sultanatet.[/*][*][url=https://sv.wikipedia.org/wiki/1375]1375[/url] – Vid Valdemar Atterdags död utropar hans dotter [url=https://sv.wikipedia.org/wiki/Drottning_Margareta]Margareta[/url] sin son [url=https://sv.wikipedia.org/wiki/Olof_av_Danmark_och_Norge]Olof Håkansson[/url] till kung av Danmark, med henne som förmyndare.[/*][*][url=https://sv.wikipedia.org/wiki/1648]1648[/url] – [url=https://sv.wikipedia.org/wiki/Westfaliska_freden]Westfaliska freden[/url] undertecknas och markerar slutet på [url=https://sv.wikipedia.org/wiki/Trettio%C3%A5riga_kriget]trettioåriga kriget[/url].[/*][*][url=https://sv.wikipedia.org/wiki/1657]1657[/url] – Den danska [url=https://sv.wikipedia.org/wiki/F%C3%A4stning]fästningen[/url] [url=https://sv.wikipedia.org/wiki/Frederiksodde]Frederiksodde[/url] stormas och intas av svenska trupper, vilket var en av förutsättningarna för [url=https://sv.wikipedia.org/wiki/T%C3%A5get_%C3%B6ver_B%C3%A4lt]tåget över Bält[/url].[/*][*][url=https://sv.wikipedia.org/wiki/1929]1929[/url] – [url=https://sv.wikipedia.org/wiki/Svarta_torsdagen]Svarta torsdagen[/url] som blev inledningen till [url=https://sv.wikipedia.org/wiki/Wall_Street-kraschen]Wall Street-kraschen[/url].[/*][*][url=https://sv.wikipedia.org/wiki/1940]1940[/url][list][*]Färja med trupptransport av ingenjörer kantrar i sjön [url=https://sv.wikipedia.org/wiki/Armasj%C3%A4rvi_(sj%C3%B6)]Armasjärvi[/url] vid [url=https://sv.wikipedia.org/wiki/%C3%96vertorne%C3%A5_kommun]Övertorneå[/url] i [url=https://sv.wikipedia.org/wiki/Sverige]Sverige[/url]. Fyrtiosex man omkommer.[/*][*][url=https://sv.wikipedia.org/w/index.php?title=Svenska_Johnsonlinjen&amp;action=edit&amp;redlink=1]Svenska Johnsonlinjens[/url] tankmotorfartyg Janus torpederas. Fyra omkomna; 33 räddade av engelskt [url=https://sv.wikipedia.org/wiki/%C3%96rlogsfartyg]örlogsfartyg[/url].[/*][*]Tyskt enmotorigt jaktflygplan nödlandar utanför [url=https://sv.wikipedia.org/wiki/Karlstad]Karlstad[/url] på grund av kompassfel.Besättningsmannen, en [url=https://sv.wikipedia.org/wiki/Underofficer]underofficer[/url], och planet omhändertas av svensk militär.[/*][/list][/*][*][url=https://sv.wikipedia.org/wiki/1945]1945[/url] – [url=https://sv.wikipedia.org/wiki/FN-stadgan]FN-stadgan[/url] träder i kraft, till vars minne [url=https://sv.wikipedia.org/wiki/FN-dagen]FN-dagen[/url] firas.[url=https://sv.wikipedia.org/wiki/24_oktober#cite_note-1][1][/url][/*][*][url=https://sv.wikipedia.org/wiki/1964]1964[/url] – [url=https://sv.wikipedia.org/wiki/Nordrhodesia]Nordrhodesia[/url] blir självständigt från [url=https://sv.wikipedia.org/wiki/Storbritannien]Storbritannien[/url] under namnet [url=https://sv.wikipedia.org/wiki/Zambia]Zambia[/url].[url=https://sv.wikipedia.org/wiki/24_oktober#cite_note-2][2][/url] Samtidigt byter [url=https://sv.wikipedia.org/wiki/Sydrhodesia]Sydrhodesia[/url] namn till [url=https://sv.wikipedia.org/wiki/Rhodesia]Rhodesia[/url].[url=https://sv.wikipedia.org/wiki/24_oktober#cite_note-3][3][/url][/*][*][url=https://sv.wikipedia.org/wiki/1998]1998[/url] – [url=https://sv.wikipedia.org/wiki/Lucian_Pulvermacher]Lucian Pulvermacher[/url] väljs till påve med namnet Pius XIII men accepteras aldrig från officiellt romersk-katolskt håll.[/*][*][url=https://sv.wikipedia.org/wiki/2004]2004[/url] – Invigning av [url=https://sv.wikipedia.org/wiki/S%C3%B6dra_L%C3%A4nken]Södra Länken[/url], en [url=https://sv.wikipedia.org/wiki/Motorv%C3%A4g]motorväg[/url] i [url=https://sv.wikipedia.org/wiki/Nacka]Nacka[/url] och [url=https://sv.wikipedia.org/wiki/Stockholm]Stockholm[/url].[/*][/list][youtube]LC5OPzt1tsM[/youtube]', '2016-10-24 13:36:25'),
(46, 73, 'Dennis bok', '[list][*][url=https://sv.wikipedia.org/wiki/1260]1260[/url] – [url=https://sv.wikipedia.org/wiki/Saif_ad-Din_Qutuz]Saif ad-Din Qutuz[/url], [url=https://sv.wikipedia.org/wiki/Sultan]sultan[/url] av mamluksultanatet i [url=https://sv.wikipedia.org/wiki/Egypten]Egypten[/url], lönnmördas av [url=https://sv.wikipedia.org/wiki/Baibars]Baibars[/url] som griper makten i sultanatet.[/*][*][url=https://sv.wikipedia.org/wiki/1375]1375[/url] – Vid Valdemar Atterdags död utropar hans dotter [url=https://sv.wikipedia.org/wiki/Drottning_Margareta]Margareta[/url] sin son [url=https://sv.wikipedia.org/wiki/Olof_av_Danmark_och_Norge]Olof Håkansson[/url] till kung av Danmark, med henne som förmyndare.[/*][*][url=https://sv.wikipedia.org/wiki/1648]1648[/url] – [url=https://sv.wikipedia.org/wiki/Westfaliska_freden]Westfaliska freden[/url] undertecknas och markerar slutet på [url=https://sv.wikipedia.org/wiki/Trettio%C3%A5riga_kriget]trettioåriga kriget[/url].[/*][*][url=https://sv.wikipedia.org/wiki/1657]1657[/url] – Den danska [url=https://sv.wikipedia.org/wiki/F%C3%A4stning]fästningen[/url] [url=https://sv.wikipedia.org/wiki/Frederiksodde]Frederiksodde[/url] stormas och intas av svenska trupper, vilket var en av förutsättningarna för [url=https://sv.wikipedia.org/wiki/T%C3%A5get_%C3%B6ver_B%C3%A4lt]tåget över Bält[/url].[/*][*][url=https://sv.wikipedia.org/wiki/1929]1929[/url] – [url=https://sv.wikipedia.org/wiki/Svarta_torsdagen]Svarta torsdagen[/url] som blev inledningen till [url=https://sv.wikipedia.org/wiki/Wall_Street-kraschen]Wall Street-kraschen[/url].[/*][*][url=https://sv.wikipedia.org/wiki/1940]1940[/url][list][*]Färja med trupptransport av ingenjörer kantrar i sjön [url=https://sv.wikipedia.org/wiki/Armasj%C3%A4rvi_(sj%C3%B6)]Armasjärvi[/url] vid [url=https://sv.wikipedia.org/wiki/%C3%96vertorne%C3%A5_kommun]Övertorneå[/url] i [url=https://sv.wikipedia.org/wiki/Sverige]Sverige[/url]. Fyrtiosex man omkommer.[/*][*][url=https://sv.wikipedia.org/w/index.php?title=Svenska_Johnsonlinjen&action=edit&redlink=1]Svenska Johnsonlinjens[/url] tankmotorfartyg Janus torpederas. Fyra omkomna; 33 räddade av engelskt [url=https://sv.wikipedia.org/wiki/%C3%96rlogsfartyg]örlogsfartyg[/url].[/*][*]Tyskt enmotorigt jaktflygplan nödlandar utanför [url=https://sv.wikipedia.org/wiki/Karlstad]Karlstad[/url] på grund av kompassfel.Besättningsmannen, en [url=https://sv.wikipedia.org/wiki/Underofficer]underofficer[/url], och planet omhändertas av svensk militär.[/*][/list][/*][*][url=https://sv.wikipedia.org/wiki/1945]1945[/url] – [url=https://sv.wikipedia.org/wiki/FN-stadgan]FN-stadgan[/url] träder i kraft, till vars minne [url=https://sv.wikipedia.org/wiki/FN-dagen]FN-dagen[/url] firas.[sup][url=https://sv.wikipedia.org/wiki/24_oktober#cite_note-1][1][/url][/sup][/*][*][url=https://sv.wikipedia.org/wiki/1964]1964[/url] – [url=https://sv.wikipedia.org/wiki/Nordrhodesia]Nordrhodesia[/url] blir självständigt från [url=https://sv.wikipedia.org/wiki/Storbritannien]Storbritannien[/url] under namnet [url=https://sv.wikipedia.org/wiki/Zambia]Zambia[/url].[url=https://sv.wikipedia.org/wiki/24_oktober#cite_note-2][2][/url] Samtidigt byter [url=https://sv.wikipedia.org/wiki/Sydrhodesia]Sydrhodesia[/url] namn till [url=https://sv.wikipedia.org/wiki/Rhodesia]Rhodesia[/url].[url=https://sv.wikipedia.org/wiki/24_oktober#cite_note-3][3][/url][/*][*][url=https://sv.wikipedia.org/wiki/1998]1998[/url] – [url=https://sv.wikipedia.org/wiki/Lucian_Pulvermacher]Lucian Pulvermacher[/url] väljs till påve med namnet Pius XIII men accepteras aldrig från officiellt romersk-katolskt håll.[/*][*][url=https://sv.wikipedia.org/wiki/2004]2004[/url] – Invigning av [url=https://sv.wikipedia.org/wiki/S%C3%B6dra_L%C3%A4nken]Södra Länken[/url], en [url=https://sv.wikipedia.org/wiki/Motorv%C3%A4g]motorväg[/url] i [url=https://sv.wikipedia.org/wiki/Nacka]Nacka[/url] och [url=https://sv.wikipedia.org/wiki/Stockholm]Stockholm[/url].[/*][/list][youtube]LC5OPzt1tsM[/youtube]', '2016-10-24 13:38:05'),
(47, 78, 'Dank', '[img width=100% title=Make America Mexico again!]http://starecat.com/content/wp-content/uploads/hey-kid-are-you-a-mexico-not-at-all-trump-for-president-keep-it-up-my-man-dios-mio-that-was-close.jpg[/img]', '2016-10-25 09:01:00'),
(48, 78, 'Dank', '[img width=100% title=Make America Mexico again!]http://starecat.com/content/wp-content/uploads/hey-kid-are-you-a-mexico-not-at-all-trump-for-president-keep-it-up-my-man-dios-mio-that-was-close.jpg[/img]', '2016-10-25 09:01:57'),
(49, 16, 'Jakob jappar', 'Jakobiii', '2016-10-25 13:43:08'),
(50, 16, 'William jappar', 'Jakobiii', '2016-10-25 13:43:34'),
(51, 44, 'Dormeeeeeeer', '[img width=100% title=Dormer]http://66.media.tumblr.com/91103ddd51567f70a80de9d4ad39d4a8/tumblr_nlwiquUtyS1r7mqm8o1_500.gif[/img]', '2016-10-25 14:53:13'),
(53, 89, 'Alphaville... Skall vi vara unga för evigt?... JA!!!!!!', 'YOutube it...!!!!\r\n', '2016-10-26 05:08:47'),
(54, 16, 'Jakob jappar', 'Jakobiii', '2016-10-27 09:14:45'),
(55, 16, 'Jakob jappar', 'Jakobiii', '2016-10-27 09:14:57'),
(56, 95, 'I tried this on simple trick, now I don&#039;t have to work for the rest of my life!', '[img width=100% title=It&#039;s so easy!]https://thechive.files.wordpress.com/2016/02/dank-memes-for-the-weekend-32-photos-9.jpg[/img]', '2016-10-27 13:48:12'),
(57, 95, 'I tried this on simple trick, now I don\'t have to work for the rest of my life!', '[img width=100% title=Its so easy!]https://thechive.files.wordpress.com/2016/02/dank-memes-for-the-weekend-32-photos-9.jpg[/img]', '2016-10-27 13:48:37'),
(58, 95, 'I tried this on simple trick, now I don\'t have to work for the rest of my life!', '[img width=100% title=Its so easy]https://thechive.files.wordpress.com/2016/02/dank-memes-for-the-weekend-32-photos-9.jpg[/img]', '2016-10-27 13:51:39'),
(59, 95, 'I tried this on simple trick, now I don\'t have to work for the rest of my life!', '[img width=100% title=It\'s so easy!]https://thechive.files.wordpress.com/2016/02/dank-memes-for-the-weekend-32-photos-9.jpg[/img]', '2016-10-27 14:04:18'),
(60, 16, 'Jakob jappar', 'Jakobiii', '2016-10-27 14:46:31'),
(61, 16, 'Jakob jappar', 'Jakobiii', '2016-10-27 14:54:20');

-- --------------------------------------------------------

--
-- Table structure for table `Post_like`
--

CREATE TABLE `Post_like` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Post_like`
--

INSERT INTO `Post_like` (`id`, `user_id`, `post_id`) VALUES
(79, 9, 2),
(85, 6, 2),
(87, 5, 30),
(88, 8, 24),
(89, 5, 50),
(90, 5, 49),
(93, 5, 56),
(104, 5, 55),
(105, 6, 48),
(106, 8, 64),
(107, 5, 69),
(112, 6, 65),
(113, 5, 75),
(114, 6, 61),
(115, 8, 77),
(116, 5, 81),
(117, 8, 83),
(119, 10, 2),
(120, 5, 94),
(121, 5, 93),
(122, 5, 91),
(123, 5, 92),
(124, 10, 98),
(125, 5, 98);

-- --------------------------------------------------------

--
-- Table structure for table `Report`
--

CREATE TABLE `Report` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `type` tinyint(1) NOT NULL,
  `reported_id` int(11) NOT NULL,
  `reason` varchar(255) CHARACTER SET latin1 NOT NULL,
  `priority` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Report`
--

INSERT INTO `Report` (`id`, `user_id`, `admin_id`, `type`, `reported_id`, `reason`, `priority`, `status`, `updated_at`) VALUES
(18, 7, 4, 1, 168, 'Han är ful :\'C', 1, 1, '2016-10-25 13:40:53'),
(19, 4, 4, 1, 164, 'jävla idiot', 1, 1, '2016-10-25 13:40:52'),
(20, 4, NULL, 1, 174, 'är han knasig eller?', 1, 0, '2016-10-25 13:48:34'),
(21, 5, NULL, 2, 86, 'Stötande', 1, 0, '2016-10-25 15:00:17'),
(22, 5, NULL, 0, 25, 'Finns inga posts', 1, 0, '2016-10-25 15:00:33'),
(23, 5, NULL, 2, 16, 'Kan inte kommentera', 1, 0, '2016-10-25 15:01:02'),
(24, 5, NULL, 0, 44, 'Inga posts', 1, 0, '2016-10-25 15:01:08'),
(25, 5, NULL, 0, 55, 'Dålig och inga posts', 1, 0, '2016-10-25 15:01:27'),
(26, 4, NULL, 2, 16, 'nub', 1, 0, '2016-10-26 08:47:57'),
(27, 5, NULL, 2, 80, 'Detta är en mycket lång och komplicerad rapportering som ska visa hur det blir när man skriver en lång text för att beskriva ett problem', 1, 0, '2016-10-26 09:11:52'),
(28, 5, NULL, 2, 79, 'Jag rapporterar nu', 1, 0, '2016-10-26 09:47:24'),
(29, 5, NULL, 2, 76, 'Hej hej', 1, 0, '2016-10-26 09:47:58'),
(30, 5, NULL, 0, 7, 'Rapporterar blogg', 1, 0, '2016-10-26 09:52:46'),
(32, 5, NULL, 1, 162, 'Rapporterar kommentar', 1, 0, '2016-10-26 10:04:40'),
(33, 5, NULL, 1, 4, 'Rapporterar', 1, 0, '2016-10-26 10:05:54'),
(34, 5, NULL, 2, 75, 'Rapporterar i inlägg', 1, 0, '2016-10-26 10:07:55'),
(35, 10, NULL, 2, 67, 'Jag är lite ...asd.asd', 1, 0, '2016-10-26 10:34:09'),
(36, 5, NULL, 2, 74, 'asdwf', 1, 0, '2016-10-26 12:14:55'),
(37, 5, NULL, 2, 73, 'dbwq', 1, 0, '2016-10-26 12:15:05'),
(38, 5, NULL, 2, 72, 'dwqb\n', 1, 0, '2016-10-26 12:15:51'),
(39, 5, NULL, 2, 71, 'qwveq', 1, 0, '2016-10-26 12:16:23'),
(40, 5, NULL, 0, 45, '5rwgv', 1, 0, '2016-10-26 12:16:35'),
(41, 5, NULL, 0, 4, 'Har ingen profilbild\n', 1, 0, '2016-10-26 14:50:34'),
(42, 4, NULL, 0, 35, 'das', 1, 0, '2016-10-27 09:05:43'),
(43, 6, NULL, 2, 44, 'Detta är politisk propaganda', 1, 0, '2016-10-27 12:17:22'),
(44, 5, NULL, 1, 186, 'Du är ful\n', 1, 0, '2016-10-27 12:50:02'),
(45, 5, NULL, 2, 67, 'Han är ful', 1, 0, '2016-10-27 12:50:23'),
(46, 7, NULL, 2, 82, 'Han är jätte ful :\'c', 1, 0, '2016-10-27 13:33:38'),
(47, 5, NULL, 2, 82, 'Hej hej', 3, 0, '2016-10-27 22:08:45'),
(48, 5, 5, 2, 78, 'Dåligt', 2, 1, '2016-10-28 07:25:11'),
(49, 5, NULL, 2, 64, 'Hej hej', 1, 0, '2016-10-28 07:27:09'),
(50, 10, NULL, 0, 60, 'Gillar inte hhonom', 3, 0, '2016-10-28 10:16:25'),
(51, 5, NULL, 2, 98, 'Håller inte med', 2, 0, '2016-10-28 10:20:49'),
(52, 5, NULL, 1, 190, 'Dålig', 2, 0, '2016-10-28 10:23:02');

-- --------------------------------------------------------

--
-- Table structure for table `Social`
--

CREATE TABLE `Social` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `parent_class` varchar(255) DEFAULT NULL,
  `class` varchar(255) NOT NULL,
  `base_url` varchar(255) DEFAULT NULL,
  `placeholder` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Social`
--

INSERT INTO `Social` (`id`, `name`, `parent_class`, `class`, `base_url`, `placeholder`) VALUES
(1, 'Facebook', 'icoFacebook', 'fa fa-facebook', 'https://www.facebook.com/', 'Profilnamn'),
(2, 'Twitter', 'icoTwitter', 'fa fa-twitter', 'https://twitter.com/', 'Användarnamn'),
(3, 'Google +', 'icoGoogle', 'fa fa-google-plus', 'https://plus.google.com/u/', 'Användareid'),
(4, 'Vimeo', 'icoVimeo', 'fa fa-vimeo', 'https://vimeo.com/', 'Profilnamn'),
(5, 'Linkedin', 'icoLinkedin', 'fa fa-linkedin', 'https://www.linkedin.com/in/', 'Profilnamn');

-- --------------------------------------------------------

--
-- Table structure for table `Social_link`
--

CREATE TABLE `Social_link` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `social_id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Social_link`
--

INSERT INTO `Social_link` (`id`, `blog_id`, `social_id`, `link`) VALUES
(23, 56, 1, 'Emil Gunnarsson'),
(24, 26, 1, 'kevinhedsand'),
(25, 26, 2, 'pollopen'),
(27, 57, 5, '&lt;/div&gt;&lt;b&gt;nope.stina&lt;/b&gt;'),
(28, 57, 4, 'stinuspinus'),
(29, 57, 3, 'stinapina'),
(30, 57, 2, 'stinapina'),
(31, 57, 1, 'stina.karlsson.1'),
(33, 58, 1, 'shrek'),
(34, 59, 1, 'carthrottle'),
(40, 7, 3, 'Stuff'),
(41, 60, 1, 'migthycarmods');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'auto incrementing user_id of each user, unique index',
  `session_id` varchar(48) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'stores session cookie id to prevent session concurrency',
  `user_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `user_active` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s activation status',
  `user_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s deletion status',
  `user_account_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'user''s account type (basic, premium, etc)',
  `user_has_avatar` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 if user has a local avatar, 0 if not',
  `user_remember_me_token` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s remember-me cookie token',
  `user_creation_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of the creation of user''s account',
  `user_suspension_timestamp` bigint(20) DEFAULT NULL COMMENT 'Timestamp till the end of a user suspension',
  `user_last_login_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of user''s last login',
  `user_failed_logins` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s failed login attempts',
  `user_last_failed_login` int(10) DEFAULT NULL COMMENT 'unix timestamp of last failed login attempt',
  `user_activation_hash` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s email verification hash string',
  `user_password_reset_hash` char(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s password reset code',
  `user_password_reset_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of the password reset request',
  `user_provider_type` text CHARACTER SET utf8 COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='user data';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `session_id`, `user_name`, `user_password_hash`, `user_email`, `user_active`, `user_deleted`, `user_account_type`, `user_has_avatar`, `user_remember_me_token`, `user_creation_timestamp`, `user_suspension_timestamp`, `user_last_login_timestamp`, `user_failed_logins`, `user_last_failed_login`, `user_activation_hash`, `user_password_reset_hash`, `user_password_reset_timestamp`, `user_provider_type`) VALUES
(4, 'vqgcqp8pqj2dco9c66h3uiddq6', 'Mithra', '$2y$10$q7UK.aVPgXs2zirnadzA.Oi2al5GjaQsC3KZcnDK70VacNvCU3LWO', 'erfan.atg@gmail.com', 1, 0, 3, 1, NULL, 1475760038, NULL, 1477577095, 0, NULL, NULL, 'c1f91a3eab321e4c8809ac7e2498bc39c05fb8af', 1475823796, 'DEFAULT'),
(5, NULL, 'Rickfo', '$2y$10$mtevc4K17e9TdkK/X/6PKOVzyAKOE1UjVHZo238DLc4tEMfr.6F3W', 'rickfo_97@hotmail.com', 1, 0, 3, 1, NULL, 1475821658, NULL, 1477642420, 0, NULL, NULL, NULL, NULL, 'DEFAULT'),
(6, 's2raote2brrc5dcmcffrjurrk3', 'Jakob', '$2y$10$5RipOOohvx5UTl4AwvFZoORahA7AE5VuWs45Rt3Gjn5KX1GARd6RO', 'sandstedt_95@hotmail.com', 1, 0, 1, 1, NULL, 1475821683, NULL, 1477600869, 0, NULL, NULL, NULL, NULL, 'DEFAULT'),
(7, 'smm9no9pljg3bfv52obvbck2f2', 'MrBulldozer', '$2y$10$oSjx1YE.EkegWM61.PUqlOUGUNw4FaQt4tU37/tsc8QidegKhs62y', 'estiv97@gmail.com', 1, 0, 1, 1, NULL, 1475821731, NULL, 1477569841, 0, NULL, NULL, NULL, NULL, 'DEFAULT'),
(8, '4231crtpt9h6n972kmchpepjk6', 'Pollopen', '$2y$10$kinchtzhYpXUP/J650tT4OtZI/2Cs4DF1vV9rC6/nYnOYpnqIxuOe', 'kevinhedsand@yahoo.se', 1, 0, 1, 1, NULL, 1475821742, NULL, 1477636886, 0, NULL, NULL, NULL, NULL, 'DEFAULT'),
(9, 'b1fl95qn1l4dpnv5uafasekbo6', 'Peychas', '$2y$10$AwgOvKyBcSeXj2PTYRKkXeRLbAhOtMonFbAoWAlWBYH47gGVPOlpu', 'Nian_wow@live.se', 1, 0, 1, 0, NULL, 1475821816, NULL, 1477636518, 0, NULL, NULL, NULL, NULL, 'DEFAULT'),
(10, NULL, 'Stina', '$2y$10$vgrtxa8MbtVu.WgEjyY/5uSjpuwolLNbZWMyX6hWGPb6DtEAK9jF6', 'stefan@jurran.se', 1, 0, 1, 1, NULL, 1477470677, 1478766548, 1477642449, 0, NULL, NULL, NULL, NULL, 'DEFAULT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Blog`
--
ALTER TABLE `Blog`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `user` (`user_id`);

--
-- Indexes for table `Blog_moderator`
--
ALTER TABLE `Blog_moderator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user_id`),
  ADD KEY `blog` (`blog_id`);

--
-- Indexes for table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_id` (`blog_id`);

--
-- Indexes for table `Comment`
--
ALTER TABLE `Comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post` (`post_id`),
  ADD KEY `comment` (`comment_id`),
  ADD KEY `user` (`user_id`) USING BTREE;

--
-- Indexes for table `Comment_like`
--
ALTER TABLE `Comment_like`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user_id`),
  ADD KEY `comment` (`comment_id`);

--
-- Indexes for table `Favorite`
--
ALTER TABLE `Favorite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user_id`),
  ADD KEY `post` (`post_id`);

--
-- Indexes for table `Pages`
--
ALTER TABLE `Pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `blog_id` (`blog_id`);

--
-- Indexes for table `Post`
--
ALTER TABLE `Post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog` (`blog_id`),
  ADD KEY `user` (`user_id`) USING BTREE,
  ADD KEY `category` (`category_id`) USING BTREE;

--
-- Indexes for table `Post_history`
--
ALTER TABLE `Post_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post` (`post_id`);

--
-- Indexes for table `Post_like`
--
ALTER TABLE `Post_like`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user_id`),
  ADD KEY `post` (`post_id`);

--
-- Indexes for table `Report`
--
ALTER TABLE `Report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user_id`);

--
-- Indexes for table `Social`
--
ALTER TABLE `Social`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Social_link`
--
ALTER TABLE `Social_link`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog` (`blog_id`),
  ADD KEY `social` (`social_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Blog`
--
ALTER TABLE `Blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `Blog_moderator`
--
ALTER TABLE `Blog_moderator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `Category`
--
ALTER TABLE `Category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `Comment`
--
ALTER TABLE `Comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;
--
-- AUTO_INCREMENT for table `Comment_like`
--
ALTER TABLE `Comment_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
--
-- AUTO_INCREMENT for table `Favorite`
--
ALTER TABLE `Favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `Pages`
--
ALTER TABLE `Pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `Post`
--
ALTER TABLE `Post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT for table `Post_history`
--
ALTER TABLE `Post_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `Post_like`
--
ALTER TABLE `Post_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;
--
-- AUTO_INCREMENT for table `Report`
--
ALTER TABLE `Report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `Social`
--
ALTER TABLE `Social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `Social_link`
--
ALTER TABLE `Social_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index', AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Blog`
--
ALTER TABLE `Blog`
  ADD CONSTRAINT `Blog_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `Blog_moderator`
--
ALTER TABLE `Blog_moderator`
  ADD CONSTRAINT `Blog_moderator_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `Blog` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Blog_moderator_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `Category`
--
ALTER TABLE `Category`
  ADD CONSTRAINT `Category_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `Blog` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `Comment_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `Comment` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Comment_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `Post` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `Comment_like`
--
ALTER TABLE `Comment_like`
  ADD CONSTRAINT `Comment_like_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Comment_like_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `Comment` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `Favorite`
--
ALTER TABLE `Favorite`
  ADD CONSTRAINT `Favorite_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Favorite_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `Post` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `Pages`
--
ALTER TABLE `Pages`
  ADD CONSTRAINT `Pages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Pages_ibfk_2` FOREIGN KEY (`blog_id`) REFERENCES `Blog` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `Post`
--
ALTER TABLE `Post`
  ADD CONSTRAINT `Post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Post_ibfk_2` FOREIGN KEY (`blog_id`) REFERENCES `Blog` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `Post_history`
--
ALTER TABLE `Post_history`
  ADD CONSTRAINT `Post_history_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `Post` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `Post_like`
--
ALTER TABLE `Post_like`
  ADD CONSTRAINT `Post_like_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Post_like_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `Post` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `Report`
--
ALTER TABLE `Report`
  ADD CONSTRAINT `Report_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
