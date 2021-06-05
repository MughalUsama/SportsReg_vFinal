-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2021 at 03:44 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sportsreg`
--

-- --------------------------------------------------------

--
-- Table structure for table `ar_brouchures`
--

CREATE TABLE `ar_brouchures` (
  `request_id` int(11) NOT NULL,
  `PrintReadyFile` varchar(5) NOT NULL,
  `NeedDesignHelp` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `business_categories`
--

CREATE TABLE `business_categories` (
  `business_category_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business_categories`
--

INSERT INTO `business_categories` (`business_category_id`, `business_id`, `category_id`) VALUES
(155, 16, 2),
(156, 16, 3),
(157, 16, 4),
(158, 16, 5),
(159, 16, 6),
(160, 16, 8),
(161, 16, 9),
(162, 16, 10),
(176, 12, 2),
(177, 12, 3),
(178, 12, 5),
(198, 28, 2),
(199, 28, 3),
(200, 28, 4),
(201, 28, 6);

-- --------------------------------------------------------

--
-- Table structure for table `business_counties`
--

CREATE TABLE `business_counties` (
  `business_counties_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `county_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business_counties`
--

INSERT INTO `business_counties` (`business_counties_id`, `business_id`, `county_name`) VALUES
(31, 12, 'Oslo'),
(32, 12, 'Rogaland'),
(42, 16, 'Hele Norge (all over the country)'),
(73, 28, 'Hele Norge (all over the country)'),
(74, 28, 'Oslo'),
(75, 28, 'Rogaland');

-- --------------------------------------------------------

--
-- Table structure for table `business_info`
--

CREATE TABLE `business_info` (
  `business_id` int(11) NOT NULL,
  `business_name` varchar(50) NOT NULL,
  `vat` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `business_email` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `contact_person` varchar(50) NOT NULL,
  `contact_email` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `logo_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business_info`
--

INSERT INTO `business_info` (`business_id`, `business_name`, `vat`, `address`, `telephone`, `business_email`, `website`, `contact_person`, `contact_email`, `email`, `password`, `logo_name`) VALUES
(12, 'Usama and Company', '1111111111111', 'Lahore', '03204115426', 'bsef17m035@pucit.edu.pk', 'https://www.github.com/mughalusama', 'Usama Shahid', 'bsef17m035@pucit.edu.pk', 'bsef17m035@pucit.edu.pk', 'aaaaaaaa', '5ff84a6e67e2c.png'),
(16, 'Unknown123', 'aujkwh828128', 'asdugauig', '2338247', 'usama@d.com', 'https://www.github.com.pk', 'FARAZ', 'usama@d.com', 'usama@d.com', 'aaaaaaaa', '5ff84a6e67e2c.png'),
(28, 'Shahid and sons', '1111111111111', 'aaaaaaaaa aaa a', '0300000000', 'aaaa@ssss.cpm', 'https://www.github.com.pk', 'Usama Shahid', 'usama@1.com', 'usama@1.com', 'aaaaaaaa', '5ffdb9c0394cb.png');

-- --------------------------------------------------------

--
-- Table structure for table `business_products`
--

CREATE TABLE `business_products` (
  `business_products_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business_products`
--

INSERT INTO `business_products` (`business_products_id`, `business_id`, `product_id`, `category_id`) VALUES
(156, 16, 3, 2),
(157, 16, 5, 2),
(158, 16, 13, 2),
(159, 16, 4, 2),
(160, 16, 2, 2),
(173, 12, 3, 2),
(174, 12, 5, 2),
(175, 12, 13, 2),
(176, 12, 4, 2),
(177, 12, 16, 5),
(178, 12, 10, 3),
(233, 28, 3, 2),
(234, 28, 5, 2),
(235, 28, 13, 2),
(236, 28, 4, 2),
(237, 28, 2, 2),
(238, 28, 10, 3),
(239, 28, 9, 3),
(240, 28, 8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `business_sports`
--

CREATE TABLE `business_sports` (
  `business_sports_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `sports_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business_sports`
--

INSERT INTO `business_sports` (`business_sports_id`, `business_id`, `sports_name`) VALUES
(64, 12, 'Football'),
(65, 12, 'Ishockey'),
(62, 16, 'Handball'),
(63, 16, 'Ishockey'),
(101, 28, 'Cricket'),
(91, 28, 'Football'),
(97, 28, 'Handball'),
(92, 28, 'Ishockey');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(2, 'Idrettsreiser'),
(3, 'Reklame'),
(4, 'Premier'),
(5, 'Treningsutstyr'),
(6, 'Medisinsk'),
(7, 'Garderobeutstyr'),
(8, 'Administrasjon/klubbdrift'),
(9, 'Stadion/arena'),
(10, 'Inntektsbringende'),
(16, 'Garderobe'),
(18, 'Fotograf'),
(19, 'Trykkeritjenester'),
(20, 'Spillerutstyr'),
(21, 'Trenerutstyr'),
(22, 'Dugnad');

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `club_id` int(11) NOT NULL,
  `club_name` varchar(50) NOT NULL,
  `contact_person` varchar(50) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL COMMENT 'username',
  `address` varchar(50) NOT NULL,
  `post_code` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `isadmin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`club_id`, `club_name`, `contact_person`, `telephone`, `email`, `address`, `post_code`, `city`, `password`, `isadmin`) VALUES
(1, 'Usama\'s Club', 'Usama Shahid', '03104115426', 'mughalusama1133@gmail.com', 'Shad bagh', '54000', 'Lahore', 'aaaaaaaa', 0),
(5, 'Real Madrid', 'aaaaa', 'llll44', 'aaaa@ssss.cpm', 'wswwwwwwwww', 'wwwww', 'wwww', 'aaaaaaaa', 0),
(6, 'mu', 'aaaaa', 'llll44', 'waleedshahid@rocketmails.com', 'wswwwwwwwww', 'wwwww', 'wwww', 'aaaaaaaaaaa', 0),
(7, 'Real Madrid', 'aaaaa', 'llll44', '03244014942@d.com', 'wswwwwwwwww', 'wwwww', 'wwww', 'zzzzzzzzzzzzz', 0),
(8, 'Real Madrid', 'aaaaa', 'llll44', 'bsef17m035@pucit.edu.pk', 'wswwwwwwwww', 'wwwww', 'Lahore', 'usamashahid', 0),
(9, 'abc12345', 'Usama Shahid', '0300000000', 'usama@d.com', 'aaaaaaaaa aaa a', '54000', 'Lahore', 'aaaaaaaa', 0),
(11, 'Administrator', 'N/A', 'N/A', 'admin@sportsreg.com', 'N/A', 'N/A', 'N/A', 'admin@sportsreg123', 1),
(12, 'New club', 'abc', '0310101010', 'musama@gmail.com', 'Lahore', '54000', 'Lahore', 'aaaaaaaa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `club_requests`
--

CREATE TABLE `club_requests` (
  `request_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `sports` varchar(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `size` varchar(30) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `accepted_by` int(11) DEFAULT NULL COMMENT 'business_id',
  `created_on` date NOT NULL DEFAULT current_timestamp(),
  `accepted_on` datetime DEFAULT NULL,
  `filename` varchar(30) DEFAULT NULL,
  `table_name` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `club_requests`
--

INSERT INTO `club_requests` (`request_id`, `club_id`, `sports`, `category_id`, `product_id`, `quantity`, `color`, `size`, `description`, `status`, `accepted_by`, `created_on`, `accepted_on`, `filename`, `table_name`) VALUES
(25, 1, 'Football', 2, 3, 9, 'red', 'large', 'ahsuijchdujbc', 0, NULL, '2021-02-09', NULL, '6022862d2c600.pdf', NULL),
(26, 1, 'Football', 2, 3, 10, 'red', 'large', 'sdfkjbsj', 0, NULL, '2021-02-09', NULL, '6022866cc14dd.pdf', NULL),
(27, 1, 'Football', 3, 10, 10, 'red', 'large', 'mlkfdmvlem', 0, NULL, '2021-02-22', NULL, '6033ba7fad698.docx', NULL),
(28, 1, 'Football', 3, 10, 10, 'red', 'kndlsnclk', 'jdks.fvjbg', 0, NULL, '2021-02-22', NULL, '6033baa71f6af.pdf', NULL),
(29, 1, 'Ishockey', 3, 10, 1, 'red', 'large', 'kkln', 0, NULL, '2021-02-22', NULL, '6033bbd53e6e9.pdf', NULL),
(30, 1, 'Ishockey', 3, 10, 2, 'jkds', 'nlkdavnlk', 'lfdjbfovnl', 0, NULL, '2021-02-22', NULL, '6033c0777b94c.docx', NULL),
(47, 1, 'Football', 6, 64, 7, NULL, NULL, 'ksdnlcnsl', 0, NULL, '2021-02-23', NULL, '6034c07bc1aa3.PNG', NULL),
(48, 1, 'Football', 6, 64, NULL, NULL, NULL, '', 0, NULL, '2021-02-23', NULL, '6034f8ac02b65.PNG', 'invitations'),
(49, 1, 'Football', 6, 64, NULL, NULL, NULL, 'knksldnk', 0, NULL, '2021-02-23', NULL, '6034f91f53f2b.PNG', 'invitations'),
(50, 1, 'Football', 6, 64, NULL, NULL, NULL, 'knlnc', 0, NULL, '2021-02-23', NULL, '6034f949667bf.PNG', 'invitations'),
(51, 1, 'Football', 6, 64, NULL, NULL, NULL, 'knlnc', 0, NULL, '2021-02-23', NULL, '6034f9afd8cc5.PNG', 'invitations'),
(52, 1, 'Football', 6, 64, NULL, NULL, NULL, 'dsnklnn', 0, NULL, '2021-02-23', NULL, '6034fa05ec317.pdf', 'invitations'),
(53, 1, 'Football', 6, 64, NULL, NULL, NULL, 'dsnklnn', 0, NULL, '2021-02-23', NULL, '6034fa3226d77.pdf', 'invitations'),
(54, 1, 'Football', 6, 64, NULL, NULL, NULL, 'dsnklnn', 0, NULL, '2021-02-23', NULL, '6034fa484caeb.pdf', 'invitations'),
(56, 1, 'Ishockey', 4, 11, NULL, NULL, NULL, 'kjsdfujbjb', 0, NULL, '2021-02-23', NULL, '6034fc5f93d14.PNG', 'medaljer'),
(57, 1, 'Football', 6, 18, NULL, NULL, NULL, 'hi', 0, NULL, '2021-02-23', NULL, '6034feae071f4.pdf', 'massage_table'),
(58, 1, 'Football', 6, 18, 11, NULL, NULL, 'jsdbcjkbd', 0, NULL, '2021-02-23', NULL, '603500a58bbf6.pdf', NULL),
(59, 1, 'Football', 6, 18, 6, NULL, NULL, 'jdzjkcjk', 0, NULL, '2021-02-23', NULL, '603500e9c8d07.PNG', NULL),
(61, 1, 'Football', 8, 23, NULL, NULL, NULL, 'kdsnkn', 0, NULL, '2021-02-23', NULL, '6035078886edf.PNG', 'photo'),
(62, 1, 'Football', 8, 23, NULL, NULL, NULL, 'kdsnkn', 0, NULL, '2021-02-23', NULL, '60350806553ba.PNG', 'photo'),
(63, 1, 'Football', 8, 23, NULL, NULL, NULL, 'kdsnkn', 0, NULL, '2021-02-23', NULL, '60350abfe7c22.PNG', 'photo'),
(64, 1, 'Football', 3, 62, NULL, NULL, NULL, 'kndknclsk', 0, NULL, '2021-02-23', NULL, '60350fcdee45d.PNG', 'printingshirts'),
(65, 1, 'Football', 3, 62, NULL, NULL, NULL, 'm cxks ', 0, NULL, '2021-02-23', NULL, '60350ff3825d2.pdf', 'printingshirts'),
(68, 1, 'Football', 19, 72, NULL, NULL, NULL, 'lkds', 0, NULL, '2021-02-23', NULL, '6035122147d71.pdf', 'printing'),
(69, 1, 'Ishockey', 3, 62, NULL, NULL, NULL, 'knkldnvl', 0, NULL, '2021-02-23', NULL, '603512868abaf.png', 'printingshirts'),
(70, 1, 'Ishockey', 3, 62, NULL, NULL, NULL, 'knkldnvl', 0, NULL, '2021-02-23', NULL, '6035156212fff.png', 'printingshirts'),
(71, 1, 'Football', 2, 3, NULL, NULL, NULL, 'lksdhnckl', 0, NULL, '2021-02-23', NULL, '60351e30a8c45.png', 'tickets'),
(72, 1, 'Football', 2, 3, NULL, NULL, NULL, 'mvbfdkjkv', 0, NULL, '2021-02-23', NULL, '60351e5e2852d.png', 'tickets'),
(73, 1, 'Football', 8, 24, NULL, NULL, NULL, 'jsdbfk', 0, NULL, '2021-02-23', NULL, '60352adba659a.png', 'tournamentsystem'),
(74, 1, 'Football', 19, 73, NULL, NULL, NULL, 'kdknbln', 0, NULL, '2021-02-23', NULL, '60352eb98b0a9.png', 'transfermarks'),
(75, 1, 'Football', 16, 68, NULL, NULL, '500meter square', 'klnkldnkl', 0, NULL, '2021-02-23', NULL, '60353092a94ba.png', NULL),
(76, 1, 'Football', 16, 68, NULL, NULL, '500 meter square', 'klnkldnkl', 0, NULL, '2021-02-23', NULL, '603531252c0f1.png', NULL),
(81, 1, 'Football', 2, 71, NULL, NULL, NULL, 'description', 0, NULL, '2021-02-24', NULL, '60364b64afa65.pptx', 'tournament'),
(82, 1, 'Football', 2, 2, NULL, NULL, NULL, ' dlfk nk', 0, NULL, '2021-02-24', NULL, '603650246d2f2.pptx', 'trainingcamps'),
(84, 1, 'Football', 2, 4, NULL, NULL, NULL, 'nlkncdn', 0, NULL, '2021-02-24', NULL, '60365627da79f.pptx', 'transport'),
(86, 1, 'Football', 3, 9, 9, '#0b5394', 'bj', 'sdlknfdkl', 0, NULL, '2021-03-18', NULL, NULL, NULL),
(87, 1, 'Football', 2, 3, NULL, NULL, NULL, 'iknnl', 0, NULL, '2021-03-18', NULL, '605377ea6e810.', 'tickets'),
(88, 1, 'Football', 3, 8, 7, 'red', 'ksdnkvn', '\r\njbwdkfbcjk\r\n', 0, NULL, '2021-03-18', NULL, '', NULL),
(89, 1, 'Handball', 16, 68, NULL, NULL, '6 meter square', '123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890\r\n\r\nTesting \r\n\r\nTesting ', 0, NULL, '2021-03-18', NULL, '', NULL),
(90, 1, 'Ishockey', 2, 118, NULL, NULL, NULL, 'heloo', 0, NULL, '2021-03-23', NULL, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `diplomer`
--

CREATE TABLE `diplomer` (
  `request_id` int(11) NOT NULL,
  `OwnDesign` varchar(10) NOT NULL,
  `NeedDesignHelp` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dugnad`
--

CREATE TABLE `dugnad` (
  `request_id` int(11) NOT NULL,
  `No_of_People` int(11) NOT NULL,
  `No_of_Products_Per_Person` int(11) NOT NULL,
  `No_of_Sales_Rounds` int(11) NOT NULL,
  `Toilet_Paper` varchar(10) NOT NULL,
  `Paper_Towels` varchar(10) NOT NULL,
  `Socks` varchar(10) NOT NULL,
  `Lighter_Briquettes` varchar(10) NOT NULL,
  `Cleaning_Products` varchar(10) NOT NULL,
  `Cookies_and_Goodies` varchar(10) NOT NULL,
  `Card` varchar(10) NOT NULL,
  `Meat` varchar(10) NOT NULL,
  `Other` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE `invitations` (
  `request_id` int(11) NOT NULL,
  `Need_Design_Help` varchar(5) NOT NULL,
  `Size_of_Print` varchar(20) NOT NULL,
  `No_of_articles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invitations`
--

INSERT INTO `invitations` (`request_id`, `Need_Design_Help`, `Size_of_Print`, `No_of_articles`) VALUES
(54, 'Yes', 'Large', 19);

-- --------------------------------------------------------

--
-- Table structure for table `massage_table`
--

CREATE TABLE `massage_table` (
  `request_id` int(11) NOT NULL,
  `No_of_Massage_Tables` int(11) NOT NULL,
  `Portable` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `massage_table`
--

INSERT INTO `massage_table` (`request_id`, `No_of_Massage_Tables`, `Portable`) VALUES
(57, 10, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `medaljer`
--

CREATE TABLE `medaljer` (
  `request_id` int(11) NOT NULL,
  `No_of_Medals` int(11) NOT NULL,
  `No_of_Trophies` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medaljer`
--

INSERT INTO `medaljer` (`request_id`, `No_of_Medals`, `No_of_Trophies`) VALUES
(56, 9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `news_headline` varchar(200) DEFAULT NULL,
  `news_description` text NOT NULL,
  `image_name` varchar(90) DEFAULT NULL,
  `top_news` int(11) NOT NULL DEFAULT 0 COMMENT '1 for yes',
  `posted_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `news_headline`, `news_description`, `image_name`, `top_news`, `posted_on`) VALUES
(168, 'Vi er sikre på at vår tjeneste vil bidra til å redusere verdifull tid for deres klubb eller lag, samtidig som den gir flere bedrifter mulighet til å kjempe om deres bestilling. På denne måte', 'Vi er sikre på at vår tjeneste vil bidra til å redusere verdifull tid for deres klubb eller lag, samtidig som den gir flere bedrifter mulighet til å kjempe om deres bestilling. På denne måten vil den endelige tilbudsprisen skvises til det ytterste, og deres klubb eller lag vil oppleve å spare penger på et planlagt kjøp. \r\n\r\nMen for å gjøre bruken enda mer spennende vil vi hvert kvartal belønne en klubb eller lag som har benyttet vår tjeneste. Den heldige vinneren vil motta produkter eller tjenester plukket ut fra våre partner-bedrifter. \r\n\r\nVinneren vil bli annonsert via våre kanaler, samt kontaktet direkte. \r\n', '60213f677a1be.png', 1, '2021-02-08 18:15:49'),
(171, 'Gode grunner til å bli leverandør', 'Vurderer din bedrift å registrere seg som leverandør hos SportsReg? Da er det ikke mer å vurdere – bare gjør det. Og her skal vi gi deg noen gode grunner til å gjøre akkurat det.\r\n\r\n<b>1. Få tilgang til flere kunder</b>\r\nUndersøkelser viser at 80% av klubber og lag kun innhenter tilbud fra 1-3 tilbydere. Det betyr at det er mange bedrifter og leverandører som ikke får være med på leken. Ved hjelp av SportsReg vil derfor din bedrift få tilgang til flere kunder rett i innboksen.\r\n\r\n<b>2. Kunder i kjøpsmodus</b>\r\nKlubber og lag som benytter SportsReg er ikke bare nysgjerrige, men de er også i kjøpsmodus og har planer om å gjennomføre et kjøp i nær fremtid. Ved å være en del av SportsReg vil din bedrift møte kunder som gis mulighet til å øke deres inntjening.\r\n\r\n<b>3. Økt omsetning og inntjening</b>\r\nVia SportsReg vil din bedrift kunne øke sin omsetning og inntjening ved at dere får direkte tilgang til nye klubb-bestillinger. Bestillinger dere ellers ville gått glipp av. \r\n\r\n<b>4. Kostnadseffektivt</b>\r\nDet finnes utallige markedsmuligheter - noen mer kostnadskrevende enn andre. Å registrere seg for å benytte SportsReg er en utrolig billig investering, og en kostnadseffektiv måte for å tilnærme seg nye kunder og nye salg. \r\n', '602140d335fae.png', 0, '2021-02-08 18:46:59'),
(172, 'Velkommen til SportsReg', 'Velkommen til SportsReg og vår nye tjeneste for klubber, lag og enkeltpersoner. En tjeneste som har som formål å redusere både tid og kostnad knyttet til kjøp i idretten. \r\n\r\nI stedet for å søke opp, undersøke, kontakte og diskutere kjøp med flere leverandører kan du ved hjelp av SportsReg registrere ditt kjøpsønske, og få tilbud fra én eller flere leverandører. På denne måten vil de ulike leverandørene kjempe om nettopp deres bestilling, ved å gi et konkurransedyktig tilbud slik at de vinner salget. Dette kommer ditt lag eller klubb til gode, da leverandørene blir nødt til å skvise sine marginer, og du vil dermed oppleve å spare penger på et planlagt kjøp. \r\n\r\nÅ benytte SportsReg er helt gratis, og det er ingen krav til å gjennomføre et kjøp etter at din forespørsel er registrert. \r\nLes mer om vår tjeneste her:\r\n<a href=\"./FAQ.php\">FAQs</a>\r\n<a href=\"./howitworks.php\">How it works</a>\r\n<a href=\"./terms.php\">Conditions and terms</a>\r\n', '6021416d8a2c6.png', 0, '2021-02-08 18:49:33');

-- --------------------------------------------------------

--
-- Table structure for table `offer_messages`
--

CREATE TABLE `offer_messages` (
  `message_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `message` varchar(200) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `request_id` int(11) NOT NULL,
  `sentby` int(11) NOT NULL COMMENT '0 for club, 1 for business',
  `status` int(11) NOT NULL DEFAULT 0,
  `is_seen` int(11) NOT NULL DEFAULT 0 COMMENT 'O for unseen,1 for seen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offer_messages`
--

INSERT INTO `offer_messages` (`message_id`, `business_id`, `club_id`, `message`, `datetime`, `request_id`, `sentby`, `status`, `is_seen`) VALUES
(3, 12, 1, 'ojpfe', '2021-03-01 20:03:30', 25, 1, 0, 1),
(4, 12, 1, 'lknekln', '2021-03-01 20:03:45', 25, 1, 0, 1),
(5, 12, 1, 'usama', '2021-03-01 20:06:51', 25, 1, 0, 1),
(6, 12, 1, 'ldmflmd;l', '2021-03-01 20:12:55', 30, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `request_id` int(11) NOT NULL,
  `No_of_Teams` int(11) NOT NULL,
  `No_of_Players` int(11) NOT NULL,
  `Date_of_Photo` varchar(40) NOT NULL,
  `Team_Photo` varchar(5) NOT NULL,
  `Player_Photo` varchar(5) NOT NULL,
  `Action_Photo` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`request_id`, `No_of_Teams`, `No_of_Players`, `Date_of_Photo`, `Team_Photo`, `Player_Photo`, `Action_Photo`) VALUES
(62, 3, 3, '2021-02-05', 'No', 'Yes', 'Yes'),
(63, 3, 3, '2021-02-05', 'No', 'Yes', 'Yes'),
(64, 0, 0, '', 'No', 'No', 'No'),
(65, 0, 0, '', 'No', 'No', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `printing`
--

CREATE TABLE `printing` (
  `request_id` int(11) NOT NULL,
  `Total_no_of_prints` int(11) NOT NULL,
  `No_of_different_prints` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `printing`
--

INSERT INTO `printing` (`request_id`, `Total_no_of_prints`, `No_of_different_prints`) VALUES
(68, 7, 8);

-- --------------------------------------------------------

--
-- Table structure for table `printingshirts`
--

CREATE TABLE `printingshirts` (
  `request_id` int(11) NOT NULL,
  `No_of_articles_to_Print` int(11) NOT NULL,
  `Prints_per_Article` int(11) NOT NULL,
  `Need_Print_Marks` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `printingshirts`
--

INSERT INTO `printingshirts` (`request_id`, `No_of_articles_to_Print`, `Prints_per_Article`, `Need_Print_Marks`) VALUES
(69, 12, 11, 'Yes'),
(70, 12, 11, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `form_name` varchar(40) NOT NULL DEFAULT 'genericform2.php',
  `sports` varchar(40) NOT NULL DEFAULT 'Football'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `product_name`, `form_name`, `sports`) VALUES
(2, 2, 'Treningsleir', 'TrainingCamps.php', 'Football'),
(3, 2, 'Fotballbilletter', 'Tickets.php', 'Football'),
(4, 2, 'Transport', 'Transport.php', 'Football'),
(5, 2, 'Halleie', 'genericform1.php', 'Football'),
(7, 3, 'Arenareklame/skilt/banner', 'banners.php', 'Football'),
(8, 3, 'Led-reklame', 'genericform1.php', 'Football'),
(9, 3, 'Klubb, supporter og profileringsartikler', 'genericform1.php', 'Football'),
(10, 3, 'Invitasjoner', 'genericform1.php', 'Football'),
(11, 4, 'Medaljer/pokaler', 'Medaljer.php', 'Football'),
(12, 4, 'Diplom', 'Diplomer.php', 'Football'),
(13, 2, 'Overnatting', 'genericform1.php', 'Football'),
(14, 5, 'Klesleverandør / treningsklær', 'genericform1.php', 'Football'),
(15, 5, 'Baller', 'genericform2.php', 'Football'),
(16, 5, 'Kjegler, stiger, hekker m.m', 'genericform2.php', 'Football'),
(17, 5, 'Styrkeapparater', 'genericform1.php', 'Football'),
(18, 6, 'Medisinsk utstyr', 'genericform1.php', 'Football'),
(19, 6, 'Massasjebenk', 'medical_msg_form.php', 'Football'),
(20, 7, 'Garderobeinnredning/inventar', 'genericform1.php', 'Football'),
(22, 8, 'Kontorrekvisita og maskiner', 'genericform2.php', 'Football'),
(23, 8, 'Medlemssystem', 'MembershipSystem.php', 'Football'),
(24, 8, 'Turneringssystem', 'TournamentSystem.php', 'Football'),
(25, 8, 'Hjemmesider', 'genericform2.php', 'Football'),
(26, 8, 'Nettbutikkløsning', 'genericform2.php', 'Football'),
(27, 9, 'Tribune', 'genericform2.php', 'Football'),
(28, 9, 'Kunstgress', 'genericform1.php', 'Football'),
(29, 9, 'Gressklippere', 'genericform2.php', 'Football'),
(30, 9, 'Hjørneflagg', 'genericform2.php', 'Football'),
(39, 9, 'Resultattavle', 'genericform2.php', 'Football'),
(40, 9, 'Innbytterskilt', 'genericform2.php', 'Football'),
(41, 9, 'Containere', 'genericform2.php', 'Football'),
(42, 9, 'Telt', 'genericform2.php', 'Football'),
(53, 8, 'Kontor møbler', 'genericform2.php', 'Football'),
(56, 8, 'Grafisk design', 'genericform2.php', 'Football'),
(57, 5, 'Koordinering og teknikk', 'genericform2.php', 'Football'),
(58, 5, 'Vester', 'genericform2.php', 'Football'),
(59, 5, 'Rebounder / små mål', 'genericform2.php', 'Football'),
(60, 5, 'Frispark markør / Dummies', 'genericform2.php', 'Football'),
(61, 5, 'GPS-sporing', 'genericform2.php', 'Football'),
(62, 3, 'Utskrift av skjorter og utstyr', 'prints_of_shirts.php', 'Football'),
(63, 3, 'Invitasjoner eller plakater', 'invitations.php', 'Football'),
(64, 6, 'Isposer', 'ice_pack.php', 'Football'),
(68, 16, 'Garderobeinventar/-innredning', 'wardrobe_furniture.php', 'Football'),
(70, 18, 'Fotograf', 'photo.php', 'Football'),
(71, 2, 'Turnering', 'Tournament.php', 'Football'),
(72, 19, 'Trykk av drakter og utstyr', 'PrintOfShirtsAndEquipment.php', 'Football'),
(73, 19, 'Trykkmerker', 'TransferMarks.php', 'Football'),
(74, 19, 'Trykk av årsrapporter, brosjyrer m.m.', 'AnnualReportBrochures.php', 'Football'),
(75, 20, 'Treningsklær', 'genericform2.php', 'Football'),
(76, 20, 'Kompresjonstøy', 'genericform2.php', 'Football'),
(77, 20, 'Fotballsko', 'genericform2.php', 'Football'),
(78, 20, 'Leggskinn', 'genericform2.php', 'Football'),
(79, 20, 'Keeperutstyr', 'genericform2.php', 'Football'),
(80, 20, 'Joggesko', 'genericform2.php', 'Football'),
(81, 20, 'Dommerutstyr', 'genericform2.php', 'Football'),
(82, 21, 'Taktikktavle/folie', 'genericform2.php', 'Football'),
(83, 21, 'Stoppeklokke', 'genericform2.php', 'Football'),
(84, 21, 'Fløyte', 'genericform2.php', 'Football'),
(85, 9, 'Digital klokke/måltavle', 'genericform2.php', 'Football'),
(87, 9, 'Innbytterbenker', 'genericform2.php', 'Football'),
(90, 9, 'Mål', 'genericform2.php', 'Football'),
(91, 9, 'Gressklipper', 'genericform2.php', 'Football'),
(92, 9, 'Merkespray', 'genericform2.php', 'Football'),
(93, 9, 'Container', 'genericform2.php', 'Football'),
(95, 21, 'Kjegler og markører', 'genericform2.php', 'Football'),
(96, 21, 'Vester', 'genericform2.php', 'Football'),
(97, 21, 'Treningshekker og porter', 'genericform2.php', 'Football'),
(98, 21, 'Koordinasjon og teknikk', 'genericform2.php', 'Football'),
(99, 21, 'Baller', 'genericform2.php', 'Football'),
(100, 21, 'Skuddvegg/småmål', 'genericform2.php', 'Football'),
(101, 21, 'Frisparkmarkør/Oppblåsbar figur', 'genericform2.php', 'Football'),
(102, 21, 'Treningsstudio-utstyr', 'genericform2.php', 'Football'),
(104, 8, 'Kontormøbler', 'genericform2.php', 'Football'),
(105, 8, 'Nettside-Nettbutikkløsning', 'genericform2.php', 'Football'),
(107, 2, 'Busstransport', 'genericform2.php', 'Football'),
(108, 2, 'Cup', 'genericform2.php', 'Football'),
(109, 6, 'Førstehjelpsutstyr', 'genericform2.php', 'Football'),
(110, 6, 'Sportspleie', 'genericform2.php', 'Football'),
(111, 6, 'Sportsteip/strømpeteip', 'genericform2.php', 'Football'),
(112, 6, 'Sportsernæring', 'genericform2.php', 'Football'),
(113, 22, 'Dugnad', 'Dugnad.php', 'Football'),
(114, 10, 'Inntektsbringende', 'genericform2.php', 'Football'),
(118, 2, 'test product', 'genericform2.php', 'Ishockey');

-- --------------------------------------------------------

--
-- Table structure for table `sports`
--

CREATE TABLE `sports` (
  `sports_id` int(11) NOT NULL,
  `sports_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sports`
--

INSERT INTO `sports` (`sports_id`, `sports_name`) VALUES
(1, 'Football'),
(2, 'Ishockey'),
(5, 'Handball'),
(7, 'Cricket');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `request_id` int(11) NOT NULL,
  `No_of_Tickets` int(11) NOT NULL,
  `Home_Team` varchar(30) NOT NULL,
  `Ticket_Type` varchar(30) NOT NULL,
  `Time_and_Opponent` varchar(50) NOT NULL,
  `No_of_Single_rooms` int(11) NOT NULL,
  `No_of_Double_rooms` int(11) NOT NULL,
  `No_of_Triple_rooms` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`request_id`, `No_of_Tickets`, `Home_Team`, `Ticket_Type`, `Time_and_Opponent`, `No_of_Single_rooms`, `No_of_Double_rooms`, `No_of_Triple_rooms`) VALUES
(71, 4, 'Lahore', 'Premium/VIP tickets', 'nslfsk', 0, 0, 0),
(72, 8, 'Lahore', 'Ordinary tickets', 'kfncskln', 8, 8, 3),
(87, 8, 'Lahore', 'Ordinary tickets', 'kfncskln', 8, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tournament`
--

CREATE TABLE `tournament` (
  `request_id` int(11) NOT NULL,
  `No_of_Players` int(11) NOT NULL,
  `No_of_Coaches` int(11) NOT NULL,
  `No_of_Single_rooms` int(11) NOT NULL,
  `No_of_Double_rooms` int(11) NOT NULL,
  `No_of_Triple_rooms` int(11) NOT NULL,
  `Desirable_time_of_tournament` varchar(100) NOT NULL,
  `Gender_and_Age` varchar(30) NOT NULL,
  `Grass_Artificial_Club` varchar(30) NOT NULL,
  `Norway` varchar(5) NOT NULL,
  `Spain` varchar(5) NOT NULL,
  `TheNetherlands` varchar(5) NOT NULL,
  `Germany` varchar(5) NOT NULL,
  `Sweden` varchar(5) NOT NULL,
  `Turkey` varchar(5) NOT NULL,
  `Malta` varchar(5) NOT NULL,
  `Dubai` varchar(5) NOT NULL,
  `Denmark` varchar(5) NOT NULL,
  `Cyprus` varchar(5) NOT NULL,
  `England` varchar(5) NOT NULL,
  `France` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tournament`
--

INSERT INTO `tournament` (`request_id`, `No_of_Players`, `No_of_Coaches`, `No_of_Single_rooms`, `No_of_Double_rooms`, `No_of_Triple_rooms`, `Desirable_time_of_tournament`, `Gender_and_Age`, `Grass_Artificial_Club`, `Norway`, `Spain`, `TheNetherlands`, `Germany`, `Sweden`, `Turkey`, `Malta`, `Dubai`, `Denmark`, `Cyprus`, `England`, `France`) VALUES
(81, 11, 4, 4, 2, 1, 'jfdvkbjweb ', 'Male 22', 'Grass', 'Yes', 'Yes', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'Yes', 'No', 'No', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tournamentsystem`
--

CREATE TABLE `tournamentsystem` (
  `request_id` int(11) NOT NULL,
  `No_of_Tournaments` int(11) NOT NULL,
  `No_of_Teams` int(11) NOT NULL,
  `No_of_Matches` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tournamentsystem`
--

INSERT INTO `tournamentsystem` (`request_id`, `No_of_Tournaments`, `No_of_Teams`, `No_of_Matches`) VALUES
(73, 7, 10, 9);

-- --------------------------------------------------------

--
-- Table structure for table `trainingcamps`
--

CREATE TABLE `trainingcamps` (
  `request_id` int(11) NOT NULL,
  `No_of_Players` int(11) NOT NULL,
  `No_of_Coaches` int(11) NOT NULL,
  `No_of_Single_rooms` int(11) NOT NULL,
  `No_of_Double_rooms` int(11) NOT NULL,
  `No_of_Triple_rooms` int(11) NOT NULL,
  `Desirable_time_of_tournament` varchar(100) NOT NULL,
  `No_of_Days` int(11) NOT NULL,
  `No_of_Trainings_per_Day` int(11) NOT NULL,
  `No_of_Training_Matches` int(11) NOT NULL,
  `Grass_Artificial_Club` varchar(30) NOT NULL,
  `Norway` varchar(5) NOT NULL,
  `Spain` varchar(5) NOT NULL,
  `TheNetherlands` varchar(5) NOT NULL,
  `Germany` varchar(5) NOT NULL,
  `Sweden` varchar(5) NOT NULL,
  `Turkey` varchar(5) NOT NULL,
  `Malta` varchar(5) NOT NULL,
  `Dubai` varchar(5) NOT NULL,
  `Denmark` varchar(5) NOT NULL,
  `Cyprus` varchar(5) NOT NULL,
  `England` varchar(5) NOT NULL,
  `France` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trainingcamps`
--

INSERT INTO `trainingcamps` (`request_id`, `No_of_Players`, `No_of_Coaches`, `No_of_Single_rooms`, `No_of_Double_rooms`, `No_of_Triple_rooms`, `Desirable_time_of_tournament`, `No_of_Days`, `No_of_Trainings_per_Day`, `No_of_Training_Matches`, `Grass_Artificial_Club`, `Norway`, `Spain`, `TheNetherlands`, `Germany`, `Sweden`, `Turkey`, `Malta`, `Dubai`, `Denmark`, `Cyprus`, `England`, `France`) VALUES
(82, 9, 9, 12, 10, 14, 'jfdvkbjweb ', 66, 22, 22, 'klxn', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'Yes', 'No', 'No', 'No', 'No', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `transfermarks`
--

CREATE TABLE `transfermarks` (
  `request_id` int(11) NOT NULL,
  `Total_transfer_marks` int(11) NOT NULL,
  `No_of_different_transfer_marks` int(11) NOT NULL,
  `Size_of_transfer_marks` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transfermarks`
--

INSERT INTO `transfermarks` (`request_id`, `Total_transfer_marks`, `No_of_different_transfer_marks`, `Size_of_transfer_marks`) VALUES
(74, 9, 10, 'lks');

-- --------------------------------------------------------

--
-- Table structure for table `transport`
--

CREATE TABLE `transport` (
  `request_id` int(11) NOT NULL,
  `No_of_People_Travelling` int(11) NOT NULL,
  `Date_of_Travel` varchar(40) NOT NULL,
  `Place_of_Departure` varchar(50) NOT NULL,
  `Place_of_Arrival` varchar(50) NOT NULL,
  `Date_of_Return` varchar(40) NOT NULL,
  `Place_of_Departure_for_Return` varchar(50) NOT NULL,
  `Place_of_Arrival_for_Return` varchar(50) NOT NULL,
  `Round_Trip` varchar(5) NOT NULL,
  `With_Driver` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transport`
--

INSERT INTO `transport` (`request_id`, `No_of_People_Travelling`, `Date_of_Travel`, `Place_of_Departure`, `Place_of_Arrival`, `Date_of_Return`, `Place_of_Departure_for_Return`, `Place_of_Arrival_for_Return`, `Round_Trip`, `With_Driver`) VALUES
(84, 5, '2021-01-01', 'LAhejf', 'klnslvnwkl', '2026-07-04', 'knkldsnlvk', ' nlknmmnlm', 'Yes', 'Yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ar_brouchures`
--
ALTER TABLE `ar_brouchures`
  ADD KEY `req_id_ARB` (`request_id`);

--
-- Indexes for table `business_categories`
--
ALTER TABLE `business_categories`
  ADD PRIMARY KEY (`business_category_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `c_id` (`business_id`);

--
-- Indexes for table `business_counties`
--
ALTER TABLE `business_counties`
  ADD PRIMARY KEY (`business_counties_id`),
  ADD KEY `b_id1` (`business_id`);

--
-- Indexes for table `business_info`
--
ALTER TABLE `business_info`
  ADD PRIMARY KEY (`business_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `business_products`
--
ALTER TABLE `business_products`
  ADD PRIMARY KEY (`business_products_id`),
  ADD KEY `b_id2` (`business_id`),
  ADD KEY `bp_id0` (`product_id`),
  ADD KEY `bc_id` (`category_id`);

--
-- Indexes for table `business_sports`
--
ALTER TABLE `business_sports`
  ADD PRIMARY KEY (`business_sports_id`),
  ADD UNIQUE KEY `business_id` (`business_id`,`sports_name`),
  ADD KEY `sports_key` (`sports_name`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`club_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `club_requests`
--
ALTER TABLE `club_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `req_cat` (`category_id`),
  ADD KEY `req_pro` (`product_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `diplomer`
--
ALTER TABLE `diplomer`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `dugnad`
--
ALTER TABLE `dugnad`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `massage_table`
--
ALTER TABLE `massage_table`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `medaljer`
--
ALTER TABLE `medaljer`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `offer_messages`
--
ALTER TABLE `offer_messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `req_id_fkey` (`request_id`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `printingshirts`
--
ALTER TABLE `printingshirts`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `category_id` (`category_id`,`product_name`),
  ADD KEY `sports` (`sports`);

--
-- Indexes for table `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`sports_id`,`sports_name`),
  ADD UNIQUE KEY `sports_name` (`sports_name`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `tournament`
--
ALTER TABLE `tournament`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `tournamentsystem`
--
ALTER TABLE `tournamentsystem`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `transfermarks`
--
ALTER TABLE `transfermarks`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `transport`
--
ALTER TABLE `transport`
  ADD PRIMARY KEY (`request_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business_categories`
--
ALTER TABLE `business_categories`
  MODIFY `business_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `business_counties`
--
ALTER TABLE `business_counties`
  MODIFY `business_counties_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `business_info`
--
ALTER TABLE `business_info`
  MODIFY `business_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `business_products`
--
ALTER TABLE `business_products`
  MODIFY `business_products_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `business_sports`
--
ALTER TABLE `business_sports`
  MODIFY `business_sports_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `club_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `club_requests`
--
ALTER TABLE `club_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `offer_messages`
--
ALTER TABLE `offer_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `sports`
--
ALTER TABLE `sports`
  MODIFY `sports_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ar_brouchures`
--
ALTER TABLE `ar_brouchures`
  ADD CONSTRAINT `req_id_ARB` FOREIGN KEY (`request_id`) REFERENCES `club_requests` (`request_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `business_categories`
--
ALTER TABLE `business_categories`
  ADD CONSTRAINT `b_id` FOREIGN KEY (`business_id`) REFERENCES `business_info` (`business_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `c_id` FOREIGN KEY (`business_id`) REFERENCES `business_info` (`business_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `business_counties`
--
ALTER TABLE `business_counties`
  ADD CONSTRAINT `b_id1` FOREIGN KEY (`business_id`) REFERENCES `business_info` (`business_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `business_products`
--
ALTER TABLE `business_products`
  ADD CONSTRAINT `b_id2` FOREIGN KEY (`business_id`) REFERENCES `business_info` (`business_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bc_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bp_id0` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `business_sports`
--
ALTER TABLE `business_sports`
  ADD CONSTRAINT `b_id5` FOREIGN KEY (`business_id`) REFERENCES `business_info` (`business_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sports_key` FOREIGN KEY (`sports_name`) REFERENCES `sports` (`sports_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `club_requests`
--
ALTER TABLE `club_requests`
  ADD CONSTRAINT `club_id` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`club_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `req_cat` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `req_pro` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `diplomer`
--
ALTER TABLE `diplomer`
  ADD CONSTRAINT `req_id_diplom` FOREIGN KEY (`request_id`) REFERENCES `club_requests` (`request_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dugnad`
--
ALTER TABLE `dugnad`
  ADD CONSTRAINT `req_id_dugnad` FOREIGN KEY (`request_id`) REFERENCES `club_requests` (`request_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invitations`
--
ALTER TABLE `invitations`
  ADD CONSTRAINT `req_id_invite` FOREIGN KEY (`request_id`) REFERENCES `club_requests` (`request_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `massage_table`
--
ALTER TABLE `massage_table`
  ADD CONSTRAINT `req_id_table` FOREIGN KEY (`request_id`) REFERENCES `club_requests` (`request_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medaljer`
--
ALTER TABLE `medaljer`
  ADD CONSTRAINT `req_id_medaljer` FOREIGN KEY (`request_id`) REFERENCES `club_requests` (`request_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `offer_messages`
--
ALTER TABLE `offer_messages`
  ADD CONSTRAINT `req_id_fkey` FOREIGN KEY (`request_id`) REFERENCES `club_requests` (`request_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `req_id_photoc` FOREIGN KEY (`request_id`) REFERENCES `club_requests` (`request_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `printingshirts`
--
ALTER TABLE `printingshirts`
  ADD CONSTRAINT `req_id_shirts` FOREIGN KEY (`request_id`) REFERENCES `club_requests` (`request_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `category_key` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sports` FOREIGN KEY (`sports`) REFERENCES `sports` (`sports_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `req_id_tickets` FOREIGN KEY (`request_id`) REFERENCES `club_requests` (`request_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tournament`
--
ALTER TABLE `tournament`
  ADD CONSTRAINT `req_id_tournament` FOREIGN KEY (`request_id`) REFERENCES `club_requests` (`request_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tournamentsystem`
--
ALTER TABLE `tournamentsystem`
  ADD CONSTRAINT `req_id_tsystem` FOREIGN KEY (`request_id`) REFERENCES `club_requests` (`request_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transfermarks`
--
ALTER TABLE `transfermarks`
  ADD CONSTRAINT `req_id_tmarks` FOREIGN KEY (`request_id`) REFERENCES `club_requests` (`request_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transport`
--
ALTER TABLE `transport`
  ADD CONSTRAINT `req_id_transport` FOREIGN KEY (`request_id`) REFERENCES `club_requests` (`request_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
